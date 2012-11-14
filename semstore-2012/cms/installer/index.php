<?php

$GLOBALS['db_tables'] = array(
        'configuration_group',
        'configuration',
        'cms_capability_group',
        'cms_capability',
        'cms_capability_group_link',
        'cms_role',
        'cms_role_capability_link',
        'cms_user',
        'cms_user_role_link'
        );

session_start();
run();
session_write_close();

exit();


function run ()
{
        if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) )
        {
                doPost();
        }
        else
        {
                doGet();
        }
}


function doPost ()
{
        $action = $_REQUEST['action'];
        
        if ( 'step1_continue' == $action )
        {
                do_action_step1_continue();
        }
        else
        {
                doGet();
        }
}


function doGet ()
{
        $view = $_REQUEST['view'];
        if ( is_null($view) || $view == '' )
        {
                presetVars();
                do_view_step1();
        }
        elseif ( $view == 'step1' )
        {
                do_view_step1();
        }
        elseif ( $view == 'complete' )
        {
                do_view_complete();
        }

}


function presetVars ()
{
        $_SESSION['errors'] = '';
        
        $_SESSION['ftphost'] = 'localhost';
        $_SESSION['ftpport'] = '21';
        $_SESSION['ftpuser'] = '';
        $_SESSION['ftppass'] = '';
        
        
        $_SESSION['dbprotocol'] = 'mysql';
        $_SESSION['dbhost'] = 'localhost';
        $_SESSION['dbport'] = '3306';
        $_SESSION['dbuser'] = '';
        $_SESSION['dbpass'] = '';
        $_SESSION['dbname'] = '';
        
        $_SESSION['emptydb'] = FALSE;
        $_SESSION['droptables'] = FALSE;
        
        
        $siterootpath = preg_replace('{/cms/installer/.*}', '', $_SERVER['SCRIPT_FILENAME']);
        $cmsrootpath = preg_replace('{/installer/.*}', '', $_SERVER['SCRIPT_FILENAME']);
        
        $_SESSION['libpath'] = 
                $siterootpath . ":\n" .
                $siterootpath . '/lib' . ":\n" .
                $siterootpath . '/lib/classes' . ":\n" .
                $siterootpath . '/lib/include' . ":\n" .
                $siterootpath . '/lib/packages' . ":\n" .
                $siterootpath . '/lib/pear' . ":\n";
        
        $_SESSION['siterootpath'] = $siterootpath;
        $_SESSION['siterootwebpath'] = '';
        $_SESSION['siterootftppath'] = '';
        $_SESSION['cmsrootpath'] = $cmsrootpath;
        $_SESSION['cmsrootwebpath'] = '';
        $_SESSION['systmp'] = '/tmp';
        
        $_SESSION['adminemail'] = '';
        $_SESSION['adminpass'] = 'admin1234';
        $_SESSION['confirmadminpass'] = 'admin1234';
}


