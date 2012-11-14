<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-09-12
 * @package Sites.JusteCommerce
 */

require_once('SEMObject.class.php');

class eComBasketItem extends SEMObject
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
        
        
        var $productId = NULL;
        var $productName = '';
        var $price = 0;
        var $tax = 0;
        var $quantity = 0;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eComBasketItem ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, 'eComBasketItem'.$numArgs),
                        $args);
        }
        
        
        function eComBasketItem0 ()
        {
                $this->_initialize();
        }
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $productId )
        {
                $this->productId = $productId;
        }
        
        
        function getProductName ()
        {
                return $this->productName;
        }
        
        
        function setProductName ( $productName )
        {
                $this->productName = $productName;
        }
        
        
        function getPrice ()
        {
                return $this->price;
        }

        
        function setPrice ( $price )
        {
                $this->price = $price;
        }
        
        
        function getTax ()
        {
                return $this->tax;
        }
        
        
        function setTax ( $tax )
        {
                $this->tax = $tax;
        }
        
        
        function getQuantity ()
        {
                return $this->quantity;
        }
        
        
        function setQuantity ( $quantity )
        {
                $this->quantity = $quantity;
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
        
        
        function addQuantity ( $quantity )
        {
                $this->setQuantity($this->getQuantity() + $quantity);
        }
        
        
        function _formatPrice ( $price )
        {
                return sprintf('%1.02f', $price / 100);
        }
        
        
        function priceExVat ()
        {
                return $this->getPrice();
        }
        
        
        function formattedPriceExVat ()
        {
                return $this->_formatPrice($this->priceExVat());
        }
        
        
        function vat ()
        {
                return $this->getTax();
        }
        
        
        function formattedVat ()
        {
                return $this->_formatPrice($this->vat());
        }
        
        
        function priceIncVat ()
        {
                return $this->priceExVat() + $this->vat();
        }
        
        
        function formattedPriceIncVat ()
        {
                return $this->_formatPrice($this->priceIncVat());
        }
        
        
        function quantity ()
        {
                return $this->getQuantity();
        }
        
        
        function lineTotalExVat ()
        {
                return $this->priceExVat() * $this->quantity();
        }
        
        
        function formattedLineTotalExVat ()
        {
                return $this->_formatPrice($this->lineTotalExVat());
        }
        
        
        function lineTotalIncVat ()
        {
                return $this->priceIncVat() * $this->quantity();
        }
        
        
        function formattedLineTotalIncVat ()
        {
                return $this->_formatPrice($this->lineTotalIncVat());
        }
}

?>
