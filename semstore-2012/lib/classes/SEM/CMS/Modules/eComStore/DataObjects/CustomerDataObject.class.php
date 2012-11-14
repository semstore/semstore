<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class CustomerDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'customer'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
                'firstname',
                'surname',
                'title',
                'company_name',
                'building_name',
                'building_number',
                'street',
                'area',
                'city',
                'county',
                'country',
                'postcode',
                'email',
                'username',
                'password'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'firstname' => 'firstname',
                'surname' => 'surname',
                'title' => 'title',
                'companyName' => 'company_name',
                'buildingName' => 'building_name',
                'buildingNumber' => 'building_number',
                'street' => 'street',
                'area' => 'area',
                'city' => 'city',
                'county' => 'county',
                'country' => 'country',
                'postcode' => 'postcode',
                'email' => 'email',
                'username' => 'username',
                'password' => 'password'
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
        var $firstname = '';
        var $surname = '';
        var $title = '';
        var $companyName = '';
        var $buildingName = '';
        var $buildingNumber = '';
        var $street = '';
        var $area = '';
        var $city = '';
        var $county = '';
        var $country = '';
        var $postcode = '';
        var $email = '';
        var $username = '';
        var $password = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function CustomerDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerDataObject'.$numArgs),
                        $args);
        }
        
        
        function _CustomerDataObject0 ()
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
        
        
        function setFirstname ( $name )
        {
                $this->firstname = $name;
        }
        
        
        function getSurname ()
        {
                return $this->surname;
        }
        
        
        function setSurname ( $name )
        {
                $this->surname = $name;
        }
        
        
        function getTitle ()
        {
                return $this->title;
        }
        
        
        function setTitle ( $title )
        {
                $this->title = $title;
        }
        
        
        function getCompanyName ()
        {
                return $this->companyName;
        }
        
        
        function setCompanyName ( $company )
        {
                $this->companyName = $company;
        }
        
        
        function getBuildingName ()
        {
                return $this->buildingName;
        }
        
        
        function setBuildingName ( $building )
        {
                $this->buildingName = $building;
        }
        
        
        function getBuildingNumber ()
        {
                return $this->buildingNumber;
        }
        
        
        function setBuildingNumber ( $number )
        {
                $this->buildingNumber = $number;
        }
        
        
        function getStreet ()
        {
                return $this->street;
        }
        
        
        function setStreet ( $street )
        {
                $this->street = $street;
        }
        
        
        function getArea ()
        {
                return $this->area;
        }
        
        
        function setArea ( $area )
        {
                $this->area = $area;
        }
        
        
        function getCity ()
        {
                return $this->city;
        }
        
        
        function setCity ( $city )
        {
                $this->city = $city;
        }
        
        
        function getCounty ()
        {
                return $this->county;
        }
        
        
        function setCounty ( $county )
        {
                $this->county = $county;
        }
        
        
        function getCountry ()
        {
                return $this->country;
        }
        
        
        function setCountry ( $country )
        {
                $this->country = $country;
        }
        
        
        function getPostcode ()
        {
                return $this->postcode;
        }
        
        
        function setPostcode ( $postcode )
        {
                $this->postcode = $postcode;
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
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new CustomerDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
