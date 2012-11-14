<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.1
 * @date 2005-08-23
 * @package core
 * @abstract
 */

require_once('SEMObject.class.php');

class Debug extends SEMObject
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
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        /**
         * @abstract
         */
        function Debug ()
        {
                die('Class Debug is Abstract and cannot be instantiated.');
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
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function debugMsg ( $level, $msg )
        {
                if ( is_object($GLOBALS['debugStream']) )
                {
                        $GLOBALS['debugStream']->debugMsg($level, $msg);
                }
                else
                {
                        print $msg;
                }
        }
        
        
        /**
         * Flushes the debug stream buffer
         *
         * Flush the debug stream buffer forcing anything in the buffer to be
         * written to the debug stream
         *
         * @static
         * @access public
         */
        function flush ()
        {
                $GLOBALS['debugStream']->flush();
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
