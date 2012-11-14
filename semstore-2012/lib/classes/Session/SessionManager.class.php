<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-07
 */

require_once('SEMObject.class.php');

class SessionManager extends SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/**
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function SessionManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'SessionManager'.$numArgs),  $args);
        }
        
        
        function SessionManager0 ()
        {
                die("Class '" . get_class($this) . "' is abstract and cannot be" .
                        " instantiated.");
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        function start ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_start'.$numArgs),  $args);
        }
        
        
        function _start0 ()
        {
                ;
        }
        
        
        function _start1 ()
        {
                ;
        }
        
        
        function commit ()
        {
                ;
        }
        
        
        function getId ()
        {
                ;
        }
        
        
        function regenerateId ()
        {
                ;
        }
        
        
        function get ( $varname )
        {
                ;
        }
        
        
        function put ( $varname, $value )
        {
                ;
        }
        
        
        function &getRef ( $varname )
        {
                ;
        }
        
        
        function putRef ( $varname, &$ref )
        {
                ;
        }
        
        
        function remove ( $varname )
        {
                ;
        }
        
        
        function garbageCollect ()
        {
                ;
        }
        
        
        function gc ()
        {
                ;
        }
}

?>
