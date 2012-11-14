<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');

class Image extends FormWidget
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
        
        
        var $value = '';
        var $defaultValue = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function Image ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Image'.$numArgs),
                        $args);
        }
        
        
        function _Image0 ()
        {
                ;
        }
        
        
        function _Image1 ( $name )
        {
                $this->setName($name);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
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
                $html = '<input type="image"';
                $html .= ( $this->getName() != '' ?
                        ' name="'.$this->getName().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.$this->getValue().'"' :
                        ' value="'.$this->getDefaultValue().'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function renderWithCSS ( $cssType, $css )
        {
                $html = '<input ';
                if ( $cssType == $this->CSS_TYPE_ID )
                {
                        $html .= 'id="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_CLASS )
                {
                        $html .= 'class="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_STYLE )
                {
                        $html .= 'style="' . $css . '"';
                }
                
                $html .= ' type="image"';
                $html .= ( $this->getName() != '' ?
                        ' name="'.$this->getName().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.$this->getValue().'"' :
                        ' value="'.$this->getDefaultValue().'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( $this->getMaxSize() != '' && $this->getMaxSize() != 0 &&
                        strlen($this->getValue()) > $this->getMaxSize() )
                {
                        $errors[$this->MAX_SIZE_EXCEEDED] =
                                'The information entered exceeded the maximum size of ' .
                                $this->getMaxSize() . ' characters';
                        return $errors;
                }
                
                return $errors;
        }
        
        
        function isComplete ()
        {
                return $this->getValue() != '';
        }
        
        
        function _populate0 ()
        {
                $this->populate(RequestParams::getParam($this->getName()));
        }
        
        
        function _populateFromArray ( $array )
        {
                $this->setValue($array[$this->getName()]);
        }
        
        
        function _populateFromScalar ( $scalar )
        {
                $this->setValue($scalar);
        }
}

?>
