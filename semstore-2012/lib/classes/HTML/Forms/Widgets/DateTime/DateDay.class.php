<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-06-27
 */

require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');

class DateDay extends ComboBox
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
        
        
        function DateDay ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_DateDay'.$numArgs ),
                        $args
                        );
        }
        
        
        function _DateDay0 ()
        {
                $this->setName('dateday');
                $this->_initialise();
        }
        
        
        function _DateDay1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->createOption('1', '01');
                $this->createOption('2', '02');
                $this->createOption('3', '03');
                $this->createOption('4', '04');
                $this->createOption('5', '05');
                $this->createOption('6', '06');
                $this->createOption('7', '07');
                $this->createOption('8', '08');
                $this->createOption('9', '09');
                $this->createOption('10', '10');
                $this->createOption('11', '11');
                $this->createOption('12', '12');
                $this->createOption('13', '13');
                $this->createOption('14', '14');
                $this->createOption('15', '15');
                $this->createOption('16', '16');
                $this->createOption('17', '17');
                $this->createOption('18', '18');
                $this->createOption('19', '19');
                $this->createOption('20', '20');
                $this->createOption('21', '21');
                $this->createOption('22', '22');
                $this->createOption('23', '23');
                $this->createOption('24', '24');
                $this->createOption('25', '25');
                $this->createOption('26', '26');
                $this->createOption('27', '27');
                $this->createOption('28', '28');
                $this->createOption('29', '29');
                $this->createOption('30', '30');
                $this->createOption('31', '31');
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
