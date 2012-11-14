<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-06-24
 * @package SEM.CMS.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ConfigurationGroupDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'configuration_group'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'name'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name'
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
        var $name = '';
        
        
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
        
        
        function ConfigurationGroupDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ConfigurationGroupDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ConfigurationGroupDataObject0 ()
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
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ConfigurationGroupDataObject();
                
                return $obj;
        }
}

?>
