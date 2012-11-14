<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-26
 * @package SEM.MySEM.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class UserDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
	function TABLE () { return 'user'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'firstname',
                'surname',
                'email',
                'username',
                'password'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'firstname' => 'firstname',
                'surname' => 'surname',
                'email' => 'email',
                'username' => 'username',
                'password' => 'password'
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
        var $firstname = '';
        var $surname = '';
        var $email = '';
        var $username = '';
        var $password = '';
        
        
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
        
        
        function getUsername ()
        {
                return $this->username;
        }
        
        
        function setUsername ( $username )
        {
                $this->username = $username;
        }
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new UserDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
