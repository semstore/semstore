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
require_once('Sites/SemStore/SessionUtils.class.php');
require_once('Sites/SemStore/Weblets/CustomerLoginWeblet.class.php');

Session::start();
SessionUtils::checkSession();

$weblet =& new CustomerLoginWeblet(Configuration::getInstance());
$weblet->setConnection($GLOBALS['dbConnection']);
$weblet->run();

Out::flush();
Debug::flush();

exit();

?>
