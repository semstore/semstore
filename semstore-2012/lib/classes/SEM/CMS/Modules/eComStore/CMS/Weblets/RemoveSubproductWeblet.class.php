<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveSubproductWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddProductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class RemoveSubproductWeblet extends Weblet
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
        var $productId = NULL;
        var $productName = '';
	var $parentId = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveSubproductWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveSubproductWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveSubproductWeblet0 ()
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
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
        }
        
        
        function getSubproductId ()
        {
                return $this->productId;
        }
        
        
        function setSubproductId ( $id )
        {
                $this->productId = $id;
        }
        
	function getParentId ()
        {
                return $this->parentId;
        }
        
        
        function setParentId ( $id )
        {
                $this->parentId = $id;
        }
        
        function getSubproductName ()
        {
                return $this->subproductName;
        }
        
        
        function setSubproductName ( $name )
        {
                $this->subproductName = $name;
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
                $product =& $this->_productId2Product(
                                $this->getSubProductId(),
                                $this->getConnection() );
		
		$this->setParentid($product->getParentId());

		$stateContainer =& new RemoveSubproductWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setSubproductId($this->getSubproductId());
                $stateContainer->setSubproductName($this->getSubproductName() );
		$stateContainer->setParentId($this->getParentId());
                
                Session::putRef('rspWebletStateContainer',
                        $stateContainer);
                /*
                Debug::debugMsg(DebugLevel::DEBUG(), 
                        'RegistrationWeblet' . print_r($this,TRUE));
                Debug::debugMsg(DebugLevel::DEBUG(), 
                        'StateContainer'.print_r($stateContainer,TRUE));
                Debug::flush();
                exit();
                */
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('rspWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setSubproductId($stateContainer->getSubproductId());
                $this->setSubproductName($stateContainer->getSubproductName());
		$this->setParentId($stateContainer->getParentId());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('rspWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
                elseif ( $view == 'confirm_details' )
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
                else
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        $this->_confirm_details_submit($httpRequest, $httpResponse);
                        return;
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
                }
        }
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $view = $httpRequest->getParameter('view');
                if ( $view == 'confirm_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
			$product =& $this->_productId2Product(
                                $this->getSubproductId(),
                                $this->getConnection() );
                        $this->setSubproductName($product->getName());
			$this->setParentId($product->getParentId());
                        
                        $this->_saveWebletState();
                }
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/subproduct_management/remove_subproduct/remove_subproduct.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/subproduct_management/remove_subproduct/remove_subproduct_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                /* Populate the template variables */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                $template->assign('action', 'confirm_details_submit');
                
                $template->assign('name', $this->getSubproductName());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Remove' )
                {
                        $this->_confirm_details_next($httpRequest, $httpResponse);
                        return;
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_confirm_details_cancel($httpRequest, $httpResponse);
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('remove_subproduct.php?view=confirm_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                                $this->getSubproductId(),
                                $this->getConnection()
                                );
                $product->remove(TRUE);
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(Configuration::getParameter('cms_root_webpath').'/ecomstore/product_catalogue/product_management/manage_product.php?productid='.$this->getParentId());
        }
        
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(Configuration::getParameter('cms_root_webpath').'/ecomstore/product_catalogue/product_management/manage_product.php?productid='.$this->getParentId());
        }
        
        
        
        function &_productId2Product ( $id, &$connection )
        {
                $product =& Product::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $product;
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
                                'name' => 'eComStore',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/'
                                ),
                        array(
                                'name' => 'Products &amp Categories',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                ),
                        array(
                                'name' => 'Products',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_management/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
