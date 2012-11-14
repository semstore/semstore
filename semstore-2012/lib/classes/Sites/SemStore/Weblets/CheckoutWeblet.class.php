<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Session/Session.class.php');
require_once('Sites/SemStore/Weblets/CheckoutWebletStateContainer.class.php');
require_once('Sites/SemStore/Templates/JusteCommerceCheckoutTemplate.class.php');
require_once('Sites/SemStore/JusteCommerceUtils.class.php');
require_once('Sites/SemStore/eComBasket.class.php');
require_once('Sites/SemStore/eComBasketItem.class.php');
//require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('ProtX/VSPBasket.class.php');
require_once('ProtX/VSPBasketItem.class.php');
require_once('ProtX/VSPFormUtils.class.php');
require_once('ProtX/VSPFormRequest.class.php');
require_once('PayPal/PaypalSOAP.class.php');
require_once('Sites/SemStore/OrderEmails.class.php');

require_once('SEM/CMS/Modules/eComStore/ProductOrder.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductOrderLineDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentDataObject.class.php');

require_once('PayPal/PaypalPayflow.class.php');

class CheckoutWeblet extends Weblet
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
        var $requireLogin = TRUE;
        
        var $view = '';
        var $formErrors = NULL;
        var $basketItems = array();
        
        var $paymentId = '';
        var $orderId = '';

        var $deliveryFirstname = '';
        var $deliverySurname = '';
        var $deliveryCompanyName = '';
        var $deliveryBuildingName = '';
        var $deliveryBuildingNumber = '';
        var $deliveryAddress1 = '';
        var $deliveryAddress2 = '';
        var $deliveryCity = '';
        var $deliveryVounty = '';
        var $deliveryPostcode = '';
        var $deliveryContactNumber = '';
        var $email = '';
        var $deliveryDate = '';
        
        var $deliveryFirstnameErrorMsg = '';
        var $deliverySurnameErrorMsg = '';
        var $deliveryCompanyNameErrorMsg = '';
        var $deliveryBuildingNameErrorMsg = '';
        var $deliveryBuildingNumberErrorMsg = '';
        var $deliveryAddress1ErrorMsg = '';
        var $deliveryAddress2ErrorMsg = '';
        var $deliveryCityErrorMsg = '';
        var $deliveryCountyErrorMsg = '';
        var $deliveryPostcodeErrorMsg = '';
        var $deliveryContactNumberErrorMsg = '';
        var $emailErrorMsg = '';
        var $deliveryDateErrorMessage = '';

	var $billingUseDeliveryDetails = '';
        var $billingFirstname = '';
        var $billingSurname = '';
        var $billingCompanyName = '';
        var $billingBuildingName = '';
        var $billing_buildingNumber = '';
        var $billingAddress1 = '';
        var $billingAddress2 = '';
        var $billingCity = '';
        var $billingCounty = '';
        var $billingPostcode = '';
        
        var $heardofsite = '';
        var $paymentmethod = '';
        //var $billing_contact_number = '';
        
        var $billingFirstnameErrorMsg = '';
        var $billingSurnameErrorMsg = '';
        var $billingCompanyNameErrorMsg = '';
        var $billingBuildingNameErrorMsg = '';
        var $billingBuildingNumberErrorMsg = '';
        var $billingAddress1ErrorMsg = '';
        var $billingAddress2ErrorMsg = '';
        var $billingCityErrorMsg = '';
        var $billingCountyErrorMsg = '';
        var $billingPostcodeErrorMsg = '';
        var $billingContactNumberErrorMsg = '';
        
        
        var $creditcardtype = '';
        var $creditcardnumber = '';
	var $cvv2 = '';
	var $issuenumber = '';
	var $startdatemonth = '';
	var $startdateyear = '';
	var $expirydatemonth = '';
	var $expirydateyear = '';
        
        
        
        var $creditcardtypeErrorMsg = '';
        var $creditcardnumberErrorMsg = '';
	var $cvv2ErrorMsg = '';
	var $issuenumberErrorMsg = '';
	var $startdatemonthErrorMsg = '';
	var $startdateyearErrorMsg = '';
	var $expirydatemonthErrorMsg = '';
	var $expirydateyearErrorMsg = '';
        
        
        /* Configuration Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        function CheckoutWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_CheckoutWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _CheckoutWeblet0 ()
        {
                $this->_initialize();
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
        
        
        function getBillingUseDeliveryDetails ()
	{
		return $this->billingUseDeliveryDetails;
	}
 
        function setBillingUseDeliveryDetails ( $newusedetails )
	{
		$this->billingUseDeliveryDetails = $newusedetails;
	}
       
        
        function getBasket ()
        {
                return $this->basket;
        }
        
        
        function setBasket ( $basket )
        {
                $this->basket = $basket;
        }
        
        
        function getPaymentId ()
        {
                return $this->paymentId;
        }
        
        
        function setPaymentId ( $id )
        {
                $this->paymentId = $id;
        }
        
        
        
        function getOrderId ()
        {
                return $this->orderId;
        }
        
        
        function setOrderId ( $id )
        {
                $this->orderId = $id;
        }
        
        function getPaymentMethod ()
	{
                return $this->paymentmethod;
	}
        
        
	function setPaymentMethod ( $method )
	{
                $this->paymentmethod = $method;
	}
        
        function getDeliveryFirstname ()
	{
                return $this->deliveryFirstname;
	}
        
        
	function setDeliveryFirstname ( $name )
	{
                $this->deliveryFirstname = $name;
	}
        
        
	function getDeliverySurname ()
	{
                return $this->deliverySurname;
	}
        
        
	function setDeliverySurname ( $name )
	{
                $this->deliverySurname = $name;
	}
        
        
        function getDeliveryCompanyName ()
	{
                return $this->deliveryCompanyName;
	}
        
        
	function setDeliveryCompanyName ( $company )
	{
                $this->deliveryCompanyName = $company;
	}
        
        
        function getDeliveryBuildingName ()
	{
                return $this->deliveryBuildingName;
	}
        
	function setDeliveryBuildingName ( $building )
	{
                $this->deliveryBuildingName = $building;
	}
        
        
        function getDeliveryBuildingNumber ()
	{
                return $this->deliveryBuildingNumber;
	}
        
        
	function setDeliveryBuildingNumber ( $number )
	{
                $this->deliveryBuildingNumber = $number;
	}
        
        
        function getDeliveryAddress1 ()
	{
                return $this->deliveryAddress1;
	}
        
        
	function setDeliveryAddress1 ( $address )
	{
                $this->deliveryAddress1 = $address;
	}
        

	function getDeliveryAddress2 ()
	{
                return $this->deliveryAddress2;
	}
        
        
	function setDeliveryAddress2 ( $address )
	{
                $this->deliveryAddress2 = $address;
	}
        
        
	function getDeliveryCity ()
	{
                return $this->deliveryCity;
	}
        
        
	function setDeliveryCity ( $city )
	{
                $this->deliveryCity = $city;
	}


	function getDeliveryCounty ()
	{
                return $this->deliveryCounty;
	}
        
        
	function setDeliveryCounty ( $county )
	{
                $this->deliveryCounty = $county;
	}
        
        
        function getDeliveryPostcode ()
	{
                return $this->deliveryPostcode;
	}
        
        
	function setDeliveryPostcode ( $postcode )
	{
                $this->deliveryPostcode = $postcode;
	}
        
        
        function getDeliveryContactNumber ()
	{
                return $this->deliveryContactNumber;
	}
        
        
	function setDeliveryContactNumber ( $number )
	{
                $this->deliveryContactNumber = $number;
	}
        
        
        function getEmail ()
	{
                return $this->email;
	}
        
        
	function setEmail ( $email )
	{
                $this->email = $email;
	}
        
        
        function getDeliveryDate ()
        {
                return $this->deliveryDate;
        }
        
        function setDeliveryDate ( $date )
        {
                $this->deliveryDate = $date;
        }
        
        
	function getDeliverySurnameErrorMsg ()
	{
                return $this->deliverySurnameErrorMsg;
	}
        
        
	function setDeliverySurnameErrorMsg ( $errorMsg )
	{
                $this->deliverySurnameErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryCompanyNameErrorMsg ()
	{
                return $this->deliveryCompanyNameErrorMsg;
	}
        
        
	function setDeliveryCompanyNameErrorMsg ( $errorMsg )
	{
                $this->deliveryCompanyNameErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryBuildingNameErrorMsg ()
	{
                return $this->deliveryBuildingNameErrorMsg;
	}
        
	function setDeliveryBuildingNameErrorMsg ( $errorMsg )
	{
                $this->deliveryBuildingNameErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryBuildingNumberErrorMsg ()
	{
                return $this->deliveryBuildingNumberErrorMsg;
	}
        
        
	function setDeliveryBuildingNumberErrorMsg ( $errorMsg )
	{
                $this->deliveryBuildingNumberErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryAddress1ErrorMsg ()
	{
                return $this->deliveryAddress1ErrorMsg;
	}
        
        
	function setDeliveryAddress1ErrorMsg ( $errorMsg )
	{
                $this->deliveryAddress1ErrorMsg = $errorMsg;
	}
        

	function getDeliveryAddress2ErrorMsg ()
	{
                return $this->deliveryAddress2ErrorMsg;
	}
        
        
	function setDeliveryAddress2ErrorMsg ( $errorMsg )
	{
                $this->deliveryAddress2ErrorMsg = $errorMsg;
	}
        
        
	function getDeliveryCityErrorMsg ()
	{
                return $this->deliveryCityErrorMsg;
	}
        
        
	function setDeliveryCityErrorMsg ( $errorMsg )
	{
                $this->deliveryCityErrorMsg = $errorMsg;
	}


	function getDeliveryCountyErrorMsg ()
	{
                return $this->deliveryCountyErrorMsg;
	}
        
        
	function setDeliveryCountyErrorMsg ( $errorMsg )
	{
                $this->deliveryCountyErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryPostcodeErrorMsg ()
	{
                return $this->deliveryPostcodeErrorMsg;
	}
        
        
	function setDeliveryPostcodeErrorMsg ( $errorMsg )
	{
                $this->deliveryPostcodeErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryContactNumberErrorMsg ()
	{
                return $this->deliveryContactNumberErrorMsg;
	}
        
        
	function setDeliveryContactNumberErrorMsg ( $errorMsg )
	{
                $this->deliveryContactNumberErrorMsg = $errorMsg;
	}
        
        
        function getEmailErrorMsg ()
	{
                return $this->emailErrorMsg;
	}
        
        
	function setEmailErrorMsg ( $errorMsg )
	{
                $this->emailErrorMsg = $errorMsg;
	}
        
        
        function getDeliveryDateErrorMsg ()
        {
                return $this->deliveryDateErrorMsg;
        }
        
        function setDeliveryDateErrorMsg ( $errorMsg )
        {
                $this->deliveryDateErrorMsg = $errorMsg;
        }
        
        
        /* Billing */


        
        function getDeliveryFirstnameErrorMsg ()
	{
                return $this->deliveryFirstnameErrorMsg;
	}
        
        
	function setDeliveryFirstnameErrorMsg ( $errorMsg )
	{
                $this->deliveryFirstnameErrorMsg = $errorMsg;
	}        
        
	function getBillingFirstname ()
	{
                return $this->billingFirstname;
	}
        
        
	function setBillingFirstname ( $name )
	{
                $this->billingFirstname = $name;
	}
        
        
	function getBillingSurname ()
	{
                return $this->billingSurname;
	}
        
        
	function setBillingSurname ( $name )
	{
                $this->billingSurname = $name;
	}
        
        
        function getBillingCompanyName ()
	{
                return $this->billingCompanyName;
	}
        
        
	function setBillingCompanyName ( $company )
	{
                $this->billingCompanyName = $company;
	}
        
        
        function getBillingBuildingName ()
	{
                return $this->billingBuildingName;
	}
        
	function setBillingBuildingName ( $building )
	{
                $this->billingBuildingName = $building;
	}
        
        
        function getBillingBuildingNumber ()
	{
                return $this->billingBuildingNumber;
	}
        
        
	function setBillingBuildingNumber ( $number )
	{
                $this->billingBuildingNumber = $number;
	}
        
        
        function getBillingAddress1 ()
	{
                return $this->billingAddress1;
	}
        
        
	function setBillingAddress1 ( $address )
	{
                $this->billingAddress1 = $address;
	}
        

	function getBillingAddress2 ()
	{
                return $this->billingAddress2;
	}
        
        
	function setBillingAddress2 ( $address )
	{
                $this->billingAddress2 = $address;
	}
        
        
	function getBillingCity ()
	{
                return $this->billingCity;
	}
        
        
	function setBillingCity ( $city )
	{
                $this->billingCity = $city;
	}


	function getBillingCounty ()
	{
                return $this->billingCounty;
	}
        
        
	function setBillingCounty ( $county )
	{
                $this->billingCounty = $county;
	}
        
        
        function getBillingPostcode ()
	{
                return $this->billingPostcode;
	}
        
        
	function setBillingPostcode ( $postcode )
	{
                $this->billingPostcode = $postcode;
	}
        
        
        function getBillingContactNumber ()
	{
                return $this->billingContactNumber;
	}
        
        
	function setBillingContactNumber ( $number )
	{
                $this->billingContactNumber = $number;
	}
        
        
        function getBillingFirstnameErrorMsg ()
	{
                return $this->billingFirstnameErrorMsg;
	}
        
        
	function setBillingFirstnameErrorMsg ( $errorMsg )
	{
                $this->billingFirstnameErrorMsg = $errorMsg;
	}
        
        
	function getBillingSurnameErrorMsg ()
	{
                return $this->billingSurnameErrorMsg;
	}
        
        
	function setBillingSurnameErrorMsg ( $errorMsg )
	{
                $this->billingSurnameErrorMsg = $errorMsg;
	}
        
        
        function getBillingCompanyNameErrorMsg ()
	{
                return $this->billingCompanyNameErrorMsg;
	}
        
        
	function setBillingCompanyNameErrorMsg ( $errorMsg )
	{
                $this->billingCompanyNameErrorMsg = $errorMsg;
	}
        
        
        function getBillingBuildingNameErrorMsg ()
	{
                return $this->billingBuildingNameErrorMsg;
	}
        
	function setBillingBuildingNameErrorMsg ( $errorMsg )
	{
                $this->billingBuildingNameErrorMsg = $errorMsg;
	}
        
        
        function getBillingBuildingNumberErrorMsg ()
	{
                return $this->billingBuildingNumberErrorMsg;
	}
        
        
	function setBillingBuildingNumberErrorMsg ( $errorMsg )
	{
                $this->billingBuildingNumberErrorMsg = $errorMsg;
	}
        
        
        function getBillingAddress1ErrorMsg ()
	{
                return $this->billingAddress1ErrorMsg;
	}
        
        
	function setBillingAddress1ErrorMsg ( $errorMsg )
	{
                $this->billingAddress1ErrorMsg = $errorMsg;
	}
        

	function getBillingAddress2ErrorMsg ()
	{
                return $this->billingAddress2ErrorMsg;
	}
        
        
	function setBillingAddress2ErrorMsg ( $errorMsg )
	{
                $this->billingAddress2ErrorMsg = $errorMsg;
	}
        
        
	function getBillingCityErrorMsg ()
	{
                return $this->billingCityErrorMsg;
	}
        
        
	function setBillingCityErrorMsg ( $errorMsg )
	{
                $this->billingCityErrorMsg = $errorMsg;
	}


	function getBillingCountyErrorMsg ()
	{
                return $this->billingCountyErrorMsg;
	}
        
        
	function setBillingCountyErrorMsg ( $errorMsg )
	{
                $this->billingCountyErrorMsg = $errorMsg;
	}
        
        
        function getBillingPostcodeErrorMsg ()
	{
                return $this->billingPostcodeErrorMsg;
	}
        
        
	function setBillingPostcodeErrorMsg ( $errorMsg )
	{
                $this->billingPostcodeErrorMsg = $errorMsg;
	}
        
        
        function getBillingContactNumberErrorMsg ()
	{
                return $this->billingContactNumberErrorMsg;
	}
        
        
	function setBillingContactNumberErrorMsg ( $errorMsg )
	{
                $this->billingContactNumberErrorMsg = $errorMsg;
	}
	
	
	function setHeardOfSite ( $where )
	{
	      $this->heardofsite = $where;
	}
	
	function getHeardOfSite ( )
	{
	      return $this->heardofsite;
	}
        
        
        function getCreditCardType ( )
        {
             return $this->creditcardtype;
        } 
        
        function setCreditCardType ( $type )
        {
             $this->creditcardtype = $type;
        }
        
        
        function getCreditCardNumber ( )
        {
             return $this->creditcardnumber;
        } 
        
        function setCreditCardNumber ( $number )
        {
             $this->creditcardnumber = $number;
        }
        
        
        
        function getCVV2 ( )
        {
             return $this->cvv2;
        } 
        
        function setCVV2 ( $number )
        {
             $this->cvv2 = $number;
        }
        
        
        
        function getIssueNumber ( )
        {
             return $this->issuenumber;
        } 
        
        function setIssueNumber ( $number )
        {
             $this->issuenumber = $number;
        }
        
        function getStartdatemonth ( )
        {
             return $this->startdatemonth;
        } 
        
        function setStartdatemonth ( $number )
        {
             $this->startdatemonth = $number;
        }
        
        function getStartdateyear ( )
        {
             return $this->startdateyear;
        } 
        
        function setStartdateyear ( $number )
        {
             $this->startdateyear = $number;
        }
        
        
        
        function getExpirydatemonth ( )
        {
             return $this->expirydatemonth;
        } 
        
        function setExpirydatemonth ( $number )
        {
             $this->expirydatemonth = $number;
        }
        
        function getExpirydateyear ( )
        {
             return $this->expirydateyear;
        } 
        
        function setExpirydateyear ( $number )
        {
             $this->expirydateyear = $number;
        }
        
        
        
        
        
        
        
        
        function getCreditCardTypeErrorMsg ( )
        {
             return $this->creditcardtypeErrorMsg;
        } 
        
        function setCreditCardTypeErrorMsg ( $type )
        {
             $this->creditcardtypeErrorMsg = $type;
        }
        
        
        function getCreditCardNumberErrorMsg ( )
        {
             return $this->creditcardnumberErrorMsg;
        } 
        
        function setCreditCardNumberErrorMsg ( $number )
        {
             $this->creditcardnumberErrorMsg = $number;
        }
        
        
        
        function getCVV2ErrorMsg ( )
        {
             return $this->cvv2ErrorMsg;
        } 
        
        function setCVV2ErrorMsg ( $number )
        {
             $this->cvv2ErrorMsg = $number;
        }
        
        
        
        function getIssueNumberErrorMsg ( )
        {
             return $this->issuenumberErrorMsg;
        } 
        
        function setIssueNumberErrorMsg ( $number )
        {
             $this->issuenumberErrorMsg = $number;
        }
        
        function getStartdatemonthErrorMsg ( )
        {
             return $this->startdatemonthErrorMsg;
        } 
        
        function setStartdatemonthErrorMsg ( $number )
        {
             $this->startdatemonthErrorMsg = $number;
        }
        
        function getStartdateyearErrorMsg ( )
        {
             return $this->startdateyearErrorMsg;
        } 
        
        function setStartdateyearErrorMsg ( $number )
        {
             $this->startdateyearErrorMsg = $number;
        }
        
        
        
        function getExpirydatemonthErrorMsg ( )
        {
             return $this->expirydatemonthErrorMsg;
        } 
        
        function setExpirydatemonthErrorMsg ( $number )
        {
             $this->expirydatemonthErrorMsg = $number;
        }
        
        function getExpirydateyearErrorMsg ( )
        {
             return $this->expirydateyearErrorMsg;
        } 
        
        function setExpirydateyearErrorMsg ( $number )
        {
             $this->expirydateyearErrorMsg = $number;
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
                
                /*
                $this->setProductImagesPath(
                        $config->getParameter('product_images_path'));
                $this->setProductImagesWebpath(
                        $config->getParameter('product_images_webpath'));
                */
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new CheckoutWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setBasket($this->getBasket());
                
                $stateContainer->setPaymentId($this->getPaymentId());
                $stateContainer->setOrderId($this->getOrderId());
                
		$stateContainer->setDeliveryFirstname($this->getDeliveryFirstname());
		$stateContainer->setDeliverySurname($this->getDeliverySurname());
                $stateContainer->setDeliveryCompanyName($this->getDeliveryCompanyName());
		$stateContainer->setDeliveryBuildingName($this->getDeliveryBuildingName());
                $stateContainer->setDeliveryBuildingNumber($this->getDeliveryBuildingNumber());
		$stateContainer->setDeliveryAddress1($this->getDeliveryAddress1());
		$stateContainer->setDeliveryAddress2($this->getDeliveryAddress2());
		$stateContainer->setDeliveryCity($this->getDeliveryCity());
 		$stateContainer->setDeliveryCounty($this->getDeliveryCounty());
		$stateContainer->setDeliveryPostcode($this->getDeliveryPostcode());
		$stateContainer->setDeliveryContactNumber($this->getDeliveryContactNumber());
		$stateContainer->setEmail($this->getEmail());
                $stateContainer->setDeliveryDate($this->getDeliveryDate());
                
                $stateContainer->setDeliveryFirstnameErrorMsg($this->getDeliveryFirstnameErrorMsg());
		$stateContainer->setDeliverySurnameErrorMsg($this->getDeliverySurnameErrorMsg());
                $stateContainer->setDeliveryCompanyNameErrorMsg($this->getDeliveryCompanyNameErrorMsg());
		$stateContainer->setDeliveryBuildingNameErrorMsg($this->getDeliveryBuildingNameErrorMsg());
                $stateContainer->setDeliveryBuildingNumberErrorMsg($this->getDeliveryBuildingNumberErrorMsg());
		$stateContainer->setDeliveryAddress1ErrorMsg($this->getDeliveryAddress1ErrorMsg());
		$stateContainer->setDeliveryAddress2ErrorMsg($this->getDeliveryAddress2ErrorMsg());
		$stateContainer->setDeliveryCityErrorMsg($this->getDeliveryCityErrorMsg());
 		$stateContainer->setDeliveryCountyErrorMsg($this->getDeliveryCountyErrorMsg());
		$stateContainer->setDeliveryPostcodeErrorMsg($this->getDeliveryPostcodeErrorMsg());
		$stateContainer->setDeliveryContactNumberErrorMsg($this->getDeliveryContactNumberErrorMsg());
		$stateContainer->setEmailErrorMsg($this->getEmailErrorMsg());
                $stateContainer->setDeliveryDateErrorMsg($this->getDeliveryDateErrorMsg());

		$stateContainer->setBillingFirstname($this->getBillingFirstname());
		$stateContainer->setBillingSurname($this->getBillingSurname());
                $stateContainer->setBillingCompanyName($this->getBillingCompanyName());
		$stateContainer->setBillingBuildingName($this->getBillingBuildingName());
                $stateContainer->setBillingBuildingNumber($this->getBillingBuildingNumber());
		$stateContainer->setBillingAddress1($this->getBillingAddress1());
		$stateContainer->setBillingAddress2($this->getBillingAddress2());
		$stateContainer->setBillingCity($this->getBillingCity());
 		$stateContainer->setBillingCounty($this->getBillingCounty());
		$stateContainer->setBillingPostcode($this->getBillingPostcode());
		$stateContainer->setBillingContactNumber($this->getBillingContactNumber());
		$stateContainer->setBillingUseDeliveryDetails($this->getBillingUseDeliveryDetails()); 

             
                $stateContainer->setBillingFirstnameErrorMsg($this->getBillingFirstnameErrorMsg());
		$stateContainer->setBillingSurnameErrorMsg($this->getBillingSurnameErrorMsg());
                $stateContainer->setBillingCompanyNameErrorMsg($this->getBillingCompanyNameErrorMsg());
		$stateContainer->setBillingBuildingNameErrorMsg($this->getBillingBuildingNameErrorMsg());
                $stateContainer->setBillingBuildingNumberErrorMsg($this->getBillingBuildingNumberErrorMsg());
		$stateContainer->setBillingAddress1ErrorMsg($this->getBillingAddress1ErrorMsg());
		$stateContainer->setBillingAddress2ErrorMsg($this->getBillingAddress2ErrorMsg());
		$stateContainer->setBillingCityErrorMsg($this->getBillingCityErrorMsg());
 		$stateContainer->setBillingCountyErrorMsg($this->getBillingCountyErrorMsg());
		$stateContainer->setBillingPostcodeErrorMsg($this->getBillingPostcodeErrorMsg());
		$stateContainer->setBillingContactNumberErrorMsg($this->getBillingContactNumberErrorMsg());
		
		
		
		$stateContainer->setCreditcardtype($this->getCreditCardType());
		$stateContainer->setcreditcardnumber($this->getCreditCardNumber());
		$stateContainer->setcvv2($this->getCVV2());
		$stateContainer->setissuenumber($this->getIssueNumber());
		$stateContainer->setstartdatemonth($this->getStartDateMonth());
		$stateContainer->setstartdateyear($this->getStartDateYear());
		$stateContainer->setexpirydatemonth($this->getExpiryDateMonth());
		$stateContainer->setexpirydateyear($this->getExpiryDateYear());
		
		
         
		$stateContainer->setCreditCardTypeErrorMsg($this->getCreditCardTypeErrorMsg());
		$stateContainer->setCreditCardNumberErrorMsg($this->getCreditCardNumberErrorMsg());
		$stateContainer->setCvv2ErrorMsg($this->getCVV2ErrorMsg());
		$stateContainer->setIssuenumberErrorMsg($this->getIssueNumberErrorMsg());
		$stateContainer->setStartdatemonthErrorMsg($this->getStartDateMonthErrorMsg());
		$stateContainer->setStartdateyearErrorMsg($this->getStartDateYearErrorMsg());
		$stateContainer->setExpirydatemonthErrorMsg($this->getExpiryDateMonthErrorMsg());
		$stateContainer->setExpirydateyearErrorMsg($this->getExpiryDateYearErrorMsg());
         
         
		$stateContainer->setHeardOfSite ( $this->getHeardOfSite() );
         
		$stateContainer->setPaymentMethod ( $this->getPaymentMethod() );
         

       
                
                Session::putRef('checkoutWebletState',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('checkoutWebletState');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                $stateContainer->getFormValidationErrors() );
                
                $this->setBasket($stateContainer->getBasket());
                
                $this->setPaymentId($stateContainer->getPaymentId());
                $this->setOrderId($stateContainer->getOrderId());
                
		$this->setDeliveryFirstname($stateContainer->getDeliveryFirstname());
		$this->setDeliverySurname($stateContainer->getDeliverySurname());
                $this->setDeliveryCompanyName($stateContainer->getDeliveryCompanyName());
		$this->setDeliveryBuildingName($stateContainer->getDeliveryBuildingName());
                $this->setDeliveryBuildingNumber($stateContainer->getDeliveryBuildingNumber());
		$this->setDeliveryAddress1($stateContainer->getDeliveryAddress1());
		$this->setDeliveryAddress2($stateContainer->getDeliveryAddress2());
 		$this->setDeliveryCity($stateContainer->getDeliveryCity());
		$this->setDeliveryCounty($stateContainer->getDeliveryCounty());
 		$this->setDeliveryPostcode($stateContainer->getDeliveryPostcode());
		$this->setDeliveryContactNumber($stateContainer->getDeliveryContactNumber());
		$this->setEmail($stateContainer->getEmail());
                $this->setDeliveryDate($stateContainer->getDeliveryDate());
                
                $this->setDeliveryFirstnameErrorMsg($stateContainer->getDeliveryFirstnameErrorMsg());
		$this->setDeliverySurnameErrorMsg($stateContainer->getDeliverySurnameErrorMsg());
                $this->setDeliveryCompanyNameErrorMsg($stateContainer->getDeliveryCompanyNameErrorMsg());
		$this->setDeliveryBuildingNameErrorMsg($stateContainer->getDeliveryBuildingNameErrorMsg());
                $this->setDeliveryBuildingNumberErrorMsg($stateContainer->getDeliveryBuildingNumberErrorMsg());
		$this->setDeliveryAddress1ErrorMsg($stateContainer->getDeliveryAddress1ErrorMsg());
		$this->setDeliveryAddress2ErrorMsg($stateContainer->getDeliveryAddress2ErrorMsg());
 		$this->setDeliveryCityErrorMsg($stateContainer->getDeliveryCityErrorMsg());
		$this->setDeliveryCountyErrorMsg($stateContainer->getDeliveryCountyErrorMsg());
 		$this->setDeliveryPostcodeErrorMsg($stateContainer->getDeliveryPostcodeErrorMsg());
		$this->setDeliveryContactNumberErrorMsg($stateContainer->getDeliveryContactNumberErrorMsg());
		$this->setEmailErrorMsg($stateContainer->getEmailErrorMsg());
                $this->setDeliveryDateErrorMsg($stateContainer->getDeliveryDateErrorMsg());
                $this->setHeardOfSite ( $stateContainer->getHeardOfSite() );
         
		
		$this->setBillingFirstname($stateContainer->getBillingFirstname());
		$this->setBillingSurname($stateContainer->getBillingSurname());
                $this->setBillingCompanyName($stateContainer->getBillingCompanyName());
                $this->setBillingBuildingName($stateContainer->getBillingBuildingName());
		$this->setBillingBuildingNumber($stateContainer->getBillingBuildingNumber());
		$this->setBillingAddress1($stateContainer->getBillingAddress1());
		$this->setBillingAddress2($stateContainer->getBillingAddress2());
 		$this->setBillingCity($stateContainer->getBillingCity());
		$this->setBillingCounty($stateContainer->getBillingCounty());
 		$this->setBillingPostcode($stateContainer->getBillingPostcode());
		$this->setBillingContactNumber($stateContainer->getBillingContactNumber());
                $this->setBillingUseDeliveryDetails($stateContainer->getBillingUseDeliveryDetails());
		

                $this->setBillingFirstnameErrorMsg($stateContainer->getBillingFirstnameErrorMsg());
		$this->setBillingSurnameErrorMsg($stateContainer->getBillingSurnameErrorMsg());
                $this->setBillingCompanyNameErrorMsg($stateContainer->getBillingCompanyNameErrorMsg());
		$this->setBillingBuildingNameErrorMsg($stateContainer->getBillingBuildingNameErrorMsg());
                $this->setBillingBuildingNumberErrorMsg($stateContainer->getBillingBuildingNumberErrorMsg());
		$this->setBillingAddress1ErrorMsg($stateContainer->getBillingAddress1ErrorMsg());
		$this->setBillingAddress2ErrorMsg($stateContainer->getBillingAddress2ErrorMsg());
 		$this->setBillingCityErrorMsg($stateContainer->getBillingCityErrorMsg());
		$this->setBillingCountyErrorMsg($stateContainer->getBillingCountyErrorMsg());
 		$this->setBillingPostcodeErrorMsg($stateContainer->getBillingPostcodeErrorMsg());
		$this->setBillingContactNumberErrorMsg($stateContainer->getBillingContactNumberErrorMsg());
		$this->setPaymentMethod ( $stateContainer->getPaymentMethod() );
         
         
         
		
		$this->setCreditcardtype($stateContainer->getCreditCardType());
		$this->setcreditcardnumber($stateContainer->getCreditCardNumber());
		$this->setcvv2($stateContainer->getCVV2());
		$this->setissuenumber($stateContainer->getIssueNumber());
		$this->setstartdatemonth($stateContainer->getStartDateMonth());
		$this->setstartdateyear($stateContainer->getStartDateYear());
		$this->setexpirydatemonth($stateContainer->getExpiryDateMonth());
		$this->setexpirydateyear($stateContainer->getExpiryDateYear());
		
		
         
		$this->setCreditCardTypeErrorMsg($stateContainer->getCreditCardTypeErrorMsg());
		$this->setCreditCardNumberErrorMsg($stateContainer->getCreditCardNumberErrorMsg());
		$this->setCvv2ErrorMsg($stateContainer->getCVV2ErrorMsg());
		$this->setIssuenumberErrorMsg($stateContainer->getIssueNumberErrorMsg());
		$this->setStartdatemonthErrorMsg($stateContainer->getStartDateMonthErrorMsg());
		$this->setStartdateyearErrorMsg($stateContainer->getStartDateYearErrorMsg());
		$this->setExpirydatemonthErrorMsg($stateContainer->getExpiryDateMonthErrorMsg());
		$this->setExpirydateyearErrorMsg($stateContainer->getExpiryDateYearErrorMsg());
         
		
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('checkoutWebletState', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_basket' )
                {
                        $this->_confirm_basket( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'choose_payment_method' )
                {
                        $this->_choose_payment_method( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'enter_delivery_details' )
                {
                        $this->_enter_delivery_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'enter_billing_details' )
                {
                        $this->_enter_billing_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_all_details' )
                {
                        $this->_confirm_all_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'send_to_protx' )
                {
                        $this->_send_to_protx( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'paypalexpresscheckout' )
                {
                        $this->_paypal_express_checkout ( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'paypalexpresscheckoutreturn' )
                {
                        $this->_paypal_express_checkout_return ( $httpRequest, $httpResponse  );
                }
                elseif ( $view == 'paypalexpresscheckoutcancel' )
                {
                        die("cancelled");
                }
                else
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        function _paypal_express_checkout_return ( &$httpRequest, &$httpResponse )
        {
                
                $this->_restoreWebletState();
                $token = $httpRequest->getParameter('token');
                $payerId = $httpRequest->getParameter('PayerID');
                
                
                //lookup the payment for the order
                $payment = Payment::findFirst(array('id' => $this->getPaymentId()), $this->getConnection());
                
                $payment->setAttributeValue('PayerId', $payerId);
                
                //ok, lets get us some details from Paypal!
                $response = PaypalSOAP::getExpressCheckoutDetails($token);
                
                $details = $response->getGetExpressCheckoutDetailsResponseDetails();
              
                $payer_info = $details->getPayerInfo();
                $payer_id = $payer_info->getPayerID();
              
                $address = $payer_info->getAddress();
                $street1 = $address->getStreet1();
                $street2 = $address->getStreet2();
                $city_name = $address->getCityName();
                $state_province = $address->getStateOrProvince();
                $postal_code = $address->getPostalCode();
                $country_code = $address->getCountryName();
              
                $order_total = $currencyCodeType.' '.$paymentAmount;
                
                //set the details into the weblet
                //fetch firstname and surname from name
                $name = $address->getName();
                
                $namewords = explode(" ",$name);
                
                $firstname = $namewords[0];
                $surname = "";
                $first = true;
                foreach ( $namewords as $word )
                {
                     if ( $first == true )
                     {      
                            $first = false;
                            continue;
                     }
                     else
                     {
                            $surname .= $word." ";
                     }
                     
                     
                }
                
                
                $this->setDeliveryFirstName($firstname);
                $this->setDeliverySurname($surname);
                $this->setDeliveryBuildingName('');
                $this->setDeliveryCompanyName('');
                $this->setDeliveryBuildingNumber('');
		$this->setDeliveryAddress1($street1);
		$this->setDeliveryAddress2($street2);
 		$this->setDeliveryCity($city_name);
		$this->setDeliveryCounty($state_province);
 		$this->setDeliveryPostcode($postal_code);
		$this->setDeliveryContactNumber($payer_info->getContactPhone());
		$this->setEmail($payer_info->getPayer());
		
		
		
                $this->setBillingFirstName($firstname);
                $this->setBillingSurname($surname);
                $this->setBillingBuildingName('');
                $this->setBillingCompanyName('');
                $this->setBillingBuildingNumber('');
		$this->setBillingAddress1($street1);
		$this->setBillingAddress2($street2);
 		$this->setBillingCity($city_name);
		$this->setBillingCounty($state_province);
 		$this->setBillingPostcode($postal_code);
		$this->setBillingContactNumber($payer_info->getContactPhone());
                
                
                //update the order with those details
                $order = ProductOrder::findFirst(array('id' => $this->getOrderId()), $this->getConnection());
                
                $order->setAttributeValue('Billing Contact Number', $this->getDeliveryContactNumber());
                
		$order->setAttributeValue('Billing Email Address', $this->getEmail());
		$order->setAttributeValue('Delivery Title', '');
		$order->setAttributeValue('Delivery Firstname', $this->getDeliveryFirstname());
		$order->setAttributeValue('Delivery Surname', $this->getDeliverySurname());
                $order->setAttributeValue('Delivery Business Name', $this->getDeliveryCompanyName());
                
                $order->setAttributeValue('Delivery Building Name', $this->getDeliveryBuildingName());
                
                
                $order->setAttributeValue('Delivery Contact Number', $this->getDeliveryBuildingNumber());
                $order->setAttributeValue('Delivery Address Line 1', $this->getDeliveryAddress1());
                $order->setAttributeValue('Delivery Address Line 2', $this->getDeliveryAddress2());
                $order->setAttributeValue('Delivery City', $this->getDeliveryCity());
                $order->setAttributeValue('Delivery County', $this->getDeliveryCounty());
                $order->setAttributeValue('Delivery Postcode', $this->getDeliveryPostcode());
                
                $order->setAttributeValue('Billing Title', '');
                $order->setAttributeValue('Billing Firstname', $this->getBillingFirstname());
                $order->setAttributeValue('Billing Surname', $this->getBillingSurname());
                
                
                
                $order->setAttributeValue('Billing Business Name', $this->getBillingCompanyName());
                $order->setAttributeValue('Billing Building Name', $this->getBillingBuildingName());
                
                $order->setAttributeValue('Billing Building Number', $this->getBillingBuildingNumber());
                $order->setAttributeValue('Billing Address Line 1', $this->getBillingAddress1());
                $order->setAttributeValue('Billing Address Line 2', $this->getBillingAddress2());
                $order->setAttributeValue('Billing City', $this->getBillingCity());
                $order->setAttributeValue('Billing County', $this->getBillingCounty());
                $order->setAttributeValue('Billing Postcode', $this->getBillingPostcode());
                
                $order->commit();
                
                $this->_saveWebletState();
                
                return $this->_confirm_all_details(&$httpRequest, &$httpResponse, 1 );
        }
        
        function _paypal_express_checkout ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                $basket = $this->getBasket();
                
                if ( is_null($basket) )
                {
                        $basket = eComBasket::getInstance();
                        $basket->updateBasketFields($this->getConnection());
                        $this->setBasket($basket);
                }
                
                
                $tokendata = PaypalSOAP::setExpressCheckout($basket);
                
                
                
                 if ( !is_null($tokendata->Token) && $tokendata->Token != "" && $tokendata->Ack == "Success" )
                 {
                     
                     
                     
                 }
                 else
                 {
                     die("cant seem to connect to paypal");
                 }
                
                //store the order and the payment with this token
                $order =& $this->_convertBasketToDBOrder(
                        $basket,
                        $this->getConnection()
                        );
                
                $this->setOrderId($order->getId());
                
                $this->setPaymentMethod('paypal_expresscheckout');
                $payment = new Payment();
                $payment->setConnection($GLOBALS['dbConnection']);
                $payment->setTypeId(2);
                $payment->setOrderId($order->getId());
                $payment->commit();
                
                $this->setPaymentId($payment->getId());
                
                
                $this->_saveWebletState();
                
                
                
                $token = $tokendata->Token;
                
                $payment->setAttributeValue('Token', $token);
                $payment->setAttributeValue('TokenData', print_r($tokendata,true));
                
                $mode = Configuration::getParameter('paypal_mode');
                
                $expressURL = Configuration::getParameter('paypal_express_url_'.$mode);
                //now we redirect the user to the paypal page
                $expressURL .= '&token='.$token;
                
                $httpResponse->redirect($expressURL);
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_basket_submit' )
                {
                        $this->_confirm_basket_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'choose_payment_method_submit' )
                {
                        $this->_choose_payment_method_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'enter_delivery_details_submit' )
                {
                        $this->_enter_delivery_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'enter_billing_details_submit' )
                {
                        $this->_enter_billing_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_all_details_submit' )
                {
                        $this->_confirm_all_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_all_details_submit_from_paypal' )
                {
                        $this->_confirm_all_details_submit_from_paypal( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'send_to_protx' )
                {
                        $this->_send_to_protx();
                }
                else
                {
                        $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $this->_confirm_basket($httpRequest, $httpResponse);
        }
        
        
        function _confirm_basket ( &$httpRequest, &$httpResponse )
        {
                $view =& $httpRequest->getParameter('view');
                if ( $view == 'confirm_basket' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $basket = eComBasket::getInstance();
                        $basket->updateBasketFields($this->getConnection());
                        $this->setBasket($basket);
                        
                        $this->_saveWebletState();
                }
                
                $template =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                $template->assign('subtemplate', '_ecomstore/checkout/confirm_basket.tpl');
                
                $basket =& $this->getBasket();
                $template->assign('basket', $basket);
                
                $basketItems = array();
                foreach ( $basket->asArray() as $basketItem )
                {
                        $product = Product::findFirst(
                                array('id' => $basketItem->getProductId()),
                                $this->getConnection());
                        $basketItems []= array(
                                'product' => $product,
                                'qty' => $basketItem->getQuantity(),
                                'item' => $basketItem
                                );
                }
                $template->assign_by_ref('basketItems', $basketItems);
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_basket_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_confirm_basket_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_confirm_basket_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('enter_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=confirm_basket');
        }
        
        function _choose_payment_method_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_choose_payment_method_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_choose_payment_method_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('enter_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=confirm_basket');
        }

        function _choose_payment_method_confirm ( &$httpRequest, &$httpResponse )
        {
              if ( $httpRequest->getParameter('paymentmethod') == 'paypal_websitepaymentspro' )
              {
                       $this->setView('paypal_websitepaymentspro');
                       $this->setPaymentMethod('paypal_websitepaymentspro');
                       $this->_saveWebletState();
                       $httpResponse->redirect('checkout.php?view=enter_delivery_details');
              }
              else if ( $httpRequest->getParameter('paymentmethod') == 'paypal_websitepaymentsstandard' )
              {
                       $this->setView('paypal_websitepaymentsstandard');
                       $this->setPaymentMethod('paypal_websitepaymentsstandard');
                       $this->_saveWebletState();
                       $httpResponse->redirect('checkout.php?view=enter_delivery_details');
              }
        }
        
        
        function _choose_payment_method_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->setView('confirm_basket');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=confirm_basket');
        }
        
        
       
        function _confirm_basket_confirm ( &$httpRequest, &$httpResponse )
        {
                $this->setView('choose_payment_method');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=choose_payment_method');
              /*
                $this->setView('enter_delivery_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=enter_delivery_details');
                */
        }
        
        
        function _confirm_basket_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect('basket.php');
        }
        
        
        
        
        
        
        
        
        function _choose_payment_method ( &$httpRequest, &$httpResponse )
        {
                $view =& $httpRequest->getParameter('view');
                
                $template =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                $template->assign('subtemplate', '_ecomstore/checkout/choose_payment_method.tpl');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                
                
                
                $httpResponse->setContent($template->render());
        }
        
        
        
        
        function _enter_delivery_details ( &$httpRequest, &$httpResponse )
        {
                $view =& $httpRequest->getParameter('view');
                if ( $view == 'enter_delivery_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->setView('confirm_basket');
                        $this->_saveWebletState();
                        $httpResponse->redirect('checkout.php?view=confirm_basket');
                        return;
                }
                
                $template =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                $template->assign('subtemplate', '_ecomstore/checkout/enter_delivery_details.tpl');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                
                
                $template->assign('deliveryDates',
                        $this->generateDeliveryDatesArray());
                
		$template->assign('firstname',$this->getDeliveryFirstname());
		$template->assign('surname',$this->getDeliverySurname());
                $template->assign('companyName',$this->getDeliveryCompanyName());
                $template->assign('buildingName',$this->getDeliveryBuildingName());
		$template->assign('buildingNumber',$this->getDeliveryBuildingNumber());
		$template->assign('address1',$this->getDeliveryAddress1());
		$template->assign('address2',$this->getDeliveryAddress2());
		$template->assign('city',$this->getDeliveryCity());
		$template->assign('county',$this->getDeliveryCounty());
		$template->assign('postcode',$this->getDeliveryPostcode());
		$template->assign('contactNumber',$this->getDeliveryContactNumber()); 
        	$template->assign('emailAddress',$this->getEmail());
                
                
                $template->assign('paymentmethod', $this->getPaymentMethod());
                
                $template->assign('firstnameErrorMessage', $this->getDeliveryFirstnameErrorMsg());
                $template->assign('surnameErrorMessage', $this->getDeliverySurnameErrorMsg());
                $template->assign('buildingNumberErrorMessage', $this->getDeliveryBuildingNumberErrorMsg());
                $template->assign('address2ErrorMessage', $this->getDeliveryAddress2ErrorMsg());
                $template->assign('cityErrorMessage', $this->getDeliveryCityErrorMsg());
                $template->assign('countyErrorMessage', $this->getDeliveryCountyErrorMsg());
                $template->assign('postcodeErrorMessage', $this->getDeliveryPostcodeErrorMsg());
                $template->assign('contactNumberErrorMessage', $this->getDeliveryContactNumberErrorMsg());
                $template->assign('emailAddressErrorMessage', $this->getEmailErrorMsg());
                
                $template->assign('selectedHeardOfSite', $this->getHeardOfSite());
                
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _enter_delivery_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_enter_delivery_details_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_enter_delivery_details_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('confirm_all_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=enter_billing_details');
        }
        
        
        function _enter_delivery_details_confirm ( &$httpRequest, &$httpResponse )
        {

		$this->setDeliveryFirstname($httpRequest->getParameter('firstname'));
		$this->setDeliverySurname($httpRequest->getParameter('surname'));
		//$this->setDeliveryCompanyName($httpRequest->getParameter('companyName'));
                //$this->setDeliveryBuildingName($httpRequest->getParameter('buildingName'));
                //$this->setDeliveryBuildingNumber($httpRequest->getParameter('buildingNumber'));
		$this->setDeliveryAddress1($httpRequest->getParameter('address1'));
		$this->setDeliveryAddress2($httpRequest->getParameter('address2'));
		$this->setDeliveryCity($httpRequest->getParameter('city'));
		$this->setDeliveryCounty($httpRequest->getParameter('county'));
		$this->setDeliveryPostcode($httpRequest->getParameter('postcode'));
		$this->setDeliveryContactNumber($httpRequest->getParameter('contactNumber'));
		$this->setEmail($httpRequest->getParameter('emailAddress'));
                
                
                $this->setHeardOfSite($httpRequest->getParameter('heardofsite'));
                
                

                $errorcount =& $this->delivery_quickvalidate($template);
		
		if( $errorcount > 0 )
                {
                        $this->setView('enter_delivery_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('checkout.php?view=enter_delivery_details');
                        return ;
		}
                
                
                $this->setView('enter_billing_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=enter_billing_details');
        }
        
        
        function _enter_delivery_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->setView('');
                $this->_destroyWebletState();
                $httpResponse->redirect('checkout.php');
        }
        
	
        function _enter_billing_details ( &$httpRequest, &$httpResponse )
        {
                $view =& $httpRequest->getParameter('view');
                if ( $view == 'enter_billing_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->setView('confirm_basket');
                        $this->_saveWebletState();
                        $httpResponse->redirect('checkout.php?view=confirm_basket');
                        return;
                }
                
                $template =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                $template->assign('subtemplate', '_ecomstore/checkout/enter_billing_details.tpl');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                
                
		$template->assign('firstname',$this->getBillingFirstname());
		$template->assign('surname',$this->getBillingSurname());
                $template->assign('companyName',$this->getBillingCompanyName());
                $template->assign('buildingName',$this->getBillingBuildingName());
		$template->assign('buildingNumber',$this->getBillingBuildingNumber());
		$template->assign('address1',$this->getBillingAddress1());
		$template->assign('address2',$this->getBillingAddress2());
		$template->assign('city',$this->getBillingCity());
		$template->assign('county',$this->getBillingCounty());
		$template->assign('postcode',$this->getBillingPostcode());
		
		
		
		$template->assign('creditcardtype',$this->getCreditCardType());
		$template->assign('creditcardnumber',$this->getCreditCardNumber());
		$template->assign('cvv2',$this->getCVV2());
		$template->assign('issuenumber',$this->getIssueNumber());
		$template->assign('startdatemonth',$this->getStartDateMonth());
		$template->assign('startdateyear',$this->getStartDateYear());
		$template->assign('expirydatemonth',$this->getExpiryDateMonth());
		$template->assign('expirydateyear',$this->getExpiryDateYear());
		
		
		
		$template->assign('billingUseDeliveryDetails',$this->getBillingUseDeliveryDetails());
                      
                $template->assign('firstnameErrorMessage', $this->getBillingFirstnameErrorMsg());
                $template->assign('surnameErrorMessage', $this->getBillingSurnameErrorMsg());
                $template->assign('buildingNumberErrorMessage', $this->getBillingBuildingNumberErrorMsg());
                $template->assign('address2ErrorMessage', $this->getBillingAddress2ErrorMsg());
                $template->assign('cityErrorMessage', $this->getBillingCityErrorMsg());
                $template->assign('countyErrorMessage', $this->getBillingCountyErrorMsg());
                $template->assign('postcodeErrorMessage', $this->getBillingPostcodeErrorMsg());
                
		$template->assign('creditcardtypeErrorMessage',$this->getCreditCardTypeErrorMsg());
		$template->assign('creditcardnumberErrorMessage',$this->getCreditCardNumberErrorMsg());
		$template->assign('cvv2ErrorMessage',$this->getCVV2ErrorMsg());
		$template->assign('issuenumberErrorMessage',$this->getIssueNumberErrorMsg());
		$template->assign('startdatemonthErrorMessage',$this->getStartDateMonthErrorMsg());
		$template->assign('startdateyearErrorMessage',$this->getStartDateYearErrorMsg());
		$template->assign('expirydatemonthErrorMessage',$this->getExpiryDateMonthErrorMsg());
		$template->assign('expirydateyearErrorMessage',$this->getExpiryDateYearErrorMsg());
		
		
                
                $template->assign('paymentmethod', $this->getPaymentMethod());
                
                $template->assign('currentyear', gmdate('Y'));
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _enter_billing_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_enter_billing_details_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_enter_billing_details_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('confirm_all_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=confirm_all_details');
        }
        
        
        function _enter_billing_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->setView('');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=enter_delivery_details');
        }
        
        
        function _enter_billing_details_confirm ( &$httpRequest, &$httpResponse )
        {
		$this->setBillingUseDeliveryDetails($httpRequest->getParameter('billingusedeliverydetails'));
		
		if($this->getBillingUseDeliveryDetails()!='on'){
		$this->setBillingFirstname($httpRequest->getParameter('firstname'));
		$this->setBillingSurname($httpRequest->getParameter('surname'));
		//$this->setBillingCompanyName($httpRequest->getParameter('companyName'));
                //$this->setBillingBuildingName($httpRequest->getParameter('buildingName'));
                //$this->setBillingBuildingNumber($httpRequest->getParameter('buildingNumber'));
		$this->setBillingAddress1($httpRequest->getParameter('address1'));
		$this->setBillingAddress2($httpRequest->getParameter('address2'));
		$this->setBillingCity($httpRequest->getParameter('city'));
		$this->setBillingCounty($httpRequest->getParameter('county'));
		$this->setBillingPostcode($httpRequest->getParameter('postcode'));
		$this->setBillingContactNumber($httpRequest->getParameter('contactNumber'));
		}else{
		//using delivery details for billing
		$this->setBillingFirstname($this->getDeliveryFirstname());
		$this->setBillingSurname($this->getDeliverySurname());
		//$this->setBillingCompanyName($this->getDeliveryCompanyName());
                //$this->setBillingBuildingName($this->getDeliveryBuildingName());
                //$this->setBillingBuildingNumber($this->getDeliveryBuildingNumber());
		$this->setBillingAddress1($this->getDeliveryAddress1());
		$this->setBillingAddress2($this->getDeliveryAddress2());
		$this->setBillingCity($this->getDeliveryCity());
		$this->setBillingCounty($this->getDeliveryCounty());
		$this->setBillingPostcode($this->getDeliveryPostcode());
		//$this->setBillingContactNumber($this->getDeliveryContactNumber());
		}
		
		$this->setCreditCardType($httpRequest->getParameter('creditcardtype'));
		$this->setCreditCardNumber($httpRequest->getParameter('creditcardnumber'));
		$this->setCVV2($httpRequest->getParameter('cvv2'));
		$this->setIssueNumber($httpRequest->getParameter('issuenumber'));
		$this->setStartDateMonth($httpRequest->getParameter('startdatemonth'));
		$this->setStartDateYear($httpRequest->getParameter('startdateyear'));
		
		$this->setExpiryDateMonth($httpRequest->getParameter('expirydatemonth'));
		$this->setExpiryDateYear($httpRequest->getParameter('expirydateyear'));

                $errorcount =& $this->billing_quickvalidate($template);
		
		
		if( $errorcount > 0 )
                {
                        $this->setView('enter_billing_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('checkout.php?view=enter_billing_details');
                        return ;
		}
                
                $this->setView('confirm_all_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=confirm_all_details');
        }
        
        
        function _confirm_all_details ( &$httpRequest, &$httpResponse, $fromPaypal = 0 )
        {
                $view =& $httpRequest->getParameter('view');
                if ( $view == 'confirm_all_details' || $view == 'paypalexpresscheckoutreturn' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->setView('confirm_basket');
                        $this->_saveWebletState();
                        $httpResponse->redirect('checkout.php?view=confirm_basket');
                        return;
                }
                
                
                $template =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                
                $basket =& $this->getBasket();
                $template->assign('basket', $basket);
                
                $basketItems = array();
                foreach ( $basket->asArray() as $basketItem )
                {
                        $product = Product::findFirst(
                                array('id' => $basketItem->getProductId()),
                                $this->getConnection());
                        $basketItems []= array(
                                'product' => $product,
                                'qty' => $basketItem->getQuantity(),
                                'item' => $basketItem
                                );
                }
                $template->assign_by_ref('basketItems', $basketItems);

                $template->assign('subtemplate', '_ecomstore/checkout/confirm_all_details.tpl');
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                
                $template->assign('delivery_firstname',$this->getDeliveryFirstname());
		$template->assign('delivery_surname',$this->getDeliverySurname());
                $template->assign('delivery_companyName',$this->getDeliveryCompanyName());
                $template->assign('delivery_buildingName',$this->getDeliveryBuildingName());
		$template->assign('delivery_buildingNumber',$this->getDeliveryBuildingNumber());
		$template->assign('delivery_address1',$this->getDeliveryAddress1());
		$template->assign('delivery_address2',$this->getDeliveryAddress2());
		$template->assign('delivery_city',$this->getDeliveryCity());
		$template->assign('delivery_county',$this->getDeliveryCounty());
		$template->assign('delivery_postcode',$this->getDeliveryPostcode());
		$template->assign('delivery_contactNumber',$this->getDeliveryContactNumber()); 
        	$template->assign('delivery_email',$this->getEmail());
                
                
                $template->assign('billing_firstname',$this->getBillingFirstname());
		$template->assign('billing_surname',$this->getBillingSurname());
                $template->assign('billing_companyName',$this->getBillingCompanyName());
                $template->assign('billing_buildingName',$this->getBillingBuildingName());
		$template->assign('billing_buildingNumber',$this->getBillingBuildingNumber());
		$template->assign('billing_address1',$this->getBillingAddress1());
		$template->assign('billing_address2',$this->getBillingAddress2());
		$template->assign('billing_city',$this->getBillingCity());
		$template->assign('billing_county',$this->getBillingCounty());
		$template->assign('billing_postcode',$this->getBillingPostcode());


		
		$template->assign('creditcardtype',$this->getCreditCardType());
		$template->assign('creditcardnumber',$this->getCreditCardNumber());
		$template->assign('cvv2',$this->getCVV2());
		$template->assign('issuenumber',$this->getIssueNumber());
		$template->assign('startdatemonth',$this->getStartDateMonth());
		$template->assign('startdateyear',$this->getStartDateYear());
		$template->assign('expirydatemonth',$this->getExpiryDateMonth());
		$template->assign('expirydateyear',$this->getExpiryDateYear());
		
		$template->assign('payment_method', $this->getPaymentMethod());
		
		
                if ( $fromPaypal == 1 )
                {
                     $template->assign('fromPaypal', 1);
                }

                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_all_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_confirm_all_details_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_confirm_all_details_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('enter_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=send_to_protx');
        }        


        function _confirm_all_details_submit_from_paypal ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                if ( $httpRequest->getParameter('continue_button') == 'Continue' ||
                        $httpRequest->getParameter('continue_button_x') != NULL )
                {
                        return $this->_confirm_all_details_from_paypal_confirm($httpRequest, $httpResponse);
                }
                elseif ( $httpRequest->getParameter('cancel_button') == 'Cancel' ||
                        $httpRequest->getParameter('cancel_button_x') != NULL )
                {
                        return $this->_confirm_all_details_cancel($httpRequest, $httpResponse);
                }
                
                $this->setView('enter_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=send_to_protx');
        }        
        
        
        function _confirm_all_details_from_paypal_confirm ( &$httpRequest, &$httpResponse )
        {
              /*
                $this->setView('send_to_protx');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=send_to_protx');
                */
                
                //now we approve the payment with paypal, send out emails etc, show order complete (or failure) screen!
                $payment = Payment::findFirst(array('id' => $this->getPaymentId()), $this->getConnection());
                
                
                $order = ProductOrder::findFirst(array('id' => $this->getOrderId()), $this->getConnection());
                
                $paymentinfo = PaypalSOAP::DoExpressCheckoutPayment($payment, $order);
                
                
                if ( $paymentinfo->Ack == 'Success' )
                {//order is complete
                     
                     //store payment info
                     $payment->setAttributeValue('rawpaymentinfo', print_r($paymentinfo, true));
                     
                     $details = $paymentinfo->getDoExpressCheckoutPaymentResponseDetails();
                     
                     $payment_info = $details->getPaymentInfo();
                     $tran_ID = $payment_info->getTransactionID();
                     
                     $amt_obj = $payment_info->getGrossAmount();
                     $amt = $amt_obj->_value;
                     $currency_cd = $amt_obj->_attributeValues['currencyID'];

                     $payment->setAttributeValue('Currency_Paid', $currency_cd);
                     $payment->setAttributeValue('Amount_Paid', $amt);
                     $payment->setAttributeValue('Transaction_Id', $tran_ID);
                     
                     //send out emails
                     OrderEmails::sendAllEmails($payment, $order);
                     
                     //show order complete
                     $httpResponse->redirect('order_complete.php?orderid='.$order->getId());
                }
                else
                {//order failed
                     
                     $httpResponse->redirect('order_failure.php?orderid='.$order->getId());
                }
        }
        

        function _confirm_all_details_confirm ( &$httpRequest, &$httpResponse )
        {
               if ( $this->getPaymentMethod() == 'paypal_websitepaymentspro' )
               {
                    
                    
                    //lets attempt to authorise the payment
                    $startdate = '';
                    
                    //fix the expiry/start dates if neccessary
                    if ( $this->getStartDateMonth() < 10 )
                    {
                         $startdate = '0';
                    }
                    
                    $startdate .= $this->getStartDateMonth().$this->getStartDateYear();
                    
                    
                    $expirydate = '';
                    
                    //fix the expiry/start dates if neccessary
                    if ( $this->getExpiryDateMonth() < 10 )
                    {
                         $expirydate = '0';
                    }
                    
                    $expirydate .= $this->getExpiryDateMonth().substr($this->getExpiryDateYear(), 2, 4);
                    
                    $response = PaypalPayflow::doTransaction('S', $_SERVER['REMOTE_ADDR'], $this->basket->formattedTotal(), $startdate, $expirydate, $this->getBillingFirstname(), $this->getBillingSurname(), $this->getBillingAddress1(), $this->getBillingAddress2(), $this->getBillingCity(), $this->getBillingCounty(), 'GB', $this->getBillingPostcode(),'GBP', $this->getDeliveryFirstname(), $this->getDeliverySurname(), $this->getDeliveryAddress1(), $this->getDeliveryAddress2(), $this->getDeliveryCity(), $this->getDeliveryCounty(), 'GB',  $this->getDeliveryPostcode(), $this->getEmail(), $this->getDeliveryContactNumber(), $this->getCreditCardType(), $this->getCreditCardNumber(), $this->getStartDateMonth(), $this->getStartDateYear(), $this->getExpiryDateMonth(), $this->getExpiryDateYear(), $this->getCVV2(), $expirydate);
                    
                    
                    
                    //stuff the result into the database
                    
                    if ( $response['RESPMSG'] != 'Approved' )
                    {
                    
                         if ( is_null($response['hfmessage']) || strlen($response['hfmessage']) < 1 )
                         {
                              $this->setCreditCardNumberErrorMsg('Sorry, the credit card authorization failed. Please double-check your name, billing address and card details and try again.');
                         }
                         else
                         {
                              $this->setCreditCardNumberErrorMsg($response['hfmessage']);
                         }
                         
                         $errorcount++;
                    }
                    
                    if ( $errorcount > 0 )
                    {
                         
                         //save state and redirect back to billing details
                         $this->setView('enter_billing_details');
                         $this->_saveWebletState();
                         $httpResponse->redirect('checkout.php?view=enter_billing_details');
                         
                    }
                    else
                    {
                              
                              $basket = $this->getBasket();
                              
                              //store the order and the payment 
                              $order =& $this->_convertBasketToDBOrder(
                                   $basket,
                                   $this->getConnection()
                                   );
                              
                              $this->setOrderId($order->getId());
                              
                              
                                             
                                             
                              //update the order with those details
                              
                              $order->setAttributeValue('Billing Contact Number', $this->getDeliveryContactNumber());
                              
                              $order->setAttributeValue('Billing Email Address', $this->getEmail());
                              $order->setAttributeValue('Delivery Title', '');
                              $order->setAttributeValue('Delivery Firstname', $this->getDeliveryFirstname());
                              $order->setAttributeValue('Delivery Surname', $this->getDeliverySurname());
                              $order->setAttributeValue('Delivery Business Name', $this->getDeliveryCompanyName());
                              
                              $order->setAttributeValue('Delivery Building Name', $this->getDeliveryBuildingName());
                              
                              
                              $order->setAttributeValue('Delivery Contact Number', $this->getDeliveryBuildingNumber());
                              $order->setAttributeValue('Delivery Address Line 1', $this->getDeliveryAddress1());
                              $order->setAttributeValue('Delivery Address Line 2', $this->getDeliveryAddress2());
                              $order->setAttributeValue('Delivery City', $this->getDeliveryCity());
                              $order->setAttributeValue('Delivery County', $this->getDeliveryCounty());
                              $order->setAttributeValue('Delivery Postcode', $this->getDeliveryPostcode());
                              
                              $order->setAttributeValue('Billing Title', '');
                              $order->setAttributeValue('Billing Firstname', $this->getBillingFirstname());
                              $order->setAttributeValue('Billing Surname', $this->getBillingSurname());
                              
                              
                              
                              $order->setAttributeValue('Billing Business Name', $this->getBillingCompanyName());
                              $order->setAttributeValue('Billing Building Name', $this->getBillingBuildingName());
                              
                              $order->setAttributeValue('Billing Building Number', $this->getBillingBuildingNumber());
                              $order->setAttributeValue('Billing Address Line 1', $this->getBillingAddress1());
                              $order->setAttributeValue('Billing Address Line 2', $this->getBillingAddress2());
                              $order->setAttributeValue('Billing City', $this->getBillingCity());
                              $order->setAttributeValue('Billing County', $this->getBillingCounty());
                              $order->setAttributeValue('Billing Postcode', $this->getBillingPostcode());
                              
                              $order->commit();
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              $payment = new Payment();
                              $payment->setConnection($GLOBALS['dbConnection']);
                              $payment->setTypeId(3);
                              $payment->setOrderId($order->getId());
                              $payment->commit();
                              
                              $payment->setAttributeValue('rawpaymentinfo', print_r($response, true));
                              $this->setPaymentId($payment->getId());
                              
                              
                              $this->_saveWebletState();
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              //store payment info
                              
          
                              $payment->setAttributeValue('Currency_Paid', 'GBP');
                              $payment->setAttributeValue('Amount_Paid', $this->basket->formattedTotal());
                              $payment->setAttributeValue('Transaction_Id', $response['PNREF']);
                              
                              //send out emails
                              OrderEmails::sendAllEmails($payment, $order);
                              
                              //show order complete
                              $httpResponse->redirect('order_complete.php?orderid='.$order->getId());
                    
                    
                    
                    }
		             
                    
               }
               else if ( $this->getPaymentMethod() == "paypal_websitepaymentsstandard" )
               {
                    
                    $this->_restoreWebletState();
                    
                    $tmpl =& new JusteCommerceCheckoutTemplate(
                         $this->getConfigurator(),
                         $this->getConnection()
                         );
                    $tmpl->assign('subtemplate', '_ecomstore/checkout/send_to_paypal.tpl');
                    
                    $basket = $this->getBasket();
     
                    $order =& $this->_convertBasketToDBOrder(
                         $basket,
                         $this->getConnection());
                    
          
                    $this->setOrderId($order->getId());
                    
                    
                                   
                                   
                    //update the order with those details
                    
                    $order->setAttributeValue('Billing Contact Number', $this->getDeliveryContactNumber());
                    
                    $order->setAttributeValue('Billing Email Address', $this->getEmail());
                    $order->setAttributeValue('Delivery Title', '');
                    $order->setAttributeValue('Delivery Firstname', $this->getDeliveryFirstname());
                    $order->setAttributeValue('Delivery Surname', $this->getDeliverySurname());
                    $order->setAttributeValue('Delivery Business Name', $this->getDeliveryCompanyName());
                    
                    $order->setAttributeValue('Delivery Building Name', $this->getDeliveryBuildingName());
                    
                    
                    $order->setAttributeValue('Delivery Contact Number', $this->getDeliveryBuildingNumber());
                    $order->setAttributeValue('Delivery Address Line 1', $this->getDeliveryAddress1());
                    $order->setAttributeValue('Delivery Address Line 2', $this->getDeliveryAddress2());
                    $order->setAttributeValue('Delivery City', $this->getDeliveryCity());
                    $order->setAttributeValue('Delivery County', $this->getDeliveryCounty());
                    $order->setAttributeValue('Delivery Postcode', $this->getDeliveryPostcode());
                    
                    $order->setAttributeValue('Billing Title', '');
                    $order->setAttributeValue('Billing Firstname', $this->getBillingFirstname());
                    $order->setAttributeValue('Billing Surname', $this->getBillingSurname());
                    
                    
                    
                    $order->setAttributeValue('Billing Business Name', $this->getBillingCompanyName());
                    $order->setAttributeValue('Billing Building Name', $this->getBillingBuildingName());
                    
                    $order->setAttributeValue('Billing Building Number', $this->getBillingBuildingNumber());
                    $order->setAttributeValue('Billing Address Line 1', $this->getBillingAddress1());
                    $order->setAttributeValue('Billing Address Line 2', $this->getBillingAddress2());
                    $order->setAttributeValue('Billing City', $this->getBillingCity());
                    $order->setAttributeValue('Billing County', $this->getBillingCounty());
                    $order->setAttributeValue('Billing Postcode', $this->getBillingPostcode());
                    
                    $order->commit();
                    
                    
                    
          
                    $payment = new Payment();
                    $payment->setConnection($GLOBALS['dbConnection']);
                    $payment->setTypeId(3);
                    $payment->setOrderId($order->getId());
                    $payment->commit();
                    
                    
                    //store payment info
                    

                    $payment->setAttributeValue('Currency_Paid', 'GBP');
                    $payment->setAttributeValue('Amount_Paid', $this->basket->formattedTotal());
                    $payment->setAttributeValue('Invoice', $order->getId());
                    
          
                    
                    $mode = Configuration::getParameter('paypal_mode');
                    if ( $mode != 'test' && $mode != 'live')
                    {	
                         die('invalid paypal_mode set! use "test" or "live", not '.$mode);
                    }
                    
                    $tmpl->assign('action',
                         Configuration::getParameter('paypal_'.$mode.'_action_url'));
                    $tmpl->assign('notify_url',
                         Configuration::getParameter('paypal_notifyurl'));
                    $tmpl->assign('successUrl',
                         Configuration::getParameter('paypal_successurl'));
                    $tmpl->assign('item_name', 'JusteCommerce Order');
                    $tmpl->assign('cancelUrl',
                         Configuration::getParameter('paypal_cancelurl'));
                    $tmpl->assign('business_email',
                         Configuration::getParameter('paypal_'.$mode.'_address'));
                    $tmpl->assign('invoice_id', $order->getId());
                    $tmpl->assign('taxamount', $order->vat());
                    $tmpl->assign('carriagecharge',
                         $order->formattedCarriageChargeExVat());
                    $tmpl->assign('basketitems', $basket->getBasket());
                    
                    Out::writeOut($tmpl->render());
               }
               else
               {
                    die("hmmm.... I dont know how to handle this payment method.");
               }
        }
        
        
        function _confirm_all_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->setView('enter_billing_details');
                $this->_saveWebletState();
                $httpResponse->redirect('checkout.php?view=enter_billing_details');
        }
        
        
        /* Protx stuff */
        function _send_to_protx ()
        {
                $this->_restoreWebletState();
                
                $tmpl =& new JusteCommerceCheckoutTemplate(
                        $this->getConfigurator(),
                        $this->getConnection()
                        );
                $tmpl->assign('subtemplate', '_ecomstore/checkout/send_to_protx.tpl');
                
                $basket = $this->getBasket();

                $order =& $this->_convertBasketToDBOrder(
                        $basket,
                        $this->getConnection()
                        );

                $vspBasket =& $this->_convertBasketToVspBasket(
                        $basket,
                        $connection
                        );

                $vspRequest =& $this->_prepareVspFormRequest(
                        $vspBasket,
                        $this->getConnection()
                        );

                $payment =& $this->_prepareDBPayment(
                        $order,
                        $vspRequest,
                        $vspBasket,
                        $this->getConnection()
                        );
                
                $vspSite = Configuration::getParameter('vsp_site');
                $vspVendor = Configuration::getParameter('vsp_vendor_name');
                
                $tmpl->assign('VSP_SITE', $vspSite);
                $tmpl->assign('VPSProtocol', '2.22');
                $tmpl->assign('TxType', 'PAYMENT');
                $tmpl->assign('Vendor', $vspVendor);
                $tmpl->assign('Crypt', $vspRequest->encrypt());
                
                Out::writeOut($tmpl->render());
        }
        
        
        function _confirm_order ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function _confirm_order_submit ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function _payment ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        function _order_confirmation ( &$httpRequest, &$httpResponse )
        {
                ;
        }
        
        
        
        
        function generateDeliveryDatesArray ()
        {
                $deliveryDates = array();
                
                $currentTZ = getenv('TZ');
                putenv('TZ=Europe/London');
                
                $startdate = time();
                //$startdate = mktime(11, 59, 0, 7, 21, 2007);
                //print $this->formatDeliveryDate($startdate);
                $days = 10;
                $currentdate = $startdate;
                $timestamps = array();
                $t = 1;
                for ( $d = 0; $d < $days; $d++ )
                {
                        $currentday = date('d', $currentdate);
                        $currentmonth = date('m', $currentdate);
                        $currentyear = date('Y', $currentdate);
                        
                        $timestamp = 
                                mktime(0, 0, 0, $currentmonth,
                                        $currentday + $t, $currentyear);
                        
                        /*
                        This stops people from having delivery within 2 days
                        of when they placed their order
                        */
                        /*uncomment
                        if ( !$this->twoWorkingDays($currentdate, $t) )
                        {
                                $t++;
                                $d--;
                                continue;
                        }*/
                        /*
                        End
                        */
                        
                        
                        /*
                        This bit of code stops people from ordering for
                        Sunday delivery
                        */
                        if ( date('l', $timestamp) == 'Sunday' )
                        {
                                $t++;
                                $d--;
                                continue;
                        }
                        /*
                        End
                        */
                        
                        
                        /*
                        This makes sure people can't order after 12pm
                        */
                        /*uncomment
                        if ( $t == 1 && date('H', $currentdate) >= 12 )
                        {
                                $t++;
                                $d--;
                                continue;
                        }*/
                        /*
                        End
                        */
                        
                        
                        /*
                        This makes sure people can't have next day delivery
                        if they are ordering on a Saturday
                        */
                        /* uncomment
                        if ( $t == 1 && date('l', $timestamp) != 'Saturday' )
                        {
                                if ( date('H', $currentdate) >= 12 )
                                {
                                        $t++;
                                        $d--;
                                        continue;
                                }
                        }*/
                        /*
                        End
                        */
                        
                        /*
                        This makes sure that if people are ordering over the
                        weekend they cannot order for delivery on the Monday
                        that follows immediately
                        */
                        if ( ( $t == 1 || $t == 2 ) &&
                                date('l', $timestamp) == 'Monday' )
                        {
                                $t++;
                                $d--;
                                continue;
                        }
                        /*
                        End
                        */
                        
                        /*
                        This stops people from having a saturday delivery
                        */
                        if ( date('l', $timestamp) == 'Saturday' )
                        {
                                $t++;
                                $d--;
                                continue;
                        }
                        /*
                        End
                        */
                        
                        
                        $t++;
                        $timestamps[] = $timestamp;
                }
                
                $t = 1;
                foreach ( $timestamps as $timestamp )
                {
                        $deliveryDates[] = array(
                                'timestamp' => $timestamp,
                                'selectorValue' => $timestamp,
                                'selectorText' => date('D jS M', $timestamp)
                                );
                        $t++;
                }
                
                //print '<pre>'.print_r($deliveryDates,TRUE).'</pre>';
                
                putenv('TZ='.$currentTZ);
                
                return $deliveryDates;
        }
        
        
        function twoWorkingDays ( $currentdate, $t )
        {
                $currentday = date('d', $currentdate);
                $currentmonth = date('m', $currentdate);
                $currentyear = date('Y', $currentdate);
                
                $workingDays = 0;
                
                for ( $i = 1; $i < $t; $i++ )
                {
                        $timestamp = 
                                mktime(0, 0, 0, $currentmonth,
                                $currentday + $i, $currentyear);
                        if ( date('l', $timestamp) != 'Saturday' &&
                                date('l', $timestamp) != 'Sunday' )
                        {
                                $workingDays++;
                        }
                }
                
                return $workingDays >= 2;
        }
        
        
        function validPostcode ( $postcode )
        {
               $postcode = str_replace(' ', '', $postcode);
          
               $regexp =  '/^[a-z](\d[a-z\d]?|[a-z]\d[a-z\d]?)\d[a-z]{2}$/i';
               
               
               if (preg_match($regexp, $postcode) > 0) {
                    return true;
               } else {
                    return false;
               }
        }
        
        
        function delivery_quickvalidate ( &$template )
        {
                $errorcount = 0;

		$temp_firstname = $this->getDeliveryFirstname();
		$temp_surname = $this->getDeliverySurname();
                $temp_buildingname = $this->getDeliveryBuildingName();
                $temp_buildingnumber = $this->getDeliveryBuildingNumber();
		$temp_address1 = $this->getDeliveryAddress1(); //only address1 is required, others optional
		$temp_city = $this->getDeliveryCity();
		$temp_county = $this->getDeliveryCounty();
		$temp_postcode = $this->getDeliveryPostcode();
		$temp_contactnumber = $this->getDeliveryContactNumber();
		$temp_email = $this->getEmail();

		if ( empty($temp_firstname) )
                {
                        $this->setDeliveryFirstnameErrorMsg('Please enter your First name');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliveryFirstnameErrorMsg('');
		}

		if ( empty($temp_surname) )
                {
                        $this->setDeliverySurnameErrorMsg('Please enter your Surname');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliverySurnameErrorMsg('');
		}
                
                /*
		if ( empty($temp_buildingname) && empty($temp_buildingnumber) )
                {
                        $this->setDeliveryBuildingNumberErrorMsg('Please complete either your Building Name or your Building Number');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliveryBuildingNumberErrorMsg('');
		}
                */
                
		if( empty($temp_address1) )
                {
                        $this->setDeliveryAddress2ErrorMsg('Please enter your Address');
                        $errorcount++;
                }
                else
                {
                        $this->setDeliveryAddress2ErrorMsg('');
		}

		if( empty($temp_city) )
                {
                        $this->setDeliveryCityErrorMsg('Please enter your City');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliveryCityErrorMsg('');
		}

		if( empty($temp_county) )
                {
                        $this->setDeliveryCountyErrorMsg('Please enter your County');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliveryCountyErrorMsg('');
		}

		if( empty($temp_postcode) )
                {
                        $this->setDeliveryPostcodeErrorMsg('Please enter your Postcode');
                        $errorcount++;
		}
                else
                {
                        if ( !$this->validPostcode($temp_postcode) )
                        {
                              $this->setDeliveryPostcodeErrorMsg('This postcode doesn\'t appear to be valid! Please enter a valid postcode.');
                              $errorcount++;
                        }
                        else
                        {
                
                              $this->setDeliveryPostcodeErrorMsg('');
                        
                        }
		}
		
		if( empty($temp_contactnumber) )
                {
                        $this->setDeliveryContactNumberErrorMsg('Please enter your Contact Number');
                        $errorcount++;
		}
                else
                {
                        $this->setDeliveryContactNumberErrorMsg('');
		}
                
		if( empty($temp_email) )
                {
                        $this->setEmailErrorMsg('Please enter your Email Address');
                        $errorcount++;
		}
                else
                {
                
                     if ( !$this->validEmail($temp_email) )
                     {
                        $this->setEmailErrorMsg('Please enter a valid email address!');
                        $errorcount++;
                     }
                     else
                     {
                        $this->setEmailErrorMsg('');
                     }
                     
		}
                
                return $errorcount;
	}
        
        
        function billing_quickvalidate ( &$template )
        {
                $errorcount = 0;

		$temp_firstname = $this->getBillingFirstname();
		$temp_surname = $this->getBillingSurname();
                $temp_buildingname = $this->getBillingBuildingName();
                $temp_buildingnumber = $this->getBillingBuildingNumber();
		$temp_address1 = $this->getBillingAddress1(); //only address1 is required, others optional
		$temp_city = $this->getBillingCity();
		$temp_county = $this->getBillingCounty();
		$temp_postcode = $this->getBillingPostcode();

                $this->setBillingFirstnameErrorMsg('');
                $this->setBillingSurnameErrorMsg('');
                $this->setBillingAddress2ErrorMsg('');
                $this->setBillingCityErrorMsg('');
                $this->setBillingCountyErrorMsg('');
                $this->setBillingPostcodeErrorMsg('');
                        
		if ( empty($temp_firstname) )
                {
                        $this->setBillingFirstnameErrorMsg('Please enter your First name');
                        $errorcount++;
		}
                else
                {
		}

		if ( empty($temp_surname) )
                {
                        $this->setBillingSurnameErrorMsg('Please enter your Surname');
                        $errorcount++;
		}
                else
                {
		}
                
                
		if( empty($temp_address1) )
                {
                        $this->setBillingAddress2ErrorMsg('Please enter your Address');
                        $errorcount++;
                }
                else
                {
		}

		if( empty($temp_city) )
                {
                        $this->setBillingCityErrorMsg('Please enter your City');
                        $errorcount++;
		}
                else
                {
		}

		if( empty($temp_county) )
                {
                        $this->setBillingCountyErrorMsg('Please enter your County');
                        $errorcount++;
		}
                else
                {
		}

		
		
		if( empty($temp_postcode) )
                {
                        $this->setBillingPostcodeErrorMsg('Please enter your Postcode');
                        $errorcount++;
		}
                else
                {
                        if ( !$this->validPostcode($temp_postcode) )
                        {
                              $this->setBillingPostcodeErrorMsg('This postcode doesn\'t appear to be valid! Please enter a valid postcode.');
                              $errorcount++;
                        }
                        else
                        {
                
                              $this->setBillingPostcodeErrorMsg('');
                        
                        }
		}
		
		
		
		
		
		
		
		
		
		
		if ( $this->getPaymentMethod() == 'paypal_websitepaymentspro' )
		{
		
		
                             $this->setCreditCardTypeErrorMsg('');
                             $this->setCreditCardNumberErrorMsg('');
                             $this->setCvv2ErrorMsg('');
                             $this->setIssuenumberErrorMsg('');
                             $this->setStartdatemonthErrorMsg('');
                             $this->setStartdateyearErrorMsg('');
                             $this->setExpirydatemonthErrorMsg('');
                             $this->setExpirydateyearErrorMsg('');
                             
		
		
		   //validate credit card details too
		   
		        if ( !$this->CardNumberLUHNCheck($this->getCreditCardNumber()) )
		        {
                             $this->setCreditCardNumberErrorMsg('This isn\'t a valid credit card number! Please try again.');
		             $errorcount++;
		        }
		        else
		        {
		             $this->setCreditCardNumberErrorMsg('');
		        }
		        
		        if ( !$this->validCVV2($this->getCVV2(), $this->getCreditCardType())  )
		        {
		             $this->setCVV2ErrorMsg('The CVV2 number should be either 4 digits for American Express or 3 digits for other cards.');
		        }
		        else
		        {
		             $this->setCVV2ErrorMsg('');
		        }
		        
		        if ( strlen($this->getIssueNumber()) != 2  && ( $this->getCreditCardType() == 'Switch' || $this->getCreditCardType() == 'Solo' ) )
		        {
		             
		             $this->setIssueNumberErrorMsg('Switch or Solo cards require a 2 digit issue number.');
		        }
		        else
		        {
		             
		             $this->setIssueNumberErrorMsg('');
		        }
		        
		        /*
		        if ( $errorcount == 0 )
		        {
		             
		        }*/
		   
		   
		
		}
		
		
		
                
                return $errorcount;
	}
	
	
	function parsePaypalError ( $error )
	{
	        if ( $error->ErrorCode == 10724 )
	        {
	              $this->setDeliveryPostcodeErrorMsg('Please enter a valid Postcode');
	              
	              
	        }
	
	        return;
	}
        
        
        function formatDeliveryDate ( $timestamp )
        {
                $currentTZ = getenv('TZ');
                putenv('TZ=Europe/London');
                
                $formatted = date('D jS M', $timestamp);
                putenv('TZ='.$currentTZ);
                
                return $formatted;
        }
        
        function withinWorkingDays ( $currentdate, $deliverydate, $days )
        {
                $t_sec =  ( $deliverydate - $currentdate );
                
                $t_min = $t_sec/60; //minutes
                $t_hours = $t_min/60;//hours
                $t = $t_hours/24; //days
                
                $currentday = date('d', $currentdate);
                $currentmonth = date('m', $currentdate);
                $currentyear = date('Y', $currentdate);
                
                $workingDays = 0;
                
                for ( $i = 1; $i < $t; $i++ )
                {
                        $timestamp = 
                                mktime(0, 0, 0, $currentmonth,
                                $currentday + $i, $currentyear);
                        if ( date('l', $timestamp) != 'Saturday' &&
                                date('l', $timestamp) != 'Sunday' )
                        {
                                $workingDays++;
                        }
                }
                
                return $workingDays < $days;
        }
        
        
        
        function isSaturdayDelivery ( $timestamp )
        {
                $currentTZ = getenv('TZ');
                putenv('TZ=Europe/London');
                
                $isSaturdayDelivery = (date('l', $timestamp) == 'Saturday');
                putenv('TZ='.$currentTZ);
                
                return $isSaturdayDelivery;
        }
        
        function isNextDayDelivery ( $timestamp )
        {
               $currentTZ = getenv('TZ');
               putenv('TZ=Europe/London');
               
               if ( $this->withinWorkingDays(time(), $timestamp, 1) )
               {     
                     $isNextDayDelivery = true;
               }
               else
               {
                     $isNextDayDelivery = false;
               }
               
               putenv('TZ='.$currentTZ);
               
               return $isNextDayDelivery;
        }
        
        
        function isNextThreeDaysDelivery ( $timestamp )
        {

               $currentTZ = getenv('TZ');
               putenv('TZ=Europe/London');
               
               if ( $this->withinWorkingDays(time(), $timestamp, 3) )
               {     
                     $isNextThreeDaysDelivery = true;
               }
               else
               {
                     $isNextThreeDaysDelivery = false;
               }
               
               
               putenv('TZ='.$currentTZ);
               
               return $isNextThreeDaysDelivery;
        }
        
        
        function formatDeliveryDateForMySQL ( $timestamp )
        {
                $currentTZ = getenv('TZ');
                putenv('TZ=Europe/London');
                
                $formatted = date('Y-m-d H:i:s', $timestamp);
                putenv('TZ='.$currentTZ);
                
                return $formatted;
        }
        
        
        function &_convertBasketToDBOrder ( &$basket, &$connection )
        {
                // Create new Order object, populate and store.
                $order =& new ProductOrder();                  
                $order->setDatePlaced(time());
                //$order->setContactNumber($this->getDeliveryContactNumber());
                
		//$order->setEmail($this->getEmail());
		/*
                $order->setDeliveryTitle('');
                $order->setDeliveryFirstname($this->getDeliveryFirstname());
                $order->setDeliverySurname($this->getDeliverySurname());
                $order->setDeliveryBusiness($this->getDeliveryCompanyName());
                $order->setDeliveryBuilding($this->getDeliveryBuildingName());
                $order->setDeliveryNumber($this->getDeliveryBuildingNumber());
                $order->setDeliveryAddress1($this->getDeliveryAddress1());
                $order->setDeliveryAddress2($this->getDeliveryAddress2());
                $order->setDeliveryCity($this->getDeliveryCity());
                $order->setDeliveryCounty($this->getDeliveryCounty());
                $order->setDeliveryPostcode($this->getDeliveryPostcode());
                //$order->setDeliveryInstructions($this->getInstructions());
                $order->setHeardOfSite($this->getHeardOfSite());
                
                $order->setBillingTitle('');
                $order->setBillingFirstname($this->getBillingFirstname());
                $order->setBillingSurname($this->getBillingSurname());
                $order->setBillingBusiness($this->getBillingCompanyName());
                $order->setBillingBuilding($this->getBillingBuildingName());
                $order->setBillingNumber($this->getBillingBuildingNumber());
                $order->setBillingAddress1($this->getBillingAddress1());
                $order->setBillingAddress2($this->getBillingAddress2());
                $order->setBillingCity($this->getBillingCity());
                $order->setBillingCounty($this->getBillingCounty());
                $order->setBillingPostcode($this->getBillingPostcode());
                */
                
                $type = 1;
                
                $order->setProductOrderTypeId($type);
                $order->setValue($basket->total());
                $order->commit($connection);
                
                foreach ( $basket->asArray() as $itemId => $item )
                {
                        $orderLine =& new ProductOrderLineDataObject();
                        $orderLine->setOrderId($order->getId());
                        $orderLine->setProductName($item->getProductName());
                        $orderLine->setPrice($item->getPrice());
                        $orderLine->setTax($item->getTax());
                        $orderLine->setQuantity($item->getQuantity());
                        $orderLine->store($connection);
                }
                
                // Stuff carriage charge into db if carriage charge exists.
                if ( $basket->carriageChargeExVat() > 0 )
                {
                        $orderLine =& new ProductOrderLineDataObject();
                        $orderLine->setOrderId($order->getId());
                        $orderLine->setProductName('Carriage Charge');
                        $orderLine->setPrice($basket->carriageChargeExVat());
                        $orderLine->setTax(
                                $basket->carriageChargeIncVat() -
                                $basket->carriageChargeExVat());
                        $orderLine->setQuantity(1);
                        $orderLine->store($connection);
                }
                
                return $order;
        }
        
        
        function &_convertBasketToVspBasket ( &$basket, &$connection )
        {
                $vspBasket =& new VSPBasket();
                
                foreach ( $basket->asArray() as $itemId => $item )
                {
                        $vspBasketItem =& new VSPBasketItem();
                        $vspBasketItem->setItem($item->getProductName());
                        $vspBasketItem->setQuantity($item->getQuantity());
                        
                        $vspBasketItem->setItemValue($item->priceExVat());
			$vspBasketItem->setTax($item->vat());
                        $vspBasketItem->setItemTotal(
                                $item->priceExVat() + $item->vat());
                        $vspBasket->addItem($vspBasketItem);
                }
                
                if ( $basket->carriageChargeExVat() > 0 )
                {
                        $vspBasketItem =& new VSPBasketItem();
                        $vspBasketItem->setItem('Carriage Charge');
                        $vspBasketItem->setQuantity(1);
                        
                        $vspBasketItem->setItemValue(
                                $basket->carriageChargeExVat());
                        $vspBasketItem->setTax(
                                $basket->carriageChargeIncVat() -
                                $basket->carriageChargeExVat());
                        $vspBasketItem->setItemTotal(
                                $basket->carriageChargeIncVat());
                        $vspBasket->addItem($vspBasketItem);
                }
                
                return $vspBasket;
        }
        
        
        function _prepareVspFormRequest ( &$vspBasket, $connection )
        {
                // Generate TxCode
                $txCode = time(). '-' . Session::getId();
		$txCode = substr($txCode,0,40);
                
                $vspRequest =& new VSPFormRequest();
                $vspRequest->setBasket($vspBasket);
                $vspRequest->setCustomerName($this->getDeliveryFirstname() .
                        ' ' . $this->getDeliverySurname() );
                $vspRequest->setCustomerEmail($this->getEmail());
                $wholedeliveryaddress = '';
                /*
                if ( $this->getDeliveryBuildingName() != '' )
                {
                        $wholedeliveryaddress .= $this->getDeliveryBuildingName() . "\n";
                }
                */
		$wholedeliveryaddress = $this->getDeliveryBuildingName() .
                        ' ' . $this->getDeliveryBuildingNumber() .
                        ' ' . $this->getDeliveryAddress1() .
                        ' ' . $this->getDeliveryAddress2() .
                        ' ' . $this->getDeliveryCity().
                        ' ' . $this->getDeliveryCounty();
		$vspRequest->setDeliveryAddress($wholedeliveryaddress);
		$vspRequest->setDeliveryPostcode($this->getDeliveryPostcode());

		$wholebillingaddress = $this->getBillingBuildingName() . 
                        ' ' . $this->getBillingBuildingNumber() . 
                        ' ' . $this->getBillingAddress1() .
                        ' ' . $this->getBillingAddress2() . 
                        ' ' . $this->getBillingCity() .
                        ' ' . $this->getBillingCounty();
		$vspRequest->setBillingAddress($wholebillingaddress);
		$vspRequest->setBillingPostcode($this->getBillingPostcode());

		$vspRequest->setContactNumber($this->getDeliveryContactNumber());
                $vspRequest->setVendorPass(Configuration::getParameter('vsp_encryption_password'));
                $vspRequest->setVendorTxCode($txCode);
                $vspRequest->setAmount(
                        sprintf("%01.02f",
                        $vspBasket->calculateTotalCost()/100 ));
                $vspRequest->setCurrency('GBP');
                $vspRequest->setDescription('Items from JusteCommerce');
                $vspRequest->setSuccessURL(Configuration::getParameter('vsp_success_url'));
                $vspRequest->setFailureURL(Configuration::getParameter('vsp_failure_url'));
                
                return $vspRequest;
        }
        
        
        function &_prepareDBPayment ( &$order, &$vspRequest, &$vspBasket,
                &$connection )
        {
                // Create Payment object, populate and store.
                $payment =& new PaymentDataObject();
                $payment->setOrderId($order->getId());
                $payment->setVSPVendorTxCode($vspRequest->getVendorTxCode());
                $payment->setVSPAmount($vspBasket->calculateTotalCost());
                $payment->setVSPCurrency($vspRequest->getCurrency());
                $payment->setVSPDescription($vspRequest->getDescription());
                $payment->setVSPSuccessURL($vspRequest->getSuccessURL());
                $payment->setVSPFailureURL($vspRequest->getFailureURL());
                $payment->setVSPCustomerName($vspRequest->getCustomerName());
                $payment->setVSPCustomerEmail($vspRequest->getCustomerEmail());
                $payment->setVSPBillingAddress($vspRequest->getBillingAddress());
                $payment->setVSPBillingPostcode($vspRequest->getBillingPostcode());
                $payment->setVSPDeliveryAddress($vspRequest->getDeliveryAddress());
                $payment->setVSPDeliveryPostcode($vspRequest->getDeliveryPostcode());
                $payment->setVSPContactNumber($vspRequest->getContactNumber());
                $payment->setVSPContactFax($vspRequest->getContactFax());
                $payment->setVSPAllowGiftAid($vspRequest->getAllowGiftAid());
                $payment->setVSPApplyCV2($vspRequest->getApplyCV2());
                $payment->setVSPApply3D($vspRequest->getApply3D());
                $payment->setVSPStatus('');
                $payment->setVSPStatusDetails('');
                $payment->setVSPVPSTxId('');
                $payment->setVSPTxAuthNo('');
                $payment->setVSPCV2('');
                $payment->setVSPAddressResult('');
                $payment->setVSPPostcodeResult('');
                $payment->setVSPCV2Result('');
                $payment->setVSPGiftAid('');
                $payment->setVSP3dResult('');
                $payment->setVSPCAVV('');
                $payment->store($connection);
                
                return $payment;
        }
        
        function validEmail ( $emailaddress )
        {
        
              if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $emailaddress)) {
                     return true;
              }
              else {
                     return false;
              }
        
        
        }
        
        
        function CardNumberLUHNCheck ( $cardnumber )
        {
               $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  // strip out any non-digits
               $cardlength=strlen($cardnumber);
               $parity=$cardlength % 2;
               $sum=0;
               for ($i=0; $i<$cardlength; $i++) {
                    $digit=$cardnumber[$i];
                    if ($i%2==$parity) $digit=$digit*2;
                    if ($digit>9) $digit=$digit-9;
                    $sum=$sum+$digit;
               }
               $valid=($sum%10==0);
               return $valid;
        }
        
        function validCVV2 ( $cvv2, $type )
        {
               $newcvv2 = preg_replace("/\D|\s/", "", $cvv2); //strip out non-digits
        
               if ( $cvv2 != $newcvv2 )
               {
                    return false;
               }
               
               if ( $type == 'Amex' )
               {
                    if ( strlen($cvv2) != 4 )
                    {
                         return false;
                    }
                    
               }
               else if ( strlen($cvv2) != 3 )
               {
                    return false;
               }
               
               return true;
               
        }
}

?>
