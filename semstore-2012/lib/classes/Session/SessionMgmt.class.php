<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2005-08-31
 */

class SessionMgmt extends SEMObject
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
        
        
        function SessionMgmt ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'SessionMgmt'.$numArgs),  $args);
        }
        
        
        function SessionMgmt0 ()
        {
                die("Class '" . get_class($this) . "' is abstract an cannot be" .
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
        
        
        function store ( $name, $value )
        {
                $prevValue = SessionMgmt::retrieve();
                $_SESSION[$name] = $value;
                return $prevValue;
        }
        
        
        function &storeRef ( $name, &$value )
        {
                $prevValue =& SessionMgmt::retrieveRef();
                $_SESSION[$name] =& $value;
                return $prevValue;
        }
        
        
        function retrieve ( $name )
        {
                return $_SESSION[$name];
        }
        
        
        function &retrieveRef ( $name )
        {
                return $_SESSION[$name];
        }
        
        
        function remove ( $name )
        {
                $value = SessionMgmt::retrieve();
                return unset($_SESSION[$name]);
                return $value;
        }
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
