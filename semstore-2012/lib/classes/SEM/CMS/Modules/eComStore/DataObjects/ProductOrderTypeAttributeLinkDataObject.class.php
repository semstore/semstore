<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductOrderTypeAttributeLinkDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_order_type_attribute_link'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'value',
                'attribute_id',
                'product_order_id'
                
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'value' => 'value',
                'attributeId' => 'attribute_id',
                'productOrderId' => 'product_order_id',
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
        var $value = '';
        var $attributeId = NULL;
        var $productOrderId = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductOrderTypeAttributeLinkDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductOrderTypeAttributeLinkDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductOrderTypeAttributeLinkDataObject0 ()
        {
                $this->_initialize();
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
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        function getAttributeId ()
        {
                return $this->attributeId;
        }
        
        
        function setAttributeId ( $id )
        {
                $this->attributeId = $id;
        }
        
        
        function getProductOrderId ()
        {
                return $this->productOrderId;
        }
        
        
        function setProductOrderId ( $id )
        {
                $this->productOrderId = $id;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductOrderTypeAttributeLinkDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