function do_view_step1 ()
{
        $contents = file_get_contents('capture_details.tpl');
        
        $contents = str_replace('{$formAction}', $_SERVER['PHP_SELF'], $contents);
        $contents = str_replace('{$formMethod}', 'post', $contents);
        $contents = str_replace('{$formEncoding}', 'application/x-www-form-urlencoded', $contents);
        $contents = str_replace('{$action}', 'step1_continue', $contents);
        
        $contents = str_replace('{$errmsg}', $_SESSION['errors'], $contents);
        
        $contents = str_replace('{$ftphost}', $_SESSION['ftphost'], $contents);
        $contents = str_replace('{$ftpport}', $_SESSION['ftpport'], $contents);
        $contents = str_replace('{$ftpuser}', $_SESSION['ftpuser'], $contents);
        $contents = str_replace('{$ftppass}', $_SESSION['ftppass'], $contents);
        
        $contents = str_replace('{$dbprotocol}', $_SESSION['dbprotocol'], $contents);
        $contents = str_replace('{$dbhost}', $_SESSION['dbhost'], $contents);
        $contents = str_replace('{$dbport}', $_SESSION['dbport'], $contents);
        $contents = str_replace('{$dbuser}', $_SESSION['dbuser'], $contents);
        $contents = str_replace('{$dbpass}', $_SESSION['dbpass'], $contents);
        $contents = str_replace('{$dbname}', $_SESSION['dbname'], $contents);
        
        
        $contents = str_replace('{$emptydb}',
                ( $_SESSION['emptydb'] == TRUE ? 'checked' : '' ),
                $contents);
        $contents = str_replace('{$droptables}',
                ( $_SESSION['droptables'] == TRUE ? 'checked' : '' ),
                $contents);
        
        $contents = str_replace('{$libpath}', $_SESSION['libpath'], $contents);
        
        $contents = str_replace('{$siterootpath}', $_SESSION['siterootpath'], $contents);
        $contents = str_replace('{$siterootwebpath}', $_SESSION['siterootwebpath'], $contents);
        $contents = str_replace('{$siterootftppath}', $_SESSION['siterootftppath'], $contents);
        $contents = str_replace('{$cmsrootpath}', $_SESSION['cmsrootpath'], $contents);
        $contents = str_replace('{$cmsrootwebpath}', $_SESSION['cmsrootwebpath'], $contents);
        $contents = str_replace('{$systmp}', $_SESSION['systmp'], $contents);
        
        $contents = str_replace('{$adminemail}', $_SESSION['adminemail'], $contents);
        $contents = str_replace('{$adminpass}', $_SESSION['adminpass'], $contents);
        $contents = str_replace('{$confirmadminpass}', $_SESSION['confirmadminpass'], $contents);
        
        print $contents;
}


