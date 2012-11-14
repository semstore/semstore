<?php

/**
 *  @author Simon Cadman (simoncadman@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2008-01-16
 */
require_once('Mail/MailWrapper.class.php');

class OrderEmails extends SEMObject
{
       
       
       function sendAllEmails ( $payment, $order )
       {
              OrderEmails::sendInternalOrderEmail($order, $payment, $GLOBALS['dbConnection']);
              OrderEmails::sendCustomerOrderEmail($order, $payment, $GLOBALS['dbConnection']);
       }
       
       
       
       
       
       
       
              
       function sendInternalOrderEmail ( $order, $payment, &$connection )
       {
               $email =& OrderEmails::prepareInternalOrderEmail($order, $payment);
               
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
               $email .= $order->getAttributeValue('Delivery Firstname') . " " .
                       $order->getAttributeValue('Delivery Surname') . "\n";
                       
               $email .= $order->getAttributeValue('Billing Email Address') . "\n";
               
               $email .= "\n\n----- Contact Number -----\n";
               $email .= $order->getAttributeValue('Billing Contact Number') . "\n";
               
               $email .= "\n\n----- Order -----\n";
               
             //  $email .= 'Heard of JusteCommerce from: '.$order->getHeardOfSite();
             //  $email .= "\n";
               
               /*
               foreach ( $order->lookupOrderLines() as $orderLine )
               {
                       $email .= $orderLine->getQuantity() . " x ";
                       $email .= $orderLine->getProductName() . "\n";
               }
               */
               
               $carriageLine = NULL;
               foreach ( $order->orderLines() as $orderLine )
               {
                       if ( $orderLine->getProductName() != 'Carriage Charge' )
                       {
                               $product =& $orderLine->product();
                               
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
               $email .= $order->getAttributeValue('Delivery Business Name') . "\n";
               $email .= $order->getAttributeValue('Delivery Building Name') . "\n";
               $email .= $order->getAttributeValue('Delivery Building Number') . " " .
                       $order->getAttributeValue('Delivery Address Line 1') . "\n";
               $email .= $order->getAttributeValue('Delivery Address Line 2') . "\n";
               $email .= $order->getAttributeValue('Delivery City') . "\n";
               $email .= $order->getAttributeValue('Delivery County') . "\n";
               $email .= $order->getAttributeValue('Delivery Postcode') . "\n";
               
               if ( $order->getAttributeValue('Delivery Date') != NULL &&
                       $order->getAttributeValue('Delivery Date') != '' )
               {
                       $email .= "\n\n----- Delivery Date -----\n";
                       $email .= OrderEmails::formatDeliveryDate(
                               $order->getAttributeValue('Delivery Date')) . "\n";
               }
               
               return $email;
       }
       
       
       function sendCustomerOrderEmail ( &$order, $payment, &$connection )
       {
               $email =& OrderEmails::prepareCustomerOrderEmail($order, $payment);
               
               $mailer =& new MailWrapper();
               $mailer->autoconfigure($GLOBALS['configuration']);
               
               $headers = array(
                       'From' => 'orders@justecommerce.co.uk',
                       'Subject' => 'JusteCommerce.co.uk Web Order'
                       );
               
               $mailer->send(array(
                               'To' => $order->getAttributeValue('Billing Email Address')
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
               foreach ( $order->orderLines() as $orderLine )
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
               $text[] = $order->getAttributeValue('Delivery Firstname') . ' ' .
                       $order->getAttributeValue('Delivery Surname');
               $text[] = $order->getAttributeValue('Delivery Address 1');
               if ( $order->getAttributeValue('Delivery Address 2') != '' )
               {
                       $text[] = $order->getAttributeValue('Delivery Address 2');
               }
               $text[] = $order->getAttributeValue('Delivery City');
               $text[] = $order->getAttributeValue('Delivery County');
               $text[] = $order->getAttributeValue('Delivery Postcode');
               $text[] = '';
               
               if ( $order->getAttributeValue('Delivery Date') != NULL &&
                       $order->getAttributeValue('Delivery Date') != '' )
               {
                       $text[] = 'DELIVERY DATE';
                       $text[] = OrderEmails::formatDeliveryDate($order->getAttributeValue('Delivery Date'));
                       
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


}

?>
