<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-24
 * @package SEM.MySEM
 */

require_once('SEMObject.class.php');

require_once('IO/DebugLevel.class.php');

class MySEMConfiguration extends SEMObject
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
        
        
        var $parameters = array();
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function MySEMConfiguration ()
        {
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                $this->setParameter('debug_level', DebugLevel::DEBUG());
                
                $this->setParameter('webserver','http://my.sem.local');
                
                $this->setParameter('site_root_path','/home/httpd/vhosts/mysem/httpdocs');
                $this->setParameter('site_root_webpath', '/mysem/httpdocs');
                $this->setParameter('site_root_ftp_path',
                        $this->getParameter('site_root_path'));
                
                $this->setParameter('template_path',
                        $this->getParameter('site_root_path').'/lib/smarty/templates');
                $this->setParameter('template_compile_path',
                        $this->getParameter('site_root_path').'/lib/smarty/templates_c');
                $this->setParameter('template_cache_path',
                        $this->getParameter('site_root_path').'/lib/smarty/cache');
                $this->setParameter('template_config_path',
                        $this->getParameter('site_root_path').'/lib/smarty/config');
                
                
                $this->setParameter('css_webpath',
                        $this->getParameter('site_root_webpath').'/css');
                $this->setParameter('images_webpath',
                        $this->getParameter('site_root_webpath').'/images');
                
                $this->setParameter('scripts_webpath',
                        $this->getParameter('site_root_webpath').'/js');
                
                $this->setParameter('tmp_uploads_path',
                        $this->getParameter('site_root_path') . '/tmpdir');
                $this->setParameter('tmp_uploads_webpath',
                        $this->getParameter('site_root_webpath') . '/tmpdir');
                $this->setParameter('tmp_uploads_ftp_path',
                        $this->getParameter('site_root_ftp_path') . '/tmpdir');
                
                $this->setParameter('ftp_host', 'localhost');
                $this->setParameter('ftp_port', 21);
                $this->setParameter('ftp_username', 'adam');
                $this->setParameter('ftp_password', 'swordfish');
                
                $this->setParameter('mailserver_host', 'mail.semstudio.co.uk');
                $this->setParameter('mailserver_port', 25);
                $this->setParameter('mailserver_auth', 1);
                $this->setParameter('mailserver_username', 'noreply');
                $this->setParameter('mailserver_password', 'S37ptHwv');
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
                if ( isset($this->parameters[$param]) )
                {
                        return $this->parameters[$param];
                }
                
                return NULL;
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
                $this->parameters[$param] = $value;
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
                unset($this->parameters[$param]);
        }
}

?>
