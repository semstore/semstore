<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-08-23
 * @package Storage
 */

require_once('SEMObject.class.php');

class Storable extends SEMObject
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
        
        
        function Storable ()
        {
                die();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getStorageDriver ()
        {
                die();
        }
        
        
        function setStorageDriver ( &$storageDriver )
        {
                die();
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
        
        
        function store ()
        {
                die();
        }
        
        
        function &retrieve ()
        {
                ;
        }
        
        
        function remove ()
        {
                ;
        }
}

?>
