<?php
namespace SSMImageImportHelper;

class URLUtils
{
    /**
     * converts filenames into standardized urls - removes special characters, removes extra whitespace,
     * converts dots into a single space
     * @param $string - the string we want to turn into a standardized url
     * @param string $separator - optional - default is dash
     * @param int $maxLength - optional - default is 96 characters
     * @return mixed|string
     */
    public function ssm_iih_sluggify($string, $separator = '-', $maxLength = 96) {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $title = preg_replace("[\.]", ' ', $title);
        $title = preg_replace("%[^-/+|\w ]%", '', $title);
        $title = strtolower(trim(substr($title, 0, $maxLength), '-'));
        $title = preg_replace("/[\/_|+ -]+/", $separator, $title);

        return $title;
    }

    /**
     * @param $string - the string (eg, a filename) we're turning into a human-readable title
     * @param string $separator - optional string to separate words; default is space
     * @return mixed|string - the human-readable Title
     */
    public function ssm_iih_titlify($string, $separator = ' ') {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $title = preg_replace("[\.]", ' ', $title);
        $title = preg_replace("%[^-'/+|\w ]%", '', $title);
        $title = preg_replace("/[\/_|+ -]+/", $separator, $title);

        return $title;
    }

    /**
     * @param $filename - the file whose extension we are trying to get
     * @return string - the file's extension, eg .jpg, .png, eg myimage.jpg returns .jpg
     */
    public function ssm_iih_getExtension($filename){
        $info = pathinfo($filename);
        $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
        return $ext;
    }

    /**
     * @param $string - the filename whose extension we want to remove
     * @param $ext - the extension we want to remove
     * @return mixed - returns the filename without the extension, eg myimage.jpg returns myimage
     */
    public function ssm_iih_removeExtension($string, $ext){
        $title = str_replace($ext, '', $string);
        return $title;
    }
    
}