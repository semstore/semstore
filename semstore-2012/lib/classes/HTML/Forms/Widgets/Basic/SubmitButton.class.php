<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-28
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/Widgets/Basic/Button.class.php');

class SubmitButton extends Button
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
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function SubmitButton ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_SubmitButton'.$numArgs),  $args);
        }
        
        
        function _SubmitButton0 ()
        {
                ;
        }
        
        
        function _SubmitButton1 ( $id )
        {
                $this->setId($id);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $html = '<input type="submit"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ' value="'.htmlspecialchars($this->getValue()).'"';
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
                
                $html .= ' type="submit"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ' value="'.htmlspecialchars($this->getValue()).'"';
                $html .= ' />';
                
                return $html;
        }
        
        
        function &validate ()
        {
                return array();
        }
        
        
        function isComplete ()
        {
                return TRUE;
        }
}

?>
