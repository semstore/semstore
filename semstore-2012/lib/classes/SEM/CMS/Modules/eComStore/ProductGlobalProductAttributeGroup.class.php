<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductGlobalAttributeGroupDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductGlobalAttributeDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalProductAttribute.class.php');

class ProductGlobalProductAttributeGroup extends SEMObject
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
	 * Constructors
         *
	 */
        
        
        function ProductGlobalProductAttributeGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductGlobalProductAttributeGroup'.$numArgs),
                        $args);
        }
        
        
        function _ProductGlobalProductAttributeGroup0 ()
        {
                $this->_initialise();
                $do =& new ProductGlobalAttributeGroupDataObject();
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
        
        
        function setId ( $id )
        {
                $this->cachedDataObject->setId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getName ()
        {
                return $this->cachedDataObject->getName();
        }
        
        
        function setName ( $name )
        {
                $this->cachedDataObject->setName($name);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getIndex ()
        {
                return $this->cachedDataObject->getIndex();
        }
        
        
        function setIndex ( $index )
        {
                $this->cachedDataObject->setIndex($index);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductGlobalAttributeGroupDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $groups = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $group =& new ProductGlobalProductAttributeGroup();
                        $group->setConnection($connection);
                        $group->_setCachedDataObject($do);
                        $groups[] =& $group;
                }
                
                return $groups;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductGlobalAttributeGroupDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $group =& new ProductGlobalProductAttributeGroup();
                $group->setConnection($connection);
                $group->_setCachedDataObject($do);
                
                return $group;
        }
        
        
        function addAttributeGroupAtStart ( &$newGroup, &$connection )
        {
                return ProductGlobalProductAttributeGroup::addAttributeGroupAtPosition(
                        $newGroup, 0, &$connection );
        }
        
        
        function addAttributeGroupAtEnd ( &$newGroup, &$connection )
        {
                $count = ProductGlobalProductAttributeGroup::groupCount($connection);
                
                return ProductGlobalProductAttributeGroup::addAttributeGroupAtPosition(
                        $newGroup, $count, &$connection );
        }
        
        
        function addAttributeGroupAtPosition ( &$newGroup, $pos, &$connection )
        {
                if ( $pos > ProductGlobalProductAttributeGroup::groupCount($connection) )
                {
                        return FALSE;
                }
                
                // Make space for new category
                $sql = 'UPDATE product_global_attribute_group SET idx = idx + 1' .
                        ' WHERE idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newGroup->setIndex($pos);
                $newGroup->setConnection($connection);
                $newGroup->commit();
                
                return TRUE;
        }
        
        
        function groupCount ( &$connection )
        {
                $sql = 'SELECT COUNT(*) FROM product_global_attribute_group';
                $res =& $connection->select($sql);
                $res->first();
                $row =& $res->getRowArray();
                $count =& $row[0];
                
                return $count;
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
                        $this->_commitSelf();
                }
                
                return TRUE;
        }
        
        
        function _commitSelf ()
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
                
                if ( $maintainIntegrity )
                {
                        $this->removeAttributes();
                }
                
                $idx = $this->getIndex();
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
                
                $sql = 'UPDATE product_global_attribute_group ' .
                        'SET idx = idx - 1 ' .
                        'WHERE idx > ' . $idx;
                $res = $connection->update($sql);
                
                return TRUE;
        }
        
        
        function removeAttributes ()
        {
                $attributes =& $this->getAttributes();
                foreach ( array_keys($attributes) as $index )
                {
                        $attribute =& $attributes[$index];
                        $attribute->remove();
                }
        }
        
        
        function &getAttributes ()
        {
                $sql = 'WHERE group_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return ProductGlobalProductAttribute::find($sql, $this->getConnection());
        }
        
        
        function getAttributeCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE group_id = %s',
                        ProductGlobalAttributeDataObject::TABLE(),
                        $this->getId());
                $connection =& $this->getConnection();
                $result =& $connection->execute($sql);
                if ( is_null($result) )
                {
                        return 0;
                }
                elseif ( @is_a($result, 'DBError') ||
                        @is_subclass_of($result, 'DBError') )
                {
                        return $result;
                }
                
                $result->first();
                $row =& $result->getRowArray();
                
                if ( is_null($row) || !is_array($row) )
                {
                        return 0;
                }
                
                return $row[0];
        }
        
        
        function addAttributeAtStart ( &$newAttribute )
        {
                return $this->addAttributeAtPosition( $newAttribute, 0 );
        }
        
        
        function addAttributeAtEnd ( &$newAttribute )
        {
                $attributes =& $this->getAttributes();
                $index = count($attributes);
                
                return $this->addAttributeAtPosition( $newAttribute, $index );
        }
        
        
        function addAttributeAtPosition ( &$newAttribute, $pos )
        {
                if ( $pos > $this->getAttributeCount() )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Make space for new category
                $sql = 'UPDATE product_global_attribute SET idx = idx + 1' .
                        ' WHERE group_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newAttribute->setIndex($pos);
                $newAttribute->setGroupId($this->getId());
                $newAttribute->setConnection($connection);
                $newAttribute->commit();
                
                /* Create links in bridge table for all products to this
                 * attribute.
                 */
                
                $sql = sprintf('INSERT INTO %s (%s, %s) SELECT %s, %s FROM %s',
                        'product_global_attribute_link',
                        'attribute_id',
                        'product_id',
                        $newAttribute->getId(),
                        'id',
                        'product'
                        );
                
                $res = $connection->insert($sql);
                
                return TRUE;
        }
}

?>
