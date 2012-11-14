<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-11
 * @package SEM.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/Templates/CMSLoginTemplate.class.php');
require_once('SEM/CMS/CMSUtils.class.php');

class CMSLoginWeblet extends Weblet
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
        
        
        function CMSLoginWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_CMSLoginWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _CMSLoginWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _CMSLoginWeblet1 ( &$config )
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
                $template =& new CMSLoginTemplate(
                        $this->getConfiguration());
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _login_submit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfiguration();
                $login = $httpRequest->getParameter('login');
                $password = $httpRequest->getParameter('password');
                
                if ( !CMSUtils::authenticateUser(
                        $this->getConnection(), $login, $password ) )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
                }
                
                $cmsUser =& CMSUtils::getUserWithLogin(
                        $this->getConnection(), $login);
                CMSUtils::loginUser($cmsUser);
                
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/index.php');
        }
}


?>
