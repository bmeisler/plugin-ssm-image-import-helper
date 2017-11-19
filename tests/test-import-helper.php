<?php

require_once '/private/var/www/html/employers/theme-gd-b2b-sage/app/plugins/GDImageImportHelper/GDImageImportHelper.class.php';

class ImportHelperTest extends WP_UnitTestCase
{

    /**
     * @var an instance of the ImageImportHelper class
     */
    private $ih;

    /**
     * create an instance of the object we will be testing against
     */
    public function setup(){
        $this->ih = new \GDImageImportHelper\ImageImportHelper();
    }

    /**
     * testing gd_ih_cleanUpFileName
     * an overall test for a terrible file name; this function uses the URLUtils function
     */
    public function testGd_ih_cleanUpFileName(){
        $originalString = "Glass.door's-Guide()...@ to___ ?(*Employee's_#$@Satisfaction.jpeg";
        $expectedResult = "glass-doors-guide-to-employees-satisfaction.jpeg";
        $result = $this->ih->gd_iih_cleanUpFileName($originalString);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * testing gd_iih_checkForBadNames
     * testing our expected bad file names against the array of bad file names
     */
    public function testGd_iih_checkForBadNames(){
        $testString = "This is Screen Shot 23423.3";
        $expectedResult = "screenshot";
        $result = $this->ih->gd_iih_checkForBadNames($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "This is iStock 23423.3";
        $expectedResult = "istock";
        $result = $this->ih->gd_iih_checkForBadNames($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "This is DSC 23423.3";
        $expectedResult = "dsc";
        $result = $this->ih->gd_iih_checkForBadNames($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "";
        $expectedResult = "";
        $result = $this->ih->gd_iih_checkForBadNames($testString);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * testing gd_iih_getBadNameKey
     * making sure that the expected bad file names return the expected key
     */
    public function testGd_iih_getBadNameKey(){
        $testString = "screenshot";
        $expectedResult = "Screen Shot";
        $result = $this->ih->gd_iih_getBadNameKey($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "istock";
        $expectedResult = "iStock";
        $result = $this->ih->gd_iih_getBadNameKey($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "dsc";
        $expectedResult = "DSC";
        $result = $this->ih->gd_iih_getBadNameKey($testString);
        $this->assertEquals($expectedResult, $result);

        $testString = "";
        $expectedResult = "";
        $result = $this->ih->gd_iih_getBadNameKey($testString);
        $this->assertEquals($expectedResult, $result);

    }
}