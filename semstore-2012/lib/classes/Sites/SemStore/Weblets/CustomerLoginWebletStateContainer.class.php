<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class CustomerLoginWebletStateContainer extends WebletStateContainer
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
        
        
        var $configuration = NULL;
        var $dbConnection = NULL;
        
        var $secureLinkKey = '';
        var $redirectUrl = '';
        
        var $email = '';
        var $password = '';
        var $loginErrorMsg = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CustomerLoginWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerLoginWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _CustomerLoginWebletStateContainer0 ()
        {
                $this->_initialize();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getSecureLinkKey ()
        {
                return $this->secureLinkKey;
        }
        
        
        function setSecureLinkKey ( $key )
        {
                $this->secureLinkKey = $key;
        }
        
        
        function getRedirectUrl ()
        {
                return $this->redirectUrl;
        }
        
        
        function setRedirectUrl ( $url )
        {
                $this->redirectUrl = $url;
        }
        
        
        function getEmail ()
        {
                return $this->email;
        }
        
        
        function setEmail ( $email )
        {
                $this->email = $email;
        }
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        function getLoginErrorMsg ()
        {
                return $this->loginErrorMsg;
        }
        
        
        function setLoginErrorMsg ( $errmsg )
        {
                $this->loginErrorMsg = $errmsg;
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
