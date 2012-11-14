<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/ProductOrderType.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrderLine.class.php');
require_once('SEM/CMS/Modules/eComStore/Customer.class.php');
require_once('SEM/CMS/Modules/eComStore/Payment.class.php');

class ProductOrder extends SEMObject
{
        /*
         *
         * Class Constants
         *
         */
        
        
        
        
         
        /*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        var $connection = NULL;
        
        var $cachedDataObject = NULL;
        var $cachedDataObjectChanged = FALSE;
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
         * Constructors
         *
         */
        
        
        function ProductOrder ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductOrder'.$numArgs),
                        $args);
        }
        
        
        function _ProductOrder0 ()
        {
                $this->_initialise();
                $do =& new ProductOrderDataObject();
                $this->_setCachedDataObject($do);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
	
	
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        function &_getCachedDataObject ()
        {
                return $this->cachedDataObject;
        }
        
        
        function _setCachedDataObject ( &$dataObject )
        {
                $this->cachedDataObject =& $dataObject;
        }
        
        
        function getCachedDataObjectChanged ()
        {
                return $this->cachedDataObjectChanged;
        }
        
        
        function _setCachedDataObjectChanged ( $bool )
        {
                $this->cachedDataObjectChanged = $bool;
        }
        
        
	function getId ()
	{	
		return $this->cachedDataObject->getId();
	}
	
	
        function setId ( $tempid )
	{	
		$this->cachedDataObject->setId($tempid);
                $this->_setCachedDataObjectChanged(TRUE);
	}
        
        
        function getProductOrderTypeId ()
	{	
		return $this->cachedDataObject->getProductOrderTypeId();
	}
	
	
        function setProductOrderTypeId ( $id )
	{	
		$this->cachedDataObject->setProductOrderTypeId($id);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getCustomerId ()
	{	
		return $this->cachedDataObject->getCustomerId();
	}
	
	
        function setCustomerId ( $tempcustomer_id )
	{	
		$this->cachedDataObject->setCustomerId($tempcustomer_id);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getDatePlaced ()
	{	
		return $this->cachedDataObject->getDatePlaced();
	}
	
	
        function setDatePlaced ( $tempdate_placed )
	{	
		$this->cachedDataObject->setDatePlaced($tempdate_placed);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getValue ()
	{	
		return $this->cachedDataObject->getValue();
	}
	
	
        function setValue ( $tempvalue )
	{	
		$this->cachedDataObject->setValue($tempvalue);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductOrderDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $product_orders = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $product_order =& new ProductOrder();
                        $product_order->setConnection($connection);
                        $product_order->_setCachedDataObject($do);
                        $product_orders[] =& $product_order;
                }
                
                return $product_orders;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductOrderDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $product_order =& new ProductOrder();
                $product_order->setConnection($connection);
                $product_order->_setCachedDataObject($do);
                
                return $product_order;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function commit ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_commit'.$numArgs),
                        $args);
        }
        
        
        function _commit0 ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commitProductOrderDetails();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commitProductOrderDetails ()
        {
                $do =& $this->_getCachedDataObject();
                
                $connection =& $this->getConnection();
                
                $result =& $do->store($connection);
                
                if ( @is_a('DBError', $result) ||
                        @is_subclass_of('DBError', $result ) )
                {
                        return $result;
                }
                
                $this->setId($do->getId());
                $this->_setCachedDataObject($do);
                $this->_setCachedDataObjectChanged(FALSE);
        }
        
        
        function remove ( $maintainIntegrity = TRUE )
        {
                if ( !is_object($this->cachedDataObject) )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        ;
                }
                
                return TRUE;
        }
        
        
        function &customer ()
        {
                return Customer::findFirst(
                        array('id' => $this->getCustomerId()),
                        $this->getConnection());
        }
        
        
        function &orderLines ()
        {
                return ProductOrderLine::find(
                        sprintf('WHERE order_id = %s ORDER BY id',
                                $this->getId()),
                        $this->getConnection());
        }
        
        
        function &payments ()
        {
                return Payment::find(
                        sprintf('WHERE order_id = %s ORDER BY id',
                                $this->getId()),
                        $this->getConnection());
        }
        
        
        function calculateTotal ()
        {
                $total = 0;
                
                $orderLines = $this->orderLines();
                foreach ( array_keys($orderLines) as $index )
                {
                        $orderLine = $orderLines[$index];
                        $total += $orderLine->calculateTotal();
                }
                
                return $total;
        }
        
        
        function _formatPrice ( $price )
        {
                return sprintf('%1.02f', $price / 100);
        }
        
        
        function subtotalExVat ()
        {
                $subtotal = 0;
                
                $lines = $this->orderLines();
                
                foreach ( array_keys($lines) as $lineId )
                {
                        $line =& $lines[$lineId];
                        if ( $line->getProductName() == 'Carriage Charge' )
                        {
                                continue;
                        }
                        $subtotal += $line->lineTotalExVat();
                }
                
                return $subtotal;
        }
        
        
        function formattedSubtotalExVat ()
        {
                return $this->_formatPrice($this->subtotalExVat());
        }
        
        
        function subtotalIncVat ()
        {
                $subtotal = 0;
                
                $lines = $this->orderLines();
                
                foreach ( array_keys($lines) as $lineId )
                {
                        $line =& $lines[$lineId];
                        $subtotal += $line->lineTotalIncVat();
                }
                
                return $subtotal;
        }
        
        
        function formattedSubtotalIncVat ()
        {
                return $this->_formatPrice($this->subtotalIncVat());
        }
        
        
        function carriageChargeExVat ()
        {
                $lines = $this->orderLines();
                
                foreach ( array_keys($lines) as $lineId )
                {
                        $line =& $lines[$lineId];
                        if ( $line->getProductName() == 'Carriage Charge' )
                        {
                                return $line->priceExVat();
                        }
                }
                
                return 0;
        }
        
        
        function formattedCarriageChargeExVat ()
        {
                return $this->_formatPrice($this->carriageChargeExVat());
        }
        
        
        function carriageChargeIncVat ()
        {
                $lines = $this->orderLines();
                
                foreach ( array_keys($lines) as $lineId )
                {
                        $line =& $lines[$lineId];
                        if ( $line->getProductName() == 'Carriage Charge' )
                        {
                                return $line->priceIncVat();
                        }
                }
                
                return 0;
        }
        
        
        function formattedCarriageChargeIncVat ()
        {
                return $this->_formatPrice($this->carriageChargeIncVat());
        }
        
        
        function vat ()
        {
                $vat = 0;
                
                $lines = $this->orderLines();
                
                foreach ( array_keys($lines) as $lineId )
                {
                        $line =& $lines[$lineId];
                        $vat += $line->vat() * $line->quantity();
                }
                
                return $vat;
        }
        
        
        function formattedVat ()
        {
                return $this->_formatPrice($this->vat());
        }
        
        
        function total ()
        {
                $total = 0;
                
                $total = $this->subtotalExVat() +
                        $this->carriageChargeExVat() +
                        $this->vat();
                
                return $total;
        }
        
        
        function formattedTotal ()
        {
                return $this->_formatPrice($this->total());
        }
        
        
        function formattedDateTimePlaced ( $pattern = 'D jS M Y' )
        {
                return date($pattern, $this->getDatePlaced());
        }
        
        
        function &getType ()
        {
                return ProductOrderType::findFirst(
                        array('id' => $this->getProductOrderTypeId()),
                        $this->getConnection());
        }
        
        
        function &getAttributeGroups ()
        {
                $type =& $this->getType();
                
                if ( is_null($type) )
                {
                        return NULL;
                }
                
                return ProductOrderTypeAttributeGroup::getGroups(
                        $this, $type, $this->getConnection() );
        }
        
        
        function getAttributeGroupWithName ( $name )
        {
                $groups =& $this->getProductOrderTypeAttributeGroups();
                
                foreach ( array_keys($groups) as $key )
                {
                        $group =& $groups[$key];
                        if ( $group->getName() == $name )
                        {
                                return $group;
                        }
                }
                
                return NULL;
        }
        
        
        function &getAttribute ( $name )
        {
                $attributeGroups =& $this->getAttributeGroups();
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        return $attribute;
                                }
                        }
                }
                
                return NULL;
        }
        
        
        function getAttributeValue ( $name )
        {
                $attributeGroups =& $this->getAttributeGroups();
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        return $attribute->getValue();
                                }
                        }
                }
                
                return NULL;
        }
        
        
        function setAttributeValue ( $name, $value )
        {
                $attributeGroups =& $this->getAttributeGroups();
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        $attribute->setValue($value);
                                        $attribute->commit();
                                        return TRUE;
                                }
                        }
                }
                
                die($name." not found ");
                
                return FALSE;
        }
}

?>