function do_action_step1_continue ()
{
        $ftphost = getReqParam('ftphost');
        $ftpport = getReqParam('ftpport');
        $ftpuser = getReqParam('ftpuser');
        $ftppass = getReqParam('ftppass');
        
        $dbprotocol = getReqParam('dbprotocol');
        $dbhost = getReqParam('dbhost');
        $dbport = getReqParam('dbport');
        $dbuser = getReqParam('dbuser');
        $dbpass = getReqParam('dbpass');
        $dbname = getReqParam('dbname');
        
        $emptydb = getReqParam('emptydb');
        $droptables = getReqParam('droptables');
        
        $libpath = getReqParam('libpath');
        
        $siterootpath = getReqParam('siterootpath');
        $siterootwebpath = getReqParam('siterootwebpath');
        $siterootftppath = getReqParam('siterootftppath');
        $cmsrootpath = getReqParam('cmsrootpath');
        $cmsrootwebpath = getReqParam('cmsrootwebpath');
        $systmp = getReqParam('systmp');
        
        $adminemail = getReqParam('adminemail');
        $adminpass = getReqParam('adminpass');
        $confirmadminpass = getReqParam('confirmadminpass');
        
        
        $_SESSION['ftphost'] = $ftphost;
        $_SESSION['ftpport'] = $ftpport;
        $_SESSION['ftpuser'] = $ftpuser;
        $_SESSION['ftppass'] = $ftppass;
        
        
        $_SESSION['dbprotocol'] = $dbprotocol;
        $_SESSION['dbhost'] = $dbhost;
        $_SESSION['dbport'] = $dbport;
        $_SESSION['dbuser'] = $dbuser;
        $_SESSION['dbpass'] = $dbpass;
        $_SESSION['dbname'] = $dbname;
        
        $_SESSION['emptydb'] = ( $emptydb == 'yes' ? TRUE : FALSE );
        $_SESSION['droptables'] = ( $droptables == 'yes' ? TRUE : FALSE );
        
        $_SESSION['libpath'] = $libpath;
        
        $_SESSION['siterootpath'] = $siterootpath;
        $_SESSION['siterootwebapth'] = $siterootwebpath;
        $_SESSION['siterootftppath'] = $siterootftppath;
        $_SESSION['cmsrootpath'] = $cmsrootpath;
        $_SESSION['cmsrootwebpath'] = $cmsrootwebpath;
        $_SESSION['systmp'] = $systmp;
        
        $_SESSION['adminemail'] = $adminemail;
        $_SESSION['adminpass'] = $adminpass;
        $_SESSION['confirmadminpass'] = $confirmadminpass;
        
        
        // Build include_path.inc.php
        $result = writeIncludePathFile($_SESSION['systmp'],
                $_SESSION['libpath'],
                $_SESSION['ftphost'],
                $_SESSION['ftpport'],
                $_SESSION['ftpuser'],
                $_SESSION['ftppass'],
                $_SESSION['siterootftppath']);
        if ( $result !== TRUE )
        {
                $_SESSION['errors'] = $result;
                redirect($_SERVER['PHP_SELF'].'?view=step1');
                return;
        }
        
        // Build db.config.inc.php
        $result = writeDbConfigIncFile($_SESSION['systmp'],
                $_SESSION['dbprotocol'],
                $_SESSION['dbhost'],
                $_SESSION['dbport'],
                $_SESSION['dbuser'],
                $_SESSION['dbpass'],
                $_SESSION['dbname'],
                $_SESSION['ftphost'],
                $_SESSION['ftpport'],
                $_SESSION['ftpuser'],
                $_SESSION['ftppass'],
                $_SESSION['siterootftppath']);
        if ( $result !== TRUE )
        {
                $_SESSION['errors'] = $result;
                redirect($_SERVER['PHP_SELF'].'?view=step1');
                return;
        }
        
        
        $result = testDatabaseCredentials( $_SESSION['dbprotocol'],
                $_SESSION['dbhost'],
                $_SESSION['dbport'],
                $_SESSION['dbuser'],
                $_SESSION['dbpass'],
                $_SESSION['dbname']);
        if ( $result !== TRUE )
        {
                $_SESSION['errors'] = $result;
                redirect($_SERVER['PHP_SELF'].'?view=step1');
                return;
        }
        
        
        $result = installDatabaseTables( $_SESSION['dbprotocol'],
                $_SESSION['dbhost'],
                $_SESSION['dbport'],
                $_SESSION['dbuser'],
                $_SESSION['dbpass'],
                $_SESSION['dbname'],
                dirname($_SERVER['SCRIPT_FILENAME']) . '/sql',
                $GLOBALS['db_tables']);
        if ( $result !== TRUE )
        {
                $_SESSION['errors'] = $result;
                redirect($_SERVER['PHP_SELF'].'?view=step1');
                return;
        }
        
        
        $result = installDatabaseTableContent( $_SESSION['dbprotocol'],
                $_SESSION['dbhost'],
                $_SESSION['dbport'],
                $_SESSION['dbuser'],
                $_SESSION['dbpass'],
                $_SESSION['dbname'],
                dirname($_SERVER['SCRIPT_FILENAME']) . '/sql',
                $GLOBALS['db_tables']);
        if ( $result !== TRUE )
        {
                $_SESSION['errors'] = $result;
                redirect($_SERVER['PHP_SELF'].'?view=step1');
                return;
        }
        
        // Set DB config parameters
        
        setConfigurationParameters($_SESSION);
        //installCMSAdministrator()
        
        //redirect($cmsrootwebpath);
        redirect($_SERVER['PHP_SELF'].'?view=complete');
}


function do_view_complete ()
{
        $contents = file_get_contents('install_complete.tpl');
        
        $contents = str_replace('{$cmswebpath}',
                $_SESSION['cmsrootwebpath'], $contents);
        
        print $contents;
}





function getReqParam ( $param )
{
        if ( !get_magic_quotes_gpc() )
        {
                return $_REQUEST[$param];
        }
        else
        {
                return stripslashes($_REQUEST[$param]);
        }
}


function redirect ( $url )
{
        header('Location: ' . $url);
}


