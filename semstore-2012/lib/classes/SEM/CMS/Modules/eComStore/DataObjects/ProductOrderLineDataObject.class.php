<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-09-12
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
//require_once('Sites/Sterlingbuild/DataObjects/Product.class.php');

class ProductOrderLineDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
        function TABLE () { return 'product_order_line'; }
	function PRIMARY_KEY () { return 'id'; }
	function FIELD_LIST () { return array(
                'id',
                'order_id',
                'product_name',
                'price',
                'tax',
                'quantity'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'orderId' => 'order_id',
                'productName' => 'product_name',
                'price' => 'price',
                'tax' => 'tax',
                'quantity' => 'quantity'
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
        var $orderId = NULL;
        var $productName = '';
        var $price = 0;
        var $tax = 0;
        var $quantity = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductOrderLineDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductOrderLineDataObject'.$numArgs),
                        $args );
        }
        
        
        function _ProductOrderLineDataObject0 ()
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
        
        
        function getOrderId ()
        {
                return $this->orderId;
        }
        
        
        function setOrderId ( $orderId )
        {
                $this->orderId = $orderId;
        }
        
        
        function getProductName ()
        {
                return $this->productName;
        }
        
        
        function setProductName ( $name )
        {
                $this->productName = $name;
        }
        
        
        function getPrice ()
        {
                return $this->price;
        }
        
        
        function setPrice ( $price )
        {
                $this->price =& $price;
        }
        
        
        function getTax ()
        {
                return $this->tax;
        }
        
        
        function setTax ( $tax )
        {
                $this->tax = $tax;
        }
        
        
        function getQuantity ()
        {
                return $this->quantity;
        }
        
        
        function setQuantity ( $quantity )
        {
                $this->quantity = $quantity;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductOrderLineDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->id = $connection->getLastInsertId();
        }
        
        
        function formatPrice ( $price )
        {
                return sprintf("%01.02f", $price / 100);
        }
        
        
        function &lookupProduct ()
        {
                $product =& Product::findFirst(
                        array('name' => $this->getProductName()),
                        $this->getConnection());
                
                return $product;
        }
        
        
        function &lookupProductOrder ()
        {
                $PRODUCTORDER_DO_CLASS =& new ProductOrderDataObject();
                $productOrder =& $PRODUCTORDER_DO_CLASS->lookup(
                        array('id' => $this->getOrderId()),
                        $this->getConnection());
                
                return $productOrder;
        }
        
        
        function calculateTotal ()
        {
                $total = ($this->getPrice() + $this->getTax()) *
                        $this->getQuantity();
                
                return $total;
        }
        
        
        
        
        
        function _formatPrice ( $price )
        {
                return sprintf('%1.02f', $price / 100);
        }
        
        
        function priceExVat ()
        {
                return $this->getPrice();
        }
        
        
        function formattedPriceExVat ()
        {
                return $this->_formatPrice($this->priceExVat());
        }
        
        
        function vat ()
        {
                return $this->getTax();
        }
        
        
        function formattedVat ()
        {
                return $this->_formatPrice($this->vat());
        }
        
        
        function priceIncVat ()
        {
                return $this->priceExVat() + $this->vat();
        }
        
        
        function formattedPriceIncVat ()
        {
                return $this->_formatPrice($this->priceIncVat());
        }
        
        
        function quantity ()
        {
                return $this->getQuantity();
        }
        
        
        function lineTotalExVat ()
        {
                return $this->priceExVat() * $this->quantity();
        }
        
        
        function formattedLineTotalExVat ()
        {
                return $this->_formatPrice($this->lineTotalExVat());
        }
        
        
        function lineTotalIncVat ()
        {
                return $this->priceIncVat() * $this->quantity();
        }
        
        
        function formattedLineTotalIncVat ()
        {
                return $this->_formatPrice($this->lineTotalIncVat());
        }
        
}

?>
