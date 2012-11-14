<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-08
 */

require_once('SEMObject.class.php');

class PRGModel extends SEMObject
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
        
        
        function PRGModel ()
        {
                die("Class '" . get_class($this) . "' is an interface and cannot" .
                        " be instantiated." );
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
        
        
        function asArray ()
        {
                die("Cannot call method 'asArray' as class '". get_class($this) .
                        "' is an interface.");
        }
}

?>
