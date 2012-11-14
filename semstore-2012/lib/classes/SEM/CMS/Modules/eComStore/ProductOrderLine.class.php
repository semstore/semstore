<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2007-10-30
 * @package SEM.CMS.Modules.eComStore
 *
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');

class ProductOrderLine extends SEMObject
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
        
        
        function ProductOrderLine ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductOrderLine'.$numArgs),
                        $args);
        }
        
        
        function _ProductOrderLine0 ()
        {
                $this->_initialise();
                $do =& new ProductOrderLineDataObject();
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
	
	
	function getOrderId ()
	{	
		return $this->cachedDataObject->getOrderId();
	}
	
	
        function setOrderId ( $temporder_id )
	{	
		$this->cachedDataObject->setOrderId($temporder_id);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getProductName ()
	{	
		return $this->cachedDataObject->getProductName();
	}
	
	
        function setProductName ( $tempproduct_name )
	{	
		$this->cachedDataObject->setProductName($tempproduct_name);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getPrice ()
	{	
		return $this->cachedDataObject->getPrice();
	}
	
	
        function setPrice ( $tempprice )
	{	
		$this->cachedDataObject->setPrice($tempprice);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getTax ()
	{	
		return $this->cachedDataObject->getTax();
	}
	
	
        function setTax ( $temptax )
	{	
		$this->cachedDataObject->setTax($temptax);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
	function getQuantity ()
	{	
		return $this->cachedDataObject->getQuantity();
	}
	
	
        function setQuantity ( $tempquantity )
	{	
		$this->cachedDataObject->setQuantity($tempquantity);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	

        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductOrderLineDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $objs = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $obj =& new ProductOrderLine();
                        $obj->setConnection($connection);
                        $obj->_setCachedDataObject($do);
                        $objs[] =& $obj;
                }
                
                return $objs;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductOrderLineDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $obj =& new ProductOrderLine();
                $obj->setConnection($connection);
                $obj->_setCachedDataObject($do);
                
                return $obj;
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
                        $this->_commitProductOrderLineDetails();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commitProductOrderLineDetails ()
        {
                $do =& $this->_getCachedDataObject();
                
                $connection =& $this->getConnection();
                
                $result =& $do->store($connection);
                
                if ( @@is_a('DBError', $result) ||
                        @@is_subclass_of('DBError', $result ) )
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
        
        
        function formatPrice ( $price )
        {
                return sprintf("%01.02f", $price / 100);
        }
        
        
        function &product ()
        {
                return Product::findFirst(
                        array('name' => $this->getProductName()),
                        $this->getConnection());
                
                return $product;
        }
        
        
        function &productOrder ()
        {
                return ProductOrder::findFirst(
                        array('id' => $this->getOrderId()),
                        $this->getConnection());
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
