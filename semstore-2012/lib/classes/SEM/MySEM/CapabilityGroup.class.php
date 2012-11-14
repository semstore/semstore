<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-26
 * @package SEM.MySEM
 */

require_once('SEMObject.class.php');

require_once('SEM/MySEM/DataObjects/CapabilityGroupDataObject.class.php');
require_once('SEM/MySEM/DataObjects/CapabilityGroupLinkDataObject.class.php');

class CapabilityGroup extends SEMObject
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
        
        
        function CapabilityGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CapabilityGroup'.$numArgs),
                        $args);
        }
        
        
        function _CapabilityGroup0 ()
        {
                $this->_initialise();
                $do =& new CapabilityGroupDataObject();
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
                $this->cachedDataObject->setLabel($label);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getDescription ()
        {
                return $this->cachedDataObject->getDescription();
        }
        
        
        function setDescription ( $description )
        {
                $this->cachedDataObject->setDescription($description);
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
                $DO =& new CapabilityGroupDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $capabilityGroups = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $capabilityGroup =& new CapabilityGroup();
                        $capabilityGroup->_setCachedDataObject($do);
                        $capabilityGroup->setConnection($connection);
                        $capabilityGroups[] =& $capabilityGroup;
                }
                
                return $capabilityGroups;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CapabilityGroupDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $capabilityGroup =& new CapabilityGroup();
                $capabilityGroup->_setCachedDataObject($do);
                $capabilityGroup->setConnection($connection);
                
                return $capabilityGroup;
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
                        $this->removeGlobalAttributes();
                        $this->removeTypeAttributes();
                        $this->removeFromCategories();
                }
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
        
        
        function &getCapabilities ()
        {
                return Capability::find(
                        'FROM capability_group_link, capability WHERE capability_group_link.group_id = ' .
                        $this->getId() . ' AND capability_group_link.capability_id = ' .
                        'capability.id ORDER BY capability.idx',
                        $this->getConnection());
        }
        
        
        function addCapability ( &$capability )
        {
                $DO_CLASS =& new CapabilityGroupLinkDataObject();
                $do =& $DO_CLASS->lookup(
                        array('capability_id' => $capability->getId(),
                                'group_id' => $this->getId()),
                        $this->getConnection());
                if ( !is_null($do) )
                {
                        return TRUE;
                }
                
                $link =& new CapabilityGroupLinkDataObject();
                $link->setCapabilityId($capability->getId());
                $link->setGroupId($this->getId());
                $link->setConnection($this->getConnection());
                $link->store();
                
                return TRUE;
        }
}

?>
