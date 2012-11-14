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
require_once('Sites/AES/CMS/Templates/CMSTemplate.class.php');
require_once('Sites/AES/AESUtils.class.php');
require_once('Sites/AES/CMS/AESCMSUtils.class.php');
require_once('Sites/AES/CMS/AESCMSUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/UploadPDFWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/eComStoreCMSUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductPDF.class.php');

class UploadPDFWeblet extends Weblet
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
        var $tmpUploadsPath = '';
        var $tmpUploadsWebpath = '';
        var $tmpUploadsFtpPath = '';
        var $productImagesPath = '';
        var $productImagesWebpath = '';
        var $productImagesFtpPath = '';
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $productId = NULL;
        var $uploadedImageFile = '';
        var $newProductBrowserThumbnailFile = '';
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadPDFWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UploadPDFWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _UploadPDFWeblet0 ()
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
        
        
        
        
        
        function getTmpUploadsPath ()
        {
                return $this->tmpUploadsPath;
        }
        
        
        function setTmpUploadsPath ( $path )
        {
                $this->tmpUploadsPath = $path;
        }
        
        
        function getTmpUploadsWebpath ()
        {
                return $this->tmpUploadsWebpath;
        }
        
        
        function setTmpUploadsWebpath ( $path )
        {
                $this->tmpUploadsWebpath = $path;
        }
        
        
        function getTmpUploadsFtpPath ()
        {
                return $this->tmpUploadsFtpPath;
        }
        
        
        function setTmpUploadsFtpPath ( $path )
        {
                $this->tmpUploadsFtpPath = $path;
        }
        
        
        function getProductImagesPath ()
        {
                return $this->productImagesPath;
        }
        
        
        function setProductImagesPath ( $path )
        {
                $this->productImagesPath = $path;
        }
        
        
        function getProductImagesWebpath ()
        {
                return $this->productImagesWebpath;
        }
        
        
        function setProductImagesWebpath ( $path )
        {
                $this->productImagesWebpath = $path;
        }
        
        
        function getProductImagesFtpPath ()
        {
                return $this->productImagesFtpPath;
        }
        
        
        function setProductImagesFtpPath ( $path )
        {
                $this->productImagesFtpPath = $path;
        }
        
        
        
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        
        function getUploadedImageFile ()
        {
                return $this->uploadedImageFile;
        }
        
        
        function setUploadedImageFile ( $file )
        {
                $this->uploadedImageFile = $file;
        }
        
        
        function getNewProductBrowserThumbnailFile ()
        {
                return $this->newProductBrowserThumbnailFile;
        }
        
        
        function setNewProductBrowserThumbnailFile ( $file )
        {
                $this->newProductBrowserThumbnailFile = $file;
        }
        
        
        function getFormErrorCount ()
        {
                return $this->formErrorCount;
        }
        
        
        function setFormErrorCount ( $errcnt )
        {
                $this->formErrorCount = $errcnt;
        }
        
        
        function getUploadedImageFileErrorMessage ()
        {
                return $this->uploadedImageFileErrMsg;
        }
        
        
        function setUploadedImageFileErrorMessage ( $errmsg )
        {
                $this->uploadedImageFileErrMsg = $errmsg;
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
                
                $this->setTmpUploadsPath(
                        $config->getParameter('site_tmp_uploads_path'));
                $this->setTmpUploadsWebpath(
                        $config->getParameter('site_tmp_uploads_webpath'));
                $this->setTmpUploadsFtpPath(
                        $config->getParameter('site_tmp_uploads_ftp_path'));
                
                $this->setProductImagesPath(
                        $config->getParameter('product_images_path'));
                $this->setProductImagesWebpath(
                        $config->getParameter('product_images_webpath'));
                $this->setProductImagesFtpPath(
                        $config->getParameter('product_images_ftp_path'));
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new UploadPDFWebletStateContainer();
                $stateContainer->setView($this->getView());
                
                $stateContainer->setProductId($this->getProductId());
                $stateContainer->setUploadedImageFile(
                        $this->getUploadedImageFile());
                        
                $stateContainer->setFormErrorCount($this->getFormErrorCount());
                $stateContainer->setUploadedImageFileErrorMessage(
                        $this->getUploadedImageFileErrorMessage());
                
                Session::putRef('upbtiWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('upbtiWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                
                $this->setProductId($stateContainer->getProductId());
                $this->setUploadedImageFile(
                        $stateContainer->getUploadedImageFile());
                        
                $this->setFormErrorCount($stateContainer->getFormErrorCount());
                $this->setUploadedImageFileErrorMessage(
                        $stateContainer->getUploadedImageFileErrorMessage());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('upbtiWebletStateContainer', NULL);
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
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
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
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/upload_pdf/upload_pdf.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/upload_pdf/upload_pdf_form.tpl');
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'multipart/form-data');
                
                $template->assign('formErrorCount', $this->getFormErrorCount());
                $template->assign('uploadedImageFileErrMsg',
                        $this->getUploadedImageFileErrorMessage());
                
                $template->assign('action', 'capture_details_submit');
                
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
                else
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('upload_pdf.php?view=capture_details');
                }
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                                
                // Reset error messages
                $errors = 0;
                $this->setFormErrorCount(0);
                $this->setUploadedImageFileErrorMessage('');
                
                // Validate form input
                if ( $_FILES['productPDF']['tmp_name'] == '' )
                {
                        $this->setUploadedImageFileErrorMessage('No image uploaded');
                        $errors++;
                }
                
                $this->setFormErrorCount($errors);
                if ( $errors > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('upload_pdf.php?view=capture_details');
                        return;
                }
                
                
                
                // Move uploaded image from webserver tmp uploads directory to
                // webapp tmp upload directory.
                $uploadedImageFilename = '';
                if ( $_FILES['productPDF']['tmp_name'] != '' )
                {
                        $config = $this->getConfigurator();
                        $uploadedImageFilename =
                                eComStoreCMSUtils::_moveUploadedImageFileToTmpDir(
                                array(
                                        'server' => $config->getParameter('ftp_server'),
                                        'port' => $config->getParameter('ftp_port'),
                                        'username' => $config->getParameter('ftp_username'),
                                        'password' => $config->getParameter('ftp_password')
                                        ),
                                $_FILES['productPDF']['tmp_name'],
                                $_FILES['productPDF']['name'],
                                $this->getTmpUploadsFtpPath());
                }
				
                $this->setUploadedImageFile($uploadedImageFilename);
                
                // Instantiate product
                $product =& eComStoreUtils::productId2Product(
                        $this->getProductId(),
                        $this->getConnection() );
                
                //create new product pdf db entry
				$productPDF =& new ProductPDF();
				$productPDF->setConnection($this->getConnection());
				$productPDF->setId($this->getProductId());
				$productPDF->setPDF($product->getId().'.pdf');
                
                // Move new product image from webapp tmp directory to product
                // images directory
                eComStoreCMSUtils::_ftpMoveFile(
                        array(
                                'server' => $config->getParameter('ftp_server'),
                                'port' => $config->getParameter('ftp_port'),
                                'username' => $config->getParameter('ftp_username'),
                                'password' => $config->getParameter('ftp_password')
                                ),
                        $this->getTmpUploadsPath() . '/' .
                                $this->getUploadedImageFile(),
                        $config->getParameter('product_pdf_ftp_path') . '/' .
                                $product->getId().'.pdf'
                        );
                                				
				$productPDF->commit();
				
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_pdf.php?productid=' .
                        $product->getId());
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $product =& Product::findFirst(
                        array('id' => $this->getProductId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_pdf.php?productid=' .
                        $product->getId());
        }
}


?>
