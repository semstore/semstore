<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class AddCustomerGroupAttributeGroupWebletStateContainer extends WebletStateContainer
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
        var $groupId = NULL;
        var $attributeGroupName = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddCustomerGroupAttributeGroupWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddCustomerGroupAttributeGroupWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _AddCustomerGroupAttributeGroupWebletStateContainer0 ()
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
        
        
        function getCustomerGroupId ()
        {
                return $this->customerGroupId;
        }
        
        
        function setCustomerGroupId ( $id )
        {
                $this->customerGroupId = $id;
        }
        
        
        function getAttributeGroupName ()
        {
                return $this->attributeGroupName;
        }
        
        
        function setAttributeGroupName ( $attrGroupName )
        {
                $this->attributeGroupName = $attrGroupName;
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
