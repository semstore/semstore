<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/CustomerGroupAttributeGroupDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/CustomerGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttribute.class.php');

class CustomerGroupCustomerAttributeGroup extends SEMObject
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
        
        
        function CustomerGroupCustomerAttributeGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerGroupCustomerAttributeGroup'.$numArgs),
                        $args);
        }
        
        
        function _CustomerGroupCustomerAttributeGroup0 ()
        {
                $this->_initialise();
                $do =& new CustomerGroupAttributeGroupDataObject();
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
        
        
        function getGroupId ()
        {
                return $this->cachedDataObject->getGroupId();
        }
        
        
        function setGroupId ( $id )
        {
                $this->cachedDataObject->setGroupId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new CustomerGroupAttributeGroupDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $groups = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $group =& new CustomerGroupCustomerAttributeGroup();
                        $group->setConnection($connection);
                        $group->_setCachedDataObject($do);
                        $groups[] =& $group;
                }
                
                return $groups;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CustomerGroupAttributeGroupDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $group =& new CustomerGroupCustomerAttributeGroup();
                $group->setConnection($connection);
                $group->_setCachedDataObject($do);
                
                return $group;
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
                
                $sql = 'UPDATE customer_group_attribute_group ' .
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
        
        
        function &getCustomerGroup ()
        {
                return CustomerGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
        }
        
        
        function &getAttributes ()
        {
                $sql = 'WHERE group_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return CustomerGroupCustomerAttribute::find(
                        $sql, $this->getConnection());
        }
        
        
        function getAttributeCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE group_id = %s',
                        CustomerGroupAttributeDataObject::TABLE(),
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
                $sql = 'UPDATE customer_group_attribute SET idx = idx + 1' .
                        ' WHERE group_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newAttribute->setIndex($pos);
                $newAttribute->setGroupId($this->getId());
                $newAttribute->setConnection($connection);
                $newAttribute->commit();
                
                print_r($newAttribute);
                die("");
                
                $customerGroup =& $this->getCustomerGroup();
                
                /* Create links in bridge table for all customers to this
                 * attribute.
                 */
                
                $sql = sprintf('INSERT INTO %s (%s, %s) SELECT %s, %s FROM %s WHERE %s = %s',
                        'customer_group_attribute_link',
                        'attribute_id',
                        'product_id',
                        $newAttribute->getId(),
                        'id',
                        'customer',
                        'customer.group_id',
                        $customerGroup->getId()
                        );
                        
                        
                
                echo $this->getId();
                
                $res = $connection->insert($sql);
                
                die($sql);
                
                
                return TRUE;
        }
}

?>
