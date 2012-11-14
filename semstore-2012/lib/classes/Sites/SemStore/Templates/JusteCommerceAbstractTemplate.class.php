<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-18
 * @package Sites.JusteCommerce.Templates
 */

require_once('HTML/WebsiteTemplate.class.php');

class JusteCommerceAbstractTemplate extends WebsiteTemplate
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
        
        
        var $configuration = NULL;
        var $connection = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function JusteCommerceAbstractTemplate ()
        {
                die("Class 'JusteCommerceAbstractTemplate' is abtract and cannot br instantiated.");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getConfiguration ()
        {
                return $this->configuration;
        }
        
        
        function setConfiguration ( &$config )
        {
                $this->configuration = $config;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        function getTemplate ()
        {
                return $this->getTemplateFile();
        }
        
        
        function setTemplate ( $template )
        {
                $this->setTemplateFile($template);
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
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function _prepare ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
                
                ;
        }
        
        
        function render ()
        {
                return $this->fetch($this->getTemplate());
        }
}

?>
