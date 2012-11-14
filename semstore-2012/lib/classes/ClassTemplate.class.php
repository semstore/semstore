<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2005-08-23
 */

class SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/**
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function SEMObject ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'Object'.$numArgs),  $args);
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
