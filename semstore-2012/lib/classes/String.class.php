<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package core
 */

require_once('SEMObject.class.php');

class String extends SEMObject
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
        
        
        var $str = '';
        
        
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
        function String ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_String'.$numArgs
                                ),
                        $args
                );
        }
        
        
        function _String0 ()
        {
                $this->_initialise();
        }
        
        
        function _String1 ( $str )
        {
                $this->_initialise();
                $this->str = $str;
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
        
        
        function append ( $str )
        {
                if ( Object::instanceOf($str, 'String') )
                {
                        $this->str .= $str->toString();
                }
                elseif ( Object::instanceOf($str, 'Object') )
                {
                        $this->str .= $str->toString();
                }
                elseif ( is_string($str) )
                {
                        $this->str .= $str;
                }
                else
                {
                        // parameter str is not a type we can use.  Need to
                        // error one day.
                }
        }
        
        
        function substring ()
        {
                ;
        }
        
        
        function substr ()
        {
                $this->substring();
        }
        
        
        function indexOf ()
        {
                ;
        }
        
        
        function lastIndexOf ()
        {
                ;
        }
        
        
        function explode ()
        {
                ;
        }
        
        
        function split ()
        {
                ;
        }
        
        
        function toString ()
        {
                return $this->str;
        }
}

?>
