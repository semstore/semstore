<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-09-07
 * @package Configuration
 */

require_once('SEMObject.class.php');

class Configuration extends SEMObject
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
        
        
        function Configuration ()
        {
                die();
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
        
        
        function &getInstance ()
        {
                return $GLOBALS['configuration'];
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        /**
         * Gets the value associated with a given parameter name from the
         * configuration.
         *
         * Returns NULL if there is no configuration value associated with
         * the parameter name
         * 
         * @access public
         * @param string $param
         * @return string
         */
        function getParameter ( $param )
        {
                return $GLOBALS['configuration']->getParameter($param);
        }
        
        
        /**
         * Sets the value associated with a given parameter name in the
         * configuration.
         * 
         * @access public
         * @param string $param
         * @param string value
         */
        function setParameter ( $param, $value )
        {
                return $GLOBALS['configuration']->setParameter($param, $value);
        }
        
        
        /**
         * Removes the value associated with a given parameter name from the
         * configuration.
         * 
         * @access public
         * @param string $param
         * @param string value
         */
        function removeParameter ( $param )
        {
                return $GLOBALS['configuration']->deleteParameter($param);
        }
}

?>
