<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-12
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class CustomerRegistrationWebletStateContainer extends WebletStateContainer
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
        
        
        var $view = '';
        var $formErrors = NULL;
        
        var $redirect = '';
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
        var $password2 = '';
        
        var $firstnameErrMsg = '';
        var $surnameErrMsg = '';
        var $titleErrMsg = '';
        var $companyNameErrMsg = '';
        var $buildingNameErrMsg = '';
        var $buildingNumberErrMsg = '';
        var $streetErrMsg = '';
        var $areaErrMsg = '';
        var $cityErrMsg = '';
        var $countyErrMsg = '';
        var $countryErrMsg = '';
        var $postcodeErrMsg = '';
        var $emailErrMsg = '';
        var $usernameErrMsg = '';
        var $passwordErrMsg = '';
        var $password2ErrMsg = '';
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CustomerRegistrationWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CustomerRegistrationWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _CustomerRegistrationWebletStateContainer0 ()
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
        }
        
        
        
        
        
        function getRedirect ()
        {
                return $this->redirect;
        }
        
        
        function setRedirect ( $redirect )
        {
                $this->redirect = $redirect;
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
        
        
        function getPassword2 ()
        {
                return $this->password2;
        }
        
        
        function setPassword2 ( $password )
        {
                $this->password2 = $password;
        }
        
        
        
        
        
        function getFirstnameErrMsg ()
        {
                return $this->firstnameErrMsg;
        }
        
        
        function setFirstnameErrMsg ( $errmsg )
        {
                $this->firstnameErrMsg = $errmsg;
        }
        
        
        function getSurnameErrMsg ()
        {
                return $this->surnameErrMsg;
        }
        
        
        function setSurnameErrMsg ( $errmsg )
        {
                $this->surnameErrMsg = $errmsg;
        }
        
        
        function getTitleErrMsg ()
        {
                return $this->titleErrMsg;
        }
        
        
        function setTitleErrMsg ( $errmsg )
        {
                $this->titleErrMsg = $errmsg;
        }
        
        
        function getCompanyNameErrMsg ()
        {
                return $this->companyNameErrMsg;
        }
        
        
        function setCompanyNameErrMsg ( $errmsg )
        {
                $this->companyNameErrMsg = $errmsg;
        }
        
        
        function getBuildingNameErrMsg ()
        {
                return $this->buildingNameErrMsg;
        }
        
        
        function setBuildingNameErrMsg ( $errmsg )
        {
                $this->buildingNameErrMsg = $errmsg;
        }
        
        
        function getBuildingNumberErrMsg ()
        {
                return $this->buildingNumberErrMsg;
        }
        
        
        function setBuildingNumberErrMsg ( $errmsg )
        {
                $this->buildingNumberErrMsg = $errmsg;
        }
        
        
        function getStreetErrMsg ()
        {
                return $this->streetErrMsg;
        }
        
        
        function setStreetErrMsg ( $errmsg )
        {
                $this->streetErrMsg = $errmsg;
        }
        
        
        function getAreaErrMsg ()
        {
                return $this->areaErrMsg;
        }
        
        
        function setAreaErrMsg ( $errmsg )
        {
                $this->areaErrMsg = $errmsg;
        }
        
        
        function getCityErrMsg ()
        {
                return $this->cityErrMsg;
        }
        
        
        function setCityErrMsg ( $errmsg )
        {
                $this->cityErrMsg = $errmsg;
        }
        
        
        function getCountyErrMsg ()
        {
                return $this->countyErrMsg;
        }
        
        
        function setCountyErrMsg ( $errmsg )
        {
                $this->countyErrMsg = $errmsg;
        }
        
        
        function getCountryErrMsg ()
        {
                return $this->countryErrMsg;
        }
        
        
        function setCountryErrMsg ( $errmsg )
        {
                $this->countryErrMsg = $errmsg;
        }
        
        
        function getPostcodeErrMsg ()
        {
                return $this->postcodeErrMsg;
        }
        
        
        function setPostcodeErrMsg ( $errmsg )
        {
                $this->postcodeErrMsg = $errmsg;
        }
        
        
        function getEmailErrMsg ()
        {
                return $this->emailErrMsg;
        }
        
        
        function setEmailErrMsg ( $errmsg )
        {
                $this->emailErrMsg = $errmsg;
        }
        
        
        function getPasswordErrMsg ()
        {
                return $this->passwordErrMsg;
        }
        
        
        function setPasswordErrMsg ( $errmsg )
        {
                $this->passwordErrMsg = $errmsg;
        }
        
        
        function getPassword2ErrMsg ()
        {
                return $this->password2ErrMsg;
        }
        
        
        function setPassword2ErrMsg ( $errmsg )
        {
                $this->password2ErrMsg = $errmsg;
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
