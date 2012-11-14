<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class CMSUserRoleLinkDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'cms_user_role_link'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'user_id',
                'role_id'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'userId' => 'user_id',
                'roleId' => 'role_id'
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
        var $userId = NULL;
        var $roleId = NULL;
        
        
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
        
        
        function CMSUserRoleLinkDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSUserRoleLinkDataObject'.$numArgs),
                        $args);
        }
        
        
        function _CMSUserRoleLinkDataObject0 ()
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
        
        
        function getUserId ()
        {
                return $this->userId;
        }
        
        
        function setUserId ( $id )
        {
                $this->userId = $id;
        }
        
        
        function getRoleId ()
        {
                return $this->roleId;
        }
        
        
        function setRoleId ( $id )
        {
                $this->roleId = $id;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new CMSUserRoleLinkDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
