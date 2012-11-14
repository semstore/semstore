<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/CustomerDataObject.class.php');

class Customer extends SEMObject
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
        
        
        function Customer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Customer'.$numArgs),
                        $args);
        }
        
        
        function _Customer0 ()
        {
                $this->_initialise();
                $do =& new CustomerDataObject();
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
        
        
        function getTitle ()
        {
                return $this->cachedDataObject->getTitle();
        }
        
        
        function setTitle ( $title )
        {
                $this->cachedDataObject->setTitle($title);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getCompanyName ()
        {
                return $this->cachedDataObject->getCompanyName();
        }
        
        
        function setCompanyName ( $company )
        {
                $this->cachedDataObject->setCompanyName($company);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getBuildingName ()
        {
                return $this->cachedDataObject->getBuildingName();
        }
        
        
        function setBuildingName ( $building )
        {
                $this->cachedDataObject->setBuildingName($building);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getBuildingNumber ()
        {
                return $this->cachedDataObject->getBuildingNumber();
        }
        
        
        function setBuildingNumber ( $number )
        {
                $this->cachedDataObject->setBuildingNumber($number);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getStreet ()
        {
                return $this->cachedDataObject->getStreet();
        }
        
        
        function setStreet ( $street )
        {
                $this->cachedDataObject->setStreet($street);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getArea ()
        {
                return $this->cachedDataObject->getArea();
        }
        
        
        function setArea ( $area )
        {
                $this->cachedDataObject->setArea($area);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getCity ()
        {
                return $this->cachedDataObject->getCity();
        }
        
        
        function setCity ( $city )
        {
                $this->cachedDataObject->setCity($city);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getCounty ()
        {
                return $this->cachedDataObject->getCounty();
        }
        
        
        function setCounty ( $county )
        {
                $this->cachedDataObject->setCounty($county);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getCountry ()
        {
                return $this->cachedDataObject->getCountry();
        }
        
        
        function setCountry ( $country )
        {
                $this->cachedDataObject->setCountry($country);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getPostcode ()
        {
                return $this->cachedDataObject->getPstcode();
        }
        
        
        function setPostcode ( $postcode )
        {
                $this->cachedDataObject->setPostcode($postcode);
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
        
        
        function setPassword ( $password )
        {
                $this->cachedDataObject->setPassword($password);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new CustomerDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $customers = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $customer =& new Customer();
                        $customer->setConnection($connection);
                        $customer->_setCachedDataObject($do);
                        $customers[] =& $customer;
                }
                
                return $customers;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new CustomerDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $customer =& new Customer();
                $customer->setConnection($connection);
                $customer->_setCachedDataObject($do);
                
                return $customer;
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
                        ;
                }
                
                return TRUE;
        }
}

?>
