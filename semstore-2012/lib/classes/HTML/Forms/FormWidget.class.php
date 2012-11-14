<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms
 */

require_once('SEMObject.class.php');

class FormWidget extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
        function COMPLETION_NOT_REQUIRED () { return 0; }
        function COMPLETION_REQUIRED () { return 1; }
        
        function VALIDATE_NEVER () { return 10; }
        function VALIDATE_IF_COMPLETE () { return 11; }
        function VALIDATE_ALWAYS () { return 12; }
        
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $id = '';
        var $completionRequirement = 1;
        var $validationRequirement = 12;
        var $validationMethod = '';
        var $eventHandlers = array();
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function FormWidget ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_FormWidget'.$numArgs),  $args);
        }
        
        
        function _FormWidget0 ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
        }
        
        
        function getCompletionRequirement ()
        {
                return $this->completionRequirement;
        }
        
        
        function setCompletionRequirement ( $requirement )
        {
                $this->completionRequirement = $requirement;
        }
        
        
        function getValidationRequirement ()
        {
                return $this->validationRequirement;
        }
        
        
        function setValidationRequirement ( $requirement )
        {
                $this->validationRequirement = $requirement;
        }
        
        
        function getValidationMethod ()
        {
                return $this->validationMethod;
        }
        
        
        function setValidationMethod ( $method )
        {
                $this->validationMethod = $method;
        }
        
        
        function getEventHandlers ()
        {
                return $this->eventHandlers;
        }
        
        
        function setEventHandlers ( $eventHandlers )
        {
                $this->eventHandlers = $eventHandlers;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function getValue ()
        {
                die('The method getValue() is abstract and must be overridden');
        }
        
        
        function setValue ( $value )
        {
                die('The method setValue() is abstract and must be overridden');
        }
        
        
        function render ()
        {
                die('The method render() is abstract and must be overridden');
        }
        
        
        function addEventHandler ( $event, $handler )
        {
                $this->eventHandlers[$event] = $handler;
        }
        
        
        function renderCssId ( $cssId )
        {
                if ( is_null($cssId) && $cssId != '' )
                {
                        return 'id="'.$cssId.'"';
                }
                
                return '';
        }
        
        
        function renderCssClass ( $cssClass )
        {
                if ( is_null($cssClass) && $cssClass != '' )
                {
                        return 'class="'.$cssClass.'"';
                }
                
                return '';
        }
        
        
        function renderCssStyle ( $cssStyle )
        {
                if ( is_null($cssStyle) && $cssStyle != '' )
                {
                        return 'style="'.$cssStyle.'"';
                }
                
                return '';
        }
        
        
        function isComplete ()
        {
                die('The method isComplete() is abstract and must be overridden');
        }
        
        
        function isValid ()
        {
                return count($this->validate()) == 0;
        }
        
        
        function validate ()
        {
                $errors = array();
                
                if ( $this->getValidationRequirement() ===
                        FormWidget::VALIDATE_IF_COMPLETE() &&
                        $this->isComplete() )
                {
                        $errors = $this->forceValidation();
                }
                else if ( $this->getValidationRequirement() ===
                        FormWidget::VALIDATE_ALWAYS() )
                {
                        $errors = $this->_forceValidation();
                }
                
                return $errors;
        }
        
        
        function _forceValidation ()
        {
                $errors = array();
                
                $validator = $this->getValidationMethod();
                if ( !is_null($validator) && $validator != '' )
                {
                        $errors = $this->_callValidationMethod($validator);
                }
                
                return $errors; 
        }
        
        
        function _callValidationMethod ( $method )
        {
                $errors = call_user_func_array(
                        array(&$this, $method),
                        array()
                        );
                
                return $errors;
        }
}

?>
