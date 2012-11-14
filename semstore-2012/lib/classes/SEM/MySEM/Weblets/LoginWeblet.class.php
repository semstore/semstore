<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-26
 * @package SEM.MySEM.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/MySEM/Templates/MySEMLoginTemplate.class.php');
require_once('SEM/MySEM/MySEMUtils.class.php');

class LoginWeblet extends Weblet
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
        var $connection = NULL;
        
        /* Configuration Variables :: Start */
        
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $formErrors = NULL;
        var $groupName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function LoginWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_LoginWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _LoginWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _LoginWeblet1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getConfiguration ()
        {
                return $this->configuration;
        }
        
        
        function setConfiguration ( $configuration )
        {
                $this->configuration = $configuration;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
        }
        
        
        function getGroupName ()
        {
                return $this->groupName;
        }
        
        
        function setGroupName ( $groupName )
        {
                $this->groupName = $groupName;
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
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
        }
        
        
        function _saveWebletState ()
        {
                ;
        }
        
        
        function _restoreWebletState ()
        {
                ;
        }
        
        
        function _destroyWebletState ()
        {
                ;
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $this->_default( $httpRequest, $httpResponse );
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( $action == 'login' )
                {
                        $this->_login_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $template =& new MySEMLoginTemplate(
                        Configuration::getInstance(),
                        $GLOBALS['dbConnection']);
                $template->assign('loginFormAction', $_SERVER['PHP_SELF']);
                $template->assign('loginFormMethod', 'post');
                $template->assign('loginFormEncoding',
                        'application/x-www-form-urlencoded');
                $template->assign('loginAction', 'login');
                $template->assign('loginUsername', '');
                $template->assign('loginPassword', '');
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _login_submit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfiguration();
                $login = $httpRequest->getParameter('username');
                $password = $httpRequest->getParameter('password');
                
                if ( !MySEMUtils::authenticateUser(
                        $this->getConnection(), $login, $password ) )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
                }
                
                $user =& MySEMUtils::getUserWithLogin(
                        $this->getConnection(), $login);
                MySEMUtils::loginUser($user);
                
                $httpResponse->redirect(
                        $configuration->getParameter('site_root_webpath') .
                        '/index.php');
        }
}


?>
