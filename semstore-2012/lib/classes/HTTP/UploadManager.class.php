<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-01-20
 * @package HTTP
 */

class UploadManager extends SEMObject
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
        
        
        function UploadManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UploadManager'.$numArgs ),
                        $args);
        }
        
        
        function _UploadManager0 ()
        {
                $this->_initialise();
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
