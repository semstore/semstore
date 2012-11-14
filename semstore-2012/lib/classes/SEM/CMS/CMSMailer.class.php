<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-02-20
 * @package Mail
 */

require_once('SEMObject.class.php');

require_once('Mail/MailWrapper.class.php');

class CMSMailer extends MailWrapper
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
        
        
        function CMSMailer ( &$config )
        {
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
                $mailmethod = $config->getParameter('mail_method'); 
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
