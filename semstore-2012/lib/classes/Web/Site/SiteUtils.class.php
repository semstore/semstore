<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package Web.Site
 */

require_once('SEMObject.class.php');

class SiteUtils extends SEMObject
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
        
        
        function SiteUtils ()
        {
                die('Class is abstract and cannot be instantiated.');
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
        
        
        function redirect ( $url = NULL, $ssl = 'AUTO', $saveSession = TRUE )
        {
                //$ssl ( isset($ssl) && $ssl != '' ? $ssl : 'AUTO' );
                //$saveSession ( isset($saveSession) && $saveSession != '' ? $saveSession : TRUE );
                
                $absUrl = '';
                
                if ( preg_match('{^http}', $url) )
                {
                        $absUrl .= $url;
                }
                else
                {
                        if ( $ssl == 'ON' )
                        {
                                $absUrl .= 'https://';
                        }
                        elseif ( $ssl == 'OFF' )
                        {
                                $absUrl .= 'http://';
                        }
                        else
                        {
                                $absUrl .= ($_SERVER['HTTPS']=='on' ? 'https://' : 'http://');
                        }
                        
                        $absUrl .= $_SERVER['HTTP_HOST'];
                        
                        if ( preg_match('{^/}', $url) )
                        {
                                $absUrl .= $url;
                        }
                        else
                        {
                                $absUrl .= dirname($_SERVER['PHP_SELF']);
                                //$absUrl .= '/' . $url;
                                if ( preg_match('{/$}', $absUrl) == 0)
                                {
                                        $absUrl .= '/';
                                }
                                $absUrl .= $url;
                        }
                }
                
                if ( $saveSession && session_id() != '' )
                {
                        session_write_close();
                }
                
                //print $absUrl;
                header("Location: $absUrl");
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
