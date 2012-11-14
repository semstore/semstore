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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/EditSubproductWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/EditSubproductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class EditSubproductWeblet extends Weblet
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
        var $subproductId = NULL;
        var $name = '';
        var $code = '';
        var $price = NULL;
        var $vatStatus = 1;
        var $formattedPrice = '';
        var $description = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditSubproductWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditSubproductWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditSubproductWeblet0 ()
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
                return $this->subproductId;
        }
        
        
        function setSubproductId ( $id )
        {
                $this->subproductId = $id;
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function setName( $name )
        {
                $this->name = $name;
        }
        
        
        function getCode ()
        {
                return $this->code;
        }
        
        
        function setCode ( $code )
        {
                $this->code = $code;
        }
        
        
        function getPrice ()
        {
                return $this->price;
        }
        
        
        function setPrice ( $price )
        {
                $this->price = $price;
        }
        
        
        function getVatStatus ()
        {
                return $this->vatStatus;
        }
        
        
        function setVatStatus ( $vatStatus )
        {
                $this->vatStatus = $vatStatus;
        }
        
        
        function getFormattedPrice ()
        {
                return $this->formattedPrice;
        }
        
        
        function setFormattedPrice ( $fprice )
        {
                $this->formattedPrice = $fprice;
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $des )
        {
                $this->description = $des;
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
                $stateContainer =& new EditSubproductWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setSubproductId($this->getSubproductId() );
                $stateContainer->setName($this->getName() );
                $stateContainer->setCode($this->getCode() );
                $stateContainer->setPrice($this->getPrice() );
                $stateContainer->setVatStatus($this->getVatStatus() );
                $stateContainer->setFormattedPrice($this->getFormattedPrice() );
                $stateContainer->setDescription($this->getDescription() );
                
                Session::putRef('editSubproductWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('editSubproductWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setSubproductId($stateContainer->getSubproductId());
                $this->setName($stateContainer->getName());
                $this->setCode($stateContainer->getCode());
                $this->setPrice($stateContainer->getPrice());
                $this->setVatStatus($stateContainer->getVatStatus());
                $this->setFormattedPrice($stateContainer->getFormattedPrice());
                $this->setDescription($stateContainer->getDescription());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('editProductWebletStateContainer', NULL);
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
                return $this->_capture_details( &$httpRequest, &$httpResponse );
        }
        
        
        function _capture_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $view = $httpRequest->getParameter('view');
                if ( $view == 'capture_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $subproduct =& $this->_productId2Product(
                                $this->getSubproductId(),
                                $this->getConnection()
                                );
                        $this->setName($subproduct->getName());
                        $this->setCode($subproduct->getCode());
                        $this->setPrice($subproduct->getPrice());
                        $this->setVatStatus($subproduct->getVatStatus());
                        $this->setFormattedPrice(
                                sprintf("%.02f", $subproduct->getPrice() / 100)
                                );
                        $this->setDescription($subproduct->getDescription());
                        
                        $this->_saveWebletState();
                }
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/subproduct_management/edit_subproduct/edit_subproduct.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/subproduct_management/edit_subproduct/edit_subproduct_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                /* Prepare the form */
                $form =& new EditSubproductForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                
                /* Populate form fields/widgets */
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getName());
                
                $codeWidget =& $form->getWidget('code');
                $codeWidget->setValue($this->getCode());
                
                $priceWidget =& $form->getWidget('price');
                if ( !is_null($this->getFormattedPrice()) ||
                        $this->getFormattedPrice() != '' )
                {
                        $priceWidget->setValue($this->getFormattedPrice());
                }
                else
                {
                        $priceWidget->setValue($this->getPrice());
                }
                $vatStatusWidget =& $form->getWidget('vatstatus');
                $vatStatusWidget->setSelectedId($this->getVatStatus());
                
                $descriptionWidget =& $form->getWidget('description');
                $descriptionWidget->setValue($this->getDescription());
                
                
                $subproduct =& $this->_productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection()
                        );
                $type =& $subproduct->getType();
                
                
                /* Populate template */
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                $template->assign('typename', $type->getName());
                
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
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/edit_subproduct.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                
                /* Prepare the data */
                $name = $httpRequest->getParameter('name');
                $name = trim($name);
                $this->setName($name);
                
                $code = $httpRequest->getParameter('code');
                $code = trim($code);
                $this->setCode($code);
                
                $price = $httpRequest->getParameter('price');
                $price = trim($price);
                $this->setPrice($price);
                
                $vatStatus = $httpRequest->getParameter('vatstatus');
                $vatStatus = trim($vatStatus);
                $this->setVatStatus($vatStatus);
                
                $description = $httpRequest->getParameter('description');
                $description = trim($description);
                $this->setDescription($description);
                
                
                /* Prepare the form */
                $form =& new EditSubproductForm();
                
                /* Populate form fields/widgets */
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getName());
                
                $codeWidget =& $form->getWidget('code');
                $codeWidget->setValue($this->getCode());
                
                $priceWidget =& $form->getWidget('price');
                $priceWidget->setValue($this->getPrice());
                
                $vatStatusWidget =& $form->getWidget('vatstatus');
                $vatStatusWidget->setSelectedId($this->getVatStatus());
                
                $descriptionWidget =& $form->getWidget('description');
                $descriptionWidget->setValue($this->getDescription());
                
                $errors = $form->validate();
                
                if ( !is_null($price) && $price != '' )
                {
                        $parsedPrice =
                                eComStoreUtils::parseStringToPence($price);
                        if ( is_null($parsedPrice) )
                        {
                                array_push($errors,
                                        'Please enter a valid price');
                        }
                        else
                        {
                                $this->setPrice($parsedPrice);
                                $this->setFormattedPrice(
                                        sprintf("%.02f", $parsedPrice/100) );
                        }
                }
                
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect(
                                $configuration->getParameter('cms_root_webpath') .
                                '/ecomstore/product_catalogue/subproduct_management' . 
                                '/edit_subproduct.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/edit_subproduct.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& $this->_productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/manage_subproduct.php?subproductid=' .
                        $subproduct->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/subproduct_management/edit_subproduct/edit_subproduct.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/subproduct_management/edit_subproduct/edit_subproduct_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                /* Populate template */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                $template->assign('action', 'confirm_details_submit');
                
                
                $subproduct =& $this->_productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection()
                        );
                $type =& $subproduct->getType();
                
                $template->assign('name', $this->getName());
                $template->assign('typename', $type->getName());
                $template->assign('code', $this->getCode());
                $template->assign('formattedPrice', $this->getFormattedPrice());
                $template->assign('vatStatus', $this->getVatStatus());
                $PRODUCT_CLASS =& new Product();
                $template->assign('PRODUCT', $PRODUCT_CLASS);
                $template->assign('description', $this->getDescription());
                
                
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
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/edit_subproduct.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& $this->_productId2Product(
                                $this->getSubproductId(),
                                $this->getConnection()
                                );
                $subproduct->setName($this->getName());
                $subproduct->setCode($this->getCode());
                $subproduct->setPrice($this->getPrice());
                $subproduct->setVatStatus($this->getVatStatus());
                $subproduct->setDescription($this->getDescription());
                $subproduct->setConnection($this->getConnection());
                $subproduct->commit();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/manage_subproduct.php?subproductid=' . 
                        $subproduct->getId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->setView('capture_details');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/edit_subproduct.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& $this->_productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' . 
                        '/manage_subproduct.php?subproductid=' .
                        $subproduct->getId());
        }
        
        
        
        
        
        
        
        function &_productId2Product ( $id, &$connection )
        {
                $product =& Product::findFirst(
                        array('id' => $id),
                        $connection 
                        );
                
                return $product;
        }
        
        
        
        
        function _prepareBreadcrumbArray ()
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& eComStoreUtils::productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection() );
                
                $parentProduct =& $subproduct->getParentProduct();
                
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'eComStore',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/'
                                ),
                        array(
                                'name' => 'Products &amp Categories',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                ),
                        array(
                                'name' => 'Products',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_management/'
                                ),
                        array(
                                'name' => 'Product: ' . $parentProduct->getName(),
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_management' .
                                        '/manage_product.php?productid=' . $parentProduct->getId()
                                ),
                        array(
                                'name' => 'Subproduct: ' . $subproduct->getName(),
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/subproduct_management' .
                                        '/manage_subproduct.php?subproductid=' . $subproduct->getId()
                                )
                                
                        );
                
                return $breadcrumb;
        }
}


?>
