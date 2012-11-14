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
require_once('Utils/ObjectArrayIterator.class.php');
require_once('SEM/CMS/CMSUser.class.php');
require_once('SEM/CMS/CMSRole.class.php');
require_once('SEM/CMS/CMSCapability.class.php');
require_once('SEM/CMS/CMSCapabilityGroup.class.php');


$user =& CMSUser::findFirst(
        array('username' => 'adam'),
        $GLOBALS['dbConnection']);
Out::writeOut($user->getEmail()."\n");

$role =& $user->getRole();
Out::writeOut($role->getName()."\n");

$capabilities =& $user->getCapabilities();
$iterator =& new ObjectArrayIterator($capabilities);
while ( $iterator->hasNext() )
{
        $capability =& $iterator->next();
        Out::writeOut($capability->getName()."\n");
}


Out::writeOut('Has access to eComStore module? ' .
        ( $user->hasCapability('ECOMSTORE_ACCESS') ? 'Yes' : 'No'));


Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
