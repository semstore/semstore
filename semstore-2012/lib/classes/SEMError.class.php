<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.1
 * @date 2005-06-07
 * @package core
 */

require_once('SEMObject.class.php');

class SEMError extends SEMObject
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
        
        
        /**
         * The (suposedly) unique id for the current object instance
         * @var string
         */
        var $code = '';
        
        /**
         * Unix timestamp of when the object was instantiated
         * @var int
         */
        var $message = '';
        
        
        /*
	 * Constructors
	 */
        
        /**
         * Constructs and instance of object
         *
         * @access public
         */
        function SEMError ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_SEMError'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _SEMError0 ()
        {
                $this->_initialise();
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /**
         * Returns the unique id of this object
         *
         * @access public
         * @return string
         */
        function getCode ()
        {
                return $this->code;
        }
        
        
        /**
         * Sets the unique id of this object
         *
         * @access public
         * @param string $code
         */
        function setCode ( $code )
        {
                $this->code = $code;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return string
         */
        function getMessage ()
        {
                return $this->message;
        }
        
        
        /**
         * Sets the unix timestamp representing the creation time of this
         * object
         *
         * @access public
         * @param string $message
         */
        function setMessage ( $message )
        {
                $this->message = $message;
        }
        
        
        /*
	 * Class Methods
	 */
        
        
        function isError ( &$obj )
        {
                if ( @@is_a($obj, 'Error') || @@is_subclass_of($obj, 'Error') )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        /**
         * Initialises the object
         *
         * @access private
         */
        function _initialise ()
        {
                $this->setObjectId($this->generateObjectId());
                $this->setObjectCreationTime(time());
        }
        
        
        function toString ()
        {
                return $this->getCode() . ': ' . $this->getMessage();
        }
}

?>
