<?php

/**
 *
 * Load my super special error handler
 *
 */
//require_once('include/bugmaster.inc.php');
//error_reporting(0);
//set_error_handler('bugmasterErrorHandler');


/**
 *
 * Load the configuration file for the database.
 * This is required so that we can access the main configuration
 * store (ie the DB)
 *
 */
require_once('include/db.config.inc.php');


/**
 *
 * Lets include the standard class definitions
 *
 */
#require_once('include/classes.inc.php');


/**
 *
 * Lets include the custom class definitions
 *
 */
//require_once('include/classes_custom.inc.php');


/**
 *
 * Build the default connection to the database.
 *
 */
require_once('Database/Interface/DBConnection.class.php');
require_once('Database/Interface/DBRowSet.class.php');
require_once('Database/Interface/MySQL/MySQLDBConnection.class.php');
require_once('Database/Interface/MySQL/MySQLRowSet.class.php');

$dbConnection =& DBConnection::create($GLOBALS['config']['db_conn_str']);
$GLOBALS['dbConnection'] =& $dbConnection;
//$GLOBALS['configuration'] =& new DBConfiguration($GLOBALS['dbConnection']);

/**
 *
 * Initialise Configuration Object
 *
 */
require_once('Configuration/Configuration.class.php');
require_once('Configuration/DBConfiguration.class.php');

$GLOBALS['configuration'] =& new DBConfiguration($GLOBALS['dbConnection']);

/**
 *
 * Initialize the Output streams
 *
 */
require_once('Out.class.php');
require_once('Debug.class.php');
require_once('IO/BufferedOutputStream.class.php');
require_once('IO/HTMLDebugStream.class.php');

$GLOBALS['outputStream'] = new BufferedOutputStream();
//$GLOBALS['debugStream'] = new HTMLDebugStream(DebugLevel::DEBUG());
$debugLevel = Configuration::getParameter('debug_level');

/*
if ( is_a($debugLevel, 'DBError') || 
        is_subclass_of($debugLevel, 'DBError') )
{
        die("An error occured while trying to prepare the runtime environment."
         . "  There error was: " . $debugLevel->getMessage());
}*/

if ( !is_numeric($debugLevel) )
{
        $debugLevel = DebugLevel::OFF();
}
//$GLOBALS['debugStream'] = new DebugStream($debugLevel);
$GLOBALS['debugStream'] = new HTMLDebugStream($debugLevel);

/**
 *
 * Initialize the Session Manager
 *
 */
require_once('Session/Session.class.php');
require_once('Session/SessionManager.class.php');
require_once('Session/PHPSessionManager.class.php');
if ( !is_null($_COOKIE['PHPSESSID']) && $_COOKIE['PHPSESSID'] != '' )
{
        $GLOBALS['session'] = new PHPSessionManager($_COOKIE['PHPSESSID']);
        //$GLOBALS['session']->start();
}
else
{
        $GLOBALS['session'] = new PHPSessionManager();
        //$GLOBALS['session']->start();
}

?>
