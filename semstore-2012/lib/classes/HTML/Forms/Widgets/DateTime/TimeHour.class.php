<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-27
 */

class TimeHour extends ComboBox
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
        
        
        function TimeHour ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_TimeHour'.$numArgs ),
                        $args
                        );
        }
        
        
        function _TimeHour0 ()
        {
                $this->setName('timehour');
                $this->_initialise();
        }
        
        
        function _TimeHour1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                for ($h = 0; $h <= 23; $h++ )
                {
                        $hourStr = $h;
                        if ( strlen($hourStr)  < 2 )
                        {
                                $hourStr = '0'.$hourStr;
                        }
                        
                        $this->createOption($h, $hourStr);
                }
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
