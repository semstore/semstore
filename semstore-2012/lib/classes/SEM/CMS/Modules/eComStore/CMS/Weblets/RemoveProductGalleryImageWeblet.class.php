<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveProductGalleryImageWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddProductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGallery.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGalleryImage.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class RemoveProductGalleryImageWeblet extends Weblet
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
        var $galleryId = NULL;
        var $productId = NULL;
        
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveProductGalleryImageWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveProductGalleryImageWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveProductGalleryImageWeblet0 ()
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
        
        
        function getGalleryId ()
        {
                return $this->galleryId;
        }
        
        
        function setGalleryId ( $id )
        {
                $this->galleryId = $id;
        }
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        function getProductId ( )
        {
                return $this->productId;
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
                $stateContainer =& new RemoveProductGalleryImageWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setGalleryId($this->getGalleryId());
                $stateContainer->setProductId($this->getProductId());
                
                Session::putRef('rpWebletStateContainer',
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
                $stateContainer =& Session::getRef('rpWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setGalleryId($stateContainer->getGalleryId());
                $this->setProductId($stateContainer->getProductId());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('rpWebletStateContainer', NULL);
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
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit($httpRequest, $httpResponse);
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
                        $productGallery =& ProductGallery::findFirst(
                                array('id' => $this->getGalleryId()),
                                $this->getConnection());
                         $this->setProductId($productGallery->getProductId());
                         $this->_saveWebletState();
                }
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/remove_product_gallery_image/remove_product_gallery_image.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/remove_product_gallery_image/remove_product_gallery_image_confirmation.tpl');
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
                
                
                $productImage =& ProductGalleryImage::findFirst(
                        array('gallery_id'=>$this->getGalleryId()),
                        $this->getConnection());
                                
                $template->assign('Configuration', $this->getConfigurator());
                $template->assign('image', $productImage->getThumbnail());
                
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
                $httpResponse->redirect('remove_product_gallery_image.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $productGallery =& ProductGallery::findFirst(array('id' => $this->getGalleryId()), $this->getConnection());
                $productGallery->remove();
                
                
                $productImage =& ProductGalleryImage::findFirst(array('gallery_id'=>$this->getGalleryId()), $this->getConnection());
                
                //remove image
                unlink(Configuration::getParameter('product_images_path') . '/' .$productImage->getImage());
                
                //remove thumbnail
                unlink(Configuration::getParameter('product_images_path') . '/' .$productImage->getThumbnail());
                
                
                
                $productImage->remove();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_image_gallery.php?productid='.$this->getProductId());
        }
        
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_image_gallery.php?productid='.$this->getProductId());
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
