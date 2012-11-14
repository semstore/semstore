<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-01-11
 * @package SEM.SimpleConstraintLogic
 */

class OpNotEqualTo extends SEMObject
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
        
        
        var $lexpr = NULL;
        var $rexpr = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function OpNotEqualTo ( $lexpr, $rexpr )
        {
                $this->lexpr = $lexpr;
                $this->rexpr = $rexpr;
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
                return sprintf("!= ( '%s', '%s' )",
                        $this->lexpr->toString(),
                        $this->rexpr->toString());
        }
}

?>
