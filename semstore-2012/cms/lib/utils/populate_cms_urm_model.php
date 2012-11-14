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
require_once('SEM/CMS/CMSUser.class.php');
require_once('SEM/CMS/CMSRole.class.php');
require_once('SEM/CMS/CMSCapability.class.php');
require_once('SEM/CMS/CMSCapabilityGroup.class.php');


// Create Capability Groups and Capabilities
$capabilityGroups =
        array(
                'CMS' => array(
                        'LOGIN'
                        ),
                'eComStore' => array(
                        'ECOMSTORE_ACCESS'
                        )
        );

foreach ( $capabilityGroups as $capabilityGroupName => $capabilities )
{
        $groupObj =& new CMSCapabilityGroup();
        $groupObj->setName($capabilityGroupName);
        $groupObj->setConnection($GLOBALS['dbConnection']);
        $groupObj->commit();
        foreach ( $capabilities as $capabilityName )
        {
                $capabilityObj =& new CMSCapability();
                $capabilityObj->setName($capabilityName);
                $capabilityObj->setConnection($GLOBALS['dbConnection']);
                $capabilityObj->commit();
                
                $groupObj->addCapability($capabilityObj);
        }
        //$groupObj->commit();
}


Out::writeOut('');
Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
