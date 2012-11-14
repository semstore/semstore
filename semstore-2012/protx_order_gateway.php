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

SessionUtils::checkSession();

// Check that a crypt field was sent.
$crypt = RequestParameters::getParameter('crypt');

if ( is_null($crypt) || $crypt == '' )
{
        SiteUtils::redirect('index.php');
        exit();
}

// Prepare the VSPResponse helpers
$vspResponse =& new VSPFormResponse($crypt);
$vspResponse->setVenderPass(
        Configuration::getParameter('vsp_encryption_password'));


// Check that the decryption was successful
if  ( $vspResponse->decrypt() == 0 )
{
        die('bad crypt response');
}


// Update database
$txCode = $vspResponse->getVendorTxCode();

//print $txCode;
$PAYMENT_DO_CLASS =& new PaymentDataObject();
$payment =& $PAYMENT_DO_CLASS->lookup(
        array('vsp_vendor_tx_code' => $txCode),
        $GLOBALS['dbConnection']);
$payment->setVSPStatus($vspResponse->getStatus());
$payment->setVSPStatusDetails($vspResponse->getStatusDetails());
$payment->setVSPVPSTxId($vspResponse->getVpsTxId());
$payment->setVSPTxAuthNo($vspResponse->getTxAuthNo());
$payment->setVSPCV2($vspResponse->getCV2());
$payment->setVSPAddressResult($vspResponse->getAddressResult());
$payment->setVSPPostcodeResult($vspResponse->getPostcodeResult());
$payment->setVSPCV2Result($vspResponse->getCV2Result());
$payment->setVSPGiftAid($vspResponse->getGiftAid());
$payment->setVSP3DResult($vspResponse->getD3Result());
$payment->setVSPCAVV($vspResponse->getCAVV());
$payment->store($GLOBALS['dbConnection']);

$order =& $payment->lookupOrder();

if ( $vspResponse->getStatus() == 'OK')
{
        sendInternalOrderEmail($payment->getOrderId(), $GLOBALS['dbConnection']);
        sendCustomerOrderEmail($order, $GLOBALS['dbConnection']);
        SiteUtils::redirect('order_complete.php?orderid=' . $order->getId());
        exit();
}
else
{
        SiteUtils::redirect('order_failure.php?orderid=' . $order->getId());
        exit();
}

exit();

function sendInternalOrderEmail ( $orderId, &$connection )
{
        $PORDER_CLASS =& new ProductOrderDataObject();
        
        $order =& $PORDER_CLASS->lookup(
                array('id' => $orderId),
                $connection
                );
        $payment =& $order->lookupPayment();
        
        $email =& prepareInternalOrderEmail($order, $payment);
        
        $mailer =& new MailWrapper();
        $mailer->autoconfigure($GLOBALS['configuration']);
        
        $headers = array(
                'From' => 'orders@justecommerce.co.uk',
                'Subject' => 'JusteCommerce Web Order'
                );
                
                
        $mailer->send(array(
                        'To' => 'simoncadman@semsolutions.co.uk'
                        ),
                $headers,
                $email
                );
         
}


function prepareInternalOrderEmail ( &$order, &$payment )
{
        $email = "JusteCommerce Order\n";
        
        $email .= "\n\n----- Name -----\n";
        $email .= $order->getDeliveryFirstname() . " " .
                $order->getDeliverySurname() . "\n";
        $email .= $payment->getVSPCustomerEmail() . "\n";
        
        $email .= "\n\n----- Contact Number -----\n";
        $email .= $order->getContactNumber() . "\n";
        
        $email .= "\n\n----- Order -----\n";
        
        $email .= 'Heard of JusteCommerce from: '.$order->getHeardOfSite();
        $email .= "\n";
        
        /*
        foreach ( $order->lookupOrderLines() as $orderLine )
        {
                $email .= $orderLine->getQuantity() . " x ";
                $email .= $orderLine->getProductName() . "\n";
        }
        */
        
        $carriageLine = NULL;
        foreach ( $order->lookupOrderLines() as $orderLine )
        {
                if ( $orderLine->getProductName() != 'Carriage Charge' )
                {
                        $product =& $orderLine->lookupProduct();
                        
                        $email .= "\n";
                        $email .= "------------------------------------------------------------------------------------------------------------------\n";
                        $email .= "\n";
                        $email .= "Item: " . $orderLine->getProductName() . "\n";
                        $email .= "Price per Item (ex VAT): £" . $orderLine->formattedPriceExVat() . "\n";
                        $email .= "Quantity: " . $orderLine->quantity() . "\n";
                        $email .= "Line Total (ex VAT): £" . $orderLine->formattedLineTotalExVat() . "\n";
                }
                else
                {
                        $carriageLine = $orderLine;
                }
        }
        
        
        $email .= "\n";
        $email .= "------------------------------------------------------------------------------------------------------------------\n";
        $email .= "\n";
        $email .= "Subtotal (ex VAT): £" . $order->formattedSubtotalExVat() . "\n";
        
        if ( is_object($carriageLine) )
        {
                $email .= "Carriage: £" .
                        $carriageLine->formattedPriceExVat() . "\n";
        }
        
        $email .= "VAT: £" . $order->formattedVat() . "\n";
        $email .= "\n";
        $email .= "------------------------------------------------------------------------------------------------------------------\n";
        $email .= "\n";
        $email .= "TOTAL COST: £" . $order->formattedTotal() . "\n";
        $email .= "------------------------------------------------------------------------------------------------------------------\n";
        
        
        $email .= "\n\n----- Delivery Address -----\n";
        $email .= $order->getDeliveryBusiness() . "\n";
        $email .= $order->getDeliveryBuilding() . "\n";
        $email .= $order->getDeliveryNumber() . " " .
                $order->getDeliveryAddress1() . "\n";
        $email .= $order->getDeliveryAddress2() . "\n";
        $email .= $order->getDeliveryCity() . "\n";
        $email .= $order->getDeliveryCounty() . "\n";
        $email .= $order->getDeliveryPostcode() . "\n";
        
        if ( $order->getDeliveryDate() != NULL &&
                $order->getDeliveryDate() != '' )
        {
                $email .= "\n\n----- Delivery Date -----\n";
                $email .= formatDeliveryDate(
                        $order->getDeliveryDate()) . "\n";
        }
        
        return $email;
}


