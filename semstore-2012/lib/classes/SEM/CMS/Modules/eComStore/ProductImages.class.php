<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SE.AES
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductImagesDataObject.class.php');

class ProductImages extends SEMObject
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
        
        
        function ProductImages ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductImages'.$numArgs),
                        $args);
        }
        
        
        function _ProductImages0 ()
        {
                $this->_initialise();
                $do =& new ProductImagesDataObject();
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
        
        
        function getBrowserThumbnailImage ()
        {
                return $this->cachedDataObject->getBrowserThumbnailImage();
        }
        
        
        function setBrowserThumbnailImage ( $image )
        {
                $this->cachedDataObject->setBrowserThumbnailImage($image);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getProductDetailsPageImage ()
        {
                return $this->cachedDataObject->getProductDetailsPageImage();
        }
        
        
        function setProductDetailsPageImage ( $image )
        {
                $this->cachedDataObject->setProductDetailsPageImage($image);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getBasketImage ()
        {
                return $this->cachedDataObject->getBasketImage();
        }
        
        
        function setBasketImage ( $image )
        {
                $this->cachedDataObject->setBasketImage($image);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getProductImage ()
        {
                return $this->cachedDataObject->getProductImage();
        }
        
        
        function setProductImage ( $image )
        {
                $this->cachedDataObject->setProductImage($image);
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
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductImagesDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $productImagesArr = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $productImages =& new ProductImages();
                        $productImages->_setCachedDataObject($do);
                        $productImages->setConnection($connection);
                        $products[] =& $productImages;
                }
                
                return $productImagesArr;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductImagesDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $productImages =& new ProductImages();
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
