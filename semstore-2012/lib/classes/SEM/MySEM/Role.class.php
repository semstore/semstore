<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-26
 * @package SEM.MySEM
 */

require_once('SEMObject.class.php');

require_once('Utils/ObjectArrayIterator.class.php');
require_once('SEM/MySEM/MySEMException.class.php');
require_once('SEM/MySEM/DataObjects/RoleDataObject.class.php');
require_once('SEM/MySEM/DataObjects/RoleCapabilityLinkDataObject.class.php');

class Role extends SEMObject
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
        
        
        function Role ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Role'.$numArgs),
                        $args);
        }
        
        
        function _Role0 ()
        {
                $this->_initialise();
                $do =& new RoleDataObject();
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
                $DO =& new RoleDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $roles = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $role =& new Role();
                        $role->_setCachedDataObject($do);
                        $role->setConnection($connection);
                        $roles[] =& $role;
                }
                
                return $role;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new RoleDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $role =& new Role();
                $role->_setCachedDataObject($do);
                $role->setConnection($connection);
                
                return $role;
        }
        
        
        function &create ()
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
        
        
        function &_getCapabilityLinks ()
        {
                $DO_CLASS =& new RoleCapabilityLinkDataObject();
                $links =& $DO_CLASS->lookupArray(
                        array('role_id' => $this->getId()),
                        $this->getConnection());
                if ( is_null($links) )
                {
                        return NULL;
                }
                
                if ( MySEMException::isException($links) )
                {
                        return $links;
                }
                
                return $links;
        }
        
        
        function &getCapabilities ()
        {
                $links =& $this->_getCapabilityLinks();
                
                if ( is_null($links) )
                {
                        return NULL;
                }
                
                if ( MySEMException::isException($links, '') )
                {
                        die($link->toString());
                }
                
                $capabilities = array();
                $iterator =& new ObjectArrayIterator($links);
                while ( $iterator->hasNext() )
                {
                        $link =& $iterator->next();
                        $capability =& MySEMCapability::findFirst(
                                array('id' => $link->getCapabilityId()),
                                $this->getConnection());
                        if ( is_null($capability) )
                        {
                                continue;
                        }
                        
                        $capabilities[] =& $capability;
                }
                
                return $capabilities;
        }
        
        
        function grantCapability ( &$capability )
        {
                $DO_CLASS =& new RoleCapabilityLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('role_id' => $this->getId(),
                                'capability_id' => $capability->getId()),
                        $this->getConnection());
                
                if ( !is_null($link) )
                {
                        return TRUE;
                }
                
                $link =& new RoleCapabilityLinkDataObject();
                $link->setConnection($this->getConnection());
                $link->setRoleId($this->getId());
                $link->setCapabilityId($capability->getId());
                $link->store();
                
                return TRUE;
        }
        
        
        function revokeCapability ( &$capability )
        {
                $DO_CLASS =& new RoleCapabilityLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('role_id' => $this->getId(),
                                'capability_id' => $capability->getId()),
                        $this->getConnection());
                
                if ( is_null($link) )
                {
                        return TRUE;
                }
                
                $link->delete();
                
                return TRUE;
        }
}

?>
