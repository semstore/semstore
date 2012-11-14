<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-01-16
 * @package Core
 */

class DateTime extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        //var $timestamp = NULL;
        var $dayOfYear = 0;
        var $dayOfWeek = 0;
        var $dayOfMonth = 0;
        var $week = 0;
        
        var $year = 0;
        var $month = 0;
        var $day = 0;
        var $hour = 0;
        var $minute = 0;
        var $second = 0;
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function DateTime ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_DateTime'.$numArgs),
                        $args);
        }
        
        
        function _DateTime1 ( $timestamp )
        {
                ;
        }
        
        
        function _DateTime6 ( $year, $month, $day, $hour, $minute, $second )
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
