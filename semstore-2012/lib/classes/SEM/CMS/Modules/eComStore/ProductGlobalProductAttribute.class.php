<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductGlobalAttributeDataObject.class.php');

class ProductGlobalProductAttribute extends SEMObject
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
        
        
        function ProductGlobalProductAttribute ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductGlobalProductAttribute'.$numArgs),
                        $args);
        }
        
        
        function _ProductGlobalProductAttribute0 ()
        {
                $this->_initialise();
                $do =& new ProductGlobalAttributeDataObject();
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
                $DO =& new ProductGlobalAttributeDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $attributes = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $attribute =& new ProductGlobalProductAttribute();
                        $attribute->setConnection($connection);
                        $attribute->_setCachedDataObject($do);
                        $attributes[] =& $attribute;
                }
                
                return $attributes;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductGlobalAttributeDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $attribute =& new ProductGlobalProductAttribute();
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
                        $this->_commitSelf();
                }
                
                return TRUE;
        }
        
        
        function _commitSelf ()
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
                
                
                if ( $maintainIntegrity )
                {
                        $this->removeProductAttributeLinks();
                }
                
                $idx = $this->getIndex();
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
                
                $sql = 'UPDATE product_global_attribute ' .
                        'SET idx = idx - 1 ' .
                        'WHERE idx > ' . $idx;
                $res = $connection->update($sql);
                
                return TRUE;
        }
        
        
        function removeProductAttributeLinks ()
        {
                $sql = 'DELETE FROM product_global_attribute_link ' .
                        'WHERE attribute_id = ' . $this->getId();
                $connection =& $this->getConnection();
                $res = $connection->delete($sql);
                
                return TRUE;
        }
        
        
        function &getGroup ()
        {
                return ProductGlobalProductAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
        }
}

?>
