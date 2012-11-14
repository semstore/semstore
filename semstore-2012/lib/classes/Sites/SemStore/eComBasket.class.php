<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-09-12
 * @package Sites.JusteCommerce
 */

require_once('SEMObject.class.php');

require_once('Session/Session.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('Sites/SemStore/eComBasketItem.class.php');


class eComBasket extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
        function CARRIAGE_EXEMPTION ()
        {
                return 50000;
        }
        
        
        function STANDARD_CARRIAGE_CHARGE ()
        {
                return 1200;
        }
        
        
        function PPS_ABOVE_GROUND_CARRIAGE_CHARGE ()
        {
                return 1750;
        }
        
        
        function PPS_BELOW_GROUND_CARRIAGE_CHARGE ()
        {
                return 5500;
        }
        
        
        /*
	 * Instance Variables
	 */
        
        
	var $items = array();
        var $lastProductAdded = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        function &getInstance ()
        {
                if ( !@@is_a(Session::getRef('ecombasket'), 'eComBasket') )
                {
                        $basket =& new eComBasket();
                        Session::putRef('ecombasket', $basket);
                }
                
                return Session::getRef('ecombasket');
        }
        
        
        /*
	 * Constructors
	 */
        
        
        function eComBasket ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, 'eComBasket'.$numArgs),
                        $args);
        }
        
        
        function eComBasket0 ()
        {
                $this->_initialise();
        }
        
        
        function _initialise ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function &getBasket ()
        {
                return $this->items;
        }
        
        
        function setBasket ( &$items )
        {
                $this->items =& $items;
        }
        
        
        function &getLastProductAdded ()
        {
                return $this->lastProductAdded;
        }
        
        
        function setLastProductAdded ( &$product )
        {
                $this->lastProductAdded =& $product;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function add ( &$product, $quantity )
        {
                $item =& $this->items[$product->getId()];
                if ( is_object($item) )
                {
                        $item->addQuantity($quantity);
                        $this->setLastProductAdded($product);
                }
                else
                {
                        $item =& new eComBasketItem();
                        $item->setProductId($product->getId());
                        $item->setQuantity($quantity);
                        
                        $this->items[$product->getId()] =& $item;
                        $this->setLastProductAdded($product);
                }
                
                //$item->setQuantity(1);
        }
        
        
        function setQuantity ( &$product, $quantity )
        {
                $item =& $this->items[$product->getId()];
                if ( $quantity > 0 )
                {
                        $item->setQuantity($quantity);
                }
                else
                {
                        $this->removeAll($product);
                }
        }
        
        
        function remove ( &$product, $quantity )
        {
                $item =& $this->items[$product->get()];
                if ( is_object($item) )
                {
                        if ( $item->getQuantity() - $quantity < 0 )
                        {
                                unset($this->items[$product->getId()]);
                        }
                        else
                        {
                                $item->removeQuantity($quantity);
                        }
                }
        }
        
        
        function removeAll ( &$product )
        {
                unset($this->items[$product->getId()]);
        }
        
        
        function emptyBasket ()
        {
                $this->items = array();
        }
        
        
        function asArray ()
        {
                $contents = $this->items;
                
                return $contents;
        }
        
        
        function isEmpty ()
        {
                return count($this->items) == 0;
        }
        
        
        function getNumberOfProducts ()
        {
                return count($this->items);
        }
        
        
        function getNumberOfItems ()
        {
                $items = 0;
                foreach ( array_keys($this->items) as $index )
                {
                        $item =& $this->items[$index];
                        $items += $item->getQuantity();
                }
                
                return $items;
        }
        
        
        function updateBasketFields ( &$connection )
        {
                $this->completeBasketFields($connection);
        }
        
        
        function completeBasketFields ( &$connection )
        {
                foreach ( array_keys($this->items) as $itemId )
                {
                        $item =& $this->items[$itemId]; 
                        $product =& Product::findFirst(
                                array( 'id' => $item->getProductId() ),
                                $connection );
                        $item->setProductId($product->getId());
                        $item->setProductName(
                                $product->getName() );
                        $item->setPrice($product->priceExVat());
                        $item->setTax($product->priceIncVAT() - $product->priceExVAT());
                }
        }
        
        
        function _formatPrice ( $price )
        {
                return sprintf('%1.02f', $price / 100);
        }
        
        
        function subtotalExVat ()
        {
                $subtotal = 0;
                
                foreach ( $this->items as $item )
                {
                        $subtotal += $item->lineTotalExVat();
                }
                
                return $subtotal;
        }
        
        
        function formattedSubtotalExVat ()
        {
                return $this->_formatPrice($this->subtotalExVat());
        }
        
        
        function subtotalIncVat ()
        {
                $subtotal = 0;
                
                foreach ( $this->items as $item )
                {
                        $subtotal += $item->lineTotalIncVat();
                }
                
                return $subtotal;
        }
        
        
        function formattedSubtotalIncVat ()
        {
                return $this->_formatPrice($this->subtotalIncVat());
        }
        
        
        function vat ()
        {
                $vat = 0;
                
                foreach ( $this->items as $item )
                {
                        $vat += $item->vat() * $item->quantity();
                }
                
                $vat += $this->carriageChargeIncVat() - 
                        $this->carriageChargeExVat();
                
                return $vat;
        }
        
        
        function formattedVat ()
        {
                return $this->_formatPrice($this->vat());
        }
        
        
        function total ()
        {
                $total = 0;
                
                $total = $this->subtotalExVat() +
                        $this->carriageChargeExVAT() +
                        $this->vat();
                
                return $total;
        }
        
        
        function formattedTotal ()
        {
                return $this->_formatPrice($this->total());
        }
        
        
        function carriageChargeExVat ()
        {
                $carriageCharge = 1000;
                
                return $carriageCharge;
        }
        
        
        function formattedCarriageChargeExVat ()
        {
                return $this->_formatPrice($this->carriageChargeExVat());
        }
        
        
        function carriageChargeIncVat ()
        {
                return round($this->carriageChargeExVat() * 1.175);
        }
        
        
        function formattedCarriageChargeIncVat ()
        {
                return $this->_formatPrice($this->carriageChargeIncVat());
        }
        
}

?>
