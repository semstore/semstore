<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-02
 */

class ContactMethod extends ComboBox
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
        
        
        function ContactMethod ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'ContactMethod'.$numArgs),  $args);
        }
        
        
        function ContactMethod0 ()
        {
                $this->initialise();
        }
        
        
        function initialise ()
        {
                $this->setName('contactMethod');
                $this->createOption('phone', 'Phone');
                $this->createOption('fax', 'Fax');
                $this->createOption('mobile', 'Mobile');
                $this->createOption('email', 'Email');
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
}

?>
