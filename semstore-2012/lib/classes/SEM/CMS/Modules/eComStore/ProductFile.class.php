<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductFileDataObject.class.php');

class ProductFile extends SEMObject
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
        
        
        function ProductFile ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductFile'.$numArgs),
                        $args);
        }
        
        
        function _ProductFile0 ()
        {
                $this->_initialise();
                $do =& new ProductFileDataObject();
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
        
        function getProductId ()
        {
                return $this->cachedDataObject->getProductId();
        }
        
        
        function setProductId ( $id )
        {
                $this->cachedDataObject->setProductId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getFilename ()
        {
                return $this->cachedDataObject->getFilename();
        }
        
        
        function setFilename ( $filename )
        {
                $this->cachedDataObject->setFilename($filename);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getHFID ()
        {
                return $this->cachedDataObject->getHFID();
        }
        
        
        function setHFID ( $hfid )
        {
                $this->cachedDataObject->setHFID($hfid);
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
                $DO =& new ProductFileDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $ProductFiles = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $ProductFile =& new ProductFile();
                        $ProductFile->setConnection($connection);
                        $ProductFile->_setCachedDataObject($do);
                        $ProductFiles[] =& $ProductFile;
                }
                
                return $ProductFiles;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductFileDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $ProductFile =& new ProductFile();
                $ProductFile->setConnection($connection);
                $ProductFile->_setCachedDataObject($do);
                
                return $ProductFile;
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
                        $this->_commitProductFileDetails();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commitProductFileDetails ()
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
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
}

?>
