<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class UploadProductBasketImageWebletStateContainer extends WebletStateContainer
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
        
        
        var $view = '';
        var $productId = NULL;
        var $uploadedImageFile = '';
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadProductBasketImageWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_UploadProductBasketImageWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _UploadProductBasketImageWebletStateContainer0 ()
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
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
        
        
        
        
}

?>
