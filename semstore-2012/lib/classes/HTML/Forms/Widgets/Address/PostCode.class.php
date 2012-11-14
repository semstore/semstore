<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-14
 * @package HTML.Forms.Widgets.Address
 */

require_once('HTML/Forms/Widgets/Basic/TextBox.class.php');
 
class PostCode extends TextBox
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
        
        
        var $size = 7;
        var $maxsize = 7;
        var $value = '';
        var $defaultValue = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function PostCode ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_PostCode'.$numArgs),  $args);
        }
        
        
        function _PostCode0 ()
        {
                $this->setName('postcode');
                $this->_initialise();
        }
        
        
        function _PostCode1 ( $name )
        {
                $this->setName($name);
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                ;
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
        
        function validate ()
        {
                return array();
        }
}

?>