function writeIncludePathFile ( $tmp, $pathStr, $ftpHost, $ftpPort, $ftpUser,
        $ftpPass, $siteRootFtpPath )
{
        $paths = explode(':', $pathStr);
        
        // Create include path file in /tmp or where ever it is on the system.
        $tmpFile = $tmp . '/' . 'include_path.inc.php';
        $fileContents = buildIncludePathFileString($paths);
        
        $fh = NULL;
        if ( !$fh = fopen($tmpFile, 'w') )
        {
                return "Unable to open file '" . $tmpFile . "'";
        }
        
        if ( !fwrite($fh, $fileContents) )
        {
                return "Unable to write to file '" . $tmpFile . "'";
        }
        
        
        if ( !fclose($fh) )
        {
                return "Unable to close file '" . $tmpFile . "'";
        }
        
        
        // Move the file via ftp into the correct dir
        $ftpLocalFile = $tmpFile;
        $ftpRemoteFile = $siteRootFtpPath .
                '/lib/include/include_path.inc.php';
        
        if ( !$ftpConn = ftp_connect($ftpHost, $ftpPort) )
        {
                return "Unable to open an ftp connection to " .
                        "host '" . $ftpHost . "' on port '" . $ftpPort . "'";
        }
        if ( !ftp_login($ftpConn, $ftpUser, $ftpPass) )
        {
                return "Unable to authenticate with ftp server using " .
                        "username '" . $ftpUser . "' and " .
                        "password '" . $ftpPass . "'";
        }
        if ( !ftp_put($ftpConn, $ftpRemoteFile, $ftpLocalFile, FTP_ASCII) )
        {
                return "Unable to ftp upload local file '" . $ftpLocalFile . "'" .
                        " to remote file '" . $ftpRemoteFile . "'";
        }
        if ( !ftp_close($ftpConn) )
        {
                return "Unable to close ftp connection";
        }
        
        
        // Delete tmp file
        unlink($tmpFile);
        
        return TRUE;
}


function buildIncludePathFileString ( $paths )
{
        $lines = array();
        $lines[] = "<?php";
        $lines[] = "";
        $lines[] = "set_include_path(";
        $lines[] = "'.' .";
        
        $lines[] = implode(" .\n",
                array_map(
                        create_function(
                                '$path',
                                'return "PATH_SEPARATOR . \'" . trim($path) . "\'";'),
                        $paths
                        )
                );
        /*
        foreach ( $paths as $path )
        {
                $lines[] = "PATH_SEPARATOR . " . "'" . trim($path) . "' .";
                
        }
        */
        $lines[] = ");";
        $lines[] = "";
        $lines[] = "?>";
        
        return join("\n", $lines);
}


function writeDbConfigIncFile ( $tmp, $dbms, $host, $port, $user, $pass, $db,
        $ftpHost, $ftpPort, $ftpUser, $ftpPass, $siteRootFtpPath )
{
        // Create db config file in /tmp or where ever it is on the system.
        $tmpFile = $tmp . '/' . 'db.config.inc.php';
        $fileContents = buildDbConfigIncFileString($dbms, $host, $port, $user, $pass, $db);
        $fh = fopen($tmpFile, 'w');
        fwrite($fh, $fileContents);
        fclose($fh);
        
        
        // Move the file via ftp into the correct dir
        $ftpLocalFile = $tmpFile;
        $ftpRemoteFile = $siteRootFtpPath .
                '/lib/include/db.config.inc.php';
        
        if ( !$ftpConn = ftp_connect($ftpHost, $ftpPort) )
        {
                return "Unable to open an ftp connection to " .
                        "host '" . $ftpHost . "' on port '" . $ftpPort . "'";
        }
        if ( !ftp_login($ftpConn, $ftpUser, $ftpPass) )
        {
                return "Unable to authenticate with ftp server using " .
                        "username '" . $ftpUser . "' and " .
                        "password '" . $ftpPass . "'";
        }
        if ( !ftp_put($ftpConn, $ftpRemoteFile, $ftpLocalFile, FTP_ASCII) )
        {
                return "Unable to ftp upload local file '" . $ftpLocalFile . "'" .
                        " to remote file '" . $ftpRemoteFile . "'";
        }
        if ( !ftp_close($ftpConn) )
        {
                return "Unable to close ftp connection";
        }
        
        
        // Delete tmp file
        unlink($tmpFile);
        
        return TRUE;
}


