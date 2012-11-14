<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-03
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class CopyProductWebletStateContainer extends WebletStateContainer
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
        
        
        var $view = '';
        var $formErrors = NULL;
        var $productId = NULL;
        var $name = '';
        var $code = '';
        var $price = NULL;
        var $vatStatus = 1;
        var $formattedPrice = NULL;
        var $description = '';
        var $copyAttributes = TRUE;
        var $copySubproducts = TRUE;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CopyProductWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CopyProductWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _CopyProductWebletStateContainer0 ()
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
        
        
        
        
}

?>
