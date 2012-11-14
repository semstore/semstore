<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-03-01
 * @package SEM.CMS.Modules.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/CMSUtils.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/Weblets/InstallModuleWebletStateContainer.class.php');

class InstallModuleWeblet extends Weblet
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
        
        
        var $configurator = NULL;
        var $connection = NULL;
        
        /* Configuration Variables :: Start */
        
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $action = '';
        
        var $formErrors = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function InstallModuleWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_InstallModuleWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _InstallModuleWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _InstallModuleWeblet2 ( &$configuration, &$connection )
        {
                $this->_initialize();
                $this->autoconfigure($configuration);
                $this->setConnection($connection);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getConfigurator ()
        {
                return $this->configurator;
        }
        
        
        function setConfigurator ( $configurator )
        {
                $this->configurator = $configurator;
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
        
        
        function getAction ()
        {
                return $this->action;
        }
        
        
        function setAction ( $action )
        {
                $this->action = $action;
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
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfigurator($config);
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new InstallModuleWeblet();
                
                $stateContainer->setView($this->getView());
                $stateContainer->setAction($this->getAction());
                
                Session::putRef('installModuleWebletWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('installModuleWebletWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setAction($stateContainer->getAction());
                
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('installModuleWebletWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'capture_details' )
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        return $this->_confirm_details( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        return $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        return $this->_confirm_details_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                return $this->_capture_details( $httpRequest, $httpResponse );
        }
        
        
        function _capture_details ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( $view == 'capture_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                /* Prepare the Template */
                $template =& new CMSTemplate('system/modules/install_module/start.tpl');
                $template->autoconfigure($this->getConfigurator());
                //$template->assign('subtemplate', 'user_management/add_cms_user/add_cms_user_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                /* Prepare the form */
                $template->assign('imFormAction', $_SERVER['PHP_SELF']);
                $template->assign('imFormMethod', 'post');
                $template->assign('imFormEncoding', 'multi-part/form-data');
                
                
                /* Populate form fields/widgets */
                $template->assign('formAction', 'capture_details_submit');
                
                /* Populate template */
                /*
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                foreach ( array_keys($form->getWidgets()) as $widgetId )
                {
                        $widget =& $form->getWidget($widgetId);
                        $template->assign($widgetId.'Widget', $widget);
                }
                */
                
                
                /* Display template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_capture_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_capture_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management' .
                        '/add_user.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                
                /* Prepare the data */
                $firstname = $httpRequest->getParameter('firstname');
                $firstname = trim($firstname);
                $this->setFirstname($firstname);
                
                $surname = $httpRequest->getParameter('surname');
                $surname = trim($surname);
                $this->setSurname($surname);
                
                $email = $httpRequest->getParameter('email');
                $email = trim($email);
                $this->setEmail($email);
                
                $username = $httpRequest->getParameter('username');
                $username = trim($username);
                $this->setUsername($username);
                
                $password = $httpRequest->getParameter('password');
                $password = trim($password);
                $this->setPassword($password);
                
                $password2 = $httpRequest->getParameter('password2');
                $password2 = trim($password2);
                
                $autogeneratePassword = FALSE;
                if ( $httpRequest->getParameter('autopassword') == 'yes' )
                {
                        $autogeneratePassword = TRUE;
                }
                $this->setAutogeneratePassword($autogeneratePassword);
                
                
                /* Prepare the form */
                $form =& new AddCMSUserForm();
                
                
                /* Populate form fields/widgets */
                $firstnameWidget =& $form->getWidget('firstname');
                $firstnameWidget->setValue($this->getFirstname());
                
                $surnameWidget =& $form->getWidget('surname');
                $surnameWidget->setValue($this->getSurname());
                
                $emailWidget =& $form->getWidget('email');
                $emailWidget->setValue($this->getEmail());
                
                $usernameWidget =& $form->getWidget('username');
                $usernameWidget->setValue($this->getUsername());
                
                $passwordWidget =& $form->getWidget('password');
                $passwordWidget->setValue($this->getPassword());
                
                $password2Widget =& $form->getWidget('password2');
                $password2Widget->setValue($password2);
                
                $errors = $form->validate();
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect(
                                $configuration->getParameter('cms_root_webpath') .
                        '/user_management' .
                        '/add_user.php?view=capture_details');
                        return;
                }
                
                
                // Check to make sure we are not creating a duplicate user
                if ( CMSUtils::userWithUsernameExists($username,
                        $this->getConnection()) === TRUE )
                {
                        $errors = array('A user with that username already exists.');
                        $this->setFormValidationErrors($errors);
                        if ( count($errors) > 0 )
                        {
                                $this->setView('capture_details');
                                $this->_saveWebletState();
                                $httpResponse->redirect(
                                        $configuration->getParameter('cms_root_webpath') .
                                '/user_management' .
                                '/add_user.php?view=capture_details');
                                return;
                        }
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management' .
                        '/add_user.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management/index.php');
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('user_management/add_cms_user/add_cms_user.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'user_management/add_cms_user/add_cms_user_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                
                /* Populate template */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                $template->assign('action', 'confirm_details_submit');
                
                $template->assign('firstname', $this->getFirstname());
                $template->assign('surname', $this->getSurname());
                $template->assign('email', $this->getEmail());
                $template->assign('username', $this->getUsername());
                $template->assign('password', '');
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_confirm_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Edit Details' )
                {
                        return $this->_confirm_details_edit( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_confirm_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management' .
                        '/add_user.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $user =& CMSUtils::createUser($username,
                        $this->getConnection());
                if ( Exception::isException($user) )
                {
                        $errors = array('An error occured while trying to create the new user.' .
                                ' The error was: ' . $user->getMessage());
                        $this->setFormValidationErrors($errors);
                        if ( count($errors) > 0 )
                        {
                                $this->setView('capture_details');
                                $this->_saveWebletState();
                                $httpResponse->redirect(
                                        $configuration->getParameter('cms_root_webpath') .
                                '/user_management' .
                                '/add_user.php?view=capture_details');
                                return;
                        }
                }
                
                
                $user->setFirstname($this->getFirstname());
                $user->setSurname($this->getsurname());
                $user->setEmail($this->getEmail());
                $user->setPassword(md5($this->getPassword()));
                $res = $user->commit();
                
                if ( Exception::isException($res) )
                {
                        $errors = array('An error occured while trying to create the new user.' .
                                ' The error was: ' . $res->getMessage());
                        $this->setFormValidationErrors($errors);
                        if ( count($errors) > 0 )
                        {
                                $this->setView('capture_details');
                                $this->_saveWebletState();
                                $httpResponse->redirect(
                                        $configuration->getParameter('cms_root_webpath') .
                                '/user_management' .
                                '/add_user.php?view=capture_details');
                                return;
                        }
                }
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management' .
                        '/manage_user.php?uid=' . 
                        $user->getId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->setView('capture_details');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management' . 
                        '/add_user.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/user_management/index.php');
        }
        
        
        
        
        function _prepareBreadcrumbArray ()
        {
                $configuration =& $this->getConfigurator();
                
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'User Management',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/user_management/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
