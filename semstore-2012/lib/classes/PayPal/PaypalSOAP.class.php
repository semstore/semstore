<?php

/**
 *  @author Simon Cadman (simoncadman@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2008-01-16
 */
require_once('PayPal.php');
require_once 'PayPal/Profile/Handler/Array.php';
require_once 'PayPal/Profile/API.php';
require_once('PayPal/Profile/Handler/Array.php');

class PaypalSOAP extends SEMObject
{
        function getCaller ( )
        {
              
              $mode = Configuration::getParameter('paypal_mode');
              $api_username = Configuration::getParameter('paypal_api_username_'.$mode);
              $api_password = Configuration::getParameter('paypal_api_password_'.$mode);
              $api_cert = Configuration::getParameter('paypal_api_certificate_'.$mode);
              
              
              if ( $mode == 'test' )
              {
                     $environment = "sandbox";
              }
              else
              {
                     $environment = 'live';
              }
              
                 $handler = & ProfileHandler_Array::getInstance(array(
                   'username' => $api_username,
                   'password' => $api_password,
                   'certificateFile' => $api_cert,
                   'subject' => null,
                   'environment' => $environment ));
                 
                 
                 $pid = ProfileHandler::generateID();
                 $profile = & new APIProfile($pid, $handler);
                 $profile->_username = $api_username;
                 $profile->_password = $api_password;
                 $profile->_signature = $api_cert;
                 $profile->_environment = $environment;
                 
                 
                 
                 $caller =& PayPal::getCallerServices($profile);
              
                 return $caller;
              
              
        }

        function setExpressCheckout ( $basket )
        {
              //these paths are not dependant upon the mode of paypal!
              $returnURL = Configuration::getParameter('paypal_express_returnurl');
              $cancelURL = Configuration::getParameter('paypal_express_cancelurl');
              
              $paymentType = "Sale";
              $currencyCodeType = 'GBP';
              
              
                 $paymentAmount=($basket->total()/100);
                 
                 $ec_request =& PayPal::getType('SetExpressCheckoutRequestType');
                 
                 $ec_details =& PayPal::getType('SetExpressCheckoutRequestDetailsType');
                 $ec_details->setReturnURL($returnURL);
                 $ec_details->setCancelURL($cancelURL);
                 $ec_details->setPaymentAction($paymentType);
                  
                 $amt_type =& PayPal::getType('BasicAmountType');
                 $amt_type->setattr('currencyID', $currencyCodeType);
                 $amt_type->setval($paymentAmount, 'iso-8859-1');  
                 $ec_details->setOrderTotal($amt_type);
                 
                 $ec_request->setSetExpressCheckoutRequestDetails($ec_details);
                 
                 $caller = PaypalSOAP::getCaller();
                 
                 
                 // Execute SOAP request
                 $response = $caller->SetExpressCheckout($ec_request);
                 
                 
                     //it worked! We have a token!
                     return $response;
        }
        
        
        function getExpressCheckoutDetails ( $token )
        {
                 
                 $ec_request =& PayPal::getType('GetExpressCheckoutDetailsRequestType');
                 //$ec_request->setButtonSource("SemSolutions_ShoppingCart_EC");
                 $ec_request->setToken($token);
                 
                 $caller = PaypalSOAP::getCaller();
                 
                 // Execute SOAP request
                 $response = $caller->GetExpressCheckoutDetails($ec_request);
                 
                 return $response;
        }
        
