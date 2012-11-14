<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/DataObjects/CMSCapabilityDataObject.class.php');

class CMSCapability extends SEMObject
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
        
        
        function CMSCapability ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSCapability'.$numArgs),
                        $args);
        }
        
        
        function _CMSCapability0 ()
        {
                $this->_initialise();
                $do =& new CMSCapabilityDataObject();
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
        
        
        function getLabel ()
        {
                return $this->cachedDataObject->getLabel();
        }
        
        
        function setLabel ( $label )
        {
                $this->cachedDataObject->setId($label);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getDescription ()
        {
                return $this->cachedDataObject->getDescription();
        }
        
        
        function setDescription ( $description )
        {
                $this->cachedDataObject->setId($description);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getGroupId ()
        {
                return $this->cachedDataObject->getGroupId();
        }
        
        
        function setGroupId ( $groupId )
        {
                $this->cachedDataObject->setId($groupId);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getIndex ()
        {
                return $this->cachedDataObject->getIndex();
        }
        
        
        function setIndex ( $index )
        {
                $this->cachedDataObject->setId($index);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new CMSCapabilityDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $capabilities = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $capability =& new CMSCapability();
                        $capability->_setCachedDataObject($do);
                        $capability->setConnection($connection);
                        $capabilities[] =& $capability;
                }
                
                return $capabilities;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CMSCapabilityDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $capability =& new CMSCapability();
                $capability->_setCachedDataObject($do);
                $capability->setConnection($connection);
                
                return $capability;
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
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        $this->removeGlobalAttributes();
                        $this->removeTypeAttributes();
                        $this->removeFromCategories();
                }
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
        
        
        function &getGroup ()
        {
                return NULL;
        }
        
        
        function setGroup ( &$group )
        {
                return FALSE;
        }
}

?>
