<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/CustomerGroupAttributeDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttributeGroup.class.php');

class CustomerGroupCustomerAttribute extends SEMObject
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
        
        
        function CustomerGroupCustomerAttribute ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerGroupCustomerAttribute'.$numArgs),
                        $args);
        }
        
        
        function _CustomerGroupCustomerAttribute0 ()
        {
                $this->_initialise();
                $do =& new CustomerGroupAttributeDataObject();
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
                $DO =& new CustomerGroupAttributeDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $attributes = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $attribute =& new CustomerGroupCustomerAttribute();
                        $attribute->setConnection($connection);
                        $attribute->_setCachedDataObject($do);
                        $attributes[] =& $attribute;
                }
                
                return $attributes;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CustomerGroupAttributeDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $attribute =& new CustomerGroupCustomerAttribute();
                $attribute->setConnection($connection);
                $attribute->_setCachedDataObject($do);
                
                return $attribute;
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
                        $this->removeCustomerAttributeLinks();
                }
                
                $idx = $this->getIndex();
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
                
                $sql = 'UPDATE customer_group_attribute ' .
                        'SET idx = idx - 1 ' .
                        'WHERE idx > ' . $idx;
                $res = $connection->update($sql);
                
                return TRUE;
        }
        
        
        function removeCustomerAttributeLinks ()
        {
                $sql = 'DELETE FROM customer_group_attribute_link ' .
                        'WHERE attribute_id = ' . $this->getId();
                $connection =& $this->getConnection();
                $res = $connection->delete($sql);
                
                return TRUE;
        }
        
        
        function &getGroup ()
        {
                return CustomerGroupCustomerAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection()
                        );
        }
        
        
        function &getCustomerGroup ()
        {
                $group =& $this->getGroup();
                
                if ( is_null($group) )
                {
                        return NULL;
                }
                
                return $group->getCustomerGroup();
        }
        
        
        /*
        function &getAttributes ()
        {
                $sql = 'WHERE group_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return ProductTypeProductAttribute::find($sql, $this->getConnection());
        }
        */
}

?>