function buildDbConfigIncFileString ( $dbms, $host, $port, $user, $pass, $db )
{
        $lines = array();
        $lines[] = "<?php";
        $lines[] = "";
        $lines[] = "\$config =& \$GLOBALS['config'];";
        $lines[] = "";
        $lines[] = "\$config['db_dbms'] = '".$dbms."';";
        $lines[] = "\$config['db_host'] = '".$host."';";
        $lines[] = "\$config['db_port'] = '".$port."';";
        $lines[] = "\$config['db_username'] = '".$user."';";
        $lines[] = "\$config['db_password'] = '".$pass."';";
        $lines[] = "\$config['db_database'] = '".$db."';";
        $lines[] = "";
        $lines[] = "\$config['db_conn_str'] = \$config['db_dbms'] . '://' .";
        $lines[] = "\t\$config['db_host'] . '/' .";
        $lines[] = "\t\$config['db_database'] .";
        $lines[] = "\t'?username=' . \$config['db_username'] .";
        $lines[] = "\t'&password=' . \$config['db_password'];";
        $lines[] = "";
        $lines[] = "?>";
        
        return join("\n", $lines);
}


function testDatabaseCredentials ( $dbms, $host, $port, $user, $pass, $db )
{
        $connection = @mysql_connect("$host:$port", $user, $pass);
        if ( $connection === FALSE )
        {
                return mysql_error();
        }
        
        
        $res = @mysql_select_db($db, $connection);
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        return TRUE;
}


function installDatabaseTables ( $dbms, $dbhost, $dbport, $dbuser, $dbpass,
        $dbname, $sqlpath, $tables )
{
        $connection = mysql_connect("$dbhost:$dbport", $dbuser, $dbpass);
        if ( $connection === FALSE )
        {
                return mysql_error();
        }
        
        $res = mysql_select_db($dbname, $connection);
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        foreach ( $tables as $table )
        {
                $sqlfile = $sqlpath . '/' . $table . '.sql';
                if ( !file_exists($sqlfile))
                {
                        continue;
                }
                
                $sql = file_get_contents($sqlfile);
                if ( $sql === FALSE )
                {
                        return "Unable to open sql file '" . $sqlfile . "'";
                }
                
                $res = mysql_query($sql, $connection);
                if ( $res === FALSE )
                {
                        return mysql_error();
                }
        }
        
        return TRUE;
}


function installDatabaseTableContent ( $dbms, $dbhost, $dbport, $dbuser,
        $dbpass, $dbname, $sqlpath, $tables )
{
        $connection = @mysql_connect("$dbhost:$dbport", $dbuser, $dbpass);
        if ( $connection === FALSE )
        {
                return mysql_error();
        }
        
        
        $res = @mysql_select_db($dbname, $connection);
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        foreach ( $tables as $table )
        {
                $sqlfile = $sqlpath . '/' . $table . '.content.sql';
                if ( !file_exists($sqlfile))
                {
                        continue;
                }
                
                $sql = file_get_contents($sqlfile);
                if ( $sql === FALSE )
                {
                        return "Unable to open sql file '" . $sqlfile . "'";
                }
                
                $stmts = explode(";\n", $sql);
                foreach ( $stmts as $stmt )
                {
                        $stmt = trim($stmt);
                        if ( is_null($stmt) || $stmt == '' )
                        {
                                continue;
                        }
                        
                        $res = mysql_query($stmt, $connection);
                        if ( $res === FALSE )
                        {
                                return mysql_error();
                        }
                }
        }
        
        return TRUE;
}


