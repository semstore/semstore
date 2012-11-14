<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-01-11
 * @package SEM.SimpleConstraintLogic
 */

require_once('SEM/SimpleConstraintLogic/Op.class.php');

class OpGreaterOrEqualTo extends Op
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
        
        
        var $opSym = '>=';
        var $lexpr = NULL;
        var $rexpr = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function OpGreaterOrEqualTo ( $lexpr, $rexpr )
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
        
        
        
        
        
}

?>
