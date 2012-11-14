<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/Weblet.class.php');

require_once('Sites/SemStore/Weblets/CustomerLoginWebletStateContainer.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Customer.class.php');

class CustomerLoginWeblet extends Weblet
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
        
        
        function CustomerLoginWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_CustomerLoginWeblet'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _CustomerLoginWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _CustomerLoginWeblet1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getConfiguration ()
        {
                return $this->configuration;
        }
        
        
        function setConfiguration ( &$config )
        {
                $this->configuration =& $config;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
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
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
                $this->setSecureLinkKey($config->getParameter('SECURE_LINK_KEY'));
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        return $this->doGet( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'login' )
                {
                        return $this->_captureDetails_Submit( $httpRequest, $httpResponse );
                }
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->destroyState();
                        
                        // Is there a secure link
                        $redirect = $httpRequest->getParameter('r');
                        if ( !is_null($redirect) && $redirect != '' )
                        {
                                $redirect = eComStoreUtils::simpleXor($redirect,
                                        $this->getSecureLinkKey());
                                $this->setRedirectUrl($redirect);
                        }
                        
                        
                        return $this->_captureDetails( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'login' )
                {
                        return $this->_captureDetails( $httpRequest, $httpResponse );
                }
        }
        
        
        function saveState ()
        {
                $state =& new CustomerLoginWebletStateContainer();
                $state->setRedirectUrl($this->getRedirectUrl());
                $state->setEmail($this->getEmail());
                $state->setLoginErrorMsg($this->getLoginErrorMsg());
                
                Session::putRef('loginWebletState', $state);
        }
        
        
        function restoreState ()
        {
                $state =& Session::getRef('loginWebletState');
                
                if ( is_object($state) )
                {
                        //$state->getLastAccessTime() > time() - (30 * 60)
                        if ( TRUE )
                        {
                                $this->setRedirectUrl($state->getRedirectUrl());
                                $this->setEmail($state->getEmail());
                                $this->setLoginErrorMsg(
                                        $state->getLoginErrorMsg());
                        }
                        else
                        {
                                $this->destroyState();
                        }
                }
        }
        
        
        function destroyState ()
        {
                Session::put('loginWebletState', NULL);
        }
        
        
        function _captureDetails ( &$httpRequest, &$httpResponse )
        {
                $this->restoreState();
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        '_ecomstore/login.tpl');
                $template->addStylesheet(
                        $this->configuration->getParameter('site_root_webpath') .
                        '/css/login.css');
                
                $template->assign('email', $this->getEmail());
                $template->assign('loginErrorMsg', $this->getLoginErrorMsg());
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _captureDetails_Submit ( &$httpRequest, &$httpResponse )
        {
                $this->restoreState();
                
                $email = $httpRequest->getParameter('email');
                $this->setEmail($email);
                
                $password = $httpRequest->getParameter('password');
                $this->setPassword($password);
                
                // Validation
                
                if ( !$this->isComplete($email) )
                {
                        $this->setLoginErrorMsg('Please complete the Email field.');
                        $this->saveState();
                        
                        $httpResponse->redirect(
                                $_SERVER['PHP_SELF'].'?view=login');
                        return;
                }
                
                
                if ( !$this->isComplete($password) )
                {
                        $this->setLoginErrorMsg('Please complete the Password field.');
                        $this->saveState();
                        
                        $httpResponse->redirect(
                                $_SERVER['PHP_SELF'].'?view=login');
                        return;
                }
                
                
                $this->saveState();
                
                
                if ( !eComstoreUtils::authenticateCustomer($email, $password,
                        $this->getConnection()) )
                {
                        $this->setLoginErrorMsg('Sorry! We could not log you into JustECommerce.  Perhaps you mispelt your email address or password?');
                        $this->saveState();
                        
                        $httpResponse->redirect(
                                $_SERVER['PHP_SELF'].'?view=login');
                        return;
                }
                
                $this->destroyState();
                
                $customer =& eComStoreUtils::findCustomerWithEmail($email,
                        $this->getConnection());
                SessionUtils::setLoggedIn($customer);
                
                // At this point we should either redirect to the encrypted url
                // or to the my account page.
                $redirect = $this->getRedirectUrl();
                if ( !is_null($redirect) && $redirect != '' )
                {
                        $httpResponse->redirect($redirect);
                        return;
                }
                
                $httpResponse->redirect('index.php');
                return;
        }
        
        
        function isComplete ( $value )
        {
                if ( is_null($value) || $value == '' )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
}

?>
