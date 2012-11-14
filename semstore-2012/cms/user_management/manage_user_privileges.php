<?php

/*** Set the path to our code library :: Start ***/
$includePathFileFound = FALSE;
for ( $i = 0; $i < 20 && !$includePathFileFound; $i++ )
{
        if ( is_file('./lib/include/include_path.inc.php') )
        {
                require('./lib/include/include_path.inc.php');
                $includePathFileFound = TRUE;
        }
        else
        {
                $dir = getcwd();
                chdir('..');
                if ( $dir == getcwd() )
                {
                        die('Could not set the include path.');
                }
        }
}
if ( !$includePathFileFound )
{
        die('Could not set the include path.');
}
/*** Set the path to our code library :: End ***/

require('envprep.inc.php');
require_once('HTTP/RequestParameters.class.php');
require_once('Web/Site/SiteUtils.class.php');
require_once('SEM/CMS/CMSUtils.class.php');
require_once('SEM/CMS/CMSUser.class.php');
require_once('SEM/CMS/Weblets/ManageUserPrivilegesWeblet.class.php');

Session::start();
CMSUtils::checkSession();


$configuration =& Configuration::getInstance();
if ( !CMSUtils::isLoggedIn() )
{
        SiteUtils::redirect(
                $configuration->getParameter('cms_root_webpath') .
                '/login.php');
        exit();
}

$loggedInUser =& CMSUtils::getLoggedInCMSUser($GLOBALS['dbConnection']);
if ( !$loggedInUser->hasCapability('CMS_URM_MANAGE_USERS') )
{
        SiteUtils::redirect(
                $configuration->getParameter('cms_root_webpath') .
                '/access_denied.php');
        exit();
}


$userId = RequestParameters::getParameter('uid');

$weblet =& new ManageUserPrivilegesWeblet();
$weblet->autoconfigure($GLOBALS['configuration']);
$weblet->setConnection($GLOBALS['dbConnection']);
$weblet->setUserId($userId);
$weblet->run();

//Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
