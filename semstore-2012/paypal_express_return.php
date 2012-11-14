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
require_once('Sites/SemStore/JusteCommerceUtils.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentDataObject.class.php');

require_once('PayPal/PaypalSOAP.class.php');
SessionUtils::checkSession();

// Check that a crypt field was sent.
$token = RequestParameters::getParameter('token');
$payerId = RequestParameters::getParameter('PayerID');

if ( is_null($token) || $token == '' || is_null($payerId) || $payerId == '' )
{
        SiteUtils::redirect('index.php');
        exit();
}

//ok, lets get us some details from Paypal!
$response = PaypalSOAP::getExpressCheckoutDetails($token);


$details = $response->getGetExpressCheckoutDetailsResponseDetails();

$payer_info = $details->getPayerInfo();
$payer_id = $payer_info->getPayerID();

$address = $payer_info->getAddress();
$street1 = $address->getStreet1();
$street2 = $address->getStreet2();
$city_name = $address->getCityName();
$state_province = $address->getStateOrProvince();
$postal_code = $address->getPostalCode();
$country_code = $address->getCountryName();

$order_total = $currencyCodeType.' '.$paymentAmount;



?>
