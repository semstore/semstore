<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package Sites.AES.DataObjects
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/product_gallery_imageDataObject.class.php');

class ProductGalleryImage extends SEMObject
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
        
        
        function ProductGalleryImage ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductGalleryImage'.$numArgs),
                        $args);
        }
        
        
        function _ProductGalleryImage0 ()
        {
                $this->_initialise();
                $do =& new Product_Gallery_ImageDataObject();
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
        
        function getIdx ()
        {
                return $this->cachedDataObject->getIdx();
        }
        
        
        function setIdx ( $id )
        {
                $this->cachedDataObject->setIdx($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        function getThumbnail ()
        {
                return $this->cachedDataObject->getThumbnail();
        }
        
        
        function setThumbnail ( $thumbnail )
        {
                $this->cachedDataObject->setThumbnail($thumbnail);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        function setImage ( $image )
        {
                $this->cachedDataObject->setImage($image);
                $this->_setCachedDataObjectChanged(TRUE);
        }        
        
        function getImage ()
        {
                return $this->cachedDataObject->getImage();
        }
        
        
        function getGalleryId ()
        {
                return $this->cachedDataObject->getGallery_Id();
        }
        
        
        function setGalleryId ( $id )
        {
                $this->cachedDataObject->setGallery_Id($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new Product_Gallery_ImageDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $categories = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $category =& new ProductGalleryImage();
                        $category->setConnection($connection);
                        $category->_setCachedDataObject($do);
                        $categories[] =& $category;
                }
                
                return $categories;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new Product_Gallery_ImageDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $category =& new ProductGalleryImage();
                $category->setConnection($connection);
                $category->_setCachedDataObject($do);
                
                return $category;
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
                        $this->_commitGalleryDetails();
                }
                
                return TRUE;
        }
        
        
        function _commitGalleryDetails ()
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
        
        
        function remove ()
        {
                if ( !is_object($this->cachedDataObject) )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
        
}

?>
