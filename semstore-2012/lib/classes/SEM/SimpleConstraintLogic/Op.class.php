<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-01-11
 * @package SEM.SimpleConstraintLogic
 */

require_once('SEMObject.class.php');

class Op extends SEMObject
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
        
        
        var $opSym = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function Op ()
        {
                die('abstract');
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
                return sprintf("%s( %s, %s )",
                        $this->opSym,
                        (is_object($this->lexpr) ? $this->lexpr->toString() : "'{$this->lexpr}'"),
                        (is_object($this->rexpr) ? $this->rexpr->toString() : "'{$this->rexpr}'"));
        }
}

?>
