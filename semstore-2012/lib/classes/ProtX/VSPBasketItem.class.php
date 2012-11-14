<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2005-09-06
 */

class VSPBasketItem extends SEMObject
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
        
        
        var $item = '';
        var $quantity = 0;
        var $itemValue = 0;
        var $tax = 0;
        var $itemTotal = 0;
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function VSPBasket ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'VSPBasket'.$numArgs),  $args);
        }
        
        
        function VSPBasket0 ()
        {
                $this->_initialize();
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getItem ()
        {
                return $this->item;
        }
        
        
        function setItem ( $item )
        {
                $this->item = $item;
        }
        
        
        function getQuantity ()
        {
                return $this->quantity;
        }
        
        
        function setQuantity ( $quantity )
        {
                $this->quantity = $quantity;
        }
        
        
        function getItemValue ()
        {
                return $this->itemValue;
        }
        
        
        function setItemValue ( $itemValue )
        {
                $this->itemValue = $itemValue;
        }
        
        
        function getTax ()
        {
                return $this->tax;
        }
        
        
        function setTax ( $tax )
        {
                $this->tax = $tax;
        }
        
        
        function getItemTotal ()
        {
                return $this->itemTotal;
        }
        
        
        function setItemTotal ( $itemTotal )
        {
                $this->itemTotal = $itemTotal;
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
        
        
        function getLineTotal ()
        {
                return ($this->getItemValue() + $this->getTax()) *
                        $this->getQuantity();
        }
        
        
        function getFormattedItemValue ()
        {
                return sprintf("%01.02f", $this->getItemValue() / 100);
        }
        
        
        function getFormattedTax ()
        {
                return sprintf("%01.02f", $this->getTax() / 100);
        }
        
        
        function getFormattedItemTotal ()
        {
                return sprintf("%01.02f", $this->getItemTotal() / 100);
        }
        
        
        function getFormattedLineTotal ()
        {
                return sprintf("%01.02f", $this->getLineTotal() / 100);
        }
        
        
        function convertToItemString ()
        {
                return $this->getItem() . ':' .
                        $this->getQuantity() . ':' .
                        $this->getFormattedItemValue() . ':' .
                        $this->getFormattedTax() . ':' .
                        $this->getFormattedItemTotal() . ':' .
                        $this->getFormattedLineTotal();
        }
}

?>
