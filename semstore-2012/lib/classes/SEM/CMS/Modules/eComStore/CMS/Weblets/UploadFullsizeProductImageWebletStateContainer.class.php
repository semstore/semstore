<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class UploadFullsizeProductImageWebletStateContainer extends WebletStateContainer
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
        var $createProductBrowserImage = FALSE;
        var $createProductDetailsPageImage = TRUE;
        var $createBasketImage = TRUE;
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadFullsizeProductImageWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_UploadFullsizeProductImageWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _UploadFullsizeProductImageWebletStateContainer0 ()
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
        
        
        
        
}

?>
