<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-12
 * @package HTTP
 */

require_once('SEMObject.class.php');

require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

class Weblet extends SEMObject
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
        
        
        var $config = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function Weblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Weblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _Weblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _Weblet1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &_getConfiguration ()
        {
                return $this->config;
        }
        
        
        function _setConfiguration ( &$config )
        {
                $this->config = $config;
        }
        
        
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
        
        
        function autoconfigure ( &$config )
        {
                $this->_setConfiguration($config);
        }
        
        
        function run ()
        {
                $request =& HttpRequest::fromPhpPrimitives();
                $response =& new HttpResponse();
                
                $requestMethod =
                        strtolower($request->getServerParameter('REQUEST_METHOD'));
                if ( $requestMethod == 'post' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> Request Method is' .
                                ' POST');
                        $this->doPost( $request, $response );
                }
                elseif ( $requestMethod == 'put' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> Request Method is' .
                                ' PUT');
                        $this->doPost( $request, $response );
                }
                elseif ( $requestMethod == 'delete' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> Request Method is' .
                                ' DELETE');
                        $this->doPost( $request, $response );
                }
                else
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> Request Method is' .
                                ' GET');
                        $this->doGet( $request, $response );
                }
                
                $response->toPhpPrimitives();
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function doPut ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function doDelete ( &$httpRequest, &$httpResponse )
        {
                ;
        }
}

?>
