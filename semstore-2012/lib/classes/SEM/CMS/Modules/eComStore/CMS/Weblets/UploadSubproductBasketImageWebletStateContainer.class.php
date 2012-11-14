<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-29
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class UploadSubproductBasketImageWebletStateContainer extends WebletStateContainer
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
        var $subproductId = NULL;
        var $uploadedImageFile = '';
        
        var $formErrorCount = 0;
        var $uploadedImageFileErrMsg = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function UploadSubproductBasketImageWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_UploadSubproductBasketImageWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _UploadSubproductBasketImageWebletStateContainer0 ()
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
