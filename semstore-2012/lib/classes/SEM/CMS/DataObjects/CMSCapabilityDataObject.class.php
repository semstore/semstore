<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class CMSCapabilityDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'cms_capability'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'name',
                'label',
                'description',
                'group_id',
                'idx'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name',
                'label' => 'label',
                'description' => 'description',
                'groupId' => 'group_id',
                'index' => 'idx'
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
        var $name = '';
        var $label = '';
        var $description = '';
        var $groupId = NULL;
        var $index = NULL;
        
        
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
        
        
        function CMSCapabilityDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSCapabilityDataObject'.$numArgs),
                        $args);
        }
        
        
        function _CMSCapabilityDataObject0 ()
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
        
        
        function getLabel ()
        {
                return $this->label;
        }
        
        
        function setLabel ( $label )
        {
                $this->label = $label;
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $description )
        {
                $this->description = $description;
        }
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function setGroupId ( $groupId )
        {
                $this->groupId = $groupId;
        }
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        function setIndex ( $index )
        {
                $this->index = $index;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new CMSCapabilityDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
