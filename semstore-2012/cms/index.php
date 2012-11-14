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
require_once('Web/Site/SiteUtils.class.php');
require_once('SEM/CMS/CMSUtils.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');

Session::start();
CMSUtils::checkSession();
$configuration = Configuration::getInstance();
/*
if ( !CMSUtils::isLoggedIn() )
{
        SiteUtils::redirect(
                $configuration->getParameter('cms_root_webpath') .
                '/login.php');
        exit();
}
*/

$template =& new CMSTemplate('index.tpl');
$template->autoconfigure($GLOBALS['configuration']);

Out::writeOut($template->render());
Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
