<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.1
 *  @date 2005-09-06
 */

class VSPBasket extends SEMObject
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
        
        
        var $items = array();
        
        
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
        
        
        function addItem ( $vspBasketItem )
        {
                $found = FALSE;
                foreach ( $this->items as $item )
                {
                        if ( $item->getItem() == $vspBasketItem->getItem() )
                        {
                                $item->setQuantity( $item->getQuantity() +
                                        $vspBasketItem->getQuantity() );
                                $found = TRUE;
                                break;
                        }
                }
                
                if ( !$found )
                {
                        array_push($this->items, $vspBasketItem);
                }
        }
        
        
        function convertToBasketString ()
        {
                $basketStr = '';
                
                $items = $this->items;
                if ( count($items) == 0 )
                {
                        return '';
                }
                
                $basketStr = count($items);
                foreach ( $items as $item )
                {
                        $basketStr .= ':' . $item->convertToItemString();
                }
                
                return $basketStr;
        }
        
        
        function calculateTotalCost ()
        {
                $totalCost = 0;
                foreach ( $this->items as $item )
                {
                        $totalCost += $item->getLineTotal();
                }
                
                return $totalCost;
        }
        
        
}

?>
