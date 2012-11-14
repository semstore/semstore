<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/CustomerGroupDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/CustomerGroupAttributeDataObject.class.php');

class CustomerGroup extends SEMObject
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
        
        
        function CustomerGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerGroup'.$numArgs),
                        $args);
        }
        
        
        function _CustomerGroup0 ()
        {
                $this->_initialise();
                $do =& new CustomerGroupDataObject();
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
        
        
        function getDescription ()
        {
                return $this->cachedDataObject->getDescription();
        }
        
        
        function setDescription ( $desc )
        {
                $this->cachedDataObject->setDescription($desc);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new CustomerGroupDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $customerGroups = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $customerGroup =& new CustomerGroup();
                        $customerGroup->setConnection($connection);
                        $customerGroup->_setCachedDataObject($do);
                        $customerGroups[] =& $customerGroup;
                }
                
                return $customerGroups;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CustomerGroupDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $customerGroup =& new CustomerGroup();
                $customerGroup->setConnection($connection);
                $customerGroup->_setCachedDataObject($do);
                
                return $customerGroup;
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
                        $this->_commitCustomerDetails();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commitCustomerDetails ()
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
                        $this->retypeCustomers();
                        $this->removeAttributeGroups();
                }
                
                // Remove myself
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
                
                return TRUE;
        }
        
        
        function retypeCustomers ()
        {
                $sql = 'UPDATE customer ' .
                        'SET group_id = NULL ' .
                        'WHERE group_id = '. $this->getId();
                $connection =& $this->getConnection();
                $res = $connection->update($sql);
                
                return TRUE;
        }
        
        
        function removeAttributeGroups ()
        {
                $groups =& $this->getAttributeGroups();
                foreach ( array_keys($groups) as $index )
                {
                        $group =& $groups[$index];
                        $group->remove();
                }
        }
        
        
        function &getAttributeGroups ()
        {
                $sql = 'WHERE group_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return CustomerGroupCustomerAttributeGroup::find(
                        $sql, $this->getConnection());
        }
        
        
        function getAttributeGroupCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE group_id = %s',
                        CustomerGroupAttributeGroupDataObject::TABLE(),
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
        
        
        function addAttributeGroupAtStart ( &$newGroup )
        {
                return $this->addAttributeGroupAtPosition( $newGroup, 0 );
        }
        
        
        function addAttributeGroupAtEnd ( &$newGroup )
        {
                $groups =& $this->getAttributeGroups();
                $index = count($groups);
                
                return $this->addAttributeGroupAtPosition( $newGroup, $index );
        }
        
        
        function addAttributeGroupAtPosition ( &$newGroup, $pos )
        {
        
                if ( $pos > $this->getAttributeGroupCount() )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Make space for new category
                $sql = 'UPDATE customer_group_attribute_group SET idx = idx + 1' .
                        ' WHERE group_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newGroup->setIndex($pos);
                $newGroup->setGroupId($this->getId());
                $newGroup->setConnection($connection);
                $newGroup->commit();
                
                return TRUE;
        }
}

?>
