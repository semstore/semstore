<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductTypeDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/ProductTypeProductAttributeGroup.class.php');

class ProductType extends SEMObject
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
        
        
        function ProductType ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductType'.$numArgs),
                        $args);
        }
        
        
        function _ProductType0 ()
        {
                $this->_initialise();
                $do =& new ProductTypeDataObject();
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
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductTypeDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $groups = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $group =& new ProductType();
                        $group->setConnection($connection);
                        $group->_setCachedDataObject($do);
                        $groups[] =& $group;
                }
                
                return $groups;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductTypeDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $group =& new ProductType();
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
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        $this->retypeProducts();
                        $this->removeAttributeGroups();
                }
                
                // Remove myself
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
        
        
        function retypeProducts ()
        {
                $sql = 'UPDATE product ' .
                        'SET type_id = NULL ' .
                        'WHERE type_id = '. $this->getId();
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
                $sql = 'WHERE type_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return ProductTypeProductAttributeGroup::find($sql, $this->getConnection());
        }
        
        
        function getAttributeGroupCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE type_id = %s',
                        ProductTypeAttributeDataObject::TABLE(),
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
                $sql = 'UPDATE product_type_attribute_gorup SET idx = idx + 1' .
                        ' WHERE type_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newGroup->setIndex($pos);
                $newGroup->setTypeId($this->getId());
                $newGroup->setConnection($connection);
                $newGroup->commit();
                
                return TRUE;
        }
        
        
        function &getGroupWithName ( $name )
        {
                $groups =& $this->getAttributeGroups();
                
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
}

?>
