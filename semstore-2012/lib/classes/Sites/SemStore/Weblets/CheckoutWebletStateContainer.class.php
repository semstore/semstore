<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package Sites.AES.Weblets
 */

require_once('HTTP/WebletStateContainer.class.php');

class CheckoutWebletStateContainer extends WebletStateContainer
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
        
        var $heardofsite = '';
        var $paymentmethod = '';
        
        
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
        

	/*
         *
	 * Constructors
         *
	 */
        
        
        function CheckoutWebletStateContainer ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CheckoutWebletStateContainer'.$numArgs),
                        $args);
        }
        
        
        function _CheckoutWebletStateContainer0 ()
        {
                $this->_initialize();
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
        
        
        function getBasket ()
        {
                return $this->basket;
        }
        
        
        function setBasket ( $basket )
        {
                $this->basket = $basket;
        }
        
        function getPaymentMethod ()
	{
                return $this->paymentmethod;
	}
        
        
	function setPaymentMethod ( $method )
	{
                $this->paymentmethod = $method;
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
        
        
        function getDeliveryFirstnameErrorMsg ()
	{
                return $this->deliveryFirstnameErrorMsg;
	}
        
        
	function setDeliveryFirstnameErrorMsg ( $errorMsg )
	{
                $this->deliveryFirstnameErrorMsg = $errorMsg;
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
        
                
        function getBillingUseDeliveryDetails ()
	{
		return $this->billingUseDeliveryDetails;
	}
 
        function setBillingUseDeliveryDetails ( $newusedetails )
	{
		$this->billingUseDeliveryDetails = $newusedetails;
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
        
        
        
        
}

?>
