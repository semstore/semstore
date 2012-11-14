<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-04-04
 * @package DateTime
 */

require_once('Object.clas.php');

class Timezone extends SEMObject
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
        
        
        function Timezone ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Timezone'.$numArgs),
                        $args);
        }
        
        
        function _Timezone0 ()
        {
                ;
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
        
        
        function toString ()
        {
                ;
        }
}

?>
