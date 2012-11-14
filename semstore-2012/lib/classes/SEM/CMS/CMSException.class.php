<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-22
 * @package SEM.CMS
 */

require_once('SEMException.class.php');

class CMSException extends SEMException
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
        
        
        
        
        
        /**
         * Constructs and instance of object
         *
         * @access public
         */
        function CMSException ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_CMSException'.$numArgs
                                ),
                        $args
                );
        }
        
        
        /**
         * No-Args Constructor
         *
         * @access private
         */
        function _CMSException0 ()
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
