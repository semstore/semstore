<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-12
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/eComStore/SessionUtils.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');
require_once('Sites/SemStore/Templates/EmailTemplate.class.php');
require_once('Sites/SemStore/Weblets/CustomerMyAccountWebletStateContainer.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/eComStore/Customer.class.php');
require_once('SEM/eComStore/eComStoreUtils.class.php');

class CustomerMyAccountWeblet extends Weblet
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
        
        
        var $configurator = NULL;
        var $connection = NULL;
        
        /* Configuration Variables :: Start */
        var $secureLinkKey = '';
        var $internationalRegistration = FALSE;
        var $autoGeneratePassword = FALSE;
        var $autoLogin = TRUE;
        var $defaultRedirect = 'index.php';
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
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
		
        var $currentPasswordErrorMessage = '';
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
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CustomerMyAccountWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_CustomerMyAccountWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _CustomerMyAccountWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        function _CustomerMyAccountWeblet1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
        }
        
        
        function _CustomerMyAccountWeblet2 ( &$config, &$connection )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getConfigurator ()
        {
                return $this->configurator;
        }
        
        
        function setConfigurator ( $configurator )
        {
                $this->configurator = $configurator;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        
        
        
        function getSecureLinkKey ()
        {
                return $this->secureLinkKey;
        }
        
        
        function setSecureLinkKey ( $key )
        {
                $this->secureLinkKey = $key;
        }
        
        
        function getInternationalRegistration ()
        {
                return $this->internationalRegistration;
        }
        
        
        function setInternationalRegistration ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->internationalRegistration = TRUE;
                }
                else
                {
                        $this->internationalRegistration = FALSE;
                }
        }
        
		function setCurrentPasswordErrMsg($message)
		{
				$this->currentPasswordErrorMessage = $message;
		}
		
		function getCurrentPasswordErrMsg()
		{
				return $this->currentPasswordErrorMessage;
		}
        
        function getAutoGeneratePassword ()
        {
                return $this->autoGeneratePassword;
        }
        
        
        function setAutoGeneratePassword ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->autoGeneratePassword = TRUE;
                }
                else
                {
                        $this->autoGeneratePassword = FALSE;
                }
        }
        
        
        function getAutoLogin ()
        {
                return $this->autoLogin;
        }
        
        
        function setAutoLogin ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->autoLogin = TRUE;
                }
                else
                {
                        $this->autoLogin = FALSE;
                }
        }
        
        
        function getDefaultRedirect ()
        {
                return $this->defaultRedirect;
        }
        
        
        function setDefaultRedirect ( $redirect )
        {
                $this->defaultRedirect = $redirect;
        }
        
        
        
        
        
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
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfigurator($config);
                $this->setSecureLinkKey($config->getParameter('secure_link_key'));
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new CustomerMyAccountWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                $stateContainer->setRedirect($this->getRedirect());
                
                $stateContainer->setTitle($this->getTitle());
                $stateContainer->setFirstname($this->getFirstname());
                $stateContainer->setSurname($this->getSurname());
                $stateContainer->setEmail($this->getEmail());
                $stateContainer->setCompanyName($this->getCompanyName());
                $stateContainer->setBuildingName($this->getBuildingName());
                $stateContainer->setBuildingNumber($this->getBuildingNumber());
                $stateContainer->setStreet($this->getStreet());
                $stateContainer->setArea($this->getArea());
                $stateContainer->setCity($this->getCity());
                $stateContainer->setCounty($this->getCounty());
                $stateContainer->setCountry($this->getCountry());
                $stateContainer->setPostcode($this->getPostcode());
                
                $stateContainer->setCurrentPasswordErrMsg($this->getCurrentPasswordErrMsg());
                $stateContainer->setTitleErrMsg($this->getTitleErrMsg());
                $stateContainer->setFirstnameErrMsg($this->getFirstnameErrMsg());
                $stateContainer->setSurnameErrMsg($this->getSurnameErrMsg());
                $stateContainer->setEmailErrMsg($this->getEmailErrMsg());
                $stateContainer->setCompanyNameErrMsg($this->getCompanyNameErrMsg());
                $stateContainer->setBuildingNameErrMsg($this->getBuildingNameErrMsg());
                $stateContainer->setBuildingNumberErrMsg($this->getBuildingNumberErrMsg());
                $stateContainer->setStreetErrMsg($this->getStreetErrMsg());
                $stateContainer->setAreaErrMsg($this->getAreaErrMsg());
                $stateContainer->setCityErrMsg($this->getCityErrMsg());
                $stateContainer->setCountyErrMsg($this->getCountyErrMsg());
                $stateContainer->setCountryErrMsg($this->getCountryErrMsg());
                $stateContainer->setPostcodeErrMsg($this->getPostcodeErrMsg());
                $stateContainer->setPasswordErrMsg($this->getPasswordErrMsg());
                $stateContainer->setPassword2ErrMsg($this->getPassword2ErrMsg());
                        
                Session::putRef('CustomerMyAccountWebletState',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('CustomerMyAccountWebletState');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                $this->setRedirect($stateContainer->getRedirect());
                
				$this->setCurrentPasswordErrMsg($stateContainer->getCurrentPasswordErrMsg());
                $this->setTitle($stateContainer->getTitle());
                $this->setFirstname($stateContainer->getFirstname());
                $this->setSurname($stateContainer->getSurname());
                $this->setEmail($stateContainer->getEmail());
                $this->setCompanyName($stateContainer->getCompanyName());
                $this->setBuildingName($stateContainer->getBuildingName());
                $this->setBuildingNumber($stateContainer->getBuildingNumber());
                $this->setStreet($stateContainer->getStreet());
                $this->setArea($stateContainer->getArea());
                $this->setCity($stateContainer->getCity());
                $this->setCounty($stateContainer->getCounty());
                $this->setCountry($stateContainer->getCountry());
                $this->setPostcode($stateContainer->getPostcode());
                
                $this->setTitleErrMsg($stateContainer->getTitleErrMsg());
                $this->setFirstnameErrMsg($stateContainer->getFirstnameErrMsg());
                $this->setSurnameErrMsg($stateContainer->getSurnameErrMsg());
                $this->setEmailErrMsg($stateContainer->getEmailErrMsg());
                $this->setCompanyNameErrMsg($stateContainer->getCompanyNameErrMsg());
                $this->setBuildingNameErrMsg($stateContainer->getBuildingNameErrMsg());
                $this->setBuildingNumberErrMsg($stateContainer->getBuildingNumberErrMsg());
                $this->setStreetErrMsg($stateContainer->getStreetErrMsg());
                $this->setAreaErrMsg($stateContainer->getAreaErrMsg());
                $this->setCityErrMsg($stateContainer->getCityErrMsg());
                $this->setCountyErrMsg($stateContainer->getCountyErrMsg());
                $this->setCountryErrMsg($stateContainer->getCountryErrMsg());
                $this->setPostcodeErrMsg($stateContainer->getPostcodeErrMsg());
                $this->setPasswordErrMsg($stateContainer->getPasswordErrMsg());
                $this->setPassword2ErrMsg($stateContainer->getPassword2ErrMsg());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('CustomerMyAccountWebletState', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_destroyWebletState();
                        
                        // Is there a redirect?
                        $redirect = $httpRequest->getParameter('r');
                        $secureRedirect = $httpRequest->getParameter('rs');
                        if ( !is_null($redirect) && $redirect != '' )
                        {
                                $this->setRedirect($redirect);
                        }
                        // Is there a secure redirect?
                        elseif ( !is_null($secureRedirect) && $secureRedirect != '' )
                        {
                                $redirect = eComStoreUtils::simpleXor($secureRedirect,
                                        $this->getSecureLinkKey());
                                $this->setRedirect($redirect);
                        }
                        $this->_saveWebletState();
                        $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'view_details' )
                {
                        $this->_view_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'edit_details' )
                {
                        $this->_edit_details( $httpRequest, $httpResponse );
                }
				elseif ( $view == 'change_password' )
                {
                        $this->_change_password( $httpRequest, $httpResponse );
                }
				elseif ( $view == 'capture_password' )
                {
                        $this->_capture_password( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'capture_details' )
                {
                        $this->_capture_details( $httpRequest, $httpResponse );
                }
				else
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
		
                $action = $httpRequest->getParameter('action');
				
                if ( is_null($action) || $action == '' )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
                elseif ( $action == 'capture_password_submit' )
                {
                        $this->_capture_password_submit( $httpRequest, $httpResponse );
                }			
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit( $httpRequest, $httpResponse );
                }			
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $this->_myaccount_main( $httpRequest, $httpResponse );
        }
        
        
        function _myaccount_main( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( $view == 'myaccount_main' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfigurator(),
                        $this->getConnection(),
                        '_ecomstore/my_account/myaccount.tpl');
                $template->addStylesheet(
                        $this->configurator->getParameter('site_root_webpath') .
                        '/css/registration.css');
                $template->assign('subtemplate',
                        '_ecomstore/my_account/myaccount_main.tpl');
                
                if ( SessionUtils::isLoggedIn() )
                {
                        $template->assign('customername',
                                Session::get('customername'));
                        $template->assign('loggedIn', 'y');	
                }
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _view_details ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( $view == 'view_details' )
                {
                        //populate customer data from database
                        $customer = eComStoreUtils::findCustomerWithId(
                                Session::get('customerId'),
                                $this->getConnection());
                                                                        
                        $this->setTitle($customer->getTitle());
                        $this->setFirstname($customer->getFirstname());
                        $this->setSurname($customer->getSurname());
                        $this->setEmail($customer->getEmail());
                        $this->setCompanyName($customer->getCompanyName());
                        $this->setBuildingName($customer->getBuildingName());
                        $this->setBuildingNumber($customer->getBuildingNumber());
                        $this->setStreet($customer->getStreet());
                        $this->setArea($customer->getArea());
                        $this->setCity($customer->getCity());
                        $this->setCounty($customer->getCounty());
                        $this->setCountry($customer->getCountry());
                        $this->setPostcode($customer->getPostcode());
						
						
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfigurator(),
                        $this->getConnection(),
                        '_ecomstore/my_account/myaccount.tpl');
                $template->addStylesheet(
                        $this->configurator->getParameter('site_root_webpath') .
                        '/css/registration.css');
                
                $template->assign('loggedIn', 'y');
				
                $template->assign('subtemplate', '_ecomstore/my_account/myaccount_view_details.tpl');
                
                $template->assign('reg_international', $this->getInternationalRegistration());
                $template->assign('reg_autogenpass', $this->getAutoGeneratePassword());
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                
                $template->assign('action_parameter_name', 'action');
                $template->assign('action_parameter_value', 'capture_details_submit');
                
                $template->assign('reg_title', $this->getTitle());
                $template->assign('reg_title_error', $this->getTitleErrMsg());
                
                $template->assign('reg_firstname', $this->getFirstname());
                $template->assign('reg_firstname_error', $this->getFirstnameErrMsg());
                
                $template->assign('reg_surname', $this->getSurname());
                $template->assign('reg_surname_error', $this->getSurnameErrMsg());
                
                $template->assign('reg_email', $this->getEmail());
                $template->assign('reg_email_error', $this->getEmailErrMsg());
                
                $template->assign('reg_company_name', $this->getCompanyName());
                $template->assign('reg_company_name_error', $this->getCompanyNameErrMsg());
                
                $template->assign('reg_building_name', $this->getBuildingName());
                $template->assign('reg_building_name_error', $this->getBuildingNameErrMsg());
                
                $template->assign('reg_building_number', $this->getBuildingNumber());
                $template->assign('reg_building_number_error', $this->getBuildingNumberErrMsg());
                
                $template->assign('reg_street', $this->getStreet());
                $template->assign('reg_street_error', $this->getStreetErrMsg());
                
                $template->assign('reg_area', $this->getArea());
                $template->assign('reg_area_error', $this->getAreaErrMsg());
                
                $template->assign('reg_city', $this->getCity());
                $template->assign('reg_city_error', $this->getCityErrMsg());
                
                $template->assign('reg_county', $this->getCounty());
                $template->assign('reg_county_error', $this->getCountyErrMsg());
                
                if ( $this->getInternationalRegistration() )
                {
                        $template->assign('reg_country', $this->getCountry());
                        $template->assign('reg_country_error', $this->getCountryErrMsg());
                }
                
                $template->assign('reg_postcode', $this->getPostcode());
                $template->assign('reg_postcode_error', $this->getPostcodeErrMsg());
                
                if ( !$this->getAutoGeneratePassword() )
                {
                        $template->assign('reg_password', $this->getPassword());
                        $template->assign('reg_password_error', $this->getPasswordErrMsg());
                        $template->assign('reg_password2', $this->getPassword2());
                        $template->assign('reg_password2_error', $this->getPassword2ErrMsg());
                }
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _edit_details ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( $view == 'edit_details' )
                {
                        $this->_restoreWebletState();
				
                        //populate customer data from database
                        $customer = eComStoreUtils::findCustomerWithId(
                                Session::get('customerId'),
                                $this->getConnection());
                        
                        $this->setTitle($customer->getTitle());
                        $this->setFirstname($customer->getFirstname());
                        $this->setSurname($customer->getSurname());
                        $this->setEmail($customer->getEmail());
                        $this->setCompanyName($customer->getCompanyName());
                        $this->setBuildingName($customer->getBuildingName());
                        $this->setBuildingNumber($customer->getBuildingNumber());
                        $this->setStreet($customer->getStreet());
                        $this->setArea($customer->getArea());
                        $this->setCity($customer->getCity());
                        $this->setCounty($customer->getCounty());
                        $this->setCountry($customer->getCountry());
                        $this->setPostcode($customer->getPostcode());
						
						
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfigurator(),
                        $this->getConnection(),
                        '_ecomstore/my_account/myaccount.tpl');
                $template->addStylesheet(
                        $this->configurator->getParameter('site_root_webpath') .
                        '/css/registration.css');
                
                $template->assign('loggedIn', 'y');
                
                $template->assign('subtemplate', '_ecomstore/my_account/myaccount_edit_details.tpl');
                
                $template->assign('reg_international', $this->getInternationalRegistration());
                $template->assign('reg_autogenpass', $this->getAutoGeneratePassword());
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                
                $template->assign('action_parameter_name', 'action');
                $template->assign('action_parameter_value', 'capture_details_submit');
                
                $template->assign('titleOptions', $this->_titleOptionsArray());
                
                $template->assign('reg_title', $this->getTitle());
                $template->assign('reg_title_error', $this->getTitleErrMsg());
                
                $template->assign('reg_firstname', $this->getFirstname());
                $template->assign('reg_firstname_error', $this->getFirstnameErrMsg());
                
                $template->assign('reg_surname', $this->getSurname());
                $template->assign('reg_surname_error', $this->getSurnameErrMsg());
                
                $template->assign('reg_email', $this->getEmail());
                $template->assign('reg_email_error', $this->getEmailErrMsg());
                
                $template->assign('reg_company_name', $this->getCompanyName());
                $template->assign('reg_company_name_error', $this->getCompanyNameErrMsg());
                
                $template->assign('reg_building_name', $this->getBuildingName());
                $template->assign('reg_building_name_error', $this->getBuildingNameErrMsg());
                
                $template->assign('reg_building_number', $this->getBuildingNumber());
                $template->assign('reg_building_number_error', $this->getBuildingNumberErrMsg());
                
                $template->assign('reg_street', $this->getStreet());
                $template->assign('reg_street_error', $this->getStreetErrMsg());
                
                $template->assign('reg_area', $this->getArea());
                $template->assign('reg_area_error', $this->getAreaErrMsg());
                
                $template->assign('reg_city', $this->getCity());
                $template->assign('reg_city_error', $this->getCityErrMsg());
                
                $template->assign('reg_county', $this->getCounty());
                $template->assign('reg_county_error', $this->getCountyErrMsg());
                
                if ( $this->getInternationalRegistration() )
                {
                        $template->assign('reg_country', $this->getCountry());
                        $template->assign('reg_country_error', $this->getCountryErrMsg());
                }
                
                $template->assign('reg_postcode', $this->getPostcode());
                $template->assign('reg_postcode_error', $this->getPostcodeErrMsg());
                
                if ( !$this->getAutoGeneratePassword() )
                {
                        $template->assign('reg_password', $this->getPassword());
                        $template->assign('reg_password_error', $this->getPasswordErrMsg());
                        $template->assign('reg_password2', $this->getPassword2());
                        $template->assign('reg_password2_error', $this->getPassword2ErrMsg());
                }
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _change_password ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( $view == 'change_password' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                
                $template =& new JusteCommerce3ColumnTemplate($this->getConfigurator(),
                        $this->getConnection(),
                        '_ecomstore/my_account/myaccount.tpl');
                $template->addStylesheet(
                        $this->configurator->getParameter('site_root_webpath') .
                        '/css/registration.css');
                
                $template->assign('loggedIn', 'y');
                
                $template->assign('subtemplate', '_ecomstore/my_account/myaccount_change_password.tpl');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', Form::METHOD_POST());
                $template->assign('formEncoding', Form::URLENCODED());
                
                $template->assign('action_parameter_name', 'action');
                $template->assign('action_parameter_value', 'capture_password_submit');
				
                $template->assign('reg_currentpassword_error',$this->getCurrentPasswordErrMsg());
                $template->assign('reg_password1_error',$this->getPasswordErrMsg());
                $template->assign('reg_password2_error',$this->getPassword2ErrMsg());
                
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_password_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit' )
                {
                        $this->_capture_password( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_password');
                $this->_saveWebletState();
                $httpRequest->redirect('myaccount.php?view=capture_password');
                return;
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit' )
                {
                        $this->_capture_details( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpRequest->redirect('myaccount.php?view=capture_details');
                return;
        }
        
        
        function _capture_password ( &$httpRequest, &$httpResponse )
        {		
                /* Prepare the data */
                $oldpassword = $httpRequest->getParameter('currentpassword');
                $oldpassword = strip_tags(stripslashes(trim($oldpassword)));

                $password1 = $httpRequest->getParameter('password1');
                $password1 = strip_tags(stripslashes(trim($password1)));

                $password2 = $httpRequest->getParameter('password2');
                $password2 = strip_tags(stripslashes(trim($password2)));

                // Validation
                $errors = 0;
                
                $this->setCurrentPasswordErrMsg('');
                $this->setPasswordErrMsg('');
                $this->setPassword2ErrMsg('');
                
                if ( $oldpassword == NULL || $oldpassword == '' )
                {
                        $this->setCurrentPasswordErrMsg('Please enter in your current password.');
                        $errors++;
                }
                
                if ( !eComstoreUtils::authenticateCustomer(
                        $this->getEmail(),
                        $oldpassword,
                        $this->getConnection()) )
                {
                        $this->setCurrentPasswordErrMsg('Please enter the correct password.');
                        $errors++;
                }
                
                $olderrors = $errors;
                
                if ( $password1 == NULL || $password1 == '' )
                {
                        $this->setPasswordErrMsg('Please enter in your new password.');
                        $errors++;
                }
                
                
                if ( $password2 == NULL || $password2 == '' )
                {
                        $this->setPassword2ErrMsg('Please confirm your new password.');
                        $errors++;
                }
                
                if ( $olderrors == $errors )
                {
                        if ( $password1 != $password2 )
                        {
                                $this->setPassword2ErrMsg('Your new password must be the same as your confirm password.');
                                $errors++;							
                        }
                }
				

                if ( $errors > 0 )
                {
                        $this->setView('change_password');
                        $this->_saveWebletState();
                        $httpResponse->redirect('myaccount.php?view=change_password');
                        return;
                }                
                
                // update details
                $customer = eComStoreUtils::findCustomerWithId(
                        Session::get('customerId'),
                        $this->getConnection());
                $customer->setPassword(md5($password1));
                
                $customer->commit($this->getConnection());
                
                // Log them in
                SessionUtils::setLoggedIn($customer);
                
                // Display message saying updated
                $this->setView('registration_complete');
                $this->_saveWebletState();
                $httpResponse->redirect('myaccount.php?view=registration_complete');
        }
        
        
        function _capture_details ( &$httpRequest, &$httpResponse )
        {		
                /* Prepare the data */
                $title = $httpRequest->getParameter('title');
                $title = strip_tags(stripslashes(trim($title)));
                $this->setTitle($title);
                
                $firstname = $httpRequest->getParameter('firstname');
                $firstname = strip_tags(stripslashes(trim($firstname)));
                $this->setFirstname($firstname);
                
                $surname = $httpRequest->getParameter('surname');
                $surname = strip_tags(stripslashes(trim($surname)));
                $this->setSurname($surname);
                
                $email = $httpRequest->getParameter('email');
                $email = strip_tags(stripslashes(trim($email)));
                $this->setEmail($email);
                
                $companyName = $httpRequest->getParameter('company_name');
                $companyName = strip_tags(stripslashes(trim($companyName)));
                $this->setCompanyName($companyName);
                
                $buildingName = $httpRequest->getParameter('building_name');
                $buildingName = strip_tags(stripslashes(trim($buildingName)));
                $this->setBuildingName($buildingName);
                
                $buildingNumber = $httpRequest->getParameter('building_number');
                $buildingNumber = strip_tags(stripslashes(trim($buildingNumber)));
                $this->setBuildingNumber($buildingNumber);
                
                $street = $httpRequest->getParameter('street');
                $street = strip_tags(stripslashes(trim($street)));
                $this->setStreet($street);
                
                $area = $httpRequest->getParameter('area');
                $area = strip_tags(stripslashes(trim($area)));
                $this->setArea($area);
                
                $city = $httpRequest->getParameter('city');
                $city = strip_tags(stripslashes(trim($city)));
                $this->setCity($city);
                
                $county = $httpRequest->getParameter('county');
                $county = strip_tags(stripslashes(trim($county)));
                $this->setCounty($county);
                
                if ( $this->getInternationalRegistration() )
                {
                        $country = $httpRequest->getParameter('country');
                        $country = strip_tags(stripslashes(trim($country)));
                        $this->setCountry($country);
                }
                
                $postcode = $httpRequest->getParameter('postcode');
                $postcode = strip_tags(stripslashes(trim($postcode)));
                $this->setPostcode($postcode);
                
                
                if ( !$this->getAutoGeneratePassword() )
                {
                        $password = $httpRequest->getParameter('password');
                        $password = strip_tags(stripslashes(trim($password)));
                        $this->setPassword($password);
                        
                        $password2 = $httpRequest->getParameter('password2');
                        $password2 = strip_tags(stripslashes(trim($password2)));
                        $this->setPassword2($password2);
                }
                
                
                // Validation
                $errors = 0;
                
                $this->setTitleErrMsg('');
                $this->setFirstnameErrMsg('');
                $this->setSurnameErrMsg('');
                $this->setEmailErrMsg('');
                $this->setCompanyNameErrMsg('');
                $this->setBuildingNameErrMsg('');
                $this->setBuildingNumberErrMsg('');
                $this->setStreetErrMsg('');
                $this->setAreaErrMsg('');
                $this->setCityErrMsg('');
                $this->setCountyErrMsg('');
                $this->setCountryErrMsg('');
                $this->setPostcodeErrMsg('');
                $this->setPasswordErrMsg('');
                $this->setPassword2ErrMsg('');
                
                
                if ( $this->getTitle() == NULL || $this->getTitle() == '' || $this->getTitle() == 'select_option')
                {
                        $this->setTitleErrMsg('Please complete the Title field.');
                        $errors++;
                }
                
                
                if ( $this->getFirstname() == NULL || $this->getFirstname() == '' )
                {
                        $this->setFirstnameErrMsg('Please complete the Firstname field.');
                        $errors++;
                }
                
                
                if ( $this->getSurname() == NULL || $this->getSurname() == '' )
                {
                        $this->setSurnameErrMsg('Please complete the Surname field.');
                        $errors++;
                }
                
                
                if ( $this->getEmail() == NULL || $this->getEmail() == '' )
                {
                        $this->setEmailErrMsg('Please complete the Email field.');
                        $errors++;
                }
                
                
                if ( $this->getStreet() == NULL || $this->getStreet() == '' )
                {
                        $this->setStreetErrMsg('Please complete the Street field.');
                        $errors++;
                }
                
                
                if ( $this->getCity() == NULL || $this->getCity() == '' )
                {
                        $this->setCityErrMsg('Please complete the City field.');
                        $errors++;
                }
                
                
                if ( $this->getCounty() == NULL || $this->getCounty() == '' )
                {
                        $this->setCountyErrMsg('Please complete the County field.');
                        $errors++;
                }
                
                
                if ( $this->getInternationalRegistration() )
                {
                        if ( $this->getCountry() == NULL || $this->getCountry() == '' )
                        {
                                $this->setCountryErrMsg('Please complete the Country field.');
                                $errors++;
                        }
                }
                
                
                if ( $this->getPostcode() == NULL || $this->getPostcode() == '' )
                {
                        $this->setPostcodeErrMsg('Please complete the Postcode field.');
                        $errors++;
                }
                
                
                if ( $errors > 0 )
                {
                        $this->setView('edit_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('myaccount.php?view=edit_details');
                        return;
                }                
                
                // update details
                $customer = eComStoreUtils::findCustomerWithId(
                        Session::get('customerId'),
                        $this->getConnection());
                $customer->setTitle($this->getTitle());
                $customer->setFirstname($this->getFirstname());
                $customer->setSurname($this->getSurname());
                $customer->setUsername($this->getEmail());
                $customer->setCompanyName($this->getCompanyName());
                $customer->setBuildingName($this->getBuildingName());
                $customer->setBuildingNumber($this->getBuildingNumber());
                $customer->setStreet($this->getStreet());
                $customer->setArea($this->getArea());
                $customer->setCity($this->getCity());
                $customer->setCounty($this->getCounty());
                $customer->setCountry($this->getCountry());
                $customer->setPostcode($this->getPostcode());
                
                $checkEmail = array('email' => $this->getEmail());
                
                $unchangedemail = false;
                
                if ( $customer->getEmail() == $this->getEmail() )
                { 
                        $unchangedemail = true;
                }
                
                if ( $unchangedemail == false && $customer->findFirst( $checkEmail, $this->getConnection() ) != NULL )
                {
                        //email already used, return user to data input with message
                        $this->setView('edit_details');
                        $this->setEmailErrMsg('Your email address has already been used.');
                        $this->_saveWebletState();
                        $httpResponse->redirect('myaccount.php?view=edit_details');	
                }
                else
                {
                        $customer->setEmail($this->getEmail());
                        
                        $registrationsuccess  = $customer->commit($this->getConnection());
                        
                        // Log them in
                        SessionUtils::setLoggedIn($customer);
                        
                        // Display message saying updated
                        $this->setView('registration_complete');
                        $this->_saveWebletState();
                        $httpResponse->redirect('myaccount.php?view=registration_complete');
                }
        }
        
        
        function _titleOptionsArray ()
        {
                return array(
                        array('id' => 'select_option', 'value' => '(select option)'),
                        array('id' => 'mr', 'value' => 'Mr'),
                        array('id' => 'mrs', 'value' => 'Mrs'),
                        array('id' => 'miss', 'value' => 'Miss')
                        );
        }
}


?>
