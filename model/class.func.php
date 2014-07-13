<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 6/11/14
 * Time: 1:27 AM
 */


/**
 * function to escape data and strip tags
 * @param $string
 * @return string
 */

abstract class Func
{

    // safe all input string and number of any injection and other problem
    public static function safestrip($string) {
        $string = trim($string);
        $string = htmlspecialchars($string);
        $string = strip_tags($string);
        $string = stripslashes($string);
        return $string;
    }

    // check AN IMAGE MIMETYPE
    public static function get_image_mime($theTmpFileloc) {
        $imageMime  = '';
        $tmpResults = getimagesize( $theTmpFileloc );
        $imageMime  = $tmpResults['mime'];

        return $imageMime;
    }
}