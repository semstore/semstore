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
require_once('Sites/SemStore/SessionUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');

require_once('Sites/SemStore/eComBasket.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');

Session::start();

SessionUtils::checkSession();


$orderId = RequestParameters::getParameter('orderid');
$ORDER_CLASS =& new ProductOrderDataObject();
$order =& $ORDER_CLASS->lookup(
        array('id' => $orderId),
        $GLOBALS['dbConnection'] );
if ( !is_object($order) )
{
        SiteUtils::redirect('index.php');
        exit();
}


$basket =& eComBasket::getInstance();
$basket->emptyBasket();

// Display the success page.
$template =& new JusteCommerce3ColumnTemplate(
        Configuration::getInstance(),
        $GLOBALS['dbConnection'], 'orders/order_failure.tpl');

Out::writeOut($template->render());

Out::flush();
Debug::flush();

?>
