<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS
 */

require_once('SEMObject.class.php');

require_once('CMSException.class.php');
require_once('Utils/ObjectArrayIterator.class.php');
require_once('SEM/CMS/CMSRole.class.php');
require_once('SEM/CMS/CMSCapability.class.php');
require_once('SEM/CMS/DataObjects/CMSUserDataObject.class.php');
require_once('SEM/CMS/DataObjects/CMSUserRoleLinkDataObject.class.php');

class CMSUser extends SEMObject
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
        
        
        function CMSUser ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSUser'.$numArgs),
                        $args);
        }
        
        
        function _CMSUser0 ()
        {
                $this->_initialise();
                $do =& new CMSUserDataObject();
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
        
        
        function getFirstname ()
        {
                return $this->cachedDataObject->getFirstname();
        }
        
        
        function setFirstname ( $name )
        {
                $this->cachedDataObject->setFirstname($name);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getSurname ()
        {
                return $this->cachedDataObject->getSurname();
        }
        
        
        function setSurname ( $name )
        {
                $this->cachedDataObject->setSurname($name);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getEmail ()
        {
                return $this->cachedDataObject->getEmail();
        }
        
        
        function setEmail ( $email )
        {
                $this->cachedDataObject->setEmail($email);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getUsername ()
        {
                return $this->cachedDataObject->getUsername();
        }
        
        
        function setUsername ( $username )
        {
                $this->cachedDataObject->setUsername($username);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getPassword ()
        {
                return $this->cachedDataObject->getPassword();
        }
        
        
        function setPassword ( $pass )
        {
                $this->cachedDataObject->setPassword($pass);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new CMSUserDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $users = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $user =& new CMSUser();
                        $user->_setCachedDataObject($do);
                        $user->setConnection($connection);
                        $users[] =& $user;
                }
                
                return $users;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CMSUserDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $user =& new CMSUser();
                $user->_setCachedDataObject($do);
                $user->setConnection($connection);
                
                return $user;
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
        
        
        function &_getRoleLink ()
        {
                $DO_CLASS =& new CMSUserRoleLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('user_id' => $this->getId()),
                        $this->getConnection());
                if ( is_null($link) )
                {
                        return NULL;
                }
                
                if ( CMSException::isException($link) )
                {
                        return $link;
                }
                
                return $link;
        }
        
        
        function &getRole ()
        {
                $link =& $this->_getRoleLink();
                
                if ( is_null($link) )
                {
                        return NULL;
                }
                
                if ( CMSException::isException($link, '') )
                {
                        die($link->toString());
                }
                
                $role =& CMSRole::findFirst(
                        array('id' => $link->getRoleId()),
                        $this->getConnection());
                
                return $role;
        }
        
        
        function setRole ( &$role )
        {
                $DO_CLASS =& new CMSUserRoleLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('user_id' => $this->getId()),
                        $this->getConnection());
                if ( is_null($link) )
                {
                        $link =& new CMSUserRoleLinkDataObject();
                        $link->setConnection($this->getConnection());
                        $link->setUserId($this->getId());
                }
                
                $link->setRoleId($role->getId());
                $link->store();
                
                return TRUE;
        }
        
        
        function &getCapabilities ()
        {
                $role =& $this->getRole();
                
                if ( is_null($role) )
                {
                        return NULL;
                }
                
                
                if ( CMSException::isException($role) )
                {
                        return $role;
                }
                
                $capabilities =& $role->getCapabilities();
                
                if ( is_null($capabilities) )
                {
                        return NULL;
                }
                
                if ( is_array($capabilities) && count($capabilities) == 0 )
                {
                        return NULL;
                }
                
                if ( CMSException::isException($capabilities) )
                {
                        return $capabilities;
                }
                
                return $capabilities;
        }
        
        
        function hasCapability ( $capability )
        {
                if ( is_scalar($capability) )
                {
                        return call_user_func_array(
                                array(&$this, '_hasCapabilityWithId'),
                                array($capability));
                }
                elseif ( is_object($capability) )
                {
                        return call_user_func_array(
                                array(&$this, '_hasCapabilityObject'),
                                array($capability));
                }
                
                die('Parameter was not a string or and object');
        }
        
        
        function _hasCapabilityWithId ( $capabilityName )
        {
                $capabilities =& $this->getCapabilities();
                
                if ( CMSException::isException($capabilities) )
                {
                        die($capabilities->toString());
                }
                
                
                if ( is_null($capabilities) )
                {
                        return FALSE;
                }
                
                $iterator =& new ObjectArrayIterator($capabilities);
                while ( $iterator->hasNext() )
                {
                        $capability =& $iterator->next();
                        if ( $capability->getName() == $capabilityName )
                        {
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function _hasCapabilityObject ( &$capabilityObj )
        {
                $capabilities =& $this->getCapabilities();
                
                if ( CMSException::isException($capabilities) )
                {
                        die($capabilities->toString());
                }
                
                
                if ( is_null($capabilities) )
                {
                        return FALSE;
                }
                
                $iterator =& new ObjectArrayIterator($capabilities);
                while ( $iterator->hasNext() )
                {
                        $capability =& $iterator->next();
                        if ( $capability->getId() == $capabilityObj->getId() )
                        {
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function grantCapability ( &$capability )
        {
                $role =& $this->getRole();
                return $role->grantCapability($capability);
        }
        
        
        function revokeCapability ( &$capability )
        {
                $role =& $this->getRole();
                return $role->revokeCapability($capability);
        }
}

?>
