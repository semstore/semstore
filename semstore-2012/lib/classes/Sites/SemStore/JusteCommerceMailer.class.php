<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-02-20
 * @package Sites.JusteCommerce
 */

require_once('Mail/MailWrapper.class.php');

class JusteCommerceMailer extends MailWrapper
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
        
        var $mailmethod = 'mail';
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
        
        
        function JusteCommerceMailer ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_JusteCommerceMailer'.$numArgs),
                        $args);
        }
        
        
        function _JusteCommerceMailer0 ()
        {
                $this->_initialise();
        }
        
        
        function _JusteCommerceMailer1 ( &$config )
        {
                $this->_initialise();
                $this->autoconfigure($config);
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
        
        
        function autoconfigure ( &$config )
        {
                $mailmethod = $config->getParameter('MAIL_METHOD'); 
                if ( $mailmethod = 'mail' )
                {
                        $this->setMailMethod($mailmethod);
                }
                elseif ( $mailmethod = 'sendmail' )
                {
                        $this->setMailMethod($mailmethod);
                }
                elseif ( $mailmethod = 'smtp' )
                {
                        $this->setMailMethod($mailmethod);
                        $this->setHost(
                                $config->getParameter('mailserver_host') );
                        $this->setPort(
                                $config->getParameter('mailserver_port') );
                        if ( $config->getParameter('mailserver_auth') == 1 )
                        {
                                $this->setAuth(TRUE);
                        }
                        else
                        {
                                $this->setAuth(FALSE);
                        }
                        $this->setUsername(
                                $config->getParameter('mailserver_username') );
                        $this->setPassword(
                                $config->getParameter('mailserver_password') );
                }
        }
}

?>
