<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package IO
 */

require_once('SEMException.class.php');
require_once('String.class.php');
require_once('IO/File.class.php');

class FileNotFoundException extends SEMException
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
        function FileNotFoundException ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_FileNotFoundException'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _FileNotFoundException0 ()
        {
                $this->_initialise();
        }
        
        
        function _FileNotFoundException1 ( $obj )
        {
                $this->_initialise();
                if ( File::instanceOf($obj, 'File') )
                {
                        $this->file =& new String($obj->toString());
                }
                elseif ( String::instanceOf($obj, 'String') )
                {
                        $this->file =& $obj;
                }
                elseif ( is_string($obj) )
                {
                        $this->file =& new String($obj);
                }
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
        
        
        function isFileNotFoundException ( &$obj )
        {
                if ( @is_a($obj, 'FileNotFoundException') ||
                        @is_subclass_of($obj, 'FileNotFoundException') )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
