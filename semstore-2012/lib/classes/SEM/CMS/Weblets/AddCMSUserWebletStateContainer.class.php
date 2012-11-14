<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-31
 * @package SEM.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class AddCMSUserWebletStateContainer extends WebletStateContainer
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
        
        
        var $view = '';
        var $action = '';
        
        var $firstname = '';
        var $surname = '';
        var $email = '';
        var $username = '';
        var $password = '';
        var $autogeneratePassword = FALSE;
        var $emailUserDetails = FALSE;
        
        var $formErrors = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddCMSUserWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddCMSUserWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _AddCMSUserWebletStateContainer0 ()
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getAction ()
        {
                return $this->action;
        }
        
        
        function setAction ( $action )
        {
                $this->action = $action;
        }
        
        
        function getFirstname ()
        {
                return $this->firstname;
        }
        
        
        function setFirstname ( $firstname )
        {
                $this->firstname = $firstname;
        }
        
        
        function getSurname ()
        {
                return $this->surname;
        }
        
        
        function setSurname ( $surname )
        {
                $this->surname = $surname;
        }
        
        
        function getEmail ()
        {
                return $this->email;
        }
        
        
        function setEmail ( $email )
        {
                $this->email = $email;
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
        
        
        function getAutogeneratePassword ()
        {
                return $this->autogeneratePassword;
        }
        
        
        function setAutogeneratePassword ( $bool )
        {
                if ( $bool === TRUE || $bool === 1 )
                {
                        $this->autogeneratePassword = TRUE;
                }
                else
                {
                        $this->autogeneratePassword = FALSE;
                }
                
        }
        
        
        function getEmailUserDetails ()
        {
                return $this->emailUserDetails;
        }
        
        
        function setEmailUserDetails ( $bool )
        {
                if ( $bool === TRUE || $bool === 1 )
                {
                        $this->emailUserDetails = TRUE;
                }
                else
                {
                        $this->emailUserDetails = FALSE;
                }
                
        }
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
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
        
        
        
        
}

?>
