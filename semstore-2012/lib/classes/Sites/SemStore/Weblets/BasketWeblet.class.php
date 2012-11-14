<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Session/Session.class.php');
require_once('Sites/SemStore/Templates/JusteCommerceBasketTemplate.class.php');
require_once('Sites/SemStore/JusteCommerceUtils.class.php');
require_once('Sites/SemStore/eComBasket.class.php');
require_once('Sites/SemStore/eComBasketItem.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');

class BasketWeblet extends Weblet
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function QTY_CTL_STANDARD () { return 0; }
        
        
        function STANDARD_CALC_MODE () { return 0; }
        
        
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
        var $productImagesPath = '';
        var $productImagesWebpath = '';
        
        
        // Layout options
        var $displayProductImages = TRUE;
        var $displayProductCodes = TRUE;
        var $displayQuantities = TRUE;
        var $displayPriceExVat = TRUE;
        var $displayPriceIncVat = FALSE;
        var $displayLineTotalExVat = TRUE;
        var $displayLineTotalIncVat = FALSE;
        
        
        // Qty Controls Mode
        var $qtyControlsMode = 0;
        
        // Calculation mode
        var $calculationMode = 0;
        
        /* Configuration Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function BasketWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_BasketWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _BasketWeblet0 ()
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
        
        
        
        
        
        function getProductImagesPath ()
        {
                return $this->productImagesPath;
        }
        
        
        function setProductImagesPath ( $path )
        {
                $this->productImagesPath = $path;
        }
        
        
        function getProductImagesWebpath ()
        {
                return $this->productImagesWebpath;
        }
        
        
        function setProductImagesWebpath ( $path )
        {
                $this->productImagesWebpath = $path;
        }
        
        
        
        
        
        function getDisplayProductImages ()
        {
                return $this->displayProductImages;
        }
        
        
        function setDisplayProductImages ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayProductImages = TRUE;
                }
                else
                {
                        $this->displayProductImages = FALSE;
                }
        }
        
        
        function getDisplayProductCodes ()
        {
                return $this->displayProductCodes;
        }
        
        
        function setDisplayProductCodes ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayProductCodes = TRUE;
                }
                else
                {
                        $this->displayProductCodes = FALSE;
                }
        }
        
        
        function getDisplayQuantities ()
        {
                return $this->displayQuantities;
        }
        
        
        function setDisplayQuantites ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayQuantities = TRUE;
                }
                else
                {
                        $this->displayQuantities = FALSE;
                }
        }
        
        
        function getDisplayPriceExVat ()
        {
                return $this->displayPriceExVat;
        }
        
        
        function setDisplayPriceExVat ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayPriceExVat = TRUE;
                }
                else
                {
                        $this->displayPriceExVat = FALSE;
                }
        }
        
        
        function getDisplayPriceIncVat ()
        {
                return $this->displayPriceIncVat;
        }
        
        
        function setDisplayPriceIncVat ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayPriceIncVat = TRUE;
                }
                else
                {
                        $this->displayPriceIncVat = FALSE;
                }
        }
        
        
        function getDisplayLineTotalExVat ()
        {
                return $this->displayLineTotalExVat;
        }
        
        
        function setDisplayLineTotalExVat ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayLineTotalExVat = TRUE;
                }
                else
                {
                        $this->displayLineTotalExVat = FALSE;
                }
        }
        
        
        function getDisplayLineTotalIncVat ()
        {
                return $this->displayLineTotalIncVat;
        }
        
        
        function setDisplayLineTotalIncVat ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $this->displayLineTotalIncVat = TRUE;
                }
                else
                {
                        $this->displayLineTotalIncVat = FALSE;
                }
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
                
                $this->setProductImagesPath(
                        $config->getParameter('product_images_path'));
                $this->setProductImagesWebpath(
                        $config->getParameter('product_images_webpath'));
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( $action == 'add' )
                {
                        $this->_addItem( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'remove' )
                {
                        $this->_removeItem( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'updatebasket' ||
                        $httpRequest->getParameter('action') != '' )
                {
                        $this->_updateBasket( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'emptybasket' )
                {
                        $this->_emptyBasket( $httpRequest, $httpResponse );
                }
                else
                {
                        $this->_showBasket( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $this->doGet( $httpRequest, $httpResponse );
        }
        
        
        function _showBasket ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $tmpl =& new JusteCommerceBasketTemplate(
                        $this->getConfigurator(),
                        $this->getConnection());
                
                $tmpl->assign('product_images_webpath',
                        $this->getProductImagesWebpath());
                $tmpl->assign('displayProductImages',
                        $this->getDisplayProductImages());
                $tmpl->assign('displayProductCodes',
                        $this->getDisplayProductCodes());
                $tmpl->assign('displayPriceExVat',
                        $this->getDisplayPriceExVat());
                $tmpl->assign('displayPriceIncVat',
                        $this->getDisplayPriceIncVat());
                $tmpl->assign('displayLineTotalExVat',
                        $this->getDisplayLineTotalExVat());
                $tmpl->assign('displayLineTotalIncVat',
                        $this->getDisplayLineTotalIncVat());
                
                $basket =& eComBasket::getInstance();
                $basket->updateBasketFields($this->getConnection());
                $tmpl->assign_by_ref('basket', $basket);
                
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
                $tmpl->assign_by_ref('basketItems', $basketItems);
                //Debug::debugMsg(DebugLevel::DEBUG(), print_r($basketItems,TRUE));
                
                $lastProductAdded =& $basket->getLastProductAdded();
                if ( !is_null($lastProductAdded) )
                {
                        $tmpl->assign('continueShoppingLink',
                                $configuration->getParameter('site_root_webpath') .
                                '/productinfo.php?productid=' . $lastProductAdded->getId()
                                );
                }
                else
                {
                        $tmpl->assign('continueShoppingLink',
                                $configuration->getParameter('site_root_webpath') .
                                '/products.php'
                                );
                }
                
                $httpResponse->setContent($tmpl->render());
        }
        
        
        function _addItem ( &$httpRequest, &$httpResponse )
        {
                $productId = $httpRequest->getParameter('productid');
                if ( !is_null($productId) && $productId != '' )
                {
                        $quantity = $httpRequest->getParameter('productqty');
                        if ( is_null($quantity) || $quantity == '' )
                        {
                                $quantity = 1;
                        }
                        elseif ( preg_match('{^[0-9]+$}', $quantity) > 0 )
                        {
                                $quantity = intval($quantity);
                        }
                        else
                        {
                                // Can't convert quantity string to a valid integer
                                // value - give up and error.
                                $httpResponse->redirect('basket.php');
                                return;
                        }
                        
                        $product =& Product::findFirst(
                                array('id' => $productId),
                                $this->getConnection() );
                        
                        $basket =& eComBasket::getInstance();
                        $basket->add($product, $quantity);
                }
                elseif ( $this->_grep_array('{^productid[0-9]+$}', array_keys($_REQUEST)) > 0 )
                {
                        $this->_addItems( $httpRequest, $httpResponse );
                }
                
                $httpResponse->redirect('basket.php');
        }
        
        
        function _addItems ( &$httpRequest, &$httpResponse )
        {
                $keys = $this->_grep_array('{^productid[0-9]+$}', array_keys($_REQUEST));
                $basket =& eComBasket::getInstance();
                foreach ( $keys as $key )
                {
                        $productId = $httpRequest->getParameter($key);
                        $id = substr($key, 9, strlen($key));
                        $quantity = $httpRequest->getParameter('productqty'.$id);
                        
                        if ( is_null($quantity) || $quantity == '' )
                        {
                                $quantity = 1;
                        }
                        elseif ( preg_match('{^[0-9]+$}', $quantity) > 0 )
                        {
                                $quantity = intval($quantity);
                        }
                        else
                        {
                                // Can't convert quantity string to a valid integer
                                // value - give up and error.
                                $httpResponse->redirect('basket.php');
                                exit();
                        }
                        
                        $product =& Product::findFirst(
                                array('id' => $productId),
                                $this->getConnection() );
                        
                        $basket->add($product, $quantity);
                }
                
                $httpResponse->redirect('basket.php');
        }
        
        
        function _removeItem ( &$httpRequest, &$httpResponse )
        {
                $productId = $httpRequest->getParameter('productid');
                if ( is_null($productId) ||  $productId == '' )
                {
                        SiteUtils::redirect('basket.php');
                        exit();
                }
                
                $product =& Product::findFirst(
                        array('id' => $productId),
                        $this->getConnection() );
                
                $basket =& eComBasket::getInstance();
                $basket->removeAll($product);
                
                $httpResponse->redirect('basket.php');
        }
        
        
        
        function _updateBasket ( &$httpRequest, &$httpResponse )
        {
                $basket =& eComBasket::getInstance();
                foreach ( $basket->asArray() as $item )
                {
                        $param = "qty".$item->getProductId();
                        $qty = $httpRequest->getParameter($param);
                        //if ( !is_null($qty) && $qty != '' )
                        if ( preg_match('{^[0-9]+$}', $qty) > 0 )
                        {
                                $product =& Product::findFirst(
                                        array('id' => $item->getProductId()),
                                        $this->getConnection() );
                                $basket->setQuantity(
                                        $product,
                                        $qty );
                        }
                        elseif ( !is_null($qty) && $qty == 0 )
                        {
                                $product =& Product::findFirst(
                                        array('id' => $item->getProductId()),
                                        $this->getConnection()
                                        );
                                $basket->removeAll($product);
                        }
                }
                
                $httpResponse->redirect('basket.php');
        }
        
        
        function _emptyBasket ( &$httpRequest, &$httpResponse )
        {
                $basket =& eComBasket::getInstance();
                $basket->emptyBasket();
                
                $httpResponse->redirect('basket.php');
        }
        
        
        function _grep_array ( $pattern, $array )
        {
                $results = array();
                foreach ( $array as $element )
                {
                        if ( preg_match($pattern, $element) > 0 )
                        {
                                array_push($results, $element);
                        }
                }
                
                return $results;
        }
}


?>
