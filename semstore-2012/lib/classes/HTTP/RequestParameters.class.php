<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-13
 * @package HTTP
 */

require_once('SEMObject.class.php');

class RequestParameters extends SEMObject
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
        
        
        function RequestParameters ()
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
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
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
