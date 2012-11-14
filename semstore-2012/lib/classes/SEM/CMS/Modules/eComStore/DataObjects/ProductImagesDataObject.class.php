<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductImagesDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_images'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'browser_thumbnail',
                'details_page_thumbnail',
                'basket_image',
                'master_image',
                'product_id',
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'browserThumbnailImage' => 'browser_thumbnail',
                'productDetailsPageImage' => 'details_page_thumbnail',
                'basketImage' => 'basket_image',
                'productImage' => 'master_image',
                'productId' => 'product_id'
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
        /*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $id = NULL;
        var $browserThumbnailImage = '';
        var $productDetailsPageImage = '';
        var $basketImage = '';
        var $productImage = '';
        var $productId = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductImagesDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductImagesDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductImagesDataObject0 ()
        {
                $this->_initialize();
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
        }
        
        
        function getBrowserThumbnailImage ()
        {
                return $this->browserThumbnailImage;
        }
        
        
        function setBrowserThumbnailImage ( $image )
        {
                $this->browserThumbnailImage = $image;
        }
        
        
        function getProductDetailsPageImage ()
        {
                return $this->productDetailsPageImage;
        }
        
        
        function setProductDetailsPageImage ( $image )
        {
                $this->productDetailsPageImage = $image;
        }
        
        
        function getBasketImage ()
        {
                return $this->basketImage;
        }
        
        
        function setBasketImage ( $image )
        {
                $this->basketImage = $image;
        }
        
        
        function getProductImage ()
        {
                return $this->productImage;
        }
        
        
        function setProductImage ( $image )
        {
                $this->productImage = $image;
        }
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductImagesDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