function sendCustomerOrderEmail ( &$order, &$connection )
{
        //$customer =& $order->lookupCustomer();
        $payment =& $order->lookupPayment();
        
        $email =& prepareCustomerOrderEmail($order, $payment);
        
        $mailer =& new MailWrapper();
        $mailer->autoconfigure($GLOBALS['configuration']);
        
        $headers = array(
                'From' => 'orders@justecommerce.co.uk',
                'Subject' => 'JusteCommerce.co.uk Web Order'
                );
        
        $mailer->send(array(
                        'To' => $payment->getVSPCustomerEmail()
                        ),
                $headers,
                $email
                );
}


function prepareCustomerOrderEmail ( &$order, &$payment )
{
        $carriageLine = NULL;
        
        $text = array();
        
        $text[] = 'Thank you for your order from JusteCommerce.co.uk.';
        $text[] = '';
        $text[] = 'ORDER DETAILS';
        $text[] = 'Set out below are the details of your order:';
        foreach ( $order->lookupOrderLines() as $orderLine )
        {
                if ( $orderLine->getProductName() != 'Carriage Charge' )
                {
                        $text[] = '';
                        $text[] = '------------------------------------------------------------------------------------------------------------------';
                        $text[] = '';
                        $text[] = 'Item: ' . $orderLine->getProductName();
                        $text[] = 'Price per Item (ex VAT): £' . $orderLine->formattedPriceExVat();
                        $text[] = 'Quantity: ' . $orderLine->quantity();
                        $text[] = 'Line Total (ex VAT): £' . $orderLine->formattedLineTotalExVat();
                }
                else
                {
                        $carriageLine = $orderLine;
                }
        }
        
        
        $text[] = '';
        $text[] = '------------------------------------------------------------------------------------------------------------------';
        $text[] = '';
        $text[] = 'Subtotal (ex VAT): £' . $order->formattedSubtotalExVat();
        
        if ( is_object($carriageLine) )
        {
                $text[] = 'Carriage: £' .
                        $carriageLine->formattedPriceExVat();
        }
        
        $text[] = 'VAT: £' . $order->formattedVat();
        $text[] = '';
        $text[] = '------------------------------------------------------------------------------------------------------------------';
        $text[] = '';
        $text[] = 'TOTAL COST: £' . $order->formattedTotal();
        $text[] = '------------------------------------------------------------------------------------------------------------------';
        
        $text[] = '';
        $text[] = '';
        
        $text[] = 'DELIVERY DETAILS';
        $text[] = 'Your specified delivery details are as follows:';
        $text[] = '';
        $text[] = $order->getDeliveryFirstname() . ' ' .
                $order->getDeliverySurname();
        $text[] = $order->getDeliveryAddress1();
        if ( $order->getDeliveryAddress2() != '' )
        {
                $text[] = $order->getDeliveryAddress2();
        }
        $text[] = $order->getDeliveryCity();
        $text[] = $order->getDeliveryCounty();
        $text[] = $order->getDeliveryPostcode();
        $text[] = '';
        
        if ( $order->getDeliveryDate() != NULL &&
                $order->getDeliveryDate() != '' )
        {
                $text[] = 'DELIVERY DATE';
                $text[] = formatDeliveryDate($order->getDeliveryDate());
                
                $text[] = '';
                $text[] = '';
        }
        
        $text[] = 'QUESTIONS';
        $text[] = 'If you have any questions regarding your order, please contact us at assistance@justecommerce.co.uk';
        
        $text[] = '';
        $text[] = '';
        $text[] = '';
        $text[] = 'Once again, we thank you for your order.';
        
        $text[] = '';
        $text[] = '';
        $text[] = '';
        $text[] = 'Kind Regards';
        $text[] = '';
        $text[] = 'The JusteCommerce Team';
        $text[] = 'www.justecommerce.co.uk';
        $text[] = 'assistance@justecommerce.co.uk';
        $text[] = '';
        
        return join("\n", $text);
}

function formatDeliveryDate ( $humandate )
{
        $currentTZ = getenv('TZ');
        putenv('TZ=Europe/London');
        
        $formatted = date('l jS F', strtotime($humandate));
        putenv('TZ='.$currentTZ);
        
        return $formatted;
}


?>
