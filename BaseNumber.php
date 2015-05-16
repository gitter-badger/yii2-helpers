<?php

/*
 *   _   __ __ _____ _____ ___  ____  _____
 *  | | / // // ___//_  _//   ||  __||_   _|
 *  | |/ // /(__  )  / / / /| || |     | |
 *  |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2015 vistart
 * @license http://vistart.name/license/
 */

namespace vistart\Helpers;

/**
 * Description of BaseNumber
 *
 * @author vistart <i@vistart.name>
 */
class BaseNumber 
{
    /**
     * Generate the guid with parameters.
     * @param boolean $need_braces Determines whether it needs both sides of braces.
     * @param boolean $lowercase Determines whether it needs to be lower case.
     * @return string the Guid generated with parameters.
     */
    public static function guid($need_braces = false, $lowercase = false)
    {
        if (function_exists('com_create_guid')){
            $uuid = com_create_guid();
        } else {
            mt_srand((double)microtime() * 1000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = chr(123)
                    .substr($charid, 0, 8) . $hyphen
                    .substr($charid, 8, 4) . $hyphen
                    .substr($charid, 12, 4) . $hyphen
                    .substr($charid, 16, 4) . $hyphen
                    .substr($charid, 20, 12) . chr(125);
        }
        if ($need_braces === false)
        {
            $uuid = (($need_braces == true) ? $uuid : trim($uuid, '{}'));
        }
        return ($lowercase === true ? strtolower($uuid) : $uuid);
    }
    
    /**
     * Generate the random number.
     * @param string $prefix
     * @param integer $length
     * @return string Random number string.
     */
    public static function randomNumber($prefix = '4', $length = 8)
    {
        $key = "";
        $pattern = '1234567890';
        for ($i = 0; $i < $length - strlen($prefix); $i++)
        {
            $key .= $pattern[mt_rand(0, 9)];
        }
        return $prefix . $key;
    }
}
