<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

require_once('HTML/Forms/Widgets/Basic/ListBox.class.php');

require_once('HTML/Forms/Widgets/Basic/ComboBoxOption.class.php');

class ComboBox extends ListBox
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
        
        
        function ComboBox ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_ComboBox'.$numArgs),  $args);
        }
        
        
        function _ComboBox0 ()
        {
                $this->_initialise();
        }
        
        
        function _ComboBox1 ( $id )
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
        
        
        
        
        
        /*
	 * Command Methods
	 */
        
        
        function createOption ( $id, $value )
        {
                $option =& new ComboBoxOption();
                $option->setId($id);
                $option->setValue($value);
                $this->addOption($option);
        }
        
        
        function addOption ( &$option )
        {
                $option->setGroup($this);
                //array_push($this->getOptions(), &$option);
                $this->options[$option->getId()] =& $option;
        }
        
        
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
                $html = '<select';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ' size="1"';
                
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
                
                
                foreach ( $this->eventHandlers as $event => $handler )
                {
                        $html .= ' ' . $event . '="' . $handler . '"';
                }
                
                
                $html .= '>';
                
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        $html .= $option->render();
                }
                
                $html .= '</select>';
                
                return $html;
        }
}

?>
