<?php

require_once '/private/var/www/html/employers/theme-gd-b2b-sage/app/plugins/GDImageImportHelper/URLUtils.php';

/**
 * a test class for the URLUtils class
 * there are three functions in URLUtils we are testing:
 * 1. Sluggify
 * Class URLTest
 */
class URLTest extends WP_UnitTestCase {


    private $url;

    /**
     * create an instance of the object we will be testing against
     */
    public function setup(){
        $this->url = new URLUtils();
    }
    /**
     * Tests the sluggify function in URLUtils
     * I feed it plain old strings, strings with numbers, special characters,
     * dots, underscores, extra whitespace, an empty string, foreign characters, etc.
     * and expect to get back url-compliant strings (lower case, words separated by dashes, no special characters)
     */
    public function testSluggifyReturns() {

        $originalString = 'This string will be sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This1 string2 will3 be 44 sluggified10';
        $expectedResult = 'this1-string2-will3-be-44-sluggified10';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This! @string#$ %$will/// ()be "sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This.string...will . be ... sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This_string__will_be____sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = "Tänk efter nu – förr'n vi föser dig bort";
        $expectedResult = 'tank-efter-nu-forrn-vi-foser-dig-bort';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = '';
        $expectedResult = '';
        $result = $this->url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);
    }


    /**
     * tests for the titlify function
     * receives a string, returns a good, human-readable title
     * removes special characters, extra white space, turns periods into spaces
     * leaves in capitalization and apostrophes
     */
    public function testTitlifyReturns() {

        $originalString = 'This is a Good Title That seemingly goes on Forever and Ever';
        $expectedResult = 'This is a Good Title That seemingly goes on Forever and Ever';
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This is a_Good Title___That_ seemingly_goes on Forever and Ever';
        $expectedResult = 'This is a Good Title That seemingly goes on Forever and Ever';
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'This! @string#$ %$Will ()be "Titleified';
        $expectedResult = 'This string Will be Titleified';
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = "Tänk Efter nu – förr'n vi föser dig Bort";
        $expectedResult = "Tank Efter nu forr'n vi foser dig Bort";
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = "Glassdoor's Guide to Employee's Satisfaction";
        $expectedResult = "Glassdoor's Guide to Employee's Satisfaction";
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = "Glass.door's-Guide()...@ to___ ?(*Employee's_#$@Satisfaction";
        $expectedResult = "Glass door's Guide to Employee's Satisfaction";
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = "Glassdoor.Guide... to ...Employee . Satisfaction";
        $expectedResult = "Glassdoor Guide to Employee Satisfaction";
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = '';
        $expectedResult = '';
        $result = $this->url->titlify($originalString);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * tests for the getExtension function
     * pass in a filename with extension (eg myimage.jpg), expect to get the extension back (eg .jpg)
     */
    public function testgetExtension(){

        $originalString = 'Sad Snoopy.jpeg';
        $expectedResult = '.jpeg';
        $result = $this->url->getExtension($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'Sad Snoopy.png';
        $expectedResult = '.png';
        $result = $this->url->getExtension($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'Glass.door\'s-Guide()...@ to___ ?(*Employee\'s_#$@Satisfaction.jpeg';
        $expectedResult = '.jpeg';
        $result = $this->url->getExtension($originalString);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'Glassdoor.Guide... to ...Employee . Satisfaction.jpg';
        $expectedResult = ".jpg";
        $result = $this->url->getExtension($originalString);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * testing the removeExtension function
     * pass in a filename with extension, and the extension we want to remove
     * should get back the filename minus the extension
     */
    public function testRemoveExtension(){

        $originalString = 'Sad Snoopy.jpeg';
        $extension = '.jpeg';
        $expectedResult = 'Sad Snoopy';
        $result = $this->url->removeExtension($originalString, $extension);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'Sad Snoopy.png';
        $extension = '.png';
        $expectedResult = 'Sad Snoopy';
        $result = $this->url->removeExtension($originalString, $extension);
        $this->assertEquals($expectedResult, $result);


        $originalString = 'Glass.door\'s-Guide()...@ to___ ?(*Employee\'s_#$@Satisfaction.jpeg';
        $extension = '.jpeg';
        $expectedResult = 'Glass.door\'s-Guide()...@ to___ ?(*Employee\'s_#$@Satisfaction';
        $result = $this->url->removeExtension($originalString, $extension);
        $this->assertEquals($expectedResult, $result);

        $originalString = 'Glassdoor.Guide... to ...Employee . Satisfaction.jpg';
        $extension = '.jpg';
        $expectedResult = 'Glassdoor.Guide... to ...Employee . Satisfaction';
        $result = $this->url->removeExtension($originalString, $extension);
        $this->assertEquals($expectedResult, $result);

    }
    
}