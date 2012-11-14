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
require_once('SEM/eComStore/SessionUtils.class.php');
require_once('Web/Site/SiteUtils.class.php');
require_once('Sites/SemStore/Weblets/CustomerMyAccount.class.php');

Session::start();
SessionUtils::checkSession();

if ( SessionUtils::isLoggedIn() )
{
        $weblet =& new CustomerMyAccountWeblet(Configuration::getInstance());
        $weblet->setConnection($GLOBALS['dbConnection']);
        $weblet->run();
}
else
{
        SiteUtils::redirect('index.php');
}

Out::flush();
Debug::flush();

exit();

?>
