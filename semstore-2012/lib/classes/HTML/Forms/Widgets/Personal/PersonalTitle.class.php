<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-06-27
 * @package HTML.Forms.Widgets.Personal
 */

require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');

class PersonalTitle extends ComboBox
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
        
        
        function PersonalTitle ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_PersonalTitle'.$numArgs),  $args);
        }
        
        
        function _PersonalTitle0 ()
        {
                $this->setName('title');
                $this->_initialise();
        }
        
        
        function _PersonalTitle1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('select_title', '-- Select --');
                $this->createOption('mr', 'Mr');
                $this->createOption('mrs', 'Mrs');
                $this->createOption('miss', 'Miss');
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
         
         
         function &validate ()
         {
                $errors = array();
                
                if ( !$this->isValidOption($this->getSelected()) )
                {
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid Title';
                }
                else if ( $this->getSelected() == 'select_title' )
                {
                        $errors[$this->INVALID_OPTION] =
                                'Please select a valid Title';
                }
                
                return $errors;
        }
}

?>
