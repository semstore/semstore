<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-09-07
 * @package Session
 * @abstract
 */

require_once('SEMObject.class.php');

class Session extends SEMObject
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
        
        
        function Session ()
        {
                die("Class '" . get_class($this) . "' is abstract and cannot be" .
                        " instantiated.");
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
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function start ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( 'Session', '_start'.$numArgs),  $args);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function _start0 ()
        {
                $GLOBALS['session']->start();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function _start1 ( $sessionId )
        {
                $GLOBALS['session']->start($sessionId);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function commit ()
        {
                $GLOBALS['session']->commit();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function getId ()
        {
                return $GLOBALS['session']->getId();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function regenerateId ()
        {
                return $GLOBALS['session']->regenerateId();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function get ( $name )
        {
                return $GLOBALS['session']->get($name);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function put ( $name, $value )
        {
                return $GLOBALS['session']->put($name, $value);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function &getRef ( $name )
        {
                return $GLOBALS['session']->getRef($name);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function &putRef ( $name, &$ref )
        {
                return $GLOBALS['session']->putRef($name, $ref);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function remove ( $name )
        {
                return $GLOBALS['session']->remove($name);
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function garbageCollect ()
        {
                return $GLOBALS['session']->garbageCollect();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function gc ()
        {
                return $GLOBALS['session']->gc();
        }
        
        
        /**
         * Write a string to the debug stream
         *
         * Writes a string to the debug stream if the debug level of the
         * message is equal to or greater than the debug level of the debug
         * stream
         * 
         * @static
         * @access public
         * @param string $level
         * @param $msg
         * 
         */
        function reset ()
        {
                return $GLOBALS['session']->reset();
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