function setConfigurationParameters ( $params )
{
        $connection = @mysql_connect($params['dbhost'].':'.$params['dbport'],
                $params['dbuser'], $params['dbpass']);
        if ( $connection === FALSE )
        {
                return mysql_error();
        }
        
        
        $res = @mysql_select_db($params['dbname'], $connection);
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        setConfigurationParamter('site_root_path',
                $params['siterootpath'],
                $connection);
        setConfigurationParamter('site_root_path',
                $params['siterootpath'],
                $connection);
        setConfigurationParamter('site_root_webpath',
                $params['siterootwebpath'],
                $connection);
        setConfigurationParamter('site_root_ftp_path',
                $params['siterootftppath'],
                $connection);
        setConfigurationParamter('ftp_server',
                $params['ftphost'],
                $connection);
        setConfigurationParamter('ftp_port',
                $params['ftpport'],
                $connection);
        setConfigurationParamter('ftp_username',
                $params['ftpuser'],
                $connection);
        setConfigurationParamter('ftp_password',
                $params['ftppass'],
                $connection);
        
        return TRUE;
}


function setConfigurationParamter ( $parameter, $value, $connection )
{
        $sql = sprintf("UPDATE configuration" .
                " SET parameter_value = '%s' WHERE parameter_name = '%s'",
                mysql_real_escape_string($value, $connection),
                mysql_real_escape_string($parameter, $connection));
        $res = mysql_query($sql, $connection);
        
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        return TRUE;
}


function installCMSAdministrator ( $params, $connection )
{
        $connection = @mysql_connect($params['dbhost'].':'.$params['dbport'],
                $params['dbuser'], $params['dbpass']);
        if ( $connection === FALSE )
        {
                return mysql_error();
        }
        
        $res = @mysql_select_db($params['dbname'], $connection);
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        
        // Create Admin user
        $sql = sprintf("INSERT INTO cms_user" .
                " (firstname, surname, email, username, password)" .
                " VALUES ('%s', '%s', '%s', '%s', '%s')",
                mysql_real_escape_string('Administrator', $connection),
                mysql_real_escape_string('Administrator', $connection),
                mysql_real_escape_string($params['adminemail'], $connection),
                mysql_real_escape_string('administrator', $connection),
                mysql_real_escape_string(md5($params['adminpass']),
                        $connection)
                );
        $res = mysql_query($connection, $sql);
        
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        $userId = mysql_insert_id($connection);
        
        
        // Create role and link to user
        $sql = sprintf("INSERT INTO cms_role" .
                " (name)" .
                " VALUES ('%s')",
                mysql_real_escape_string('administrator', $connection));
        $res = mysql_query($connection, $sql);
        
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        $roleId = mysql_insert_id($connection);
        
        $sql = sprintf("INSERT INTO cms_user_role_link" .
                " (user_id, role_id)" .
                " VALUES ('%s', '%s')",
                mysql_real_escape_string($userId, $connection),
                mysql_real_escape_string($roleId, $connection));
        $res = mysql_query($connection, $sql);
        
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        
        // Associate role with all privileges
        $sql = 'SELECT * FROM cms_capability';
        $res = mysql_query($connection, $sql);
        
        if ( $res === FALSE )
        {
                return mysql_error();
        }
        
        while ( ($row = mysql_fetch_assoc($res)) != NULL )
        {
                $capabilityId = $row['id'];
                $sql = sprintf("INSERT INTO cms_role_capability_link" .
                        " (role_id, capability_id)" .
                        " VALUES ('%s', '%s')",
                        mysql_real_escape_string($roleId, $connection),
                        mysql_real_escape_string($capabilityId, $connection));
                $res = mysql_query($connection, $sql);
                
                if ( $res === FALSE )
                {
                        return mysql_error();
                }
        }
        
        return TRUE;
}


?>
