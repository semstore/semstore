<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.1
 * @date 2005-06-07
 * @package Database.Abstraction
 */

require_once('SEMError.class.php');

class DataObjectError extends SEMError
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
        /*
	 * Instance Variables
	 */
        
        
	/*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        /**
         * Constructs and instance of object
         *
         * @access public
         */
        function DataObjectError ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_DataObjectError'.$numArgs),
                        $args);
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _DataObjectError0 ()
        {
                $this->_initialise();
        }
        
        
        function _DataObjectError1 ( $message )
        {
                $this->_initialise();
                $this->setMessage($message);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
}

?>
