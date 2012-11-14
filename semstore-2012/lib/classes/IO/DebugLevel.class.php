<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('SEMObject.class.php');

class DebugLevel extends SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        var $OFF = 0;
        var $DEBUG = 1;
        var $INFO = 2;
        var $WARN = 3;
        var $ERROR = 4;
        var $FATAL = 5;
        
        
        function OFF () { return 0; }
        function DEBUG () { return 1; }
        function INFO () { return 2; }
        function WARN () { return 3; }
        function ERROR () { return 4; }
        function FATAL () { return 5; }
        
        
	/**
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function DebugLevel ()
        {
                die("Class '" . get_class($this) . "' is abstract and cannot be" .
                        " instantiated.");
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
