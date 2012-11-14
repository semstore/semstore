<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-29
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/eComStoreCMSUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/UploadFullsizeSubproductImageWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductImages.class.php');

class UploadFullsizeSubproductImageWeblet extends Weblet
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
        var $subproductId = NULL;
        var $uploadedImageFile = '';
        var $newProductImageFile = '';
        var $newProductBrowserThumbnailFile = '';
        var $newProductDetailsPageImageFile = '';
        var $newBasketImageFile = '';
        var $createProductBrowserImage = FALSE;
        var $createProductDetailsPageImage = FALSE;
        var $createBasketImage = FALSE;
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadFullsizeSubproductImageWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UploadFullsizeSubproductImageWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _UploadFullsizeSubproductImageWeblet0 ()
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
        
        
        function getSubproductId ()
        {
                return $this->subproductId;
        }
        
        
        function setSubproductId ( $id )
        {
                $this->subproductId = $id;
        }
        
        
        function getUploadedImageFile ()
        {
                return $this->uploadedImageFile;
        }
        
        
        function setUploadedImageFile ( $file )
        {
                $this->uploadedImageFile = $file;
        }
        
        
        function getNewProductImageFile ()
        {
                return $this->newProductImageFile;
        }
        
        
        function setNewProductImageFile ( $file )
        {
                $this->newProductImageFile = $file;
        }
        
        
        function getNewProductBrowserThumbnailFile ()
        {
                return $this->newProductBrowserThumbnailFile;
        }
        
        
        function setNewProductBrowserThumbnailFile ( $file )
        {
                $this->newProductBrowserThumbnailFile = $file;
        }
        
        
        function getNewProductDetailsPageImageFile ()
        {
                return $this->newProductDetailsPageImageFile;
        }
        
        
        function setNewProductDetailsPageImageFile ( $file )
        {
                $this->newProductDetailsPageImageFile = $file;
        }
        
        
        function getNewBasketImageFile ()
        {
                return $this->newBasketImageFile;
        }
        
        
        function setNewBasketImageFile ( $file )
        {
                $this->newBasketImageFile = $file;
        }
        
        
        function getCreateProductBrowserImage ()
        {
                return $this->createProductBrowserImage;
        }
        
        
        function setCreateProductBrowserImage ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->createProductBrowserImage = TRUE;
                }
                else
                {
                        $this->createProductBrowserImage = FALSE;
                }
        }
        
        
        function getCreateProductDetailsPageImage ()
        {
                return $this->createProductDetailsPageImage;
        }
        
        
        function setCreateProductDetailsPageImage ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->createProductDetailsPageImage = TRUE;
                }
                else
                {
                        $this->createProductDetailsPageImage = FALSE;
                }
        }
        
        
        function getCreateBasketImage ()
        {
                return $this->createBasketImage;
        }
        
        
        function setCreateBasketImage ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->createBasketImage = TRUE;
                }
                else
                {
                        $this->createBasketImage = FALSE;
                }
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
                $stateContainer =& new UploadFullsizeSubproductImageWebletStateContainer();
                $stateContainer->setView($this->getView());
                
                $stateContainer->setSubproductId($this->getSubproductId());
                $stateContainer->setCreateProductBrowserImage(
                        $this->getCreateProductBrowserImage());
                $stateContainer->setCreateProductDetailsPageImage(
                        $this->getCreateProductDetailsPageImage());
                $stateContainer->setCreateBasketImage(
                        $this->getCreateBasketImage());
                
                $stateContainer->setFormErrorCount($this->getFormErrorCount());
                $stateContainer->setUploadedImageFileErrorMessage(
                        $this->getUploadedImageFileErrorMessage());
                
                Session::putRef('ufssiWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('ufssiWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                
                $this->setSubproductId($stateContainer->getSubproductId());
                $this->setCreateProductBrowserImage(
                        $stateContainer->getCreateProductBrowserImage());
                $this->setCreateProductDetailsPageImage(
                        $stateContainer->getCreateProductDetailsPageImage());
                $this->setCreateBasketImage(
                        $stateContainer->getCreateBasketImage());
                
                $this->setFormErrorCount($stateContainer->getFormErrorCount());
                $this->setUploadedImageFileErrorMessage(
                        $stateContainer->getUploadedImageFileErrorMessage());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('ufssiWebletStateContainer', NULL);
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
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/subproduct_management/upload_subproduct_images/upload_fullsize_subproduct_image.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/subproduct_management/upload_subproduct_images/upload_fullsize_subproduct_image_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
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
                $template->assign('createProductBrowserImage',
                        $this->getCreateProductBrowserImage());
                $template->assign('createProductDetailsPageImage',
                        $this->getCreateProductDetailsPageImage());
                $template->assign('createBasketImage',
                        $this->getCreateBasketImage());
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
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
                        $httpResponse->redirect(
                                $configuration->getParameter('cms_root_webpath') .
                                '/ecomstore/product_catalogue/subproduct_management' .
                                '/upload_fullsize_subproduct_image.php?view=capture_details');
                }
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                /* Prepare the data */
                //$this->setUploadedImageFileInfo($_FILES['image']);
                if ( $httpRequest->getParameter('createProductBrowserImage')
                        == 'true' )
                {
                        $this->setCreateProductBrowserImage(TRUE);
                }
                else
                {
                        $this->setCreateProductBrowserImage(FALSE);
                }
                
                if ( $httpRequest->getParameter('createProductDetailsPageImage')
                        == 'true' )
                {
                        $this->setCreateProductDetailsPageImage(TRUE);
                }
                else
                {
                        $this->setCreateProductDetailsPageImage(FALSE);
                }
                
                if ( $httpRequest->getParameter('createBasketImage')
                        == 'true' )
                {
                        $this->setCreateBasketImage(TRUE);
                }
                else
                {
                        $this->setCreateBasketImage(FALSE);
                }
                
                
                // Reset error messages
                $errors = 0;
                $this->setFormErrorCount(0);
                $this->setUploadedImageFileErrorMessage('');
                
                // Validate form input
                if ( $_FILES['productImage']['tmp_name'] == '' )
                {
                        $this->setUploadedImageFileErrorMessage('No image uploaded');
                        $errors++;
                }
                
                $this->setFormErrorCount($errors);
                if ( $errors > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect(
                                $configuration->getParameter('cms_root_webpath') .
                                '/ecomstore/product_catalogue/subproduct_management' .
                                '/upload_fullsize_product_image.php?view=capture_details');
                        return;
                }
                
                
                
                // Move uploaded image from webserver tmp uploads directory to
                // webapp tmp upload directory.
                $uploadedImageFilename = '';
                if ( $_FILES['productImage']['tmp_name'] != '' )
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
                                $_FILES['productImage']['tmp_name'],
                                $_FILES['productImage']['name'],
                                $this->getTmpUploadsFtpPath());
                }
                $this->setUploadedImageFile($uploadedImageFilename);
                
                
                // Instantiate product
                $subproduct =& eComStoreUtils::productId2Product(
                        $this->getSubproductId(),
                        $this->getConnection() );
                
                
                // Instantiate product images object
                $productImages =& $subproduct->getImages();
                if ( is_null($productImages) )
                {
                        $productImages =& new ProductImages();
                        $productImages->setConnection($this->getConnection());
                        $productImages->setProductId($subproduct->getId());
                }
                
                
                // Convert uploaded image to png if not already.
                eComStoreCMSUtils::createProductImage(
                        $this->getTmpUploadsPath() . '/' .
                                $this->getUploadedImageFile(),
                        $this->getTmpUploadsPath() . '/' .
                                'prd'.$subproduct->getId().'.png'
                        );
                $this->setNewProductImageFile('prd'.$subproduct->getId().'.png');
                
                
                // If we need to create product browser thumbnail then
                // create it now
                if ( $this->getCreateProductBrowserImage() )
                {
                        eComStoreCMSUtils::createProductBrowserThumbnail(
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewProductImageFile(),
                                $this->getTmpUploadsPath() . '/' .
                                        'prd'.$subproduct->getId().'_tn.png'
                                );
                        $this->setNewProductBrowserThumbnailFile(
                                'prd'.$subproduct->getId().'_tn.png');
                }
                
                
                // If we need to create product details page image then
                // create it now
                if ( $this->getCreateProductDetailsPageImage() )
                {
                        eComStoreCMSUtils::createProductDetailsPageImage(
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewProductImageFile(),
                                $this->getTmpUploadsPath() . '/' .
                                        'prd'.$subproduct->getId().'_small.png'
                                );
                        $this->setNewProductDetailsPageImageFile(
                                'prd'.$subproduct->getId().'_small.png');
                }
                
                
                // If we need to create basket image then
                // create it now
                if ( $this->getCreateBasketImage() )
                {
                        eComStoreCMSUtils::createBasketImage(
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewProductImageFile(),
                                $this->getTmpUploadsPath() . '/' .
                                        'prd'.$subproduct->getId().'_bsk.png'
                                );
                        $this->setNewBasketImageFile(
                                'prd'.$subproduct->getId().'_bsk.png');
                }
                
                
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
                                $this->getNewProductImageFile(),
                        $this->getProductImagesFtpPath() . '/' .
                                'prd'.$subproduct->getId().'.png'
                        );
                
                
                // If a new product browser thumbnail created then move to
                // images directory
                if ( $this->getCreateProductBrowserImage() )
                {
                        eComStoreCMSUtils::_ftpMoveFile(
                                array(
                                        'server' => $config->getParameter('ftp_server'),
                                        'port' => $config->getParameter('ftp_port'),
                                        'username' => $config->getParameter('ftp_username'),
                                        'password' => $config->getParameter('ftp_password')
                                        ),
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewProductBrowserThumbnailFile(),
                                $this->getProductImagesFtpPath() . '/' .
                                        'prd'.$subproduct->getId().'_tn.png'
                                );
                }
                
                
                // If a new product details page image created then move to
                // images directory
                if ( $this->getCreateProductDetailsPageImage() )
                {
                        eComStoreCMSUtils::_ftpMoveFile(
                                array(
                                        'server' => $config->getParameter('ftp_server'),
                                        'port' => $config->getParameter('ftp_port'),
                                        'username' => $config->getParameter('ftp_username'),
                                        'password' => $config->getParameter('ftp_password')
                                        ),
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewProductDetailsPageImageFile(),
                                $this->getProductImagesFtpPath() . '/' .
                                        'prd'.$subproduct->getId().'_small.png'
                                );
                }
                
                
                // If a new basket image created then move to
                // images directory
                if ( $this->getCreateBasketImage() )
                {
                        eComStoreCMSUtils::_ftpMoveFile(
                                array(
                                        'server' => $config->getParameter('ftp_server'),
                                        'port' => $config->getParameter('ftp_port'),
                                        'username' => $config->getParameter('ftp_username'),
                                        'password' => $config->getParameter('ftp_password')
                                        ),
                                $this->getTmpUploadsPath() . '/' .
                                        $this->getNewBasketImageFile(),
                                $this->getProductImagesFtpPath() . '/' .
                                        'prd'.$subproduct->getId().'_bsk.png'
                                );
                }
                
                
                // Destroy uploaded image file in webapp tmp directory
                unlink($this->getTmpUploadsPath() . '/' .
                        $this->getUploadedImageFile());
                
                
                // Commit name of new image to database
                $productImages->setProductImage($this->getNewProductImageFile());
                if ( $this->getCreateProductBrowserImage() )
                {
                        $productImages->setBrowserThumbnailImage(
                                $this->getNewProductBrowserThumbnailFile());
                }
                if ( $this->getCreateProductDetailsPageImage() )
                {
                        $productImages->setProductDetailsPageImage(
                                $this->getNewProductDetailsPageImageFile());
                }
                if ( $this->getCreateBasketImage() )
                {
                        $productImages->setBasketImage(
                                $this->getNewBasketImageFile());
                }
                $productImages->commit();
                
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' .
                        '/manage_subproduct_images.php?subproductid=' .
                        $subproduct->getId());
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& Product::findFirst(
                        array('id' => $this->getSubproductId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/subproduct_management' .
                        '/manage_subproduct_images.php?subproductid=' .
                        $subproduct->getId());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $configuration =& $this->getConfigurator();
                
                $subproduct =& Product::findFirst(
                        array('id' => $this->getSubproductId()),
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
                                        '/ecomstore/product_catalogue/product_management/' .
                                        'manage_product.php?productid=' . $parentProduct->getId()
                                ),
                        array(
                                'name' => 'Subproduct: ' . $subproduct->getName(),
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/subproduct_management/' .
                                        'manage_subproduct.php?subproductid=' . $subproduct->getId()
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
