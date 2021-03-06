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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/EditGlobalProductAttributesWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeAttribute.class.php');

class EditGlobalProductAttributesWeblet extends Weblet
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
        var $fieldsArray = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditGlobalProductAttributesWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditGlobalProductAttributesWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditGlobalProductAttributesWeblet0 ()
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
        
        
        function &getFieldsArray ()
        {
                return $this->fieldsArray;
        }
        
        
        function setFieldsArray ( &$array )
        {
                $this->fieldsArray =& $array;
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
                $stateContainer =& new EditGlobalProductAttributesWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setProductId($this->getProductId() );
                $stateContainer->setFieldsArray($this->getFieldsArray());
                
                Session::putRef('epgaWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('epgaWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setProductId($stateContainer->getProductId());
                $this->setFieldsArray($stateContainer->getFieldsArray());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('epgaWebletStateContainer', NULL);
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
                        return $this->_capture_details(
                                $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        return $this->_confirm_details(
                                $httpRequest, $httpResponse );
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
                        return $this->_capture_details_submit(
                                $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        return $this->_confirm_details_submit(
                                $httpRequest, $httpResponse );
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
                        
                        $groups =& $product->getProductGlobalAttributeGroups();
                        $fieldsArray = $this->_groups2FieldsArray($groups);
                        $this->setFieldsArray($fieldsArray);
                        
                        $this->_saveWebletState();
                }
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/edit_global_product_attributes/edit_global_product_attributes.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/edit_global_product_attributes/edit_global_product_attributes_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                /* Populate template */
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                $template->assign('action', 'capture_details_submit');
                $template->assign('fieldsArray', $this->getFieldsArray());
                
                
                /* Display template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_capture_details_next(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_capture_details_cancel(
                                $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_global_product_attributes.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $errors = array();
                
                /* Prepare the data */
                $fieldsArray = $this->getFieldsArray();
                
                foreach ( array_keys($fieldsArray) as $grpIndex )
                {
                        foreach ( array_keys($fieldsArray[$grpIndex]['attributes'])
                                as $attIndex )
                        {
                                $param = 'attribute' .
                                        $fieldsArray[$grpIndex]['attributes'][$attIndex]['attributeId'];
                                $value = $httpRequest->getParameter($param);
                                if ( !is_null($value) )
                                {
                                        $fieldsArray[$grpIndex]['attributes'][$attIndex]['value'] = $value;
                                }
                        }
                }
                
                $this->setFieldsArray($fieldsArray);
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('edit_global_product_attributes.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_global_product_attributes.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
                        $product->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/edit_global_product_attributes/edit_global_product_attributes.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/edit_global_product_attributes/edit_global_product_attributes_confirmation.tpl');
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
                
                $template->assign('fieldsArray', $this->getFieldsArray());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_confirm_details_next(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Edit Details' )
                {
                        return $this->_confirm_details_edit(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_confirm_details_cancel(
                                $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_global_product_attributes.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection()
                        );
                $fieldsArray =& $this->getFieldsArray();
                
                $groups =& $product->getProductGlobalAttributeGroups();
                foreach ( array_keys($groups) as $grpIndex )
                {
                        $group =& $groups[$grpIndex];
                        $attributes =& $group->getAttributes();
                        foreach ( array_keys($attributes) as $attIndex )
                        {
                                $attribute =& $attributes[$attIndex];
                                $value = $this->_searchFieldsArrayForAttributeValue(
                                        $fieldsArray,
                                        $attribute->getAttributeId() );
                                
                                if ( !is_null($value) )
                                {
                                        $attribute->setValue($value);
                                        $attribute->commit();
                                }
                                
                        }
                }
                        
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product.php?productid=' . 
                        $product->getId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('edit_global_product_attributes.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& $this->_productId2Product(
                        $this->getProductId(),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
                        $product->getId());
        }
        
        
        
        
        
        function &_productId2Product ( $id, &$connection )
        {
                $product =& Product::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $product;
        }
        
        
        function &_groups2FieldsArray ( &$groups )
        {
                $fieldsArray = array();
                
                foreach ( array_keys($groups) as $grpIndex )
                {
                        $group =& $groups[$grpIndex];
                        
                        $groupArray = array();
                        $groupArray['name'] = $group->getName();
                        $groupArray['attributes'] = array();
                        
                        $attributes =& $group->getAttributes();
                        foreach ( array_keys($attributes) as $attIndex )
                        {
                                $attribute =& $attributes[$attIndex];
                                
                                $attributeArray = array();
                                $attributeArray['id'] = $attribute->getId();
                                $attributeArray['attributeId'] =
                                        $attribute->getAttributeId();
                                $attributeArray['name'] = $attribute->getName();
                                $attributeArray['value'] =
                                        $attribute->getValue();
                                
                                $groupArray['attributes'][] = $attributeArray;
                        }
                        
                        $fieldsArray[] = $groupArray;
                }
                
                return $fieldsArray;
        }
        
        
        function _searchFieldsArrayForAttributeValue ( $fieldsArray, $id )
        {
                foreach ( $fieldsArray as $group )
                {
                        foreach ( $group['attributes'] as $attribute )
                        {
                                if ( $attribute['attributeId'] == $id )
                                {
                                        return $attribute['value'];
                                }
                        }
                }
                
                return NULL;
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
