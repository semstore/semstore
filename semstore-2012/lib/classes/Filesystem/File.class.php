<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('SEMObject.class.php');

class File extends SEMObject
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
        
        
        function File ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, 'File'.$numArgs),
                        $args
                        );
        }
        
        
        function File0 ()
        {
                $this->_initialize();
        }
        
        
        function File1 ( $file )
        {
                $this->_initialize();
                $this->setFile( $file );
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getFile ()
        {
                return $this->file;
        }
        
        
        function setFile ( $file )
        {
                $this->file = $file;
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
        
        
        function getFilename ()
        {
                return basename($this->getFile());
        }
        
        
        function getDescriptor ()
        {
                $matches = array();
                if ( preg_match('{\.(.+?)$}', $this->getFilename(), $matches ) > 0 )
                {
                        return $matches[1];
                }
                
                return '';
        }
        
}

?>
