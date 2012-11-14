<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-02-20
 * @package Mail
 */

require_once('SEMObject.class.php');

require_once('Mail.php');

class MailWrapper extends SEMObject
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
        
        
        var $mailer = NULL;
        
        var $mailmethod = 'smtp';
        var $host = 'localhost';
        var $port = 25;
        var $auth = FALSE;
        var $username = '';
        var $password = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function MailWrapper ()
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getMailer ()
        {
                return $this->mailer;
        }
        
        
        function setMailer ( &$mailer )
        {
                $this->mailer =& $mailer;
        }
        
        
        function getMailMethod ()
        {
                return $this->mailmethod;
        }
        
        
        function setMailMethod ( $mailmethod )
        {
                $this->mailmethod = $mailmethod;
        }
        
        
        function getHost ()
        {
                return $this->host;
        }
        
        
        function setHost ( $host )
        {
                $this->host = $host;
        }
        
        
        function getPort ()
        {
                return $this->port;
        }
        
        
        function setPort ( $port )
        {
                $this->port = $port;
        }
        
        
        function getAuth ()
        {
                return $this->auth;
        }
        
        
        function setAuth ( $auth )
        {
                $this->auth = $auth;
        }
        
        
        function getUsername ()
        {
                return $this->username;
        }
        
        
        function setUsername ( $username )
        {
                $this->username = $username;
        }
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
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
                
                $mailmethod = $config->getParameter('MAIL_METHOD');
                //print 'Mail Method: ' . $mailmethod;
                if ( $mailmethod == 'mail' )
                {
                        $this->setMailMethod($mailmethod);
                }
                elseif ( $mailmethod == 'sendmail' )
                {
                        $this->setMailMethod($mailmethod);
                }
                elseif ( $mailmethod == 'smtp' )
                {
                        $this->setMailMethod($mailmethod);
                        $this->setHost(
                                $config->getParameter('MAILSERVER_HOST') );
                        $this->setPort(
                                $config->getParameter('MAILSERVER_PORT') );
                        if ( $config->getParameter('MAILSERVER_AUTH') == 1 )
                        {
                                $this->setAuth(TRUE);
                        }
                        else
                        {
                                $this->setAuth(FALSE);
                        }
                        $this->setUsername(
                                $config->getParameter('MAILSERVER_USERNAME') );
                        $this->setPassword(
                                $config->getParameter('MAILSERVER_PASSWORD') );
                }

        }
        
        
        function send ( $recipients, $headers, $mailbody )
        {
                $mailer =& $this->getMailer();
                if ( is_null($mailer) )
                {
                        $mailer =& $this->_instantiateMailer();
                        $this->setMailer($mailer);
                }
                
                return $mailer->send($recipients, $headers, $mailbody);
        }
        
        
        function &_instantiateMailer ()
        {
                if ( $this->getMailMethod() == 'mail' )
                {
                        $mailer =& Mail::factory('mail');
                        return $mailer;
                }
                elseif ( $this->getMailMethod() == 'sendmail' )
                {
                        $mailer =& Mail::factory('sendmail');
                        return $mailer;
                }
                elseif ( $this->getMailMethod() == 'smtp' )
                {
			/*
                        print 'Host: ' . $this->getHost() . "\n";
                        print 'Port: ' . $this->getPort() . "\n";
                        print 'Auth: ' . $this->getAuth() . "\n";
                        print 'Username: ' . $this->getUsername() . "\n";
                        print 'Password: ' . $this->getPassword() . "\n";
                        */

                        $mailer =& Mail::factory('smtp',
                                array(
                                        'host' => $this->getHost(),
                                        'port' => $this->getPort(),
                                        'auth' => $this->getAuth(),
                                        'username' => $this->getUsername(),
                                        'password' => $this->getPassword() )
                                );
                        
			//print_r($mailer);

                        return $mailer;
                }
                else
                {
                        $mailer =& Mail::factory('mail');
                        return $mailer;
                }
                        
        }
}

?>
