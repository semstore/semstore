<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');

class Hidden extends FormWidget
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
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function Hidden ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_Hidden'.$numArgs),  $args);
        }
        
        
        function _Hidden0 ()
        {
                ;
        }
        
        
        function _Hidden1 ( $id )
        {
                $this->setId($id);
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
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $html = '<input type="hidden"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.$this->getValue().'"' :
                        ' value=""' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function renderWithCSS ( $cssType, $css )
        {
                $html = '<input';
                if ( $cssType == $this->CSS_TYPE_ID )
                {
                        $html .= ' id="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_CLASS )
                {
                        $html .= ' class="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_STYLE )
                {
                        $html .= ' style="' . $css . '"';
                }
                
                $html .= ' type="hidden"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.htmlspecialchars($this->getValue()).'"' :
                        ' value="'.htmlspecialchars($this->getDefaultValue()).'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function &validate ()
        {
                return array();
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
