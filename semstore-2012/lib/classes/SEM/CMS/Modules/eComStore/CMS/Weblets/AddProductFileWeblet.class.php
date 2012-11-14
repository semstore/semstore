<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-25
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/AddProductFileWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddProductFileForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductFile.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class AddProductFileWeblet extends Weblet
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
        var $parentProductId = NULL;
        
        var $productFile = '';
        var $description = '';
        var $hfid = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddProductFileWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_AddProductFileWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _AddProductFileWeblet0 ()
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
        
        
        
        function getParentProductId ()
        {
                return $this->parentProductId;
        }
        
        
        function setParentProductId ( $id )
        {
                $this->parentProductId = $id;
        }
        
        /*
        var $hfid = '';
        */
        
        function setProductFile ( $file )
        {
                $this->productFile = $file;
        }
        
        function getProductFile ( )
        {
                return $this->productFile;
        }
        
        function setDescription ( $description )
        {
                $this->description = $description;
        }
        
        function getDescription ( )
        {
                return $this->description;
        }
        
        function setHFID ( $hfid )
        {
                $this->hfid = $hfid;
        }
        
        function getHFID ( )
        {
                return $this->hfid;
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
                $stateContainer =& new AddProductFileWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                $stateContainer->setParentProductId(
                        $this->getParentProductId() );
                        
                $stateContainer->setProductFile(
                        $this->getProductFile() );
                $stateContainer->setDescription(
                        $this->getDescription() );
                $stateContainer->setHFID(
                        $this->getHFID() );
                        
                        
                $stateContainer->setProductId($this->getProductId() );
                
                Session::putRef('AddProductFileWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('AddProductFileWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                
                $this->setProductFile(
                        $stateContainer->getProductFile() );
                $this->setDescription(
                        $stateContainer->getDescription() );
                $this->setHFID(
                        $stateContainer->getHFID() );
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                $this->setParentProductId(
                        $stateContainer->getParentProductId() );
                $this->setProductId(
                        $stateContainer->getProductId() );
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('AddProductFileWebletStateContainer', NULL);
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
                        $this->_saveWebletState();
                }
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $parentProduct =&  Product::findFirst(
                        array('id' => $this->getParentProductId()),
                        $this->getConnection());
                $type =& $parentProduct->getType();
                
                /* Prepare the form */
                $form =& new AddProductFileForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                
                /* Populate form fields/widgets */
                $productFileWidget =& $form->getWidget('productfile');
                #$productFileWidget->setSelected($this->getProductId());
                
                $productDescriptionWidget =& $form->getWidget('description');
                $productDescriptionWidget->setValue($this->getDescription());
                
                $productHFIDWidget =& $form->getWidget('hfid');
                $productHFIDWidget->setValue($this->getHFID());
                
                /* Populate template */
                $template->assign('formErrors', $this->getFormValidationErrors());
                $template->assign('form', $form);
                
                foreach ( array_keys($form->getWidgets()) as $widgetId )
                {
                        $widget =& $form->getWidget($widgetId);
                        $template->assign($widgetId.'Widget', $widget);
                }
                
                
                $template->assign('filename', $this->getProductFile());
                $template->assign('filenamepath', $GLOBALS['configuration']->getParameter('product_files_webpath').$this->getProductFile());
                
                $template->assign('parentProduct', $parentProduct);
                $template->assign('type', $type);
                
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
                        '/add_product_file.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                /* Prepare the data */
                $description = $httpRequest->getParameter('description');
                $description = trim($description);
                $this->setDescription($description);
                
                $hfid = $httpRequest->getParameter('hfid');
                $hfid = trim($hfid);
                $this->setHFID($hfid);
                
                $productfileFilename = '';
                
                if ( $_FILES['productfile']['tmp_name'] != '' )
                {
                        $productfileFilename = $this->moveUploadedFileToFileDir(
                                'productfile',
                                $this->getParentProductId() );
                        $this->setProductFile($productfileFilename);
                }
                
                /* Prepare the form */
                $form =& new AddProductFileForm();
                
                $productDescriptionWidget =& $form->getWidget('description');
                $productDescriptionWidget->setValue($this->getDescription());
                
                $productHFIDWidget =& $form->getWidget('hfid');
                $productHFIDWidget->setValue($this->getHFID());
                
                /* Populate form fields/widgets */
                $errors = $form->validate();
                
                
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect(
                                $configuration->getParameter('cms_root_webpath') .
                                '/ecomstore/product_catalogue/product_management' .
                                '/add_product_file.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management/add_product_file.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $product =& Product::findFirst(
                        array('id' => $this->getParentProductId()),
                        $this->getConnection());
                
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' .
                        '/manage_product.php?productid=' . $product->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Prepare the Template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                /* Populate template */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::MULTIPART_FORM_DATA());
                $template->assign('action', 'confirm_details_submit');
                
                $template->assign('filename', $this->getProductFile());
                $template->assign('filenamepath', $GLOBALS['configuration']->getParameter('product_files_webpath').$this->getProductFile());
                $template->assign('description', $this->getDescription());
                $template->assign('hfid', $this->getHFID());
                
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
                        '/add_product_file.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $productFile =& new ProductFile();
                $productFile->setProductId($this->getParentProductId());
                $productFile->setFilename($this->getProductFile());
                $productFile->setDescription($this->getDescription());
                $productFile->setHFID($this->getHFID());
                $productFile->setConnection($this->getConnection());
                $productFile->commit();
                
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management/manage_product.php?productid=' . 
                        $this->getParentProductId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->setView('capture_details');
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' .
                        '/add_product_file.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $product =& Product::findFirst(
                        array('id' => $this->getParentProductId()),
                        $this->getConnection());
                
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        $configuration->getParameter('cms_root_webpath') .
                        '/ecomstore/product_catalogue/product_management' .
                        '/manage_product.php?productid=' . $product->getId());
        }
        
        
        
        
        
        function _prepareBreadcrumbArray ()
        {
                $configuration =& $this->getConfigurator();
                
                $product =& Product::findFirst(
                        array('id' => $this->getParentProductId()),
                        $this->getConnection());
                
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
                                'name' => 'Product: ' . $product->getName(),
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_management/' .
                                        'manage_product.php?productid=' . $product->getId()
                                )
                        
                        );
                
                return $breadcrumb;
        }
        
        
        
        
        
        function moveUploadedFileToFileDir ( $fileId, $productId )
        {
                $filename = $productId;
                $src = $_FILES[$fileId]['tmp_name'];
                $ext = '';
                if ( preg_match('{(\.[^\.]+?)$}', $_FILES[$fileId]['name'], $matches) > 0 )
                {
                        $ext = $matches[1];
                        
                        if ( $ext == '.php' )
                        {
                            $ext = '.notphp';
                        }
                        
                }
                
                return $this->moveFileToFileDir( $src, $filename, $ext );
        }
        
        
        
        
        function moveFileToFileDir ( $src, $origfilename, $ext )
        {
                $filename = $origfilename;
                $ftp =& new Ftp(
                        Configuration::getParameter('ftp_server'),
                        Configuration::getParameter('ftp_port'),
                        Configuration::getParameter('ftp_username'),
                        Configuration::getParameter('ftp_password')
                        );
                $ftp->connect();
                
                //check for existing files
                $inc = 0;
                
                while ( $ftp->fileExists(Configuration::getParameter('product_files_ftp_path')  ,$filename.$ext) )
                {
                     $inc++;
                     
                     $filename = $origfilename.'_'.$inc ;
                }
                
                $filename .= $ext;
                
                $dest = Configuration::getParameter('product_files_ftp_path') .$filename;
                 
                
                
                $ftp->put($src, $dest, FTP_BINARY);
                $ftp->chmod('666', $dest);
                
                return $filename;
        }
        
}


?>
