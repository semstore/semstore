<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-03
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/CopyProductWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/CopyProductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class CopyProductWeblet extends Weblet
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
        
        var $stateContainer = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CopyProductWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_CopyProductWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _CopyProductWeblet0 ()
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
                return $this->stateContainer->view;
        }
        
        
        function setView ( $view )
        {
                $this->stateContainer->view = $view;
        }
        
        
        function getFormValidationErrors ()
        {
                return $this->stateContainer->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->stateContainer->formErrors = $errorsArray;
        }
        
        
        function getProductId ()
        {
                return $this->stateContainer->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->stateContainer->productId = $id;
        }
        
        
        function getName ()
        {
                return $this->stateContainer->name;
        }
        
        
        function setName( $name )
        {
                $this->stateContainer->name = $name;
        }
        
        
        function getCode ()
        {
                return $this->stateContainer->code;
        }
        
        
        function setCode ( $code )
        {
                $this->stateContainer->code = $code;
        }
        
        
        function getPrice ()
        {
                return $this->stateContainer->price;
        }
        
        
        function setPrice ( $price )
        {
                $this->stateContainer->price = $price;
        }
        
        
        function getVatStatus ()
        {
                return $this->stateContainer->vatStatus;
        }
        
        
        function setVatStatus ( $vatStatus )
        {
                $this->stateContainer->vatStatus = $vatStatus;
        }
        
        
        function getFormattedPrice ()
        {
                return $this->stateContainer->formattedPrice;
        }
        
        
        function setFormattedPrice ( $fprice )
        {
                $this->stateContainer->formattedPrice = $fprice;
        }
        
        
        function getDescription ()
        {
                return $this->stateContainer->description;
        }
        
        
        function setDescription ( $des )
        {
                $this->stateContainer->description = $des;
        }
        
        
        function getCopyAttributes ()
        {
                return $this->stateContainer->copyAttributes;
        }
        
        
        function setCopyAttributes ( $bool )
        {
                $this->stateContainer->copyAttributes =
                        ($bool === TRUE || $bool == 1);
        }
        
        
        function getCopySubproducts ()
        {
                return $this->stateContainer->copySubproducts;
        }
        
        
        function setCopySubproducts ( $bool )
        {
                $this->stateContainer->copySubproducts =
                        ($bool === TRUE || $bool == 1);
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
                $this->stateContainer =&
                        new CopyProductWebletStateContainer();
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfigurator($config);
        }
        
        
        function _saveWebletState ()
        {
                Session::putRef('copyProductWebletStateContainer',
                        $this->stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =&
                        Session::getRef('copyProductWebletStateContainer');
                if ( !is_null($stateContainer) )
                {
                        $this->stateContainer =& $stateContainer;
                }
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('copyProductWebletStateContainer', NULL);
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
                
                $product = NULL;
                
                if ( $view == 'capture_details' )
                {
                        $this->_restoreWebletState();
                }
                
                $product =& $this->_productId2Product(
                                $this->getProductId(),
                                $this->getConnection()
                                );
                
                if ( $view != 'capture_details' )
                {
                        $this->setName($product->getName());
                        $this->setCode($product->getCode());
                        $this->setPrice($product->getPrice());
                        $this->setVatStatus($product->getVatStatus());
                        $this->setFormattedPrice(
                                sprintf("%1.02f", $product->getPrice() / 100)
                                );
                        $this->setDescription($product->getDescription());
                        
                        $this->_saveWebletState();
                }
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/copy_product/copy_product.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/copy_product/copy_product_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $template->assign('product', $product);
                
                /* Prepare the form */
                $form =& new CopyProductForm();
                
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
                
                $copyAttributesWidget =& $form->getWidget('copyAttributes');
                $copyAttributesWidget->setChecked(
                        $this->getCopyAttributes());
                
                $copySubproductsWidget =& $form->getWidget('copySubproducts');
                $copySubproductsWidget->setChecked(
                        $this->getCopySubproducts());
                
                /*
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                */
                $type =& $product->getType();
                
                
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
                        '/ecomstore/product_catalogue/product_management' . 
                        '/copy_product.php?view=capture_details');
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
                
                $copyAttributes = $httpRequest->getParameter('copyAttributes');
                $copyAttributes = trim($copyAttributes);
                $this->setCopyAttributes($copyAttributes);
                
                $copySubproducts =
                        $httpRequest->getParameter('copySubproducts');
                $copySubproducts = trim($copySubproducts);
                $this->setCopySubproducts($copySubproducts);
                
                
                /* Prepare the form */
                $form =& new CopyProductForm();
                
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
                
                $copyAttributesWidget =& $form->getWidget('copyAttributes');
                $copyAttributesWidget->setChecked(
                        $this->getCopyAttributes());
                
                $copySubproductsWidget =& $form->getWidget('copySubproducts');
                $copySubproductsWidget->setChecked(
                        $this->getCopySubproducts());
                
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
                                '/ecomstore/product_catalogue/product_management' . 
                                '/copy_product.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' . 
                        '/copy_product.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' . 
                        '/manage_product.php?productid=' .
                        $product->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/copy_product/copy_product.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/copy_product/copy_product_confirmation.tpl');
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
                
                
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                $template->assign('product', $product);
                $type =& $product->getType();
                
                $template->assign('name', $this->getName());
                $template->assign('typename', $type->getName());
                $template->assign('code', $this->getCode());
                $template->assign('formattedPrice', $this->getFormattedPrice());
                $template->assign('vatStatus', $this->getVatStatus());
                $PRODUCT_CLASS =& new Product();
                $template->assign('PRODUCT', $PRODUCT_CLASS);
                $template->assign('description', $this->getDescription());
                $template->assign('copyAttributes',
                        ($this->getCopyAttributes() == TRUE ? 1 : 0));
                $template->assign('copySubproducts',
                        ($this->getCopySubproducts() == TRUE ? 1 : 0));
                
                
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
                        '/ecomstore/product_catalogue/product_management' . 
                        '/copy_product.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $product =& $this->_productId2Product(
                                $this->getProductId(),
                                $this->getConnection()
                                );
                
                $newProduct =& $product->copyToProduct(
                        array(
                                'name' => $this->getName(),
                                'code' => $this->getCode(),
                                'price' => $this->getPrice(),
                                'vatStatus' => $this->getVatStatus(),
                                'description' => $this->getDescription(),
                                'dateTimeAdded' => date('Y-m-d H:i:s')
                                ),
                        $this->getCopyAttributes(),
                        $this->getCopySubproducts());
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' .
                        '/manage_product.php?productid=' .
                        $newProduct->getId());
                return TRUE;
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->setView('capture_details');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' . 
                        '/copy_product.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' . 
                        '/manage_product.php?productid=' .
                        $product->getId());
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
                
                $product =& eComStoreUtils::productId2Product(
                        $this->getProductId(),
                        $this->getConnection() );
                
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
                                'name' => 'Subproduct: ' . $product->getName(),
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/subproduct_management' .
                                        '/manage_subproduct.php?subproductid=' . $product->getId()
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
