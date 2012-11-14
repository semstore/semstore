<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-06-24
 * @package SEM.CMS.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ConfigurationDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'configuration'; }
        function PRIMARY_KEY () { return 'parameter_name'; }
        
        function FIELD_LIST () { return array(
                'parameter_name',
                'parameter_value',
                'parameter_label',
                'description',
                'type',
                'idx',
                'group_id'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'parameter_name',
                'value' => 'parameter_value',
                'name' => 'parameter_label',
                'description' => 'description',
                'type' => 'type',
                'index' => 'idx',
                'groupId' => 'group_id'
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
        
        
	var $id = '';
        var $value = '';
        var $name = '';
        var $description = '';
        var $type = '';
        var $index = '';
        
        
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
        
        
        function ConfigurationDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ConfigurationDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ConfigurationDataObject0 ()
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
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
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
        
        
        function getType ()
        {
                return $this->type;
        }
        
        
        function setType ( $type )
        {
                $this->type = $type;
        }
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        function setIndex ( $index )
        {
                $this->index = $index;
        }
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function setGroupId ( $groupId )
        {
                $this->groupId = $groupId;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ConfigurationDataObject();
                
                return $obj;
        }
}

?>
