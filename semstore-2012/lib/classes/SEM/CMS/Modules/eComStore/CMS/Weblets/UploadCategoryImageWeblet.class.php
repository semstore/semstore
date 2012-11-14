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
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/eComStoreCMSUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/UploadCategoryImageWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductImages.class.php');

class UploadCategoryImageWeblet extends Weblet
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
        var $categoryImagesPath = '';
        var $categoryImagesWebpath = '';
        var $categoryImagesFtpPath = '';
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $categoryId = NULL;
        var $category = NULL;
        var $uploadedImageFile = '';
        var $newProductCategoryThumbnailFile = '';
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadCategoryImageWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UploadCategoryImageWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _UploadCategoryImageWeblet0 ()
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
        
        
        function getProductCategoryImagesPath ()
        {
                return $this->categoryImagesPath;
        }
        
        
        function setProductCategoryImagesPath ( $path )
        {
                $this->categoryImagesPath = $path;
        }
        
        
        function getProductCategoryImagesWebpath ()
        {
                return $this->categoryImagesWebpath;
        }
        
        
        function setProductCategoryImagesWebpath ( $path )
        {
                $this->categoryImagesWebpath = $path;
        }
        
        
        function getProductCategoryImagesFtpPath ()
        {
                return $this->categoryImagesFtpPath;
        }
        
        
        function setProductCategoryImagesFtpPath ( $path )
        {
                $this->categoryImagesFtpPath = $path;
        }
        
        
        
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getCategoryId ()
        {
                return $this->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->categoryId = $id;
        }
        
        function setCategory ( $cat )
        {
                $this->category = $cat;
        }
        
        function getCategory ( )
        {
                return $this->category;
        }
        
        function getUploadedImageFile ()
        {
                return $this->uploadedImageFile;
        }
        
        
        function setUploadedImageFile ( $file )
        {
                $this->uploadedImageFile = $file;
        }
        
        
        function getNewProductCategoryThumbnailFile ()
        {
                return $this->newProductCategoryThumbnailFile;
        }
        
        
        function setNewProductCategoryThumbnailFile ( $file )
        {
                $this->newProductCategoryThumbnailFile = $file;
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
                
                $this->setProductCategoryImagesPath(
                        $config->getParameter('product_category_images_path'));
                $this->setProductCategoryImagesWebpath(
                        $config->getParameter('product_category_images_webpath'));
                $this->setProductCategoryImagesFtpPath(
                        $config->getParameter('product_category_images_ftp_path'));
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new UploadCategoryImageWebletStateContainer();
                $stateContainer->setView($this->getView());
                
                $stateContainer->setCategoryId($this->getCategoryId());
                $stateContainer->setCategory($this->getCategory());
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
                
                $this->setCategoryId($stateContainer->getCategoryId());
                $this->setCategory($stateContainer->getCategory());
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
                        $category = ProductCategory::findFirst(
                                array('id' => $this->getCategoryId()),
                                $this->getConnection());
                        
                        $this->setCategory($category);
                        
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/upload_category_image/upload_category_image.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/upload_category_image/upload_category_image_form.tpl');
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
                        $httpResponse->redirect('upload_product_category_image.php?view=capture_details');
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
                if ( $_FILES['categoryImage']['tmp_name'] == '' )
                {
                        $this->setUploadedImageFileErrorMessage('No image uploaded');
                        $errors++;
                }
                
                $this->setFormErrorCount($errors);
                if ( $errors > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('upload_product_category_image.php?view=capture_details');
                        return;
                }
                
                
                
                // Move uploaded image from webserver tmp uploads directory to
                // webapp tmp upload directory.
                $uploadedImageFilename = '';
                if ( $_FILES['categoryImage']['tmp_name'] != '' )
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
                                $_FILES['categoryImage']['tmp_name'],
                                $_FILES['categoryImage']['name'],
                                $this->getTmpUploadsFtpPath());
                }
                $this->setUploadedImageFile($uploadedImageFilename);
                
                
                // Instantiate category
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection());
                
                
                // Convert uploaded image to png if not already.
                eComStoreCMSUtils::createProductCategoryThumbnail(
                        $this->getTmpUploadsPath() . '/' .
                                $this->getUploadedImageFile(),
                        $this->getTmpUploadsPath() . '/' .
                                'cat'.$category->getId().'.png'
                        );
                $this->setNewProductCategoryThumbnailFile(
                        'cat'.$category->getId().'.png');
                
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
                                $this->getNewProductCategoryThumbnailFile(),
                        $this->getProductCategoryImagesFtpPath() . '/' .
                                'cat'.$category->getId().'.png'
                        );
                // Destroy uploaded image file in webapp tmp directory
                unlink($this->getTmpUploadsPath() . '/' .
                        $this->getUploadedImageFile());
                
                
                // Commit name of new image to database
                $category->setImage($this->getNewProductCategoryThumbnailFile());
                $category->commit($this->getConnection());
                
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $category->getId());
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $this->getCategoryId());
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
                                'name' => 'Categories',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/catalogue_management/'
                                )
                        );
                
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                $ancestorCategories =& $category->getAncestorCategories();
                foreach ( array_keys($ancestorCategories) as
                        $ancestorCategoriesKey )
                {
                        $ancestorCategory =&
                                $ancestorCategories[$ancestorCategoriesKey];
                        $breadcrumb[] =
                                array(
                                        'name' => $ancestorCategory->getName(),
                                        'url' => Configuration::getParameter('cms_root_webpath') .
                                                '/ecomstore/product_catalogue/catalogue_management/' .
                                                'manage_product_category.php?categoryid=' .
                                                $ancestorCategory->getId()
                                );
                }
                
                $breadcrumb[] =
                        array(
                                'name' => $category->getName(),
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/catalogue_management/' .
                                        'manage_product_category.php?categoryid=' .
                                        $category->getId()
                        );
                
                
                return $breadcrumb;
        }
}


?>
