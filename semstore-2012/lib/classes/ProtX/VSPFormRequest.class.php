<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-06
 */

class VSPFormRequest extends SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        function TX_PAYMENT () { return "PAYMENT"; }
        function TX_DEFERRED () { return "DEFERRED"; }
        function TX_PREAUTH () { return "PREAUTH"; }
        
        function GIFT_AID () { return "1"; }
        function NO_GIFT_AID () { return "0"; }
        
        
        function CV2_DEFAULT () { return "0"; }
        function CV2_FORCE_WITH_RULES () { return "1"; }
        function CV2_NO_FORCE_WITH_RULES () { return "2"; }
        function CV2_FORCE_WITHOUT_RULES () { return "3"; }
        
        function D3_DEFAULT () { return "0"; }
        function D3_FORCE_WITH_RULES () { return "1"; }
        function D3_NO_FORCE_WITH_RULES () { return "2"; }
        function D3_FORCE_WITHOUT_RULES () { return "3"; }
        
        
	/**
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        var $vendorPass = '';
        var $vspProtocol = '2.22';
        var $txType = '';
        var $vendor = '';
        // Crypt is not stored since its a generated attribute.
        var $vendorTxCode = '';
        var $amount = '';
        var $currency = 'GBP';
        var $description = '';
        var $sucessURL = '';
        var $failureURL = '';
        var $customerName = '';
        var $customerEmail = '';
        var $vendorEmail = '';
        var $eMailMessage = '';
        var $billingAddress = '';
        var $billingPostcode = '';
        var $deliveryAddress = '';
        var $deliveryPostcode = '';
        var $contactNumber = '';
        var $contactFax = '';
        var $allowGiftAid = '';
        var $applyAVSCV2 = '';
        var $applyAVS3DSecure = '';
        var $basket = NULL;
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function VSPFormRequest ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'VSPFormRequest'.$numArgs),  $args);
        }
        
        
        function VSPFormRequest0 ()
        {
                $this->_initialize();
        }
        
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getVendorPass ()
        {
                return $this->vendorPass;
        }
        
        
        function setVendorPass ( $vendorPass )
        {
                $this->vendorPass = $vendorPass;
        }
        
        
        function getVSPProtocol ()
        {
                return $this->vspProtocol;
        }
        
        
        function setVSPProtocol ( $vspProtocol )
        {
                $this->vspProtocol = $vspProtocol;
        }
        
        
        function getTxType ()
        {
                return $this->txType;
        }
        
        
        function setTxType ( $txType )
        {
                $this->txType = $txType;
        }
        
        
        function getVendor ()
        {
                return $this->vendor;
        }
        
        
        function setVendor ( $vendor )
        {
                $this->vendor = $vendor;
        }
        
        
        function getVendorTxCode ()
        {
                return $this->vendorTxCode;
        }
        
        
        function setVendorTxCode ( $vendorTxCode)
        {
                $this->vendorTxCode = $vendorTxCode;
        }
        
        
        function getAmount ()
        {
                return $this->amount;
        }
        
        
        function setAmount ( $amount )
        {
                $this->amount = $amount;
        }
        
        
        function getCurrency ()
        {
                
                return $this->currency;
        }
        
        
        function setCurrency ( $currency )
        {
                $this->currency = $currency;
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $description )
        {
                $this->description = $description;
        }
        
        
        function getSuccessURL ()
        {
                return $this->successURL;
        }
        
        
        function setSuccessURL ( $successURL )
        {
                $this->successURL = $successURL;
        }
        
        
        function getFailureURL ()
        {
                return $this->failureURL;
        }
        
        
        function setFailureURL ( $failureURL )
        {
                $this->failureURL = $failureURL;
        }
        
        
        function getCustomerName ()
        {
                return $this->customerName;
        }
        
        
        function setCustomerName ( $customerName )
        {
                $this->customerName = $customerName;
        }
        
        
        function getCustomerEmail ()
        {
                return $this->customerEmail;
        }
        
        
        function setCustomerEmail ( $customerEmail )
        {
                $this->customerEmail = $customerEmail;
        }
        
        
        function getVendorEmail ()
        {
                return $this->vendorEmail;
        }
        
        
        function setVendorEmail ( $vendorEmail )
        {
                $this->vendorEmail = $vendorEmail;
        }
        
        
        function getEmailMessage ()
        {
                return $this->eMailMessage;
        }
        
        
        function setEmailMessage ( $eMailMessage )
        {
                $this->eMailMessage = $eMailMessage;
        }
        
        
        function getBillingAddress ()
        {
                return $this->billingAddress;
        }
        
        
        function setBillingAddress ( $billingAddress )
        {
                $this->billingAddress = $billingAddress;
        }
        
        
        function getBillingPostcode ()
        {
                return $this->billingPostcode;
        }
        
        
        function setBillingPostcode ( $billingPostcode )
        {
                $this->billingPostcode = $billingPostcode;
        }
        
        
        function getDeliveryAddress ()
        {
                return $this->deliveryAddress;
        }
        
        
        function setDeliveryAddress ( $deliveryAddress )
        {
                $this->deliveryAddress = $deliveryAddress;
        }
        
        
        function getdeliveryPostcode ()
        {
                return $this->deliveryPostcode;
        }
        
        
        function setDeliveryPostcode ( $deliveryPostcode )
        {
                $this->deliveryPostcode = $deliveryPostcode;
        }
        
        
        function getContactNumber ()
        {
                return $this->contactNumber;
        }
        
        
        function setContactNumber ( $contactNumber )
        {
                $this->contactNumber = $contactNumber;
        }
        
        
        function getContactFax ()
        {
                return $this->contactFax;
        }
        
        
        function setContactFax ( $contactFax )
        {
                $this->contactFax = $contactFax;
        }
        
        
        function getAllowGiftAid ()
        {
                return $this->allowGiftAid;
        }
        
        
        function setAllowGiftAid ( $allowGiftAid )
        {
                $this->allowGiftAid = $allowGiftAid;
        }
        
        
        function getApplyCV2 ()
        {
                return $this->applyAVSCV2;
        }
        
        
        function setApplyCV2 ( $applyAVSCV2 )
        {
                $this->applyAVSCV2 = $applyAVSCV2;
        }
        
        
        function getApply3D ()
        {
                return $this->applyAVS3DSecure;
        }
        
        
        function setApply3D ( $applyAVS3DSecure )
        {
                $this->applyAVS3DSecure = $applyAVS3DSecure;
        }
        
        
        function getBasket ()
        {
                return $this->basket;
        }
        
        
        function setBasket ( $basket )
        {
                $this->basket = $basket;
        }
        
        
        /**
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        function _initialize ()
        {
                $this->setTxType($this->TX_PAYMENT());
                $this->setAllowGiftAid($this->NO_GIFT_AID());
                $this->setApplyCV2($this->CV2_DEFAULT());
                $this->setApply3D($this->D3_DEFAULT());
                $this->createEmptyBasket();
        }
        
        
        function createEmptyBasket ()
        {
                $basket =& new VSPBasket();
                $this->setBasket($basket);
        }
        
        
        function isValid ()
        {
                return FALSE;
        }
        
        
        function buildVSPString ()
        {
                $stuff = "VendorTxCode=" . $this->getVendorTxCode();
                $stuff .= "&Amount=" . $this->getAmount();
                $stuff .= "&Currency=" . $this->getCurrency();
                $stuff .= "&Description=" . $this->getDescription();
                $stuff .= "&SuccessURL=" . $this->getSuccessURL();
                $stuff .= "&FailureURL=" . $this->getFailureURL();
        
                if ( $this->getCustomerEmail() != '' )
                {
                        $stuff .= "&CustomerEmail=" . $this->getCustomerEmail();
                }
                
                if ( $this->getVendorEmail() != '' )
                {
                        $stuff .= "&VendorEmail=" . $this->getVendorEmail();
                }
                
                if ( $this->getCustomerName() != '' )
                {
                        $stuff .= "&CustomerName=" . $this->getCustomerName();
                }
                
                if ( $this->getDeliveryAddress() != '' )
                {
                        $stuff .= "&DeliveryAddress=" . $this->getDeliveryAddress();
                }
                
                if ( $this->getDeliveryPostCode() != '' )
                {
                        $stuff .= "&DeliveryPostCode=" . $this->getDeliveryPostCode();
                }
                
                if ( $this->getBillingAddress() != '' )
                {
                        $stuff .= "&BillingAddress=" . $this->getBillingAddress();
                }
                
                if ( $this->getBillingPostCode() != '' )
                {
                        $stuff .= "&BillingPostCode=" . $this->getBillingPostCode();
                }
                
                if ( $this->getContactNumber() != '' )
                {
                        $stuff .= "&ContactNumber=" . $this->getContactNumber();
                }
                
                if ( $this->getContactFax() != '' )
                {
                        $stuff .= "&ContactFax=" . $this->getContactFax();
                }
                
                if ( $this->getAllowGiftAid() != '' )
                {
                        $stuff .= "&AllowGiftAid=" . $this->getAllowGiftAid();
                }
                
                if ( $this->getApplyCV2() != '' )
                {
                        $stuff .= "&ApplyAVSCV2=" . $this->getApplyCV2();
                }
                
                if ( $this->getApply3D() != '' )
                {
                        $stuff .= "&Apply3DSecure=" . $this->getApply3D();
                }
                
                $basket = $this->getBasket();
                $stuff .= "&Basket=" . $basket->convertToBasketString();
                //print $basket->convertToBasketString();
                
                return $stuff;
        }
        
        
        function encrypt ()
        {
                $vspStr = $this->buildVSPString();
                return VSPFormUtils::base64encode(
                        VSPFormUtils::simpleXor($vspStr, $this->getVendorPass())
                        );
        }
}

?>
