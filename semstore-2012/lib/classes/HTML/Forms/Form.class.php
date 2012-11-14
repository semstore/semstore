<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Form
 */

require_once('SEMObject.class.php');
 
class Form extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
        /*
        var $NONE = 0;
        var $REQUIRED = 1;
        var $NOT_REQUIRED = 2;
        */
        
        function METHOD_POST () { return 'post'; }
        function MEHTOD_GET () { return 'get'; }
        
        function URLENCODED () { return 'application/x-www-form-urlencoded'; }
        function MULTIPART_FORM_DATA () { return 'multipart/form-data'; }
        
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        var $method ='';
        var $action = '';
        var $encoding = '';
        /*
        widgets = array(
                'widgetId' => array(
                        'widget' => &widgetRef,
                        'label' => &labelRef,
                        'validator' => 'callback'
                        ),
        );
        */
        var $widgets = array();
        var $labels = array();
        var $formValidator = '';
        
        
	/*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function Form ()
        {
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getMethod ()
        {
                return $this->method;
        }
        
        
        function setMethod ( $method )
        {
                $this->method = $method;
        }
        
        
        function getAction ()
        {
                return $this->action;
        }
        
        
        function setAction ( $action )
        {
                $this->action = $action;
        }
        
        
        function getEncoding ()
        {
                return $this->encoding;
        }
        
        
        function setEncoding ( $encoding )
        {
                $this->encoding = $encoding;
        }
        
        
        function &getWidgetParams ()
        {
                return $this->widgetParams;
        }
        
        
        function setWidgetParams ( &$widgetParams )
        {
                $this->widgetParams =& $widgetParams;
        }
        
        
        function getFormValidator ()
        {
                return $this->formValidator;
        }
        
        
        function setFormValidator ( $method )
        {
                $this->formValidator = $method;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function addWidget ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_addWidget'.$numArgs),  $args);
        }
        
        
        function _addWidget3 ( $widgetId, &$widget, $widgetLabel )
        {
                $this->widgets[$widgetId] = &$widget;
                $this->labels[$widgetId] = $widgetLabel;
        }
        
        
        function &getWidget ( $widgetId )
        {
                return $this->widgets[$widgetId];
        }
        
        
        function getWidgetLabel ( $widgetId )
        {
                return $this->labels[$widgetId];
        }
        
        
        function &getWidgets ()
        {
                return $this->widgets;
        }
        
        
        function render ()
        {
                $html = '<form';
                
                if ( !is_null($this->getAction()) && $this->getAction() != '' )
                {
                        $html .= ' action="'.$this->getAction().'"';
                }
                
                if ( !is_null($this->getMethod()) && $this->getMethod() != '' )
                {
                        $html .= ' method="'.$this->getMethod().'"';
                }
                
                if ( !is_null($this->getEncoding()) &&
                        $this->getEncoding() != '' )
                {
                        $html .= ' enctype="'.$this->getEncoding().'"';
                }
                
                $html .= '>';
                
                return $html;
        }
        
        
        function isComplete ()
        {
                foreach ( $this->getWidgets() as $widgetId => $widget )
                {
                        if ( !$widget->isComplete() )
                        {
                                return FALSE;
                        }
                }
                
                return TRUE;
                
        }
        
        
        function isValid ()
        {
                return count($this->validate()) == 0;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                foreach ( array_keys($this->getWidgets()) as $widgetId )
                {
                        $widget =& $this->getWidget($widgetId);
                        if ( $widget->getCompletionRequirement() ===
                                FormWidget::COMPLETION_REQUIRED() )
                        {
                                if ( !$widget->isComplete() )
                                {
                                        array_push($errors,
                                                $this->getWidgetLabel($widgetId)
                                                        . ' needs to be completed.');
                                }
                                else
                                {
                                        if ( $widget->getValidationRequirement() ===
                                                FormWidget::VALIDATE_IF_COMPLETE()
                                                ||
                                                $widget->getValidationRequirement() ===
                                                FormWidget::VALIDATE_ALWAYS()
                                                )
                                        {
                                                $verrors = call_user_func_array( array( &$widget, 'validate' ), array() );
                                                foreach ( $verrors as $error )
                                                {
                                                        array_push($errors,
                                                                $this->getWidgetLabel($widgetId) . ': ' . $error);
                                                }
                                        }
                                }
                        }
                }
                
                
                $validator = $this->getFormValidator();
                if ( !is_null($validator) && $validator != '' )
                {
                        foreach ( $this->runValidator($this, $validator)
                                as $error )
                        {
                                array_push($errors, $error);
                        }
                }
                
                return $errors;
        }
        
        
        function _runValidator ( $ref, $methodName )
        {
                $errors = call_user_func_array(
                        array(&$ref, $methodName),
                        array()
                        );
                
                return $errors;
        }
}

?>
