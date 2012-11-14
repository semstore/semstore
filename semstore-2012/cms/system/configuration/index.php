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
require_once('SEM/CMS/Templates/CMSTemplate.class.php');

Session::start();

$template =& new CMSTemplate('system/configuration/index.tpl');
$template->autoconfigure($GLOBALS['configuration']);

$breadcrumb = array(
        array(
                'name' => 'Home',
                'url' => Configuration::getParameter('cms_root_webpath') .
                        '/'
                )
        );
$template->assign('breadcrumb', $breadcrumb);


$res =& $GLOBALS['dbConnection']->select(
        'SELECT configuration.* ' .
        'FROM configuration, configuration_group ' .
        'WHERE configuration.group_id = configuration_group.id ' .
        'AND configuration_group.name = \'SEM Content Management System\' ' .
        'ORDER BY parameter_name' );
if ( DBConnection::isError($res) )
{
        print $res->getMessage();
}
elseif ( Error::isError($res) )
{
        print $res->getMessage();
}
else
{
        $params = array();
        while ( $res->next() )
        {
                $row =& $res->getRowHash();
                $params[] = array('param' => $row['parameter_name'],
                        'value' => $row['parameter_value'] );
        }
        $template->assign('parameters', $params);
}


//Out::writeOut('Nothing here yet!');
Out::writeOut($template->render());
Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
