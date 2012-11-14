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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveProductFileWeblet.class.php');

Session::start();

$fileid = RequestParameters::getParameter('fileid');

$weblet =& new RemoveProductFileWeblet();
$weblet->autoconfigure($GLOBALS['configuration']);
$weblet->setConnection($GLOBALS['dbConnection']);
$weblet->setFileId($fileid);
$weblet->run();

//Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
