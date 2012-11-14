<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.CMS.Drivers.DBDriver.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class UserDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'user'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'password',
                'firstname',
                'surname',
                'email',
                'timstamp'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'password' => 'password',
                'firstname' => 'firstname',
                'surname' => 'surname',
                'email' => 'email',
                'timestamp' => 'timestamp'
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
        var $password = '';
        var $firstname = '';
        var $surname = '';
        var $email = '';
        var $timestamp = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function UserDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_UserDataObject'.$numArgs),
                        $args);
        }
        
        
        function _UserDataObject0 ()
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
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        function getFirstname ()
        {
                return $this->firstname;
        }
        
        
        function setFirstname ( $firstname )
        {
                $this->firstname = $firstname;
        }
        
        
        function getSurname ()
        {
                return $this->surname;
        }
        
        
        function setSurname ( $surname )
        {
                $this->surname = $surname;
        }
        
        
        function getEmail ()
        {
                return $this->email;
        }
        
        
        function setEmail ( $email )
        {
                $this->email = $email;
        }
        
        
        function getTimestamp ()
        {
                return $this->timestamp;
        }
        
        
        function setTimestamp ( $timestamp )
        {
                $this->timestamp = $timestamp;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new UserDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->id = $connection->getLastInsertId();
        }
}

?>
