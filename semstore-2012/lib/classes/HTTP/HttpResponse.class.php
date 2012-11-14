<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-12
 * @package HTTP
 */

require_once('SEMObject.class.php');

require_once('Out.class.php');

class HttpResponse extends SEMObject
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
        var $cookies = array();
        var $content = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function HttpResponse ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this,'_HttpResponse'.$numArgs),
                        $args
                        );
        }
        
        
        function _HttpResponse0 ()
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
        
        
        function setHeader ( $header, $value )
        {
                $oldValue = NULL;
                if ( isset($this->headers[$header]) )
                {
                        $oldValue = $this->headers[$header];
                }
                
                $this->headers[$header] = $value;
                
                return $oldValue;
        }
        
        
        function setContent ( $content )
        {
                $this->content = $content;
        }
        
        
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
                
                //$this->setHeader('Location', $absUrl);
                header('Location: ' .$absUrl);
        }
        
        
        function toPhpPrimitives ()
        {
                Out::writeOut($this->content);
        }
}

?>
