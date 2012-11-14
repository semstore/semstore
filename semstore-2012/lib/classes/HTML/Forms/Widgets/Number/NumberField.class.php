<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

class NumberField extends TextBox
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
        var $lowerlimit = '';
        var $upperlimit = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function NumberField ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'NumberField'.$numArgs),  $args);
        }
        
        
        function NumberField0 ()
        {
                ;
        }
        
        
        function NumberField1 ( $name )
        {
                $this->setName($name);
        }
        
        
        function NumberField3 ( $name, $lowerlimit, $upperlimit )
        {
                $this->setName($name);
                $this->setLowerLimit($lowerlimit);
                $this->setUpperLimit($upperlimit);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getLowerLimit ()
        {
                return $this->lowerlimit;
        }
        
        
        function setLowerLimit ( $lowerlimit )
        {
                $this->lowerlimit = $lowerlimit;
        }
        
        
        function getUpperLimit ()
        {
                return $this->upperlimit;
        }
        
        
        function setUpperLimit ( $upperlimit )
        {
                $this->upperlimit = $upperlimit;
        }
        
        
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
                
                if ( !is_numeric($this->getValue()) )
                {
                        //array_push($errors, $this->NOT_A_NUMBER);
                        $errors[$this->NON_A_NUMBER] = 'A number must be entered';
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
