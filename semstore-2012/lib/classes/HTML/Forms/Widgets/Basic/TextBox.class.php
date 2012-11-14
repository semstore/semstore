<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');

class TextBox extends FormWidget
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
        
        
        function TextBox ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_TextBox'.$numArgs),  $args);
        }
        
        
        function _TextBox0 ()
        {
                $this->_initialise();
        }
        
        
        function _TextBox1 ( $id )
        {
                $this->_initialise();
                $this->setId($id);
        }
        
        
        function _initialise ()
        {
                ;
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
                $html .= ( $this->getValue() != '' ?
                        ' value="'.htmlspecialchars($this->getValue()).'"' :
                        ' value=""' );
                $html .= ' type="text"';
                
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
                
                if ( $this->maxLengthExceeded() )
                {
                        array_push($errors,
                                'The information entered exceeded the maximum size of ' .
                                $this->getMaxLength() . ' characters');
                }
                
                return $errors;
        }
        
        
        function maxLengthExceeded ()
        {
                if ( strlen($this->getValue()) > $this->getMaxLength() )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
}

?>
