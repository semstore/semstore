<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 *  @date 2005-06-27
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/Widgets/Basic/ListOption.class.php');

class ComboBoxOption extends ListOption
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
        
        
        function ComboBoxOption ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_ComboBoxOption'.$numArgs),  $args);
        }
        
        
        function _ComboBoxOption0 ()
        {
                $this->_initialise();
        }
        
        
        function _ComboBoxOption1 ( $id )
        {
                $this->_initialise();
                $this->setId($id);
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
        
        
}

?>
