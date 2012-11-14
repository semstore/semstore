<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

class DateMonth extends ComboBox
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
        
        
        function DateMonth ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_DateMonth'.$numArgs ),
                        $args
                        );
        }
        
        
        function _DateMonth0 ()
        {
                $this->setName('datemonth');
                $this->_initialise();
        }
        
        
        function _DateMonth1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('1', 'January');
                $this->createOption('2', 'February');
                $this->createOption('3', 'March');
                $this->createOption('4', 'April');
                $this->createOption('5', 'May');
                $this->createOption('6', 'June');
                $this->createOption('7', 'July');
                $this->createOption('8', 'August');
                $this->createOption('9', 'September');
                $this->createOption('10', 'October');
                $this->createOption('11', 'November');
                $this->createOption('12', 'December');
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
                
                return $errors;
        }
}

?>
