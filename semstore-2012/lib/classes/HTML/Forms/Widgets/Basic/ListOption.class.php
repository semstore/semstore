<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

require_once('HTML/Forms/FormWidget.class.php');

require_once('HTML/Forms/Widgets/Basic/ListBox.class.php');

class ListOption extends FormWidget
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
        
        
        var $group = NULL;
        var $value = '';
        var $selected = false;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ListOption ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_ListOption'.$numArgs),  $args);
        }
        
        
        function _ListOption0 ()
        {
                $this->_initialise();
        }
        
        
        function _ListOption1 ( $id )
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
        
        
        function &getGroup ()
        {
                return $this->group;
        }
        
        
        function setGroup ( &$group )
        {
                $this->group =& $group;
        }
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        function getSelected ()
        {
                return $this->selected;
        }
        
        
        function setSelected ( $selected )
        {
                $this->selected = $selected;
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
                $html = '<option';
                $html .= ( $this->getId() != '' ?
                        ' value="'.$this->getId().'"' :
                        '' );
                
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
                
                
                if ( $this->getSelected() )
                {
                        $html .= ' selected="selected"';
                }
                
                $html .= '>';
                
                $html .= ( $this->getValue() != '' ?
                        htmlspecialchars($this->getValue()) : '' );
                
                $html .= '</option>';
                
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
                                "'" . $this->value . "' is not a valid option";
                }
                
                return $errors;
        }
}

?>
