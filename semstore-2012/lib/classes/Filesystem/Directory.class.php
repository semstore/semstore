<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 */

require_once('SEMObject.class.php');

class Directory extends SEMObject
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
        
        
        var $directoryStr = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function Directory ()
        {
                die('Argggghh');
        }
        
        
        function _Directory1 ( $dir )
        {
                $this->_setDirectoryStr ($dir);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function _getDirectoryString ()
        {
                return $this->directoryStr;
        }
        
        
        function _setDirectoryString ( $dir )
        {
                $this->directoryStr = $dir;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &create ( $dir )
        {
                if ( is_dir($dir) )
                {
                        $dirObj =& new _Directory1($dir);
                }
                
                return NULL;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function toString ()
        {
                ;
        }
}

?>
