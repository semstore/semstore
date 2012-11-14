<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

require_once('HTML/Forms/FormWidget.class.php');

class RadioGroup extends FormWidget
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
        
        
	var $name = '';
        var $options = array();
        var $selected = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function RadioGroup ()
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
        
        
        function createOption ( $name, $value )
        {
                $option =& new RadioButton();
                $option->name = $name;
                $option->value = $value;
                $this->addOption($option);
        }
        
        
        function addOption ( &$option )
        {
                //$options =& $this->getOptions();
                //$option->setGroup(&$this);
                $option->group =& $this;
                //array_push($options, $option);
                array_push($this->options, &$option);
                //$this->options =& $options;
        }
        
        
        function &getOption ( $optionName )
        {
                //foreach ( $this->getOptions() as $opt )
                for ( $i = 0; $i < count($this->options); $i++ )
                {
                        $opt =& $this->options[$i];
                        //print "'".$opt->name."' => '$optionName'";
                        if ( $opt->name == $optionName )
                        {
                                return $opt;
                        }
                }
                
                return null;
        }
        
        
        function getSelected ()
        {
                return $this->selected;
        }
        
        
        function setSelected ( $optionName )
        {
                //print "Setting '$optionName' to selected.";
                $this->selected = $optionName;
                //foreach ( $this->options as $opt )
                for ( $i = 0; $i < count($this->options); $i++ )
                {
                        $opt =& $this->options[$i];
                        if ( $opt->name == $optionName )
                        {
                                $opt->selected = true;
                        }
                        else
                        {
                                $opt->selected = false;
                        }
                }
        }
        
        
        function isSelected ( $optionName )
        {
                //print "'".($this->selected)."' is selected.";
                return $this->selected == $optionName;
        }
        
        
        function render ()
        {
                ;
        }
        
        
        function renderWithCSS( $cssType, $css )
        {
                ;
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
                                "'" . $this->getValue . "' is not a valid option";
                }
                
                return $errors;
        }
        
        
        function isComplete ()
        {
                return $this->getSelected() != '';
        }
        
        
}

?>
