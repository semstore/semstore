<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'code',
                'type_id',
                'name',
                'description',
                'price',
                'vat_status',
                'dt_added',
                'on_sale',
                'parent_id'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'code' => 'code',
                'typeId' => 'type_id',
                'name' => 'name',
                'description' => 'description',
                'price' => 'price',
                'vatStatus' => 'vat_status',
                'dateTimeAdded' => 'dt_added',
                'onSale' => 'on_sale',
                'parentId' => 'parent_id'
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
        var $code = '';
        var $typeId = NULL;
        var $name = '';
        var $description = '';
        var $price = 0;
        var $vatStatus = 1;
        var $dateTimeAdded = NULL;
        var $parentId = NULL;
        var $onSale = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductDataObject0 ()
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
        
        
        function getCode ()
        {
                return $this->code;
        }
        
        
        function setCode ( $code )
        {
                $this->code = $code;
        }
        
        
        function getTypeId ()
        {
                return $this->typeId;
        }
        
        
        function setTypeId ( $id )
        {
                $this->typeId = $id;
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
        
        
        function getPrice ()
        {
                return $this->price;
        }
        
        
        function setPrice ( $price )
        {
                $this->price = $price;
        }
        
        
        function getVatStatus ()
        {
                return $this->vatStatus;
        }
        
        
        function setVatStatus ( $status )
        {
                $this->vatStatus = $status;
        }
        
        
        function getDateTimeAdded ()
        {
                return $this->dateTimeAdded;
        }
        
        
        function setDateTimeAdded ( $dtAdded )
        {
                $this->dateTimeAdded = $dtAdded;
        }
        
        
        function getParentId ()
        {
                return $this->parentId;
        }
        
        
        function setParentId ( $id )
        {
                $this->parentId = $id;
        }
        
        
        function getOnSale ()
        {
                return $this->onSale;
        }
        
        
        function setOnSale ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->onSale = 1;
                }
                else
                {
                        $this->onSale = 0;
                }
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
