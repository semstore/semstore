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
require_once('SEM/CMS/Modules/eComStore/ProductOrder.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderLine.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderType.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeProductOrderAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeProductOrderAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/Payment.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypeAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentType.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypePaymentAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypePaymentAttribute.class.php');


$truncateTables = TRUE;
$makeDB = TRUE;
$truncateConversionTables = TRUE;
$convert = TRUE;


if ( $truncateTables )
{
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order_type');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order_type_attribute_group');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order_type_attribute');
        
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  payment_type');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  payment_type_attribute_group');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  payment_type_attribute');
}


if ( $makeDB )
{
        $dispatchableOrderType =& new ProductOrderType();
        $dispatchableOrderType->setName('Order');
        $dispatchableOrderType->setConnection($GLOBALS['dbConnection']);
        $dispatchableOrderType->commit($GLOBALS['dbConnection']);
        
        $dispatchableOrderBillingGroup =&
                new ProductOrderTypeProductOrderAttributeGroup();
        $dispatchableOrderBillingGroup->setName('Billing Details');
        $dispatchableOrderType->addAttributeGroupAtEnd(
                $dispatchableOrderBillingGroup);
        
        $attributeNames = array(
                'Billing Title',
                'Billing Firstname',
                'Billing Surname',
                'Billing Business Name',
                'Billing Building Name',
                'Billing Building Number',
                'Billing Address Line 1',
                'Billing Address Line 2',
                'Billing City',
                'Billing County',
                'Billing Country',
                'Billing Postcode',
                'Billing Contact Number',
                'Billing Email Address');
        foreach ( $attributeNames as $attributeName )
        {
                $dispatchableOrderAttribute =&
                        new ProductOrderTypeProductOrderAttribute();
                $dispatchableOrderAttribute->setName($attributeName);
                $dispatchableOrderBillingGroup->addAttributeAtEnd(
                        $dispatchableOrderAttribute);
        }
        
        $dispatchableOrderDeliveryGroup =&
                new ProductOrderTypeProductOrderAttributeGroup();
        $dispatchableOrderDeliveryGroup->setName('Delivery Details');
        $dispatchableOrderType->addAttributeGroupAtEnd(
                $dispatchableOrderDeliveryGroup);
        
        $attributeNames = array(
                'Delivery Title',
                'Delivery Firstname',
                'Delivery Surname',
                'Delivery Business Name',
                'Delivery Building Number',
                'Delivery Address Line 1',
                'Delivery Address Line 2',
                'Delivery City',
                'Delivery County',
                'Delivery Country',
                'Delivery Postcode',
                'Delivery Contact Number',
                'Delivery Email Address',
                'Delivery Instructions',
                'Delivery Date');
        foreach ( $attributeNames as $attributeName )
        {
                $dispatchableOrderAttribute =&
                        new ProductOrderTypeProductOrderAttribute();
                $dispatchableOrderAttribute->setName($attributeName);
                $dispatchableOrderDeliveryGroup->addAttributeAtEnd(
                        $dispatchableOrderAttribute);
        }
        
        $vspPaymentType =& new PaymentType();
        $vspPaymentType->setName('ProtX VSP Form');
        $vspPaymentType->setConnection($GLOBALS['dbConnection']);
        $vspPaymentType->commit($GLOBALS['dbConnection']);
        
        $vspPaymentRequestGroup =&
                new PaymentTypePaymentAttributeGroup();
        $vspPaymentRequestGroup->setName('Request Details');
        $vspPaymentType->addAttributeGroupAtEnd(
                $vspPaymentRequestGroup);
        
        $attributeNames = array(
                'Vendor Tx Code',
                'Amount',
                'Currency',
                'Description',
                'Success URL',
                'Failure URL',
                'Customer Name',
                'Customer Email',
                'Vendor Email',
                'Email Message',
                'Billing Address',
                'Billing Postcode',
                'Delivery Address',
                'Delivery Postcode',
                'Contact Number',
                'Contact Fax',
                'Basket',
                'Allow Gift Aid',
                'Apply AVS CV2',
                'Apply 3D Secure');
        foreach ( $attributeNames as $attributeName )
        {
                $vspPaymentAttribute =&
                        new PaymentTypePaymentAttribute();
                $vspPaymentAttribute->setName($attributeName);
                $vspPaymentRequestGroup->addAttributeAtEnd(
                        $vspPaymentAttribute);
        }
        
        $vspPaymentResponseGroup =&
                new PaymentTypePaymentAttributeGroup();
        $vspPaymentResponseGroup->setName('Response Details');
        $vspPaymentType->addAttributeGroupAtEnd(
                $vspPaymentResponseGroup);
        
        $attributeNames = array(
                'Status',
                'Status Detail',
                'Vendor Tx Code',
                'VPS Tx Id',
                'Tx Auth no',
                'Amount',
                'AVS CV2',
                'Address Result',
                'Postcode Result',
                'CV2 Result',
                'Gift Aid',
                '3D Secure Status',
                'CAVV');
        foreach ( $attributeNames as $attributeName )
        {
                $vspPaymentAttribute =&
                        new PaymentTypePaymentAttribute();
                $vspPaymentAttribute->setName($attributeName);
                $vspPaymentResponseGroup->addAttributeAtEnd(
                        $vspPaymentAttribute);
        }
}


