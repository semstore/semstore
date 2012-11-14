<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-27
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class RemoveSubproductFromSaleWebletStateContainer extends WebletStateContainer
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
        var $subproductId = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveSubproductFromSaleWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_RemoveSubproductFromSaleWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _RemoveSubproductFromSaleWebletStateContainer0 ()
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
        
        
        function getSubproductId ()
        {
                return $this->subproductId;
        }
        
        
        function setSubproductId ( $id )
        {
                $this->subproductId = $id;
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
