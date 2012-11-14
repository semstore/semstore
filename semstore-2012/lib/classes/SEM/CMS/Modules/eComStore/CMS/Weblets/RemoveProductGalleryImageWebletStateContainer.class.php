<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class RemoveProductGalleryImageWebletStateContainer extends WebletStateContainer
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
        var $formErrors = NULL;
        var $galleryId = NULL;
        var $productId = NULL;
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveProductGalleryImageWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_RemoveProductGalleryImageWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _RemoveProductGalleryImageWebletStateContainer0 ()
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
        
        
        
        
}

?>
