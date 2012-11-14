<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-12
 * @package HTTP
 */

require_once('HTTP/Weblet.class.php');

require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

class ActionWeblet extends Weblet
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
        
        
        function ActionWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ActionWeblet'.$numArgs),
                        $args
                        );
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
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                ;
        }
}

?>
