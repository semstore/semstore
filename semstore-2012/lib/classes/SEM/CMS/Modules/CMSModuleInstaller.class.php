<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package SEM.CMS
 */

require_once('SEMObject.class.php');
require_once('String.class.php');
require_once('IO/File.class.php');
require_once('IO/FileNotFoundException.class.php');

require_once('File/Archive.php');

class CMSModuleInstaller extends SEMObject
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
        var $pkgFile = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CMSModuleInstaller ( &$configuration, $pkgFile )
        {
                $this->autoconfigure($configuration);
                $this->setPackageFile($pkgFile);
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
        
        
        function setConfiguration ( &$configuration )
        {
                $this->configuration =& $configuration;
        }
        
        
        function &getPackageFile ()
        {
                return $this->pkgFile;
        }
        
        
        function setPackageFile ( $pkgFile )
        {
                if ( File::isInstanceOf($pkgFile, 'File') )
                {
                        $this->pkgFile =& $pkgFile;
                }
                elseif ( String::isInstanceOf($pkgFile, 'String') )
                {
                        $file =& new File($pkgFile);
                        $this->pkgFile =& $file;
                }
                else
                {
                        $file =& new File($pkgFile);
                        $this->pkgFile =& $file;
                }
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
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
        }
        
        
        function unpack ()
        {
                $pkgFile =& $this->getPackageFile();
                if ( !$pkgFile->exists() )
                {
                        return FileNotFoundException($pkgFile);
                }
        }
        
        
        function check ()
        {
                if ( !$this->isUnpacked() )
                {
                        $this->unpack();
                }
                
                
        }
        
        
        function install ()
        {
                if ( !$this->isUnpacked() )
                {
                        $this->unpack();
                }
                
                if ( !$this->passedChecks() )
                {
                        $this->check();
                }
                
                
                
        }
}

?>
