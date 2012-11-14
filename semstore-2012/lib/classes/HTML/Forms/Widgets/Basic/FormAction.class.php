<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-28
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/Widgets/Basic/Hidden.class.php');

class FormAction extends Hidden
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
        
        
        function FormAction ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_FormAction'.$numArgs),  $args);
        }
        
        
        function _FormAction0 ()
        {
                $this->_initialise();
        }
        
        
        function _FormAction1 ( $id )
        {
                $this->_initialise();
                $this->setId($id);
        }
        
        
        function _initialise ()
        {
                $this->setId('action');
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
                $html .= ( $this->getValue() != '' ?
                        ' value="'.htmlspecialchars($this->getValue()).'"' :
                        ' value=""' );
                $html .= ' type="hidden"';
                
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
                return TRUE;
        }
        
        
        function &validate ()
        {
                return array();
        }
}

?>
