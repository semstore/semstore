<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/User.class.php');

class CMSManager extends SEMObject
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
        
        
        function CMSManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSManager'.$numArgs),
                        $args);
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
        
        
        function &factory ( $clazz, $options )
        {
                require_once($clazz);
                
                $clazzname = '';
                if ( preg_match('{^.*?([^/]+)\.class\.php$}', $clazz, $matches) > 0 )
                {
                        $clazzname = $matches[1];
                }
                
                $driver = NULL;
                if ( is_array($options) )
                {
                        $driver = new $clazzname($options);
                }
                else
                {
                        $options = explode(explode($driver, ','), '=');
                        $driver = new $clazzname($options);
                }
                
                return $driver;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        /* User :: Begin */
        function &newUser ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_newUser'.$numArgs),
                        $args);
        }
        
        
        function &_newUser0 ()
        {
                die('abstract');
        }
        
        
        function &_newUser1 ( $typeName )
        {
                die('abstract');
        }
        
        
        function &findUser ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_findUser'.$numArgs),
                        $args);
        }
        
        
        function &_findUser0 ()
        {
                die('abstract');
        }
        
        
        function &findUsers ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_findUsers'.$numArgs),
                        $args);
        }
        
        
        function &_findUsers0 ()
        {
                die('abstract');
        }
        /* User :: End */
}

?>
