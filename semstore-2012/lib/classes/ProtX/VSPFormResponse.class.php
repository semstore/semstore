<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-06
 */

require_once('ProtX/VSPFormUtils.class.php');

class VSPFormResponse extends SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
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
        
        
        var $crypt = '';
        var $vendorPass = '';
        var $status = '';
        var $statusDetails = '';
        var $vendorTxCode = '';
        var $vpsTxId = '';
        var $txAuthNo = '';
        var $amount = '';
        var $avscv2 = '';
        var $addressResult = '';
        var $postcodeResult = '';
        var $cv2result = '';
        var $giftAid = '';
        var $d3SecureResult = '';
        var $cavv = '';
        
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function VSPFormResponse ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'VSPFormResponse'.$numArgs),  $args);
        }
        
        
        function VSPFormResponse0 ()
        {
                die("The constructor of '".get_class($this)."' requires a crypt string");
        }
        
        
        function VSPFormResponse1 ( $crypt )
        {
                $this->_initialize();
                $this->setCrypt($crypt);
                //$this->decrypt();
        }
        
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getCrypt ()
        {
                return $this->crypt;
        }
        
        function setCrypt ( $crypt )
        {
                $this->crypt = $crypt;
        }
        
        
        function getVendorPass ()
        {
                return $this->vendorPass;
        }
        
        
        function setVenderPass ( $vendorPass )
        {
                $this->vendorPass = $vendorPass;
        }
        
        
        function getStatus ()
        {
                return $this->status;
        }
        
        
        function setStatus ( $status )
        {
                $this->status = $status;
        }
        
        
        function getStatusDetails ()
        {
                return $this->statusDetails;
        }
        
        
        function setStatusDetails ( $statusDetails )
        {
                $this->statusDetails = $statusDetails;
        }
        
        
        function getVendorTxCode ()
        {
                return $this->vendorTxCode;
        }
        
        
        function setVendorTxCode ( $vendorTxCode )
        {
                $this->vendorTxCode = $vendorTxCode;
        }
        
        
        function getVpsTxId ()
        {
                return $this->vpsTxId;
        }
        
        
        function setVpsTxId ( $vpsTxId )
        {
                $this->vpsTxId = $vpsTxId;
        }
        
        
        function getTxAuthNo ()
        {
                return $this->txAuthNo;
        }
        
        
        function setTxAuthNo ( $txAuthNo )
        {
                $this->txAuthNo = $txAuthNo;
        }
        
        
        function getAmount ()
        {
                return $this->amount;
        }
        
        
        function setAmount ( $amount )
        {
                $this->amount = $amount;
        }
        
        
        function getCV2 ()
        {
                return $this->avscv2;
        }
        
        
        function setCV2 ( $avscv2 )
        {
                $this->avscv2 = $avscv2;
        }
        
        
        function getAddressResult ()
        {
                return $this->addressResult;
        }
        
        
        function setAddressResult ( $addressResult )
        {
                $this->addressResult = $addressResult;
        }
        
        
        function getPostcodeResult ()
        {
                return $this->postcodeResult;
        }
        
        
        function setPostcodeResult ( $postcodeResult )
        {
                $this->postcodeResult = $postcodeResult;
        }
        
        
        function getCV2Result ()
        {
                return $this->cv2result;
        }
        
        
        function setCV2Result ( $cv2result )
        {
                $this->cv2result = $cv2result;
        }
        
        
        function getGiftAid ()
        {
                return $this->giftAid;
        }
        
        
        function setGiftAid ( $giftAid )
        {
                $this->giftAid = $giftAid;
        }
        
        
        function getD3Result ()
        {
                return $this->d3SecureResult;
        }
        
        
        function setD3Result ( $d3SecureResult )
        {
                $this->d3SecureResult = $d3SecureResult;
        }
        
        
        function getCAVV ()
        {
                return $this->cavv;
        }
        
        
        function setCAVV ( $cavv )
        {
                $this->cavv = $cavv;
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
                ;
        }
        
        
        function decrypt ()
        {
                $decoded = VSPFormUtils::SimpleXor(
                        VSPFormUtils::base64Decode($this->getCrypt()),
                        $this->getVendorPass()
                        );
                
                $values = VSPFormUtils::getTokens($decoded);
                $this->setVendorTxCode($values['VendorTxCode']);
                $this->setStatus($values['Status']);
                $this->setStatusDetails($values['StatusDetail']);
                $this->setVpsTxId($values['VPSTxId']);
                $this->setTxAuthNo($values['TxAuthNo']);
                $this->setCV2($values['AVSCV2']);
                $this->setAddressResult($values['AddressResult']);
                $this->setPostcodeResult($values['PostCodeResult']);
                $this->setCV2Result($values['CV2Result']);
                $this->setGiftAid($values['GiftAid']);
                $this->setD3Result($values['3DSecureStatus']);
                $this->setCAVV($values['CAVV']);
                
                return count($values);
        }
}

?>
