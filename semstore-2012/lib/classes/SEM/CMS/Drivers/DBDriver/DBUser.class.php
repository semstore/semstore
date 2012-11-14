<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Drivers.DBDriver
 */

require_once('SEM/CMS/User.class.php');

require_once('SEM/CMS/Drivers/DBDriver/DataObjects/UserDataObject.class.php');

class DBUser extends User
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
        
        
        var $driver = NULL;
        var $cachedDataObject = NULL;
        var $attributesChanged = FALSE;
        var $id = NULL;
        var $name = '';
        var $description = '';
        var $timestamp = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function DBUser ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_DBUser'.$numArgs),
                        $args);
        }
        
        
        function _DBUser0 ()
        {
                $this->_initialise();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getDriver ()
        {
                return $this->driver;
        }
        
        
        function setDriver ( &$driver )
        {
                $this->driver =& $driver;
        }
        
        
        /*
        function &getDBConnection ()
        {
                return $this->dbConnection;
        }
        
        
        function _setDBConnection ( &$dbConnection )
        {
                $this->dbConnection =& $dbConnection;
        }
        */
        
        
        function &_getCachedDataObject ()
        {
                return $this->cachedDataObject;
        }
        
        
        function _setCachedDataObject ( &$dataObject )
        {
                $this->cachedDataObject =& $dataObject;
        }
        
        
        function getAttributesChanged ()
        {
                return $this->attributesChanged;
        }
        
        
        function _setAttributesChanged ( $bool )
        {
                $this->attributesChanged = $bool;
        }

        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
                $this->_setAttributesChanged(TRUE);
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function setName ( $name )
        {
                $this->name = $name;
                $this->_setAttributesChanged(TRUE);
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $description )
        {
                $this->description = $description;
                $this->_setAttributesChanged(TRUE);
        }
        
        
        function getTimestamp ()
        {
                return $this->timestamp;
        }
        
        
        function setTimestamp ( $timestamp )
        {
                $this->timestamp = $timestamp;
                $this->_setAttributesChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, $driver )
        {
                $dbConn =& $driver->getDBConnection();
                $PDO_CLASS =& new ProductTypeDataObject();
                
                $productTypesDOArr =&
                        $PDO_CLASS->lookupArray($criteria, $dbConn);
                        
                $productTypes = array();
                foreach ( $productTypesDOArr as $productTypeDO )
                {
                        $productType =& new DBProductType();
                        $productType->setDriver($driver);
                        $productType->setId($productTypeDO->getId());
                        $productType->setName(
                                $productTypeDO->getName());
                        $productType->setDescription(
                                $productTypeDO->getDescription());
                        $productType->setTimestamp(
                                $productTypeDO->getTimestamp());
                        $productTypes[] =& $productType;
                }
                
                return $productTypes;
        }
        
        
        function &findFirst ( $criteria, $driver )
        {
                $dbConn =& $driver->getDBConnection();
                $PDO_CLASS =& new ProductTypeDataObject();
                $productTypeDO =& $PDO_CLASS->lookup($criteria, $dbConn);
                
                $productType = NULL;
                if ( !is_null($productTypeDO) )
                {
                        $productType =& new DBProductType();
                        $productType->setDriver($driver);
                        $productType->setId($productTypeDO->getId());
                        $productType->setName(
                                $productTypeDO->getName());
                        $productType->setDescription(
                                $productTypeDO->getDescription());
                        $productType->setTimestamp(
                                $productTypeDO->getTimestamp());
                        $productTypes[] =& $productType;
                }
                
                return $productType;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function commit ()
        {
                if ( !$this->getAttributesChanged() )
                {
                        return;
                }
                
                $dataObject =& $this->getCachedDataObject();
                if ( is_null($dataObject) )
                {
                        $dataObject =& new ProductDataObject();
                        $dataObject->setConnection($this->getDBConnection());
                }
                
                $dataObject->setId($this->getId());
                $dataObject->setName($this->getName());
                $dataObject->setCode($this->getCode());
                $dataObject->setTypeId($this->type->getId());
                $dataObject->setDescription($this->getDescription());
                $dataObject->setTimestamp($this->getTimestamp());
                
                $dataObject->store();
                $this->setId($dataObject->getId());
                $this->_setCachedDataObject($dataObject);
        }
}

?>
