<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-04
 * @package DateTime
 */

require_once('Object.clas.php');

require_once('Timezone.clas.php');

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
        
        
        var $day = 0;
        var $month = 0;
        var $year = 0;
        var $hour = 0;
        var $minute = 0;
        var $second = 0;
        var $timezone = Timezone::GMT();
        
        
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
        
        
        function _DateTime0 ()
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
        
        
        function &fromString ( $dateStr )
        {
                ;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function equals ( &$datetime )
        {
                ;
        }
        
        
        function compare ( &$datetime )
        {
                ;
        }
        
        
        function toString ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_toString'.$numArgs),
                        $args);
        }
        
        
        function _toString0 ()
        {
                ;
        }
        
        
        function _toString1 ( $formatStr )
        {
                ;
        }
        
        
        function addDays ( $days )
        {
                ;
        }
        
        
        function addMonths ( $months )
        {
                ;
        }
        
        
        function addYears ( $years )
        {
                ;
        }
        
        
        function addHours ( $hours )
        {
                ;
        }
        
        
        function addMinutes ( $minutes )
        {
                ;
        }
        
        
        function addSeconds ( $seconds )
        {
                ;
        }
        
        
        function subtractDays ( $days )
        {
                ;
        }
        
        
        function subtractMonths ( $months )
        {
                ;
        }
        
        
        function subtractYears ( $years )
        {
                ;
        }
        
        
        function subtractHours ( $hours )
        {
                ;
        }
        
        
        function subtractMinutes ( $minutes )
        {
                ;
        }
        
        
        function secondsDays ( $seconds )
        {
                ;
        }
        
        
        function add ( $hours = 0, $minutes = 0, $seconds = 0,
                $days = 0, $months = 0, $years = 0 )
        {
                ;
        }
        
        
        function subtract ( $hours = 0, $minutes = 0, $seconds = 0,
                $days = 0, $months = 0, $years = 0 )
        {
                ;
        }
}

?>
