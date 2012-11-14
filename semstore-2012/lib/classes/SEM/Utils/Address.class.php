<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-12-16
 * @package SEM.Utils
 */

require_once('SEMObject.class.php');

class Address extends SEMObject
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
        
        
        var $buildingName = '';
        var $buildingNumber = '';
        var $street = '';
        var $area = '';
        var $city = '';
        var $county = '';
        var $country = '';
        var $postcode = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function Address ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Address'.$numArgs),
                        $args);
        }
        
        
        function _Address0 ()
        {
                $this->_initialise();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
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
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
