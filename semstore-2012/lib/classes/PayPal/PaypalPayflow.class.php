<?php

/**
 *  @author Simon Cadman (simoncadman@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2008-06-13
 */

require_once('PayPal.php');
require_once('HTTP/Curl.class.php');

class PaypalPayflow {




        function doTransaction ( $paymentaction, $ipaddress, $total, $startdate, $expirydate, $billingfirstname, $billingsurname, $billingstreet1, $billingstreet2, $billingcity, $billingcounty, $billingcountry, $billingpostcode, $currency, $deliveryfirstname, $deliverysurname, $deliverystreet1, $deliverystreet2, $deliverycityname, $deliverystate, $deliverycountry,  $deliverypostcode, $email, $deliveryphone, $cardtype, $cardnumber, $cardstartmonth, $cardstartyear, $cardexpirymonth, $cardexpiryyear, $cardcvv2, $expirydate )
        {
        
        
                $txCode = time(). '-' . Session::getId();
		$txCode = substr($txCode,0,30);
                
                $username = 'semsolutionstest';
                $vendorname = 'semsolutionstest';
                $password = '50lut10n5';
                
                $vars = 'TRXTYPE['.strlen($paymentaction).']='.$paymentaction.'&ACCT['.strlen($cardnumber).']='.$cardnumber.'&EXPDATE['.strlen($expirydate).']='.$expirydate.'&CVV2['.strlen($cardcvv2).']='.$cardcvv2.'&TENDER[1]=C&AMT['.strlen($total).']='.$total.'&STREET['.strlen($billingstreet1.' '.$billingstreet2).']='.$billingstreet1.' '.$billingstreet2.'&ZIP['.strlen($billingpostcode).']='.$billingpostcode.'&USER['.strlen($username).']='.$username.'&VENDOR['.strlen($vendorname ).']='.$vendorname .'&PARTNER[6]=PayPal&PWD['.strlen($password).']='.$password.'&CURRENCY['.strlen($currency).']='.$currency.'&NAME['.strlen($billingfirstname.' '.$billingsurname).']='.$billingfirstname.' '.$billingsurname;

               $httpheaders = array( 
                                     "Content-Type: text/namevalue", 
                                     "X-VPS-REQUEST-ID: ".$txCode,
                                     "X-VPS-CLIENT-TIMEOUT: 45",
                                     "X-VPS-VIT-CLIENT-CERTIFICATION-ID: ".Configuration::getParameter('software_paypal_certification_id'),
                                     "X-VPS-VIT-Integration-Product: ".Configuration::getParameter('software_name'),
                                     "X-VPS-VIT-Integration-Version: ".Configuration::getParameter('software_version')
                                   );
               
               
               $curl = new Curl();
               $result = $curl->doRequest('POST', Configuration::getParameter('paypal_payflow_url_'.Configuration::getParameter('paypal_mode')), $vars, $httpheaders, 0);
               
               
               //parse up the response
               $responses = explode('&', $result);
               $resultdata = array();
               
               foreach ( $responses as $response )
               {
                    $splitresponse = explode('=', $response);
                    
                    
                    $resultdata[$splitresponse[0]] = $splitresponse[1];
               }
               
               $hfmessage = '';
               
               
               //add human-friendly message
               switch ( $resultdata['RESULT'] )
               {
                    
                    case 12:
                          $hfmessage = 'Please check the credit card number, expiration date, and transaction information to make sure they were entered correctly. If this does not resolve the problem, please call your card issuing bank or use another card.';
                          break;
                    
                    
               }
               
               $resultdata['hfmessage'] = $hfmessage;
               
               return $resultdata;
        }

}




?>