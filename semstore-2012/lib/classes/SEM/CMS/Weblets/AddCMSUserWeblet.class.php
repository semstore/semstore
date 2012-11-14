<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-31
 * @package SEM.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/CMSUtils.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Weblets/AddCMSUserWebletStateContainer.class.php');
require_once('SEM/CMS/Forms/AddCMSUserForm.class.php');
require_once('SEM/CMS/CMSUser.class.php');

class AddCMSUserWeblet extends Weblet
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
        
        var $firstname = '';
        var $surname = '';
        var $email = '';
        var $username = '';
        var $password = '';
        var $autogeneratePassword = FALSE;
        var $emailUserDetails = FALSE;
        
        var $formErrors = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddCMSUserWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_AddCMSUserWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _AddCMSUserWeblet0 ()
        {
                $this->_initialize();
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
                $stateContainer =& new AddCMSUserWebletStateContainer();
                
                $stateContainer->setView($this->getView());
                $stateContainer->setAction($this->getAction());
                
                $stateContainer->setFirstname($this->getFirstname() );
                $stateContainer->setSurname($this->getSurname() );
                $stateContainer->setEmail($this->getEmail());
                $stateContainer->setUsername($this->getUsername() );
                $stateContainer->setPassword($this->getPassword() );
                $stateContainer->setAutogeneratePassword(
                        $this->getAutogeneratePassword() );
                $stateContainer->setEmailUserDetails(
                        $this->getEmailUserDetails() );
                
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                Session::putRef('addCMSUserWebletStateContainer',
                        $stateContainer);
                
                //print "<pre>" . print_r($_SESSION, TRUE) . "</pre>";
        }
        
        
        function _restoreWebletState ()
        {
                //print "<pre>" . print_r($_SESSION, TRUE) . "</pre>";
                $stateContainer =& Session::getRef('addCMSUserWebletStateContainer');
                
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setAction($stateContainer->getAction());
                
                $this->setFirstname($stateContainer->getFirstname());
                $this->setSurname($stateContainer->getSurname());
                $this->setEmail($stateContainer->getEmail());
                $this->setUsername($stateContainer->getUsername());
                $this->setPassword($stateContainer->getPassword());
                $this->setAutogeneratePassword(
                        $stateContainer->getAutogeneratePassword());
                $this->setEmailUserDetails(
                        $stateContainer->getEmailUserDetails());
                
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('addCMSUserWebletStateContainer', NULL);
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
                $template =& new CMSTemplate('user_management/add_cms_user/add_cms_user.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'user_management/add_cms_user/add_cms_user_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                /* Prepare the form */
                $form =& new AddCMSUserForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                
                /* Populate form fields/widgets */
                $firstnameWidget =& $form->getWidget('firstname');
                $firstnameWidget->setValue($this->getFirstname());
                
                $surnameWidget =& $form->getWidget('surname');
                $surnameWidget->setValue($this->getSurname());
                
                $emailWidget =& $form->getWidget('email');
                $emailWidget->setValue($this->getEmail());
                
                $usernameWidget =& $form->getWidget('username');
                $usernameWidget->setValue($this->getUsername());
                
                $autogenpasswordWidget =& $form->getWidget('autopassword');
                if ( $this->getAutogeneratePassword() == TRUE )
                {
                        $autogenpasswordWidget->setChecked(TRUE);
                }
                else
                {
                        $autogenpasswordWidget->setChecked(FALSE);
                }
                
                
                $emailUserDetailsWidget =& $form->getWidget('emailuserdetails');
                if ( $this->getEmailUserDetails() == TRUE )
                {
                        $emailUserDetailsWidget->setChecked(TRUE);
                }
                else
                {
                        $emailUserDetailsWidget->setChecked(FALSE);
                }
                
                /* Populate template */
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                foreach ( array_keys($form->getWidgets()) as $widgetId )
                {
                        $widget =& $form->getWidget($widgetId);
                        $template->assign($widgetId.'Widget', $widget);
                }
                
                
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
                
                $emailUserDetails = FALSE;
                if ( $httpRequest->getParameter('emailuserdetails') == 'yes' )
                {
                        $emailUserDetails = TRUE;
                }
                $this->setEmailUserDetails($emailUserDetails);
                
                
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
                
                /*
                $autogeneratePassword =& $form->getWidget('autogeneratePassword');
                $emailUserDetailsWidget->setValue($emailUserDetails);
                
                $autogeneratePassword =& $form->getWidget('autogeneratePassword');
                $emailUserDetailsWidget->setValue($emailUserDetails);
                */
                
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
