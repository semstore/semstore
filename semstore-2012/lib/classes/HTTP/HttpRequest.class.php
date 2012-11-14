<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-12
 * @package HTTP
 */

require_once('SEMObject.class.php');

class HttpRequest extends SEMObject
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
        
        
        var $headers = array();
        var $server = array();
        var $request = array();
        var $cookies = array();
        var $files = array();
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function HttpRequest ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this,'_HttpRequest'.$numArgs),
                        $args
                        );
        }
        
        
        function _HttpRequest0 ()
        {
                ;
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
        
        
        function &fromPhpPrimitives () 
        {
                $request =& new HttpRequest();
                
                //$request->headers
                $request->server = $_SERVER;
                $request->request = $_REQUEST;
                $request->cookies = $_COOKIES;
                $request->files = $_FILES;
                
                return $request;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function getServerParameter ( $param )
        {
                $value = $this->server[$param];
                
                if ( is_null($value) || $value == '' )
                {
                        return NULL;
                }
                
                return $value;
        }
        
        
        function getParameter ( $param )
        {
                if ( !is_null($_REQUEST[$param]) && isset($_REQUEST[$param]) )
                {
                        $value = trim($_REQUEST[$param]);
                        if ( get_magic_quotes_gpc() == 1 )
                        {
                                return stripslashes($value);
                        }
                        
                        return $value;
                }
                else
                {
                        return NULL;
                }
        }
}

?>