if ( !$convert )
{
        exit();
}


if ( $truncateConversionTables )
{
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order_type_attribute_link');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  product_order_line');
        $GLOBALS['dbConnection']->execute(
        
                'TRUNCATE  payment');
        $GLOBALS['dbConnection']->execute(
                'TRUNCATE  payment_type_attribute_link');
}


$DISPATCHABLE_ORDER_TYPE =& ProductOrderType::findFirst(
        array('name' => 'Order'),
        $GLOBALS['dbConnection']);

$VSPFORM_PAYMENT_TYPE =& PaymentType::findFirst(
        array('name' => 'ProtX VSP Form'),
        $GLOBALS['dbConnection']);

// Select each order row from database
$orderRows =& $GLOBALS['dbConnection']->execute(
        'SELECT * FROM product_order_old WHERE id > 244 ORDER BY date_placed');
while( $orderRows->next() )
{
        // Convert order row to new order structure
        $orderRow =& $orderRows->getRowHash();
        $productOrder =& new ProductOrder();
        $productOrder->setProductOrderTypeId(
                $DISPATCHABLE_ORDER_TYPE->getId());
        $productOrder->setDatePlaced($orderRow['date_placed']);
        $productOrder->setValue($orderRow['value']);
        $productOrder->setConnection($GLOBALS['dbConnection']);
        $productOrder->commit($GLOBALS['dbConnection']);
        
        $productOrder->setAttributeValue('Billing Title',
                $orderRow['billing_title']);
        $productOrder->setAttributeValue('Billing Firstname',
                $orderRow['billing_firstname']);
        $productOrder->setAttributeValue('Billing Surname',
                $orderRow['billing_surname']);
        $productOrder->setAttributeValue('Billing Business Name',
                $orderRow['billing_business']);
        $productOrder->setAttributeValue('Billing Building Name',
                $orderRow['billing_building']);
        $productOrder->setAttributeValue('Billing Building Number',
                $orderRow['billing_number']);
        $productOrder->setAttributeValue('Billing Address Line 1',
                $orderRow['billing_address1']);
        $productOrder->setAttributeValue('Billing Address Line 2',
                $orderRow['billing_address2']);
        $productOrder->setAttributeValue('Billing City',
                $orderRow['billing_city']);
        $productOrder->setAttributeValue('Billing County',
                $orderRow['billing_county']);
        $productOrder->setAttributeValue('Billing Country',
                '');
        $productOrder->setAttributeValue('Billing Postcode',
                $orderRow['billing_postcode']);
        $productOrder->setAttributeValue('Billing Contact Number',
                '');
        $productOrder->setAttributeValue('Billing Email Address',
                '');
        
        
        $productOrder->setAttributeValue('Delivery Title',
                $orderRow['delivery_title']);
        $productOrder->setAttributeValue('Delivery Firstname',
                $orderRow['delivery_firstname']);
        $productOrder->setAttributeValue('Delivery Surname',
                $orderRow['delivery_surname']);
        $productOrder->setAttributeValue('Delivery Business Name',
                $orderRow['delivery_business']);
        $productOrder->setAttributeValue('Delivery Building Name',
                $orderRow['delivery_building']);
        $productOrder->setAttributeValue('Delivery Building Number',
                $orderRow['delivery_number']);
        $productOrder->setAttributeValue('Delivery Address Line 1',
                $orderRow['delivery_address1']);
        $productOrder->setAttributeValue('Delivery Address Line 2',
                $orderRow['delivery_address2']);
        $productOrder->setAttributeValue('Delivery City',
                $orderRow['delivery_city']);
        $productOrder->setAttributeValue('Delivery County',
                $orderRow['delivery_county']);
        $productOrder->setAttributeValue('Delivery Country',
                '');
        $productOrder->setAttributeValue('Delivery Postcode',
                $orderRow['delivery_postcode']);
        $productOrder->setAttributeValue('Delivery Contact Number',
                $orderRow['contact_number']);
        $productOrder->setAttributeValue('Delivery Email Address',
                '');
        $productOrder->setAttributeValue('Delivery Date',
                $orderRow['delivery_date']);
        
        
        // Convert each order line row
        $orderLineRows =& $GLOBALS['dbConnection']->execute(
                sprintf('SELECT * FROM product_order_line_old' .
                        ' WHERE order_id = ' .
                                $GLOBALS['dbConnection']->escapeString(
                                $orderRow['id']) .
                        ' ORDER BY id'));
        
        while ( $orderLineRows->next() )
        {
                $orderLineRow =& $orderLineRows->getRowHash();
                $productOrderLine =& new ProductOrderLine();
                $productOrderLine->setOrderId(
                        $productOrder->getId());
                $productOrderLine->setProductName($orderLineRow['product_name']);
                $productOrderLine->setPrice($orderLineRow['price']);
                $productOrderLine->setTax($orderLineRow['tax']);
                $productOrderLine->setQuantity($orderLineRow['quantity']);
                $productOrderLine->setConnection($GLOBALS['dbConnection']);
                $productOrderLine->commit();
        }
        
        // Convert each order line row
        $paymentRows =& $GLOBALS['dbConnection']->execute(
                sprintf('SELECT * FROM payment_old' .
                        ' WHERE order_id = ' .
                                $GLOBALS['dbConnection']->escapeString(
                                $orderRow['id']) .
                        ' ORDER BY id'));
        
        while ( $paymentRows->next() )
        {
                $paymentRow =& $paymentRows->getRowHash();
                $payment =& new Payment();
                $payment->setTypeId(
                        $VSPFORM_PAYMENT_TYPE->getId());
                $payment->setOrderId($productOrder->getId());
                $payment->setConnection($GLOBALS['dbConnection']);
                $payment->commit();
                
                $payment->setAttributeValue('Vendor Tx Code',
                        $paymentRow['vsp_vendor_tx_code']);
                $payment->setAttributeValue('Amount',
                        $paymentRow['vsp_amount']);
                $payment->setAttributeValue('Currency',
                        $paymentRow['vsp_currency']);
                $payment->setAttributeValue('Description',
                        $paymentRow['vsp_description']);
                $payment->setAttributeValue('Success URL',
                        $paymentRow['vsp_success_url']);
                $payment->setAttributeValue('Failure URL',
                        $paymentRow['vsp_failure_url']);
                $payment->setAttributeValue('Customer Name',
                        $paymentRow['vsp_customer_name']);
                $payment->setAttributeValue('Customer Email',
                        $paymentRow['vsp_customer_email']);
                $payment->setAttributeValue('Vendor Email',
                        '');
                $payment->setAttributeValue('Email Message',
                        '');
                $payment->setAttributeValue('Billing Address',
                        $paymentRow['vsp_billing_address']);
                $payment->setAttributeValue('Billing Postcode',
                        $paymentRow['vsp_billing_postcode']);
                $payment->setAttributeValue('Delivery Address',
                        $paymentRow['vsp_delivery_address']);
                $payment->setAttributeValue('Delivery Postcode',
                        $paymentRow['vsp_delivery_postcode']);
                $payment->setAttributeValue('Contact Number',
                        $paymentRow['vsp_contact_number']);
                $payment->setAttributeValue('Contact Fax',
                        $paymentRow['vsp_contact_fax']);
                $payment->setAttributeValue('Basket',
                        $paymentRow['vsp_basket']);
                $payment->setAttributeValue('Allow Gift Aid',
                        $paymentRow['vsp_allow_gift_aid']);
                $payment->setAttributeValue('Apply AVS CV2',
                        $paymentRow['vsp_apply_cv2']);
                $payment->setAttributeValue('Apply 3D Secure',
                        $paymentRow['vsp_apply_3d']);
                
                $payment->setAttributeValue('Status',
                        $paymentRow['vsp_status']);
                $payment->setAttributeValue('Status Detail',
                        $paymentRow['vsp_status_details']);
                $payment->setAttributeValue('VPS Tx Id',
                        $paymentRow['vsp_tx_id']);
                $payment->setAttributeValue('Tx Auth No',
                        $paymentRow['vsp_tx_auth_no']);
                $payment->setAttributeValue('AVS CV2',
                        $paymentRow['vsp_cv2']);
                $payment->setAttributeValue('Gift Aid',
                        $paymentRow['vsp_gift_aid']);
                $payment->setAttributeValue('3D Secure Status',
                        $paymentRow['vsp_3d_result']);
                $payment->setAttributeValue('CAVV',
                        $paymentRow['vsp_cavv']);
        }
        
        //exit();
}



Out::flush();
Debug::flush();

?>
