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
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('Sites/SemStore/SessionUtils.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');


Session::start();
SessionUtils::checkSession();

$template =& new JusteCommerce3ColumnTemplate(
        Configuration::getInstance(),
        $GLOBALS['dbConnection'], 'index.tpl');
if ( SessionUtils::isLoggedIn() )
{
        $template->assign('customername', Session::get('customername'));
		$template->assign('loggedIn', 'y');	
}
elseif ( !empty($_COOKIE['customername']) && $_COOKIE['customername'] == '' )
{
        $template->assign('customername', $_COOKIE['customername']);
}
elseif ( Configuration::getParameter('store_name') != '' )
{
        $template->assign('storename',
                Configuration::getParameter('store_name'));
}

Out::writeOut($template->render());
Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));

Out::flush();
Debug::flush();

?>
