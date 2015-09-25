<?php

/**
 * Helper Class for text
 *
 * A class that contains functions for parsing blocks of text or strings.
 *
 * @link       https://github.com/jelofsson
 * @package    WordPress
 * @subpackage Component
 * @since      1.0.0
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 */

/**
 * Helper_Text class
 * 
 * Contains static helper functions for parsing text.
 *
 * @since      1.0.0
 */
class Helper_Text
{
    /**
     * Returns truncated string based on the character count.
     * 
     * @param  string  $str              the input string
     * @param  integer [$length=10]      max character length
     * @param  string  [$trailing='...'] trailing chars
     * @return string  truncated string
     */
    public static function Truncate($str, $length=20, $trailing='...') 
    {
        // take off chars for the trailing
        $length -= strlen($trailing);
        
        if ( strlen( $str ) > $length ) 
        {
            // string exceeded length, truncate and add trailing dots
            $res = substr( $str, 0, $length ) . $trailing;
        } 
        else 
        { 
            // string was already short enough, return the string
            $res = $str; 
        }

        return $res;
    } 
    
}