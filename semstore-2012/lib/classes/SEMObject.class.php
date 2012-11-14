<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.1
 * @date 2005-06-07
 * @package Core
 */

class SEMObject
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
        
        
        /**
         * The (suposedly) unique id for the current object instance
         * @var string
         */
        var $objId = '';
        
        /**
         * Unix timestamp of when the object was instantiated
         * @var int
         */
        var $objCreationTime = -1;
        
        /**
         * Unix timestamp of when the object should be destroyed after
         * @var int
         */
        var $objExpiryTime = -1;
        
        /**
         * The level of debugging output that this object should generate
         * @var int
         */
        var $debugLevel = 0;
        
        
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
        function SEMObject ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_SEMObject'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _SEMObject0 ()
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
        function getObjectId ()
        {
                return $this->objId;
        }
        
        
        /**
         * Sets the unique id of this object
         *
         * @access public
         * @param string $objectId
         */
        function setObjectId ( $objectId )
        {
                $this->objId = $objectId;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getObjectCreationTime ()
        {
                return $this->objCreationTime;
        }
        
        
        /**
         * Sets the unix timestamp representing the creation time of this
         * object
         *
         * @access public
         * @param int $time
         */
        function setObjectCreationTime ( $time )
        {
                $this->objCreationTime = $time;
        }
        
        
        /**
         * Returns the unix timestamp representing the time when the object
         * should expire and be destroyed
         *
         * @access public
         * @return int
         */
        function getObjectExpiryTime ()
        {
                return $this->objExpiryTime;
        }
        
        
        /**
         * Set the unix timestamp representing the time when the object
         * should expire and be destroyed
         *
         * @access public
         * @param int $time
         */
        function setObjectExpiryTime ( $time )
        {
                $this->objExpiryTime = $time;
        }
        
        
        /**
         * Returns the level of debugging output that is generated for
         * this object
         *
         * @access public
         * @return int
         */
        function getDebugLevel ()
        {
                return $this->debugLevel;
        }
        
        
        /**
         * Sets the level of debugging output that is generated for
         * this object
         *
         * @access public
         * @param int $level
         */
        function setDebugLevel ( $level )
        {
                $this->debugLevel = $level;
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
        
        
        /**
         * An alias of _initialize
         *
         * @access private
         */
        function _initialize ()
        {
                $this->_initialise;
        }
        
        
        /**
         * Sets the objects attributes to the values stored in the array passed
         * to the method
         * 
         * The array passed is maps attribute names to values.  This method sets
         * each of the attributes in the array to the value they are mapped to.
         * The setting of an attribute is handled by calling the correct mutator
         * method.  There for is the attribute name was blah the method would
         * call setBlah along with the mapped value in order to set the
         * attribute.
         * 
         * @access private
         * @param array $attributes
         */
        function _setAttributes ( &$attributes )
        {
                foreach ( $attributes as $attrib => $val )
                {
                        $this->debugMsg( $this->DEBUG, "'" . $attrib . "' => '" . $val .
                                "'<BR>" );
                        $method = 'set' . ucfirst($attrib);
                        call_user_func_array( array(&$this, $method),
                                array( $val ) );
                        //$this->{$attrib} = $val;
                }
        }
        
        
        /**
         * Generates a unique id for this object
         * 
         * @access public
         * @return string
         */
        function generateObjectId ()
        {
                return '';
        }
        
        
        /**
         * Prints out the debugging message if the debugging level of the
         * message is greater than or equal to the debugging level of the
         * object
         * 
         * @access public
         * @param int $level
         * @param string $message
         */
        function debugMsg ( $level, $message )
        {
                if ( $this->getDebugLevel() != $this->OFF &&
                        $level >= $this->getDebugLevel() )
                {
                        print $message;
                }
        }
        
        
        /**
         * Returns whether or not the expiry time of the object has passed
         * 
         * @access public
         * @return bool
         */
        function hasExpired ()
        {
                if ( $this->getObjectExpiryTime() < 0 );
                {
                        return FALSE;
                }
                
                return $this->getObjectExpiryTime() < time();
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function methodChain ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_methodChain'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * Call methods of the return values of other methods recursively
         * 
         * @access private
         * @param array $methods
         * @return mixed
         */
        function _methodChain1 ( $methods )
        {
                $this->methodChain($methods, TRUE);
        }
        
        
        /**
         * Call methods of the return values of other methods recursively
         * 
         * @access private
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function _methodChain2 ( $methods, $recursive )
        {
                if ( $recursive == TRUE )
                {
                        $this->_methodChainRecursive($methods);
                }
                else
                {
                        $this->_methodChainIterative($methods);
                }
        }
        
        
        /**
         * Call methods of the return values of other methods recursively
         * 
         * @access private
         * @param array $methods
         * @return mixed
         */
        function _methodChainRecursive ( $methods )
        {
                
                $args = array_shift($methods);
                $method = array_shift($args);
                $result =& call_user_func_array(
                                array(
                                        &$this,
                                        $method
                                        ),
                                $args
                                );
                                
                return $result->methodChain($methods);
        }
        
        
        /**
         * Call methods of the return values of other methods iteratively
         * 
         * @access private
         * @param array $methods
         * @return mixed
         */
        function _methodChainIterative ( $methods )
        {
                $result =& $this;
                
                while ( count($methods) > 0 )
                {
                        $args = array_shift($methods);
                        $methodName = array_shift($args);
                        $result =& call_user_func_array(
                                array(
                                        &$result,
                                        $methodName
                                        ),
                                $args
                                );
                }
                
                return $result;
        }
        
        
        /**
         * Returns the instance of the class as a string
         * 
         * @access public
         * @return string
         */
        function toString ()
        {
                return print_r($this, TRUE);
        }
        
        
        /**
         * Tests an object for eqaulity with another object
         * 
         * @access public
         * @param object $object
         * @return boolean
         */
        function equals ( $object )
        {
                return TRUE;
        }
        
        
        /**
         * Compares one object to another
         * 
         * @access public
         * @param object $object
         * @return int
         */
        function compare ( $object )
        {
                return 0;
        }
        
        
        /**
         * 
         * 
         * @access public
         * @return object
         */
         /*
        function clone ()
        {
                ;
        }*/
        
        
        /**
         * 
         * 
         * @access public
         * @return String
         */
        function serialize ()
        {
                ;
        }
        
        
        /**
         * 
         * 
         * @access public
         * @param String $objstr
         * @return object
         */
        function unserialize ( $objstr )
        {
                ;
        }
        
        
        function isInstanceOf ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                
                if ( $numArgs == 2 )
                {
                        return call_user_func_array(
                                array( 'Object',
                                '_isInstanceOf2' ),
                                $args);
                }
                else
                {
                        return call_user_func_array(
                                array( &$this,
                                '_isInstanceOf1' ),
                                $args);
                }
        }
        
        
        function _isInstanceOf1 ( $classname )
        {
                if ( @@is_a($this, $classname) ||
                        @@is_subclass_of($this, $classname) )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function _isInstanceOf2 ( &$obj, $classname )
        {
                if ( @@is_a($obj, $classname) ||
                        @@is_subclass_of($obj, $classname) )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
}

?>
