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
require_once('Net/Ftp.class.php');

$sourceFile = '/home/httpd/vhosts/drain-systems.co.uk/httpdocs/utils/ftp_test_source/source.txt';
$destFile = '/httpdocs/utils/ftp_test_destination/';

$ftp =& new Ftp('localhost', 'water', 'b0ath0u53');
$ftp->connect();
$ftp->put($sourceFile, $destFile, FTP_BINARY);

//Out::writeOut($template->render());
Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
