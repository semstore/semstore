<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-10-25
 */

require_once('HTTP/GPRGWeblet.class.php');

class CaptureConfirmCommitWeblet extends GPRGWeblet
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CaptureConfirmCommitWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_CaptureConfirmCommitWeblet'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
