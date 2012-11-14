<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

require_once('HTML/Forms/FormWidget.class.php');

class RadioButton extends FormWidget
{
        /*
	 * Class Constants
	 */
	
        
        var $INVALID_OPTION = 1;
        
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $name = '';
        var $group = NULL;
        var $options = array();
        var $value = '';
        var $selected = false;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function RadioButton ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function setGroup ( &$group )
        {
                $this->group =& $group;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                //$group =& $this->group;
                
                $html = '<input type="radio"';
                $html .= ' name="'.$this->group->name.'"';
                $html .= ' value="'.htmlspecialchars($this->value).'"';
                /*
                $html .= ( $this->group->isSelected($this->name)
                        ? ' checked' : '' );
                */
                $html .= ( $this->selected == true ? ' checked' : '' );
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
                
                $html .= ' type="radio"';
                $html .= ' name="'.$this->group->name.'"';
                $html .= ' value="'.htmlspecialchars($this->value).'"';
                $html .= ( $this->selected == true ? ' checked' : '' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( !array_search($this->value, $this->options) )
                {
                        /*
                        array_push($errors, "'" . $this->value . "' is not a valid option.");
                        */
                        $errors[$this->INVALID_OPTION] =
                                "'" . $this->getValue() . "' is not a valid option";
                }
                
                return $errors;
        }
        
        
}

?>
