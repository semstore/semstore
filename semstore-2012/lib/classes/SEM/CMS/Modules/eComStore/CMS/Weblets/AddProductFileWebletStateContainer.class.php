<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-25
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class AddProductFileWebletStateContainer extends WebletStateContainer
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
        var $parentProductId = NULL;
        var $productFile = '';
        var $description = '';
        var $hfid = '';
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddProductFileWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddProductFileWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _AddProductFileWebletStateContainer0 ()
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
        
        function getParentProductId ()
        {
                return $this->parentProductId;
        }
        
        
        function setParentProductId ( $id )
        {
                $this->parentProductId = $id;
        }
        
        
        
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
        
        
        
        
}

?>
