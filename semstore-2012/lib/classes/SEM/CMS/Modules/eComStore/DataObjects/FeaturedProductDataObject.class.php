<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-24
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class FeatureProductDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'featured_product'; }
	function PRIMARY_KEY () { return 'id'; }
	
        function FIELD_LIST () { return array(
                'id',
                'product_id',
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'productId' => 'product_id',
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
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
        
        
	var $id = NULL;
	var $productId = NULL;
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Constructors
         *
	 */
	
	
        function FeatureProductDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_FeatureProductDataObject'.
                                $numArgs),
                        $args);
        }
        
        
        function _FeatureProductDataObject0 ()
        {
                $this->_initialize();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
	
	
	function getId()
	{	
		return $this->id;
	}
        
        
        function setId( $id )
	{	
		$this->id = $id;
	}
        
	
	function getProductId()
	{	
		return $this->productId;
	}
        
        
        function setProductId( $productId )
	{	
		$this->productId = $productId;
	}
	

        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new FeatureProductDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setid($connection->getLastInsertId());
        }
}

?>
