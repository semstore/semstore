<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-09
 */

class CheckBoxUserGroups extends FormWidget
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
        
        
        var $name = 'usergroups';
        var $options = array();
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function CheckBoxUserGroups ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'CheckBoxUserGroups'.$numArgs),  $args);
        }
        
        
        function CheckBoxUserGroups0 ()
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
        
        
        /*
	 * Command Methods
	 */
        
        
        function createOption ( $name, $label, $value )
        {
                $option =& new CheckBox();
                $option->setName($this->getName().'[]');
                $option->setValue($value);
                $this->addOption($name, $label, $option);
        }
        
        
        function addOption ($name, $label, &$option)
        {
                array_push($this->getOptions(),
                        array('name' => $name, 'label' => $label, 'option' => &$option)
                        );
        }
        
        
        function render ()
        {
                $html = '';
                for ( $i = 0; $i < count($this->options); $i++ )
                {
                        $opt =& $this->options[$i]['option'];
                        $html .= $opt->render();
                        $html .= '<label>'.$this->options[$i]['label'].'</label>';
                        $html .= '<br />';
                }
                
                return $html;
        }
        
        
        function validate ()
        {
                $errors = array();
                
                return $errors;
        }
        
        
        function populate ( &$formdata )
        {
                foreach ( $formdata[$this->getName()] as $checked )
                {
                        $cbOpt =& $this->findOption($checked);
                        $cbOpt->setChecked(TRUE);
                }
        }
        
        
        function &findOption ( $optionName )
        {
                $option = NULL;
                for ( $i = 0; $i < count($this->options); $i++ )
                {
                        if ( $this->options[$i]['name'] == $optionName )
                        {
                                return $this->options[$i]['option'];
                        }
                }
                
                return $option;
        }
        
        
}

?>
