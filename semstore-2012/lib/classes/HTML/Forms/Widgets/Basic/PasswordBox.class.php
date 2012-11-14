<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-07-07
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');

class PasswordBox extends FormWidget
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        var $size = 10;
        var $maxlength = 0;
        var $value = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function PasswordBox ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_PasswordBox'.$numArgs),  $args);
        }
        
        
        function _PasswordBox0 ()
        {
                $this->_initialise();
        }
        
        
        function _PasswordBox1 ( $id )
        {
                $this->_initialise();
                $this->setId($id);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getSize ()
        {
                return $this->size;
        }
        
        
        function setSize ( $size )
        {
                $this->size = $size;
        }
        
        
        function getMaxLength ()
        {
                return $this->maxlength;
        }
        
        
        function setMaxLength ( $maxlength )
        {
                $this->maxlength = $maxlength;
        }
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        function getDefaultValue ()
        {
                return $this->defaultValue;
        }
        
        
        function setDefaultValue ( $defaultValue )
        {
                $this->defaultValue = $defaultValue;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array( &$this, '_render'.$numArgs),  $args );
        }
        
        
        function _render0 ()
        {
                return $this->render('', '', '');
        }
        
        
        function _render3 ( $cssId, $cssClass, $cssStyle )
        {
                $html = '<input';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
                        '' );
                $html .= ( $this->getMaxLength() != '' ?
                        ' maxlength="'.$this->getMaxLength().'"' :
                        '' );
                $html .= ' type="password"';
                
                if ( !is_null($cssId) && $cssId != '' )
                {
                        $html .= ' ' . $this->renderCssId($cssId);
                }
                
                if ( !is_null($cssClass) && $cssClass != '' )
                {
                        $html .= ' ' . $this->renderCssClass($cssClass);
                }
                
                if ( !is_null($cssStyle) && $cssStyle != '' )
                {
                        $html .= ' ' . $this->renderCssStyle($cssStyle);
                }
                
                
                $html .= ' />';
                
                return $html;
        }
        
        
        function isComplete ()
        {
                return $this->getValue() != '';
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                return $errors;
        }
}

?>
