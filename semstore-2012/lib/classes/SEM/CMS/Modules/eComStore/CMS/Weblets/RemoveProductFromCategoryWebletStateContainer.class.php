<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class RemoveProductFromCategoryWebletStateContainer extends WebletStateContainer
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
        var $productId = NULL;
        var $productName = '';
        var $categoryId = NULL;
        var $categoryName = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveProductFromCategoryWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_RemoveProductFromCategoryWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _RemoveProductFromCategoryWebletStateContainer0 ()
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
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        
        function getProductName ()
        {
                return $this->productName;
        }
        
        
        function setProductName ( $name )
        {
                $this->productName = $name;
        }
        
        
        function getCategoryId ()
        {
                return $this->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->categoryId = $id;
        }
        
        
        function getCategoryName ()
        {
                return $this->categoryName;
        }
        
        
        function setCategoryName ( $name )
        {
                $this->categoryName = $name;
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
