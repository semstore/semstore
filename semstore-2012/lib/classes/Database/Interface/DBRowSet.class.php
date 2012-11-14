<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-22
 * @package Database.Interface
 */

require_once('SEMObject.class.php');

class DBRowSet extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	/*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function DBRowSet ()
        {
                die('Abstract method invoked');
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
        function rowCount ()
        {
                die('Abstract method invoked');
        }
        
        
        function next ()
        {
                die('Abstract method invoked');
        }
        
        
        function previous ()
        {
                die('Abstract method invoked');
        }
        
        
        function first ()
        {
                die('Abstract method invoked');
        }
        
        
        function last ()
        {
                die('Abstract method invoked');
        }
        
        
        function &getRowArray ()
        {
                die('Abstract method invoked');
        }
	
        
	function &getRowHash ()
	{
		die('Abstract method invoked');
	}
        
        
        function getSqlStatement ()
        {
                die('Abstract method invoked');
        }
        
        
        function free ()
        {
                die('Abstract method invoked');
        }
}

?>