        /*
         DoDirectPayment is derivative of OpenAvanti, http://code.google.com/p/openavanti/source/browse/branches/paypal/class.paypalapipayment.php?r=92:
        
        
         Copyright (c) 2008 Kristopher Wilson
          
          Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
          
          The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
          
          THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
        
        
        
        */
        
        
        function DoDirectPayment ( $paymentaction, $ipaddress, $total, $startdate, $expirydate, $billingfirstname, $billingsurname, $billingstreet1, $billingstreet2, $billingcity, $billingcounty, $billingcountry, $billingpostcode, $currency, $deliveryfirstname, $deliverysurname, $deliverystreet1, $deliverystreet2, $deliverycityname, $deliverystate, $deliverycountry,  $deliverypostcode, $email, $deliveryphone, $cardtype, $cardnumber, $cardstartmonth, $cardstartyear, $cardexpirymonth, $cardexpiryyear, $cardcvv2 )
        {
               $oDirectPaymentRequest =& PayPal::getType( "DoDirectPaymentRequestType" );


               
               
               $oTotal =& PayPal::getType( "BasicAmountType" );
               $oTotal->setattr( "currencyID", $currency );
               $oTotal->setval( $total, "iso-8859-1" );
               
               
                        
               $oShipTo =& PayPal::getType( "AddressType" );
               
               $oShipTo->setName( $deliveryfirstname . " " . $deliverysurname );
               $oShipTo->setStreet1( $deliverystreet1 );
               $oShipTo->setStreet2( $deliverystreet2 );
               $oShipTo->setCityName( $deliverycityname );
               $oShipTo->setStateOrProvince( $deliverystate );
               $oShipTo->setCountry( $deliverycountry ); 
               $oShipTo->setPostalCode( $deliverypostcode );
               $oShipTo->setPhone( $deliveryphone );
               
               $oBilling =& PayPal::getType( "AddressType" );
               
               $oBilling->setName( $billingfirstname . " " . $billingsurname );
               $oBilling->setStreet1( $billingstreet1 );
               $oBilling->setStreet2( $deliverystreet2 );
               $oBilling->setCityName( $billingcity );
               $oBilling->setStateOrProvince( $billingcounty );
               $oBilling->setCountry( $billingcountry ); 
               $oBilling->setPostalCode( $billingpostcode );
               
               
               $oPerson =& PayPal::getType( "PersonNameType" );
               $oPerson->setFirstName( $deliveryfirstname );
               $oPerson->setLastName( $deliverysurname );

               
               $oPayer =& PayPal::getType( "PayerInfoType" );
               $oPayer->setPayerName( $oPerson );
               $oPayer->setPayer( $email );
               $oPayer->setContactPhone( $deliveryphone );
               $oPayer->setAddress($oBilling);
               
               
               $oCard =& PayPal::getType( "CreditCardDetailsType" );
               $oCard->setCreditCardType( $cardtype );
               $oCard->setCreditCardNumber( $cardnumber );
               $oCard->setStartMonth( $cardstartmonth );
               $oCard->setStartYear( $cardstartyear );
               $oCard->setExpMonth( $cardexpirymonth );
               $oCard->setExpYear( $cardexpiryyear );
               $oCard->setCVV2( $cardcvv2 );
               $oCard->setCardOwner( $oPayer );

     
               $oPaymentDetails =& PayPal::getType( "PaymentDetailsType" );
               $oPaymentDetails->setOrderTotal( $oTotal );
               $oPaymentDetails->setShipToAddress( $oShipTo );
               $oPaymentDetails->setButtonSource("SemSolutions_ShoppingCart_DP");
               
               $oDirectPaymentDetails =& PayPal::getType( "DoDirectPaymentRequestDetailsType" );
               $oDirectPaymentDetails->setPaymentDetails( $oPaymentDetails );
               $oDirectPaymentDetails->setCreditCard( $oCard );
               $oDirectPaymentDetails->setButtonSource("SemSolutions_ShoppingCart_DP");
               
               $oDirectPaymentDetails->setIPAddress( $ipaddress );
               $oDirectPaymentDetails->setPaymentAction( $paymentaction );
               
               $oDirectPaymentRequest->setDoDirectPaymentRequestDetails( $oDirectPaymentDetails );
               
               
               $caller = PaypalSOAP::getCaller();
               
               
               
               $result = $caller->DoDirectPayment($oDirectPaymentRequest);
               
               return $result;
        }
        
        /*
               End of DoDirectPayment and MIT license-covered code
        
        */
        
        function DoExpressCheckoutPayment ( $payment, $order )
        {
                 
                 $token = $payment->getAttributeValue('Token');
                 $payerId = $payment->getAttributeValue('PayerId');
                 $paymentType = "Sale";
                 $currencyCodeType = 'GBP';
                 $paymentAmount = ($order->total()/100);
                 
                 $ec_details =& PayPal::getType('DoExpressCheckoutPaymentRequestDetailsType');
                     
                 $ec_details->setToken($token);
                 $ec_details->setPayerID($payerId);
                 $ec_details->setPaymentAction($paymentType);
                 
                 $amt_type =& PayPal::getType('BasicAmountType');
                 $amt_type->setattr('currencyID', $currencyCodeType);
                 $amt_type->setval($paymentAmount, 'iso-8859-1');  
                 
                 $payment_details =& PayPal::getType('PaymentDetailsType');
                 $payment_details->setOrderTotal($amt_type);
                 $payment_details->setButtonSource("SemSolutions_ShoppingCart_EC");
                 
                 $ec_details->setPaymentDetails($payment_details);
                 
                 
                 
                 $ec_request =& PayPal::getType('DoExpressCheckoutPaymentRequestType');
                 $ec_request->setDoExpressCheckoutPaymentRequestDetails($ec_details);
                     
                 $caller = PaypalSOAP::getCaller();
                    
                 // Execute SOAP request
                 $response = $caller->DoExpressCheckoutPayment($ec_request);
                 
                 return $response;
        }
}

?>
