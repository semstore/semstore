<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-22
 */

class VSPFormUtils extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	/*
	 * Class Methods
	 */
        
        
        function generateTxCode ()
        {
                return date("Ymd-His", time()) . "-" .
                        $_SESSION['customerId'];
        }
        
        
        function buildVSPString ( &$fields, &$basket )
        {
                $stuff = "VendorTxCode=" . $fields['VendorTxCode'];
                $stuff .= "&Amount=" . $fields['Amount'];
                $stuff .= "&Currency=" . $fields['Currency'];
                $stuff .= "&Description=" . $fields['Description'];
                $stuff .= "&SuccessURL=" . $fields['SuccessURL'];
                $stuff .= "&FailureURL=" . $fields['FailureURL'];
        
                if ( isset($fields['CustomerEmail']) &&
                        $fields['CustomerEmail'] != '' )
                {
                        $stuff .= "&CustomerEmail=" . $fields['CustomerEmail'];
                }
                
                if ( isset($fields['VendorEmail']) &&
                        $fields['VendorEmail'] != '' )
                {
                        $stuff .= "&VendorEmail=" . $fields['VendorEmail'];
                }
                
                if ( isset($fields['CustomerName']) &&
                        $fields['CustomerName'] != '' )
                {
                        $stuff .= "&CustomerName=" . $fields['CustomerName'];
                }
                
                if ( isset($fields['DeliveryAddress']) &&
                        $fields['DeliveryAddress'] != '' )
                {
                        $stuff .= "&DeliveryAddress=" . $fields['DeliveryAddress'];
                }
                
                if ( isset($fields['DeliveryPostCode']) &&
                        $fields['DeliveryPostCode'] != '' )
                {
                        $stuff .= "&DeliveryPostCode=" . $fields['DeliveryPostCode'];
                }
                
                if ( isset($fields['BillingAddress']) &&
                        $fields['BillingAddress'] != '' )
                {
                        $stuff .= "&BillingAddress=" . $fields['BillingAddress'];
                }
                
                if ( isset($fields['BillingPostCode']) &&
                        $fields['BillingPostCode'] != '' )
                {
                        $stuff .= "&BillingPostCode=" . $fields['BillingPostCode'];
                }
                
                if ( isset($fields['ContactNumber']) &&
                        $fields['ContactNumber'] != '' )
                {
                        $stuff .= "&ContactNumber=" . $fields['ContactNumber'];
                }
                
                if ( isset($fields['ContactFax']) &&
                        $fields['ContactFax'] != '' )
                {
                        $stuff .= "&ContactFax=" . $fields['ContactFax'];
                }
                
                if ( isset($fields['AllowGiftAid']) &&
                        $fields['AllowGiftAid'] != '' )
                {
                        $stuff .= "&AllowGiftAid=" . $fields['AllowGiftAid'];
                }
                
                if ( isset($fields['ApplyAVSCV2']) &&
                        $fields['ApplyAVSCV2'] != '' )
                {
                        $stuff .= "&ApplyAVSCV2=" . $fields['ApplyAVSCV2'];
                }
                
                if ( isset($fields['Apply3DSecure']) &&
                        $fields['Apply3DSecure'] != '' )
                {
                        $stuff .= "&Apply3DSecure=" . $fields['Apply3DSecure'];
                }
                
                if ( is_object($basket) )
                {
                        /*
                        $dbConn = &createDBConnection();
                        
                        $USER_CLASS =& new User();
                        $user =& $USER_CLASS->lookup(
                                array( 'id' => $_SESSION['userId'] ),
                                $dbConn );
                        $customer = $user->lookupCustomer();
                        
                        $PRODUCT_CLASS =& new Product();
                        //Basket=3:Sony SV-234 DVD Player:1:�170.20:�29.79:�199.99:�199.99:The Fast and The Furious Region 2 DVD:2:�17.01:�2.98:�19.99:�39.98:Delivery:1:�4.99:----:�4.99:�4.99&"
                        $stuff .= "&Basket=" . ($basket->getNumberOfProducts() + 2);
                        $items = $basket->asArray();
                        foreach ( $items as $itemId => $item )
                        {
                                $product =& $PRODUCT_CLASS->lookup(
                                        array( 'id' => $itemId ),
                                        $dbConn );
                                $stuff .= ':' . $product->getProductName();
                                $stuff .= ':' . $items[$itemId]['quantity'];
                                if ( is_object($customer) )
                                {
                                        $price =& $product->lookupPriceForCustomerByObject($customer);
                                        $stuff .= ':' . $price->getFormattedPrice();
                                }
                                else
                                {
                                        $price =& $product->lookupStandardPrice();
                                        $stuff .= ':' . $price->getFormattedPrice();
                                }
                        }
                        
                        $stuff .= ':Delivery Charge:1:'.sprintf("%2.02f", $basket->deliveryCharge / 100);
                        $stuff .= ':VAT:1:'.sprintf("%2.02f", $basket->calculateVAT() / 100);
                        */
                        
                        $stuff .= "&Basket=" . ($basket->getNumberOfProducts() + 1);
                        $items = $basket->asArray();
                        foreach ( $items as $itemId => $item )
                        {
                                $stuff .= ':' . $items[$itemId]['product'];
                                $stuff .= ':' . $items[$itemId]['quantity'];
                                $stuff .= ':' . $items[$itemId]['priceExVAT'];
                                $stuff .= ':' . $items[$itemId]['tax'];
                                $stuff .= ':' . $items[$itemId]['itemTotal'];
                                $stuff .= ':' . $items[$itemId]['lineTotal'];
                        }
                        
                        $stuff .= ':Delivery Charge:1' .
                                ':' . sprintf("%2.02f", $basket->deliveryCharge / 100) .
                                ':' .
                                ':' . sprintf("%2.02f", $basket->deliveryCharge / 100) .
                                ':' . sprintf("%2.02f", $basket->deliveryCharge / 100);
                }
                
                return $stuff;
        }
        
        
        function base64Encode($plain)
        {
                $output = "";
                $output = base64_encode($plain);
                
                return $output;
        }
        
        
        function base64Decode($scrambled)
        {
                $output = "";
                $scrambled = str_replace(" ","+",$scrambled);
                $output = base64_decode($scrambled);
                
                return $output;
        }
        
        
        function simpleXor( $InString, $Key )
        {
                // Initialise key array
                $KeyList = array();
                // Initialise out variable
                $output = "";
                
                // Convert $Key into array of ASCII values
                for( $i = 0; $i < strlen($Key); $i++ )
                {
                        $KeyList[$i] = ord(substr($Key, $i, 1));
                }

                // Step through string a character at a time
                for( $i = 0; $i < strlen($InString); $i++ )
                {
                        // Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
                        // % is MOD (modulus), ^ is XOR
                        $output.= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
                }
                
                // Return the result
                return $output;
        }
        
        
        function getTokens ( $thisString )
        {
                // List the possible tokens
                $Tokens = array(
                        "Status",
                        "StatusDetail",
                        "VendorTxCode",
                        "VPSTxId",
                        "TxAuthNo",
                        "Amount",
                        "AVSCV2", 
                        "AddressResult", 
                        "PostCodeResult", 
                        "CV2Result", 
                        "GiftAid", 
                        "3DSecureStatus", 
                        "CAVV" );
        
                // Initialise arrays
                $output = array();
                $resultArray = array();
                
                // Get the next token in the sequence
                for ( $i = count($Tokens)-1; $i >= 0 ; $i-- )
                {
                        // Find the position in the string
                        $start = strpos($thisString, $Tokens[$i]);
                        // If it's present
                        if ( $start !== false )
                        {
                                // Record position and token name
                                $resultArray[$i]->start = $start;
                                $resultArray[$i]->token = $Tokens[$i];
                        }
                }
          
                // Sort in order of position
                sort($resultArray);
                
                // Go through the result array, getting the token values
                for ( $i = 0; $i<count($resultArray); $i++ )
                {
                        // Get the start point of the value
                        $valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
                        // Get the length of the value
                        if ( $i==(count($resultArray)-1) )
                        {
                                $output[$resultArray[$i]->token] = substr($thisString, $valueStart);
                        }
                        else
                        {
                                $valueLength = $resultArray[$i+1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
                                $output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
                        }
                }
                
                // Return the ouput array
                return $output;
        }
        
        
        /*
	 * Constructors
	 */
        
        
        function VSPFormUtils ()
        {
                die('VSPFormUtils is an abstact class and cannot be instatiated');
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /*
	 * Command Methods
	 */
        
        
}

?>
