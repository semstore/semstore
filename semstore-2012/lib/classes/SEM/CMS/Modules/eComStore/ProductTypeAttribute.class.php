<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/ProductTypeProductAttributeGroup.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductTypeAttributeDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductTypeAttributeGroupDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductTypeAttributeLinkDataObject.class.php');

class ProductTypeAttribute extends SEMObject
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
        
        
        function ProductTypeAttribute ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductTypeAttribute'.$numArgs),
                        $args);
        }
        
        
        function _ProductTypeAttribute0 ()
        {
                $this->_initialise();
                $do =& new ProductTypeAttributeLinkDataObject();
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
        
        
        
        function getProductId ()
        {
                return $this->cachedDataObject->getProductId();
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
        
        
        function &getAttributes ( &$product, $group, &$connection )
        {
                $attributes = array();
                
                $typeGroup =& ProductTypeProductAttributeGroup::findFirst(
                        array('id' => $group->getId()),
                        $this->getConnection() );
                $groupAttributes =& $typeGroup->getAttributes();
                $DO_CLASS =& new ProductTypeAttributeLinkDataObject();
                foreach ( array_keys($groupAttributes) as $index )
                {
                        $groupAttribute =& $groupAttributes[$index];
                        $tmpDo =& $DO_CLASS->lookup(
                                array('product_id' => $product->getId(),
                                        'attribute_id' => $groupAttribute->getId()),
                                $connection );
                        
                        if ( !is_null($tmpDo) )
                        {
                                $attribute =& new ProductTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $attribute->_setCachedDataObject($tmpDo);
                                $attributes[] =& $attribute;
                        }
                        else
                        {
                                $attribute =& new ProductTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $tmpDo =& new ProductTypeAttributeLinkDataObject();
                                $tmpDo->setAttributeId($groupAttribute->getId());
                                $tmpDo->setProductId($product->getId());
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
                return ProductType::findFirst(
                        array('id' => $this->getTypeId()),
                        $this->getConnection() );
        }
}

?>
