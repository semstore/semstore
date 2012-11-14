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
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/UploadProductImagesWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/UploadProductImagesForm.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('Net/Ftp.class.php');

class UploadProductImagesWeblet extends Weblet
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
        var $categoryId = NULL;
        var $categoryName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadProductImagesWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UploadProductImagesWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _UploadProductImagesWeblet0 ()
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
                $stateContainer =& new UploadProductImagesWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setProductId($this->getProductId());
                
                Session::putRef('upiWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('upiWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setProductId($stateContainer->getProductId());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('upiWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'capture_details' )
                {
                        $this->_capture_details(  $httpRequest, $httpResponse );
                }
                else
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        exit();
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        exit();
                }
        }
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $this->_capture_details( $httpRequest, $httpResponse );
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
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/upload_product_images/upload_product_images.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/upload_product_images/upload_product_images_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new UploadProductImagesForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                $template->assign('form', $form);
                
                foreach ( array_keys($form->getWidgets()) as $widgetId )
                {
                        $widget =& $form->getWidget($widgetId);
                        $template->assign($widgetId.'Widget', $widget);
                }
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        $this->_capture_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_capture_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('upload_product_images.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                $form =& new UploadProductImagesForm();
                $errors = $form->validate();
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('upload_product_images.php?view=capture_details');
                        return;
                }
                
                //print '<pre>'.print_r($_FILES,TRUE).'</pre>';
                
                $pfImageFilename = '';
                if ( $_FILES['productinfo_image']['tmp_name'] != '' )
                {
                        $pfImageFilename = $this->moveUploadedMasterImageToImageDir(
                                'productinfo_image',
                                $this->getProductId() );
                }
                
                
                $tnImageFilename = '';
                if ( $_FILES['thumbnail_image']['tmp_name'] != '' )
                {
                        $tnImageFilename = $this->moveUploadedThumbnailImageToImageDir(
                                'thumbnail_image',
                                $this->getProductId() );
                }
                
                
                $product =& Product::findFirst(
                        array('id' => $this->getProductId()),
                        $this->getConnection() );
                if ( !is_null($pfImageFilename) && $pfImageFilename != '' )
                {
                        $product->setImage($pfImageFilename);
                }
                if ( !is_null($tnImageFilename) && $tnImageFilename != '' )
                {
                        $product->setThumbnail($tnImageFilename);
                }
                
                $product->commit();
                
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
                        $product->getId());
                exit();
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& Product::findFirst(
                        array('id' => $this->getProductId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product.php?productid=' .
                        $product->getId());
                exit();
        }
        
        
        
        
        
        function moveUploadedMasterImageToImageDir ( $fileId, $productId )
        {
                $filename = $productId;
                $src = $_FILES[$fileId]['tmp_name'];
                $ext = '';
                if ( preg_match('{(\.[^\.]+?)$}', $_FILES[$fileId]['name'], $matches) > 0 )
                {
                        $ext = $matches[1];
                        $filename .= $ext;
                }
                
                return $this->moveUploadedFileToImageDir( $src, $filename );
        }
        
        
        function moveUploadedThumbnailImageToImageDir ( $fileId, $productId )
        {
                $filename = 'tn'.$productId;
                $src = $_FILES[$fileId]['tmp_name'];
                $ext = '';
                if ( preg_match('{(\.[^\.]+?)$}', $_FILES[$fileId]['name'], $matches) > 0 )
                {
                        $ext = $matches[1];
                        $filename .= $ext;
                }
                
                return $this->moveUploadedFileToImageDir( $src, $filename );
        }
        
        
        function moveUploadedFileToImageDir ( $src, $filename )
        {
                $dest = Configuration::getParameter('ftp_webapp_product_images_dir') .
                 '/'.$filename;
                 
                $ftp =& new Ftp(
                        Configuration::getParameter('ftp_server'),
                        Configuration::getParameter('ftp_port'),
                        Configuration::getParameter('ftp_username'),
                        Configuration::getParameter('ftp_password')
                        );
                $ftp->connect();
                $ftp->put($src, $dest, FTP_BINARY);
                $ftp->chmod('666', $dest);
                
                return $filename;
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
