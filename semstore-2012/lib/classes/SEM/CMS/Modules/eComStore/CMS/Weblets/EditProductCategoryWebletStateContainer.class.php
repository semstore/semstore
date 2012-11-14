<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class EditProductCategoryWebletStateContainer extends WebletStateContainer
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
        var $categoryId = NULL;
        var $categoryName = '';
        var $categoryDescription = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditProductCategoryWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_EditProductCategoryWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _EditProductCategoryWebletStateContainer0 ()
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
        
        
        function getCategoryDescription ()
        {
                return $this->categoryDescription;
        }
        
        
        function setCategoryDescription ( $description )
        {
                $this->categoryDescription = $description;
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
