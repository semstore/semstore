<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 *  @date 2005-06-27
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');

require_once('HTML/Forms/Widgets/Basic/ListOption.class.php');

class ListBox extends FormWidget
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
        
        
        var $options = array();
        var $selectedIndex = NULL;
        var $size = 5;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ListBox ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_ListBox'.$numArgs),  $args);
        }
        
        
        function _ListBox0 ()
        {
                $this->_initialise();
        }
        
        
        function _ListBox1 ( $id )
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
        
        
        function &getOptions ()
        {
                return $this->options;
        }
        
        
        function setOptions ( &$options )
        {
                $this->options =& $options;
        }
        
        
        function getSize ()
        {
                return $this->size;
        }
        
        
        function setSize ( $size )
        {
                $this->size = $size;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function createOption ( $id, $value )
        {
                $option =& new ListOption();
                $option->setId($id);
                $option->setValue($value);
                $this->addOption($option);
        }
        
        
        function addOption ( &$option )
        {
                $option->setGroup($this);
                array_push($this->options, $option);
                //$this->options[$option->getId()] =& $option;
        }
        
        
        function &getOption ( $optionId )
        {
                return $this->getOptionWithId($optionId);
        }
        
        
        function &getOptionAtIndex ( $index )
        {
                return $this->options[$index];
        }
        
        
        function &getOptionWithId ( $id )
        {
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        if ( $option->getId() == $id )
                        {
                                return $option;
                        }
                }
                
                return NULL;
        }
        
        
        function &getOptionWithValue ( $value )
        {
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        if ( $option->getValue() == $value )
                        {
                                return $option;
                        }
                }
                
                return NULL;
        }
        
        
        function getSelected ()
        {
                return $this->getSelectedId();
        }
        
        
        function setSelected ( $id )
        {
                return $this->setSelectedId($id);
        }
        
        
        function getSelectedIndex ()
        {
                return $this->selectedIndex;
        }
        
        
        function setSelectedIndex ( $listIndex )
        {
                if ( $this->isValidIndex($listIndex) )
                {
                        //print "valid index";
                        $this->selectedIndex = $listIndex;
                        $this->options[$listIndex]->setSelected(TRUE);
                }
        }
        
        
        function getSelectedId ()
        {
                if ( $this->isValidIndex() )
                {
                        $option =& $this->getOption($this->getSelectedIndex());
                        return $option->getid();
                }
        }
        
        
        function setSelectedId ( $id )
        {
                foreach ( array_keys($this->options) as $listIndex )
                {
                        $option =& $this->options[$listIndex];
                        if ( $option->getId() == $id )
                        {
                                $this->setSelectedIndex($listIndex);
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function getSelectedItem ()
        {
                if ( $this->isValidIndex() )
                {
                        $option =& $this->getOption($this->getSelectedIndex());
                        return $option->getValue();
                }
        }
        
        
        function setSelectedItem ( $item )
        {
                foreach ( array_keys($this->options) as $listIndex )
                {
                        $option =& $this->options[$listIndex];
                        if ( $option->getValue() == $item )
                        {
                                $this->setSelectedIndex($listIndex);
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function getValue ()
        {
                return $this->getSelectedItem();
        }
        
        
        function setValue ( $item )
        {
                return $this->getSelectedItem($item);
        }
        
        
        function isSelectedIndex ( $listIndexd )
        {
                return $this->selectedIndex == $listIndex;
        }
        
        
        function isSelectedId ( $id )
        {
                $option =& $this->getOptionWithIndex($this->selectedIndex);
                if ( is_null($option) )
                {
                        return FALSE;
                }
                
                if ( $option->getId() == $d )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function isSelectedItem ( $item )
        {
                $option =& $this->getOptionWithIndex($this->selectedIndex);
                if ( is_null($option) )
                {
                        return FALSE;
                }
                
                if ( $option->getValue() == $item )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function isValidIndex ( $listIndex )
        {
                if ( array_key_exists($listIndex, $this->options) )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function isValidId ( $id )
        {
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        if ( $option->getId() == $id )
                        {
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function isValidOption ( $optionValue )
        {
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        if ( $option->getValue() == $optionValue )
                        {
                                return TRUE;
                        }
                }
                
                return FALSE;
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
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
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
                
                
                $html .= '>';
                
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        $html .= $option->render();
                }
                
                $html .= '</select>';
                
                return $html;
        }
        
        
        function isComplete ()
        {
                return !is_null($this->getSelectedIndex());
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( !$this->isValidIndex($this->getSelectedIndex()) )
                {
                        $errors[$this->INVALID_OPTION] =
                                "'" . $this->getSelectedItem() . "' is not a valid option";
                }
                
                return $errors;
        }
}

?>
