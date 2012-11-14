<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms.Widgets.Personal
 */

require_once('HTML/Forms/Widgets/Basic/TextBox.class.php');

class EmailAddress extends TextBox
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
        
        
        function EmailAddress ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_EmailAddress'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _EmailAddress0 ()
        {
                $this->_initialise();
                $this->setId('email');
        }
        
        
        function _EmailAddress1 ( $name )
        {
                $this->_initialise();
                $this->setId($name);
                
        }
        
        
        function _initialise ()
        {
                $this->setId('email');
                $this->setSize(30);
                $this->setMaxLength(100);
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
                
                if ( $this->getMaxLength() != '' && $this->getMaxLength() != 0 &&
                        strlen($this->getValue()) > $this->getMaxLength() )
                {
                        $errors[$this->MAX_SIZE_EXCEEDED] =
                                'The information entered exceeded the maximum size of ' .
                                $this->getMaxLength() . ' characters';
                        return $errors;
                }
                
                
                $atIdx = strpos($this->getValue(), '@');
                $dotIdx = strrpos($this->getValue(), '.');
                if ( !( $atIdx > 0 && $atIdx < strlen($this->getValue()) ) )
                {
                        array_push($errors, 'Please enter a valid email address');
                }
                elseif ( !($dotIdx > 0 && $atIdx < $dotIdx) )
                {
                        array_push($errors, 'Please enter a valid email address');
                }
                
                return $errors;
        }
}

?>
