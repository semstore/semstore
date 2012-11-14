<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-09-12
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class PaymentDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
        function TABLE () { return 'payment'; }
	function PRIMARY_KEY () { return 'id'; }
	function FIELD_LIST () { return array(
                'id',
                'type_id',
                'order_id'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'typeId' => 'type_id',
                'orderId' => 'order_id'
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        /*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $id = NULL;
        var $typeId = NULL;
        var $orderId = NULL;
        
        
        /*
	 * Class Methods
	 */

        
        
        /*
	 * Constructors
	 */
        
        
        function PaymentDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_PaymentDataObject'.$numArgs),
                        $args );
        }
        
        
        function _PaymentDataObject0 ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
        }
        
        
        function getTypeId ()
        {
                return $this->typeId;
        }
        
        
        function setTypeId ( $typeId )
        {
                $this->typeId = $typeId;
        }
        
        
        function getOrderId ()
        {
                return $this->orderId;
        }
        
        
        function setOrderId ( $orderId )
        {
                $this->orderId = $orderId;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new PaymentDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->id = $connection->getLastInsertId();
        }
        
        
        function &lookupOrder ()
        {
                $PRODUCT_ORDER_DO_CLASS =& new ProductOrderDataObject();
                $productOrder =& $PRODUCT_ORDER_DO_CLASS->lookup(
                        array('id' => $this->getOrderId()),
                        $this->getConnection());
                
                return $productOrder;
        }
}

?>
