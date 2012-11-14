<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-07
 */

require_once('Session/SessionManager.class.php');

class PHPSessionManager extends SessionManager
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
        
        
        var $sessionId = '';
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function PHPSessionManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'PHPSessionManager'.$numArgs),  $args);
        }
        
        
        function PHPSessionManager0 ()
        {
                ;
        }
        
        
        function PHPSessionManager1 ( $sessionId )
        {
                $this->_setSessionId($sessionId);
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function _getSessionId ()
        {
                return $this->sessionId;
        }
        
        
        function _setSessionId ( $sessionId )
        {
                $this->sessionId = $sessionId;
                session_id($sessionId);
        }
        
        
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
                
                session_start();
        }
        
        
        function _start1 ( $sessionId )
        {
                $this->_setSessionId($sessionId);
                session_start();
        }
        
        
        function commit ()
        {
                session_write_close();
        }
        
        
        function getId ()
        {
                return $this->_getSessionId();
        }
        
        
        function regenerateId ()
        {
                ;
        }
        
        
        function get ( $varname )
        {
                return $_SESSION[$varname];
        }
        
        
        function put ( $varname, $value )
        {
                $oldVal = $_SESSION[$varname];
                $_SESSION[$varname] = $value;
                
                return $oldVal;
        }
        
        
        function &getRef ( $varname )
        {
                return $_SESSION[$varname];
        }
        
        
        function putRef ( $varname, &$ref )
        {
                $oldRef =& $_SESSION[$varname];
                $_SESSION[$varname] =& $ref;
                
                return $oldRef;
        }
        
        
        function remove ( $varname )
        {
                $oldVal = $_SESSION[$varname];
                $_SESSION[$varname] = NULL;
                unset($_SESSION[$varname]);
                
                return $oldVal;
        }
        
        
        function garbageCollect ()
        {
                foreach ( $_SESSION as $key => $item )
                {
                        if ( is_object($item) &&
                                $item->getObjectExpiryTime() <= time() )
                        {
                                unset($_SESSION[$key]);
                        }
                }
        }
        
        
        function gc ()
        {
                $this->garbageCollect();
        }
        
        
        function reset ()
        {
                foreach (array_keys($_SESSION) as $key )
                {
                        $_SESSION[$key] = NULL;
                        unset($_SESSION[$key]);
                }
        }
}

?>
