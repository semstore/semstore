<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentDataObject.class.php');

class ProductOrderDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
        function TABLE () { return 'product_order'; }
	function PRIMARY_KEY () { return 'id'; }
	function FIELD_LIST () { return array(
                'id',
                'product_order_type_id',
                'customer_id',
                'date_placed',
                'value'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'productOrderTypeId' => 'product_order_type_id',
                'customerId' => 'customer_id',
                'datePlaced' => 'date_placed',
                'value' => 'value'
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
        var $productOrderTypeId = NULL;
        var $customerId = NULL;
        var $datePlaced = 0;
        var $value = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductOrderDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();

                call_user_func_array(
                        array(&$this, '_ProductOrderDataObject'.$numArgs),
                        $args );
        }
        
        
        function _ProductOrderDataObject0 ()
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
        
        
        function getProductOrderTypeId ()
        {
                return $this->productOrderTypeId;
        }
        
        
        function setProductOrderTypeId ( $id )
        {
                $this->productOrderTypeId = $id;
        }
        
        
        function getCustomerId ()
        {
                return $this->customerId;
        }
        
        
        function setCustomerId ( $customerId )
        {
                $this->customerId = $customerId;
        }
        
        
        function getDatePlaced ()
        {
                return $this->datePlaced;
        }
        
        
        function setDatePlaced ( $datePlaced )
        {
                $this->datePlaced = $datePlaced;
        }
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductOrderDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->id = $connection->getLastInsertId();
        }
}

?>
