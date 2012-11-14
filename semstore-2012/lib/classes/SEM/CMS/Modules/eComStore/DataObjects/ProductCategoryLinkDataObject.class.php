<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-10
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductCategoryLinkDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_category_link'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'category_id',
                'product_id'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'categoryId' => 'category_id',
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
        var $categoryId = NULL;
        var $productId = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductCategoryLinkDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductCategoryLinkDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductCategoryLinkDataObject0 ()
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
        
        
        function getCategoryId ()
        {
                return $this->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->categoryId = $id;
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
                $obj =& new ProductCategoryLinkDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
