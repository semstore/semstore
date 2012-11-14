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
        var $src = '';
        var $alt = '';
        
        
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
                $this->_initialise();
        }
        
        
        function _Image1 ( $id )
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
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        function getImageSrc ()
        {
                return $this->src;
        }
        
        
        function setImageSrc ( $src )
        {
                return $this->src = $src;
        }
        
        
        function getAltText ()
        {
                return $this->alt;
        }
        
        
        function setAltText ( $alt )
        {
                return $this->alt = $alt;
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
                $html .= ( $this->getImageSrc() != '' ) ?
                        ' src="'.$this->getImageSrc().'"' :
                        '';
                $html .= ( $this->getAltText() != '' ) ?
                        ' alt="'.$this->getAltText().'"' :
                        '';
                $html .= ' type="image"';
                
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
                $errors = array();
                
                return $errors;
        }
}

?>
