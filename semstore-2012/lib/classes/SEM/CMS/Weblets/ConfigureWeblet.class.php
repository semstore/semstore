<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Weblets/ConfigureWebletStateContainer.class.php');
require_once('SEM/CMS/DataObjects/ConfigurationDataObject.class.php');
require_once('SEM/CMS/DataObjects/ConfigurationGroupDataObject.class.php');


class ConfigureWeblet extends Weblet
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
        var $formErrors = NULL;
        
        var $id = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ConfigureWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ConfigureWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _ConfigureWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _ConfigureWeblet2 ( &$configuration, &$connection )
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
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
        }
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
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
                $stateContainer =& new ConfigureWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                Session::putRef('configureWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('configureWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                ;
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('configureWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'edit' )
                {
                        return $this->_edit( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( $action == 'edit_parameters_submit' )
                {
                        return $this->_edit_parameters_submit(
                                $httpRequest, $httpResponse );
                }
                
                $httpResponse->redirect($_SERVER['PHP_SELF']);
        }
        
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $this->_config_page( $httpRequest, $httpResponse );
        }
        
        
        function _config_page ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the Template */
                $template =& new CMSTemplate('system/configuration/configuration_page.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                $CONFIG_GROUP_DO =& new ConfigurationGroupDataObject();
                $configGroup =& 
                        $CONFIG_GROUP_DO->lookup(
                                array('id' => $this->getId()),
                                $this->getConnection()
                                );
                
                $sql = 'FROM configuration, configuration_group' .
                        ' WHERE configuration.group_id = configuration_group.id ' .
                        ' AND configuration_group.id = ' . $this->getId() .
                        ' ORDER BY configuration.idx';
                $CONFIG_DO =& new ConfigurationDataObject();
                $parameters =& 
                        $CONFIG_DO->lookupArray($sql, $this->getConnection());
                
                /* Populate template */
                $template->assign('configGroup', $configGroup);
                $template->assign('parameters', $parameters);
                
                /* Display template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _edit ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the Template */
                $template =& new CMSTemplate('system/configuration/configuration_page_edit.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                $CONFIG_GROUP_DO =& new ConfigurationGroupDataObject();
                $configGroup =& 
                        $CONFIG_GROUP_DO->lookup(
                                array('id' => $this->getId()),
                                $this->getConnection()
                                );
                                
                $sql = 'FROM configuration, configuration_group' .
                        ' WHERE configuration.group_id = configuration_group.id ' .
                        ' AND configuration_group.id = ' . $this->getId() .
                        ' ORDER BY configuration.idx';
                $CONFIG_DO =& new ConfigurationDataObject();
                $parameters =& 
                        $CONFIG_DO->lookupArray($sql, $this->getConnection());
                
                /* Populate template */
                $template->assign('configGroup', $configGroup);
                $template->assign('parameters', $parameters);
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                $template->assign('action', 'edit_parameters_submit');
                
                /* Display template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _edit_parameters_submit ( &$httpRequest, &$httpResponse )
        {
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Update' )
                {
                        return $this->_edit_parameters_update(
                                $httpRequest, $httpResponse);
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_edit_parameters_cancel(
                                $httpRequest, $httpResponse);
                }
                
                
                $httpResponse->redirect($_SERVER['PHP_SELF']);
        }
        
        
        function _edit_parameters_update ( &$httpRequest, &$httpResponse )
        {
                $CONFIG_GROUP_DO =& new ConfigurationGroupDataObject();
                $configGroup =& 
                        $CONFIG_GROUP_DO->lookup(
                                array('id' => $this->getId()),
                                $this->getConnection()
                                );
                
                $sql = 'FROM configuration, configuration_group' .
                        ' WHERE configuration.group_id = configuration_group.id ' .
                        ' AND configuration_group.id = ' . $this->getId() .
                        ' ORDER BY configuration.idx';
                $CONFIG_DO =& new ConfigurationDataObject();
                $parameters =& 
                        $CONFIG_DO->lookupArray($sql, $this->getConnection());
                
                foreach ( array_keys($parameters) as $parameterId )
                {
                        $parameter =& $parameters[$parameterId];
                        $parameterValue =& $httpRequest->getParameter(
                                $parameter->getId());
                        if ( is_null($parameterValue) )
                        {
                                continue;
                        }
                        
                        if ( $parameter->getValue() != $parameterValue )
                        {
                                Debug::DebugMsg(
                                        DebugLevel::DEBUG(),
                                        "Updating '" . $parameter->getId() . 
                                        "' from '" .$parameter->getValue() .
                                        "' to '" . $parameterValue . "'"
                                        );
                                $parameter->setValue($parameterValue);
                                $parameter->store($this->getConnection());
                        }
                }
                
                $httpResponse->redirect($_SERVER['PHP_SELF'].'?id='.
                        $this->getId());
        }
        
        
        function _edit_parameters_cancel ( &$httpRequest, &$httpResponse )
        {
                $httpResponse->redirect($_SERVER['PHP_SELF'].'?id='.$this->getId());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'Configuration',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/system/configuration/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
