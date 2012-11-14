<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-12
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class EditProductTypeAttributeGroupWebletStateContainer extends WebletStateContainer
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
        var $typeId = NULL;
        var $typeName = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditProductTypeAttributeGroupWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_EditProductTypeAttributeGroupWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _EditProductTypeAttributeGroupWebletStateContainer0 ()
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
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function setGroupId ( $id )
        {
                $this->groupId = $id;
        }
        
        
        function getGroupName ()
        {
                return $this->groupName;
        }
        
        
        function setGroupName ( $name )
        {
                $this->groupName = $name;
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
