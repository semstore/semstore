<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-08
 */

class PRGView extends SEMObject
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
        
        
        var $model = NULL;
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function PRGView ()
        {
                die("Class '".get_class($this)."' is abstract and cannot be".
                        " instantiated.");
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getModel ()
        {
                return $this->model;
        }
        
        
        function setModel ( &$model )
        {
                $this->model =& $model;
        }
        
        
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
        
        
        function render ()
        {
                ;
        }
}

?>
