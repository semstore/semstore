<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package core
 */

require_once('IndexOutOfBoundsException.class.php');

class StringIndexOutOfBoundsException extends IndexOutOfBoundsException
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
        function StringIndexOutOfBoundsException ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_StringIndexOutOfBoundsException'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _StringIndexOutOfBoundsException0 ()
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
        
        
        function isStringIndexOutOfBoundsException ( &$obj )
        {
                if ( @@is_a($obj, 'StringIndexOutOfBoundsException') ||
                        @@is_subclass_of($obj, 'StringIndexOutOfBoundsException') )
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
