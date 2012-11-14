<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductTypeAttributeGroupDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeAttribute.class.php');

class ProductTypeAttributeGroup extends SEMObject
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
        
        var $id = NULL;
        var $name = '';
        var $index = NULL;
        var $typeId = NULL;
        var $productId = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ProductTypeAttributeGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductTypeAttributeGroup'.$numArgs),
                        $args);
        }
        
        
        function _ProductTypeAttributeGroup0 ()
        {
                $this->_initialise();
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
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        function setIndex ( $index )
        {
                $this->index = $index;
        }
        
        
        function getTypeId ()
        {
                return $this->typeId;
        }
        
        
        function setTypeId ( $id )
        {
                $this->typeId = $id;
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
         *
	 * Class Methods
         *
	 */
        
        
        function &getGroups ( $product, $type, &$connection )
        {
                $groups = array();
                
                $sql = 'WHERE type_id = ' .
                        $type->getId() .
                        ' ORDER BY idx';
                $PTAGDO_CLASS =& new ProductTypeAttributeGroupDataObject();
                $tempGroups =& $PTAGDO_CLASS->lookupArray(
                        $sql,
                        $connection );
                foreach ( array_keys($tempGroups) as $index )
                {
                        $tempGroup =& $tempGroups[$index];
                        
                        $group =& new ProductTypeAttributeGroup();
                        $group->setConnection($connection);
                        $group->id = $tempGroup->getId();
                        $group->name = $tempGroup->getName();
                        $group->index = $tempGroup->getIndex();
                        $group->typeId = $tempGroup->getTypeId();
                        $group->productId = $product->getId();
                        $groups[] =& $group;
                }
                
                return $groups;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &getAttributes ()
        {
                $product =& Product::findFirst(
                        array('id' => $this->getProductId()),
                        $this->getConnection() );
                
                return ProductTypeAttribute::getAttributes(
                        $product, $this, $this->getConnection() );
        }
        
        
        function remove ( $maintainIntegrity = TRUE )
        {
                $attributes =& $this->getAttributes();
                foreach ( array_keys($attributes) as $index )
                {
                        $attribute =& $attributes[$index];
                        $attribute->remove();
                }
        }
        
        
        function &getAttributeWithName ( $name )
        {
                $attributes =& $this->getAttributes();
                
                foreach ( array_keys($attributes) as $key )
                {
                        $attribute =& $attributes[$key];
                        if ( $attribute->getName() == $name )
                        {
                                return $attribute;
                        }
                }
                
                return NULL;
        }
}

?>
