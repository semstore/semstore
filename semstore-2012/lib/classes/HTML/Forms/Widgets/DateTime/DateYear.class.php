<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

class DateYear extends ComboBox
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
        
        
        function DateYear ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_DateYear'.$numArgs ),
                        $args
                        );
        }
        
        
        function _DateYear0 ()
        {
                $this->setName('dateyear');
                $this->_initialise();
        }
        
        
        function _DateYear1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('2005', '2005');
                $this->createOption('2006', '2006');
                $this->createOption('2007', '2007');
                $this->createOption('2008', '2008');
                $this->createOption('2009', '2009');
                $this->createOption('2010', '2010');
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
