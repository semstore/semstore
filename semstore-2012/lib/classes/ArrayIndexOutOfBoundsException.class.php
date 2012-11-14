<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package core
 */

require_once('IndexOutOfBoundsException.class.php');

class ArrayIndexOutOfBoundsException extends IndexOutOfBoundsException
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
        function ArrayIndexOutOfBoundsException ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_ArrayIndexOutOfBoundsException'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _ArrayIndexOutOfBoundsException0 ()
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
        
        
        function isArrayIndexOutOfBoundsException ( &$obj )
        {
                if ( @is_a($obj, 'ArrayIndexOutOfBoundsException') ||
                        @is_subclass_of($obj, 'ArrayIndexOutOfBoundsException') )
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
