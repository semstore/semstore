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
require_once('HTTP/RequestParameters.class.php');
require_once('ProtX/VSPFormResponse.class.php');
require_once('Mail/MailWrapper.class.php');
require_once('Sites/SemStore/SessionUtils.class.php');
/*
require_once('Sites/SPT/DataObjects/ProductOrderDataObject.class.php');
require_once('Sites/SPT/DataObjects/ProductOrderLineDataObject.class.php');
require_once('Sites/SPT/DataObjects/PaymentDataObject.class.php');
*/
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrder.class.php');
require_once('SEM/CMS/Modules/eComStore/Payment.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentType.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentTypeAttributeLinkDataObject.class.php');
require_once('Sites/SemStore/OrderEmails.class.php');

Session::start();
SessionUtils::checkSession();
 
$logfh = fopen(
        Configuration::getParameter('site_root_path') .
        '/ipnlogs/log-'.time().'.txt',
        'w+');
fwrite($logfh, 'Logging started on ' . date('jS M Y at H:i:s') . "\n\n");
fwrite($logfh, '$_REQUEST = ' . print_r($_REQUEST, TRUE) . "\n\n");

//read the post from paypal and add cmd
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

//echo $req.'<br>';

$mode = Configuration::getParameter('paypal_mode');

if ( $mode != 'test' && $mode != 'live')
{	
	die('invalid paypal_mode set! use "test" or "live", not '.$mode);
        fwrite($logfh, 'invalid paypal_mode set! use "test" or "live", not '.
                $mode . "\n");
}

$paypal_validate_URL = Configuration::getParameter('paypal_'.$mode.'_validate_url');

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ($paypal_validate_URL, 80, $errno, $errstr, 30);

$success = false;
$reason = "";

if (!$fp) {
       // HTTP ERROR, log
       $reason = "Paypal appears to be down; Could not verify payment was made.";
       fwrite($logfh, 'Paypal appears to be down; Could not verify payment was made ' . "\n");
       
} else {
       
       //connected, validate item
       fputs ($fp, $header . $req);
       
       while (!feof($fp)) {
              $res = fgets ($fp, 1024);
              
              if (strcmp ($res, "VERIFIED") == 0) 
              {
                     $success = true;
              }
              
       }
       fwrite($logfh, "Sent Paypal 'VERFIED'\n");
}


if ( strtolower($_REQUEST['receiver_email']) !=  strtolower(Configuration::getParameter('paypal_'.$mode.'_address')) )
{
       //paypal account being paid to isnt this one!
       $success = false;
       $reason = "The address being paid to was incorrect; I was expecting ".Configuration::getParameter('paypal_'.$mode.'_address')." and was told ".$_REQUEST['receiver_email'];
}


$payment =& Payment::findfirst(
        sprintf(
                'FROM payment, payment_type_attribute_link, payment_type_attribute, payment_type_attribute_group ' .
                'WHERE payment.id = payment_type_attribute_link.payment_id ' .
                'AND payment_type_attribute_link.attribute_id = payment_type_attribute.id ' .
                'AND payment_type_attribute.group_id = payment_type_attribute_group.id ' .
                "AND payment_type_attribute_group.type_id = '%s' " .
                "AND payment_type_attribute.name = '%s' " .
                "AND payment_type_attribute_link.value = '%s' ",
                $GLOBALS['dbConnection']->escapeString(3),
                'Invoice',
                $GLOBALS['dbConnection']->escapeString($_REQUEST['invoice'])),
        $GLOBALS['dbConnection']);
fwrite($logfh, '$payment = ' . print_r($payment, TRUE) . "\n\n");
if ( is_null($payment) )
{
        fwrite($logfh, "Could not find payment in DB!\n");
        fclose($logfh);
        exit();
}

$payment->setAttributeValue('Txn ID', $_REQUEST['txn_id']);
$payment->setAttributeValue('Address Name', $_REQUEST['address_name']);
$payment->setAttributeValue('Address Street', $_REQUEST['address_street']);
$payment->setAttributeValue('Address City', $_REQUEST['address_city']);
$payment->setAttributeValue('Address State', $_REQUEST['address_state']);
$payment->setAttributeValue('Address Country', $_REQUEST['address_country']);
$payment->setAttributeValue('Address Country Code', $_REQUEST['address_country_code']);
$payment->setAttributeValue('Address Postcode', $_REQUEST['address_zip']);
$payment->setAttributeValue('Address Status', $_REQUEST['address_status']);
$payment->setAttributeValue('Firstname', $_REQUEST['firstname']);
$payment->setAttributeValue('Surname', $_REQUEST['surname']);
$payment->setAttributeValue('Payer Business Name', $_REQUEST['payer_business_name']);
$payment->setAttributeValue('Payer Email', $_REQUEST['payer_email']);
$payment->setAttributeValue('Payer ID', $_REQUEST['payer_id']);
$payment->setAttributeValue('Payer Status', $_REQUEST['payer_status']);
$payment->setAttributeValue('Residence Country', $_REQUEST['residence_country']);
$payment->setAttributeValue('Quantity', $_REQUEST['mc_gross']*100);

$order =& ProductOrder::findFirst(
              array('id' => $payment->getOrderId()),
              $GLOBALS['dbConnection']);
fwrite($logfh, '$order = ' . print_r($order, TRUE) . "\n\n");

if ( !is_null($order) )
{
       
       if ( round($order->calculateTotal()/100) != $_REQUEST['mc_gross'] )
       {
              //payment amounts differ!
              $success = false;
              $reason = "The payment amounts differed; I was expecting &pound;".($order->calculateTotal()/100)." and receieved &pound;".$_REQUEST['mc_gross'];
       }

}
else
{
       $success = false;
       $reason = "The order specified was not found!";
}

$payment->setAttributeValue('Status', $success==true ? "OK" : "FAILED" );
$payment->setAttributeValue('Status Details',$reason );

if ( is_null($order) )
{
        fwrite($logfh, "Could not find order in DB!\n");
        fclose($logfh);
        exit();
}

$success = true;
if ( $success === true )
{
        fwrite($logfh, 'Sending out email on ' . date('jS M Y at H:i:s') . "\n\n");
        //verified as valid order
        OrderEmails::sendAllEmails($payment, $order);
}
else
{      
        //not a valid order
        if ( !is_null($order) )
        {
          fwrite($logfh, 'Not sending out email on ' . date('jS M Y at H:i:s') . "\n\n");
        }
}


fwrite($logfh, 'Logging finished on ' . date('jS M Y at H:i:s') . "\n\n");
fclose($logfh);

exit();




?>