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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/EditProductWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/EditProductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class EditProductWeblet extends Weblet
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
        var $name = '';
        var $typeName = NULL;
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
        
        
        function EditProductWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditProductWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditProductWeblet0 ()
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
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function setName( $name )
        {
                $this->name = $name;
        }
        
        
        function getTypeName ()
        {
                return $this->typeName;
        }
        
        
        function setTypeName ( $name )
        {
                $this->typeName = $name;
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
                $stateContainer =& new EditProductWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setProductId($this->getProductId() );
                $stateContainer->setName($this->getName() );
                $stateContainer->setTypeName($this->getTypeName());
                $stateContainer->setCode($this->getCode() );
                $stateContainer->setPrice($this->getPrice() );
                $stateContainer->setVatStatus($this->getVatStatus() );
                $stateContainer->setFormattedPrice($this->getFormattedPrice() );
                $stateContainer->setDescription($this->getDescription() );
                
                Session::putRef('editProductWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('editProductWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setProductId($stateContainer->getProductId());
                $this->setName($stateContainer->getName());
                $this->setTypeName($stateContainer->getTypeName());
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
                        $product =& $this->_productId2Product(
                                $this->getProductId(),
                                $this->getConnection()
                                );
                        $type =& $product->getType();
                        
                        $this->setName($product->getName());
                        $this->setTypeName(
                                is_object($type) ?
                                        $type->getName() :
                                        'Untyped' );
                        $this->setCode($product->getCode());
                        $this->setPrice($product->getPrice());
                        $this->setVatStatus($product->getVatStatus());
                        $this->setFormattedPrice(
                                sprintf("%.02f", $product->getPrice() / 100)
                                );
                        $this->setDescription($product->getDescription());
                        
                        $this->_saveWebletState();
                }
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/edit_product/edit_product.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/edit_product/edit_product_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                /* Prepare the form */
                $form =& new EditProductForm();
                /*
                $types =& ProductType::find(
                        'ORDER BY name',
                        $this->getConnection()
                        );
                $form->populateTypes($types);
                */
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                
                /* Populate form fields/widgets */
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getName());
                
                //$typeWidget =& $form->getWidget('type');
                //$typeWidget->setSelected($this->getTypeName());
                
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
                
                
                /* Populate template */
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                $template->assign('typename', $this->getTypeName());
                
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
                $httpResponse->redirect('edit_product.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                $name = $httpRequest->getParameter('name');
                $name = trim($name);
                $this->setName($name);
                
                /*
                $typeName = $httpRequest->getParameter('type');
                $typeName = trim($typeName);
                $this->setTypeName($typeName);
                */
                
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
                $form =& new EditProductForm();
                /*
                $types =& ProductType::find(
                        'ORDER BY name',
                        $this->getConnection()
                        );
                $form->populateTypes($types);
                */
                
                /* Populate form fields/widgets */
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getName());
                
                /*
                $typeWidget =& $form->getWidget('type');
                $typeWidget->setSelected($this->getTypeName());
                */
                
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
                        $httpResponse->redirect('edit_product.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
                        $product->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/edit_product/edit_product.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/edit_product/edit_product_confirmation.tpl');
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
                
                $template->assign('name', $this->getName());
                $template->assign('typename', $this->getTypeName());
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
                $httpResponse->redirect('edit_product.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $product =& new Product();
                
                $product =& $this->_productId2Product(
                                $this->getProductId(),
                                $this->getConnection()
                                );
                $product->setName($this->getName());
                $product->setCode($this->getCode());
                $product->setPrice($this->getPrice());
                $product->setVatStatus($this->getVatStatus());
                $product->setDescription($this->getDescription());
                $product->setConnection($this->getConnection());
                $product->commit();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product.php?productid=' . 
                        $product->getId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('edit_product.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                        
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
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
        
        
        
        
        function buildTypesDropDown ()
        {
                $sql = 'ORDER BY name';
                $types = ProductType::find($sql, $this->getConnection());
                
                $html = '<select name="type">'."\n";
                foreach ( array_keys($types) as $index )
                {
                        $type =& $types[$index];
                        
                        $html .= '<option value="'.$type->getId().'">' . 
                                $type->getName().'</option>'."\n";
                }
                $html .= '</select>'."\n";
                
                return $html;
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
