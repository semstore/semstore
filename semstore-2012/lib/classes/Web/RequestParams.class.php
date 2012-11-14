<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-13
 * @package Web
 */

class RequestParams extends SEMObject
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
        
        
        function RequestParams ()
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
        
        
        function getParam ( $param )
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
