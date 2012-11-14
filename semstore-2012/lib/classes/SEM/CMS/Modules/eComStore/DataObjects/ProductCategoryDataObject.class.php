<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-10
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductCategoryDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_category'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'name',
                'description',
                'image',
                'idx',
                'parent_id',
                'lft',
                'rgt'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
                'image' => 'image',
                'index' => 'idx',
                'parentId' => 'parent_id',
                'left' => 'lft',
                'right' => 'rgt'
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
        var $name = '';
        var $description = '';
        var $image = '';
        var $index = NULL;
        var $parentId = NULL;
        var $left = NULL;
        var $right = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductCategoryDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductCategoryDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductCategoryDataObject0 ()
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
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function setName ( $name )
        {
                $this->name = $name;
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $description )
        {
                $this->description = $description;
        }
        
        
        function getImage ()
        {
                return $this->image;
        }
        
        
        function setImage ( $image )
        {
                $this->image = $image;
        }
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        function setIndex ( $index )
        {
                $this->index = $index;
        }
        
        
        function getParentId ()
        {
                return $this->parentId;
        }
        
        
        function setparentId ( $id )
        {
                $this->parentId = $id;
        }
        
        
        function getLeft ()
        {
                return $this->left;
        }
        
        
        function setLeft ( $left )
        {
                $this->left = $left;
        }
        
        
        function getRight ()
        {
                return $this->right;
        }
        
        
        function setRight ( $right )
        {
                $this->right = $right;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductCategoryDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
