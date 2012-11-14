<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package SEM.Utils
 */

require_once('SEM/Utils/Address.class.php');

class CompanyAddress extends Address
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
        
        
        var $companyName = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CompanyAddress ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CompanyAddress'.$numArgs),
                        $args);
        }
        
        
        function _CompanyAddress0 ()
        {
                $this->_initialise();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getCompanyName ()
        {
                return $this->companyName;
        }
        
        
        function setCompanyName ( $company )
        {
                $this->companyName = $company;
        }
        
        
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
