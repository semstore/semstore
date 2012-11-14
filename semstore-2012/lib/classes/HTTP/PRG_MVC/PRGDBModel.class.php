<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-07
 */

class PRGDBModel extends SEMObject
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
        
        
        function PRGDBModel ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'PRGDBModel'.$numArgs),  $args);
        }
        
        
        function PRGDBModel0 ()
        {
                ;
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
        
        
        function getVar ( $varname )
        {
                die("Cannot call method 'getVar' as class '". get_class($this) .
                        "' is an interface.");
        }
        
        function setVar ( $varname, $var )
        {
                die("Cannot call method 'setVar' as class '". get_class($this) .
                        "' is an interface.");
        }
        
        function &getVarByRef ( $varname )
        {
                die("Cannot call method 'getVarByRef' as class '". get_class($this) .
                        "' is an interface.");
        }
        
        function setVarbyRef ( $varname, &$var )
        {
                die("Cannot call method 'setVarByRef' as class '". get_class($this) .
                        "' is an interface.");
        }
        
        function destroyVar ( $varname )
        {
                die("Cannot call method 'destroyVar' as class '". get_class($this) .
                        "' is an interface.");
        }
}

?>
