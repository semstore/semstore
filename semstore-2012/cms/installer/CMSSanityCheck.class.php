<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-11
 * @package 
 */

class CMSSanityCheck
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
        
        
        var $verbose = TRUE;
        var $cli = TRUE;
        
        var $report = NULL;
        
        var $skipLocateIncludePath = FALSE;
        var $includePath = NULL;
        
        var $dbms = '';
        var $dbhost = '';
        var $dbport = '';
        var $dbuser = '';
        var $dbpass = '';
        var $dbname = '';
        var $dbconn = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CMSSanityCheck ()
        {
                ;
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
        
        
        function writeOut ( $line )
        {
                $this->report[] = $line;
        }
        
        
        function locateIncludeDirectory ()
        {
                $includePath = NULL;
                $includePathFileFound = FALSE;
                for ( $i = 0; $i < 20 && !$includePathFileFound; $i++ )
                {
                        if ( is_file('./lib/include/include_path.inc.php') )
                        {
                                $includePath = getcwd() .
                                        ( getcwd() == '/' ? '' : '/' ) .
                                        'lib/include';
                                $includePathFileFound = TRUE;
                        }
                        else
                        {
                                $dir = getcwd();
                                chdir('..');
                                if ( $dir == getcwd() )
                                {
                                        break;
                                }
                        }
                }
                
                return $includePath;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        function run ()
        {
                $this->report = array();
                
                
                // Lets see if we can locate the include files directory
                if ( !$this->$skipLocateIncludePath )
                {
                        $this->includePath =
                                $this->locateIncludeDirectory();
                }
                else
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("Skipping search for include files directory\n");
                        }
                        
                }
                
                
                if ( is_null($this->includePath) )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("Could not find include files directory\n");
                                return;
                        }
                }
                else
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The include files directory is '".$this->includePath."'\n");
                        }
                }
                
                
                $this->checkIncludePathsIncFile();
                $this->checkDBConfigIncFile();
                $this->checkConfigurationDetails();
                //$this->checkFTPCredentials();
                
                
                
                
                return $this->report;
        }
        
        
        function checkIncludePathsIncFile ()
        {
                // Now can we locate the include_path.inc.php file
                if ( !file_exists($this->includePath.'/include_path.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'include_path.inc.php' does not exists!\n");
                                return;
                        }
                }
                elseif ( !is_file($this->includePath.'/include_path.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'include_path.inc.php' is not a file\n");
                                return;
                        }
                }
                
                
                // Can the include_path.inc.php file be read
                $inludePathFileConents = NULL;
                if ( !is_readable($this->includePath.'/include_path.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'include_path.inc.php' is not readable\n");
                                return;
                        }
                }
                elseif ( ($inludePathFileConents =
                        file_get_contents(
                        $this->includePath.'/include_path.inc.php') )
                                === FALSE )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'include_path.inc.php' is not readable\n");
                                return;
                        }
                }
                
                
                // Once the include_path.inc.php file is loaded can we locate
                // key files/packages required by the runtime
                set_include_path('');
                require_once($this->includePath.'/include_path.inc.php');
                if ( (include('Object.class.php')) !== 1 )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The SEM Solutions Ltd package framework could not be found in the include paths\n");
                                return;
                        }
                }
                elseif ( (include('Smarty/Smarty.class.php')) !== 1 )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The Smarty package could not be found in the include paths\n");
                                return;
                        }
                }
        }
        
        
        function checkDBConfigIncFile ()
        {
                // Now can we locate the db.config.inc.php file
                if ( !file_exists($this->includePath.'/db.config.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'db.config.inc.php' does not exists!\n");
                                return;
                        }
                }
                elseif ( !is_file($this->includePath.'/db.config.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'db.config.inc.php' is not a file\n");
                                return;
                        }
                }
                
                
                // Can the db.config.inc.php file be read
                $inludePathFileConents = NULL;
                if ( !is_readable($this->includePath.'/db.config.inc.php') )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'db.config.inc.php' is not readable\n");
                                return;
                        }
                }
                elseif ( ($inludePathFileConents =
                        file_get_contents(
                        $this->includePath.'/db.config.inc.php') )
                                === FALSE )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("The file 'db.config.inc.php' is not readable\n");
                                return;
                        }
                }
                
                
                // Once the db.config.inc.php file is loaded can we connect to the
                // database with the credentials
                require_once($this->includePath.'/db.config.inc.php');
                $this->dbms = $GLOBALS['config']['db_dbms'];
                $this->dbost = $GLOBALS['config']['db_server'];
                $this->dbport = ( !is_null($GLOBALS['config']['db_port'])
                        ? $GLOBALS['config']['db_port'] : 3306 );
                $this->dbuser = $GLOBALS['config']['db_username'];
                $this->dbpass = $GLOBALS['config']['db_password'];
                $this->dbname = $GLOBALS['config']['db_database'];
                
                $this->dbconn = NULL;
                if ( ($this->dbconn = @mysql_connect($this->dbhost.':'.$this->dbport,
                        $this->dbuser, $this->dbpass)) === FALSE )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("Could not connect to the database server with the details " .
                                        "provided in the file 'db.config.inc.php'.\n" .
                                        "Reason given by database server :- 'Code: '" . 
                                        mysql_errno() . ': ' . mysql_error());
                                return;
                        }
                }
                
                if ( mysql_select_db($this->dbname, $this->dbconn) === FALSE )
                {
                        if ( $this->verbose )
                        {
                                $this->writeOut("Could not select the database to use with the details " .
                                        "provided in the file 'db.config.inc.php'.\n" .
                                        "Reason given by database server :- 'Code: '" . 
                                        mysql_errno() . ': ' . mysql_error());
                                return;
                        }
                }
                
        }
        
        
        function checkConfigurationDetails ()
        {
                require_once('envprep.inc.php');
                require_once('Configuration/Configuration.class.php');
                // Check site root paths are correct (or at least point to a 
                // valid site)
                
                ;
                
                
                // Check permissions on directories that should be writeable
                
                // Check that the temporary directory is writeable
                $tmpDir = Configuration::getParameter('tmp_path');
                if ( !file_exists($tmpDir) )
                {
                        $this->writeOut("The tmp directory which is set to path '" .
                                $tmpDir . "' does not exists!\n");
                }
                elseif ( !is_dir($tmpDir) )
                {
                        $this->writeOut("The tmp directory which is set to path '" .
                                $tmpDir . "' is not a directory!\n");
                }
                elseif ( substr(sprintf('%o',
                        fileperms($tmpDir)), -4) != '0777' )
                {
                        $this->writeOut("The tmp directory which is set to path '" .
                                $tmpDir . "' does not have the permissons '777'!\n");
                }
                
                
                // Check that the temporary uploads directory is writeable
                $tmpUploadPath = Configuration::getParameter('site_tmp_uploads_path');
                if ( !file_exists($tmpUploadPath) )
                {
                        $this->writeOut("The temporary uploads directory which is set to path '" .
                                $tmpUploadPath . "' does not exists!\n");
                }
                elseif ( !is_dir($tmpUploadPath) )
                {
                        $this->writeOut("The temporary uploads directory which is set to path '" .
                                $tmpUploadPath . "' is not a directory!\n");
                }
                elseif ( substr(sprintf('%o',
                        fileperms($tmpUploadPath)), -4) != '0777' )
                {
                        $this->writeOut("The temporary uploads directory which is set to path '" .
                                $tmpUploadPath . "' does not have the permissons '777'!\n");
                }
                
                
                // Check that the site compiled templates directory is writeable
                $siteTemplateCPath = Configuration::getParameter('template_compile_path');
                if ( !file_exists($siteTemplateCPath) )
                {
                        $this->writeOut("The compiled templates directory for the site which is set to path '" .
                                $siteTemplateCPath . "' does not exists!\n");
                }
                elseif ( !is_dir($siteTemplateCPath) )
                {
                        $this->writeOut("The compiled templates directory which is set to path '" .
                                $siteTemplateCPath . "' is not a directory!\n");
                }
                elseif ( substr(sprintf('%o',
                        fileperms($siteTemplateCPath)), -4) != '0777' )
                {
                        $this->writeOut("The compiled templates directory which is set to path '" .
                                $siteTemplateCPath . "' does not have the permissons '777'!\n");
                }
                
                
                // Check that the CMS compiled templates directory is writeable
                $cmsTemplateCPath = Configuration::getParameter('cms_template_compile_path');
                if ( !file_exists($cmsTemplateCPath) )
                {
                        $this->writeOut("The compiled CMS templates directory for the site which is set to path '" .
                                $cmsTemplateCPath . "' does not exists!\n");
                }
                elseif ( !is_dir($cmsTemplateCPath) )
                {
                        $this->writeOut("The compiled CMS templates directory which is set to path '" .
                                $cmsTemplateCPath . "' is not a directory!\n");
                }
                elseif ( substr(sprintf('%o',
                        fileperms($cmsTemplateCPath)), -4) != '0777' )
                {
                        $this->writeOut("The compiled CMS templates directory which is set to path '" .
                                $cmsTemplateCPath . "' does not have the permissons '777'!\n");
                }
                
                
                // Check ftp details
                
                ;
                
                // Check mail server details
                
                ;
        }
        
        
        function getConfigParam ( $param, $dbconn )
        {
                return Configuration::getParameter($param);
        }
}

?>
