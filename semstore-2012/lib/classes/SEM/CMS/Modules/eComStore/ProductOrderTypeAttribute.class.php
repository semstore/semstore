<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/ProductOrderTypeProductOrderAttributeGroup.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderTypeAttributeDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderTypeAttributeGroupDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderTypeAttributeLinkDataObject.class.php');

class ProductOrderTypeAttribute extends SEMObject
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
        
        var $groupId = NULL;
        var $index = NULL;
        var $name = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ProductOrderTypeAttribute ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductOrderTypeAttribute'.$numArgs),
                        $args);
        }
        
        
        function _ProductOrderTypeAttribute0 ()
        {
                $this->_initialise();
                $do =& new ProductOrderTypeAttributeLinkDataObject();
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
        
        
        function getValue ()
        {
                return $this->cachedDataObject->getValue();
        }
        
        
        function setValue ( $value )
        {
                $this->cachedDataObject->setValue($value);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getAttributeId ()
        {
                return $this->cachedDataObject->getAttributeId();
        }
        
        
        
        function getPaymentId ()
        {
                return $this->cachedDataObject->getPaymentId();
        }
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &getAttributes ( &$productOrder, $group, &$connection )
        {
                $attributes = array();
                
                $typeGroup =& ProductOrderTypeProductOrderAttributeGroup::findFirst(
                        array('id' => $group->getId()),
                        $this->getConnection() );
                $groupAttributes =& $typeGroup->getAttributes();
                $DO_CLASS =& new ProductOrderTypeAttributeLinkDataObject();
                foreach ( array_keys($groupAttributes) as $index )
                {
                        $groupAttribute =& $groupAttributes[$index];
                        $tmpDo =& $DO_CLASS->lookup(
                                array('product_order_id' => $productOrder->getId(),
                                        'attribute_id' => $groupAttribute->getId()),
                                $connection );
                        
                        if ( !is_null($tmpDo) )
                        {
                                $attribute =& new ProductOrderTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $attribute->_setCachedDataObject($tmpDo);
                                $attributes[] =& $attribute;
                        }
                        else
                        {
                                $attribute =& new ProductOrderTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $tmpDo =& new ProductOrderTypeAttributeLinkDataObject();
                                $tmpDo->setAttributeId($groupAttribute->getId());
                                $tmpDo->setProductOrderId($productOrder->getId());
                                $attribute->_setCachedDataObject($tmpDo);
                                $attributes[] =& $attribute;;
                        }
                }
                
                return $attributes;
        }
        
        
        function &find ( $criteria, &$connection )
        {
                ;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                ;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function commit ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commitCategoryDetails();
                }
                
                return TRUE;
        }
        
        
        function _commitCategoryDetails ()
        {
                $do =& $this->_getCachedDataObject();
                
                $connection =& $this->getConnection();
                $result =& $do->store($connection);
                
                if ( @@is_a('DBError', $result) ||
                        @@is_subclass_of('DBError', $result ) )
                {
                        return $result;
                }
                
                $this->id = $do->getId();
                $this->_setCachedDataObject($do);
                $this->_setCachedDataObjectChanged(FALSE);
        }
        
        
        function remove ()
        {
                if ( !is_object($this->cachedDataObject) )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                return $this->cachedDataObject->delete($connection);
        }
        
        
        function &getType ()
        {
                return ProductOrderType::findFirst(
                        array('id' => $this->getTypeId()),
                        $this->getConnection() );
        }
}

?>
