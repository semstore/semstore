<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

class IntegerField extends NumberField
{
        /*
	 * Class Constants
	 */
	
        
        var $MAX_SIZE_EXCEEDED = 101;
        var $NOT_A_NUMBER = 101;
        var $LOWER_LIMIT_EXCEEDED = 102;
        var $UPPER_LIMIT_EXCEEDED = 103;
        
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        var $value = 0;
        var $defaultValue = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function IntegerField ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'IntegerField'.$numArgs),  $args);
        }
        
        
        function IntegerField0 ()
        {
                ;
        }
        
        
        function IntegerField1 ( $name )
        {
                $this->setName($name);
        }
        
        
        function IntegerField3 ( $name, $lowerlimit, $upperlimit )
        {
                $this->setName($name);
                $this->setLowerLimit($lowerlimit);
                $this->setUpperLimit($upperlimit);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $html = '<input type="text"';
                $html .= ( $this->getName() != '' ?
                        ' name="'.$this->getName().'"' :
                        '' );
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
                        '' );
                $html .= ( $this->getMaxSize() != '' ?
                        ' maxsize="'.$this->getMaxSize().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.htmlspecialchars($this->getValue()).'"' :
                        ' value="'.htmlspecialchars($this->getDefaultValue()).'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( $this->getMaxSize() != '' &&
                        strlen($this->getValue()) > $this->getMaxSize() )
                {
                        $errors[$this->MAX_SIZE_EXCEEDED] =
                                'The information entered exceeded the maximum size of ' .
                                $this->getMaxSize() . ' characters';
                        return $errors;
                }
                
                //if ( !is_numeric($this->getValue()) ||
                //        !is_int((int)$this->getValue()) )
                //if ( !is_numeric($this->getValue()) )
                if ( !ereg("^[0-9]+$", $this->getValue()) )
                {
                        //print $this->value;
                        //array_push($errors, $this->NOT_A_NUMBER);
                        $errors[$this->NON_A_NUMBER] =
                                'A whole number must be entered';
                        return $errors;
                }
                
                if ( $this->getLowerLimit() != '' &&
                        $this->getValue() < $this->getLowerLimit() )
                {
                        //array_push($errors, $this->LOWER_LIMIT_EXCEEDED);
                        $errors[$this->LOWER_LIMIT_EXCEEDED] =
                                'Value entered cannot be less than ' .
                                $this->getLowerLimit();
                        return $errors;
                }
                
                if ( $this->getUpperLimit() != '' &&
                        $this->getValue() > $this->getUpperLimit() )
                {
                        //array_push($errors, $this->UPPER_LIMIT_EXCEEDED);
                        $errors[$this->UPPER_LIMIT_EXCEEDED] =
                                'Value entered cannot be greater than ' .
                                $this->getUpperLimit();
                        return $errors;
                }
                
                return $errors;
        }
        
        
        function isComplete ()
        {
                return $this->getValue() != '';
        }
        
        
}

?>
