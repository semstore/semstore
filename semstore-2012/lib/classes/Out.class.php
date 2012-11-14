<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.1
 * @date 2005-08-23
 * @package core
 * @abstract
 */

require_once('SEMObject.class.php');

class Out extends SEMObject
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
        function Out ()
        {
                die('Class Out is Abstract and cannot be instantiated.');
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
         * Write a string to the output stream
         * 
         * @static
         * @access public
         * @param string $str
         */
        function writeOut ( $str )
        {
                if ( is_object($GLOBALS['outputStream']) )
                {
                        $GLOBALS['outputStream']->write($str);
                }
                else
                {
                        print $str;
                }
        }
        
        
        /**
         * Write a string to the output stream terminating the string with a
         * new line character
         * 
         * @static
         * @access public
         * @param string $str
         */
        function writeln ( $str )
        {
                Out::writeOut($str."\n");
        }
        
        
        /**
         * Flushes the output stream buffer
         *
         * Flush the output stream buffer forcing anything in the buffer to be
         * written to the output stream
         * 
         * @static
         * @access public
         */
        function flush ()
        {
                $GLOBALS['outputStream']->flush();
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
