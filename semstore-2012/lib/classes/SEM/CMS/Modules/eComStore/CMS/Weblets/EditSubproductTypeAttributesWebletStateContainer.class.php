<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-30
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class EditSubproductTypeAttributesWebletStateContainer extends WebletStateContainer
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
        var $fieldsArray = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditSubproductTypeAttributesWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_EditSubproductTypeAttributesWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _EditSubproductTypeAttributesWebletStateContainer0 ()
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
        
        
        function &getFieldsArray ()
        {
                return $this->fieldsArray;
        }
        
        
        function setFieldsArray ( &$array )
        {
                $this->fieldsArray = $array;
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
