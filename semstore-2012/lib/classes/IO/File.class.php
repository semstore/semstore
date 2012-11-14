<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package IO
 */

require_once('SEMObject.class.php');
require_once('IO/FileNotFoundException.class.php');

class File extends SEMObject
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
         * Constructs and instance of object
         *
         * @access public
         */
        function File ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_File'.$numArgs
                                ),
                        $args
                );
        }
        
        
        function _File1 ( $file )
        {
                $this->_initialise();
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
        
        
        function isAbsolute ()
        {
                ;
        }
        
        
        function getAbsoluteFile ()
        {
                ;
        }
        
        
        function getAbsolutePath ()
        {
                ;
        }
        
        
        function getName ()
        {
                ;
        }
        
        
        function getPath ()
        {
                ;
        }
        
        
        function getParentFile ()
        {
                ;
        }
        
        
        function isFile ()
        {
                ;
        }
        
        
        function isDirectory ()
        {
                ;
        }
        
        
        function canRead ()
        {
                ;
        }
        
        
        function canWrite ()
        {
                ;
        }
        
        
        function delete ()
        {
                ;
        }
        
        
        function mkdir ()
        {
                ;
        }
        
        
        function mkdirs ()
        {
                ;
        }
        
        
        function copy ()
        {
                ;
        }
        
        
        function renameTo ()
        {
                ;
        }
        
        
        function toString ()
        {
                ;
        }
        
        
        function equals ()
        {
                ;
        }
}

?>
