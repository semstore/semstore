<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SE.AES
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductPDFDataObject.class.php');

class ProductPDF extends SEMObject
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
        
        
        function ProductPDF ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductPDF'.$numArgs),
                        $args);
        }
        
        
        function _ProductPDF0 ()
        {
                $this->_initialise();
                $do =& new ProductPDFDataObject();
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
                
		function getPDF ( )
		{
				return $this->cachedDataObject->pdf;
		}
		
		function setPDF ( $pdf )
		{
				$this->cachedDataObject->setPDF($pdf);
				$this->_setCachedDataObjectChanged(TRUE);
		}
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductPDFDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $productImagesArr = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $productImages =& new ProductPDF();
                        $productImages->_setCachedDataObject($do);
                        $productImages->setConnection($connection);
                        $products[] =& $productImages;
                }
                
                return $productImagesArr;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductPDFDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $productImages =& new ProductPDF();
                $productImages->_setCachedDataObject($do);
                $productImages->setConnection($connection);
                
                return $productImages;
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
                // -- None to remove --
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
}

?>
