<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2005-08-23
 */

require_once('SEMObject.class.php');

class Importer extends SEMObject
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
        
        
        function Importer ()
        {
                die('Class Importer is Abstract and cannot be instantiated.');
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
        
        
        function import ( $class )
        {
                $config =& $GLOBALS['config'];
                $found = false;
                $relpath = str_replace( '::', '/', $class );
                foreach ( split(PATH_SEPARATOR, get_include_path()) as $path )
                {
                        $fullpath = $path .
                                ( substr($path, -1, 1) != '/' ? '/' : '' ) .
                                $relpath;
                        if ( file_exists($fullpath) )
                        {
                                require_once($fullpath);
                                $arr = array('class' => $class, 'path' => $fullpath);
                                array_push($config['imports'], $arr);
                                $found = true;
                        }
                }
                
                if ( !$found )
                {
                        die("*** ERROR ***:  Cannot import class '$class':" .
                                " No class with that name could be found.");
                }
        }
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
