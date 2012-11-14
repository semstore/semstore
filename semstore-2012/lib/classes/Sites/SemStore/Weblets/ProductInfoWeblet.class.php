<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-10-25
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
class ProductInfoWeblet extends Weblet
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
        
        var $configuration = NULL;
        
        var $productId = NULL;
        var $productNotFoundTemplate = '';
        var $typeTemplatesDir = '';
        
        var $connection = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ProductInfoWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ProductInfoWeblet'.$numArgs ),
                        $args );
        }
        
        
        function _ProductInfoWeblet0 ()
        {
                ;
        }
        
        
        function _ProductInfoWeblet1 ( &$config )
        {
                $this->autoconfigure($config);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getConfiguration ()
        {
                return $this->configuration;
        }
        
        
        function setConfiguration ( &$config )
        {
                $this->configuration =& $config;
        }
        
        
        function getProductId ()
        {
                return $this->productId;
        }
        
        
        function setProductId ( $id )
        {
                $this->productId = $id;
        }
        
        
        function getCategoryId ()
        {
                return $this->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->categoryId = $id;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
                
        }
        
        
        function setConnection ( $connection )
        {
                $this->connection = $connection;
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
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $this->doGet($httpRequest, $httpResponse);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $productId = $this->getProductId();
                if ( is_null($productId) || empty($productId) )
                {
                        return $this->displayProductNotFound($httpRequest, $httpResponse);
                }
                elseif ( preg_match('{^[0-9]+$}', $productId) == 0 )
                {
                        return $this->displayProductNotFound($httpRequest, $httpResponse);
                }
                
                $product =& Product::findFirst(
                        array('id' => $productId),
                        $this->getConnection() );

                if ( is_null($product) )
                {
                        return $this->displayProductNotFound($httpRequest, $httpResponse);
                }
                
                return $this->displayProduct($httpRequest, $httpResponse, $product);
        }
        
        
        function displayProductNotFound ( &$httpRequest, &$httpResponse )
        {
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        '_ecomstore/products/productinfo.tpl');
                $template->addStylesheet(
                        $this->configuration->getParameter('site_root_webpath') .
                        '/css/product_details.css');
                
                //$root =& ProductCategory::getRootCategory($GLOBALS['dbConnection']);
                //$template->assign_by_ref('catroot', $root);
                
                $template->setTitle($template->getTitle() . ' :: ' .
                        'Product Not Found' );
                
                $httpResponse->setContent($template->render());
                Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));
        }
        
        
        function displayProduct ( &$httpRequest, &$httpResponse, &$product )
        {
                //$template = 'products/productinfo.tpl';
                //$templateCode = 'products/productinfo.php';
                
                $template = '_ecomstore/products/productinfo.tpl';
                $templateCode = '_ecomstore/products/productinfo.php';
                
                if ( $this->_customProductTemplate($product) != NULL )
                {
                        $template = $this->_customProductTemplate($product);
                }
                elseif ( $this->_customProductTypeTemplate($product) )
                {
                        $template = $this->_customProductTypeTemplate($product);
                }
                
                if ( $this->_customProductTemplateCode($product) != NULL )
                {
                        $templateCode =
                                $this->_customProductTemplateCode($product);
                }
                elseif ( $this->_customProductTypeTemplateCode($product) )
                {
                        $templateCode =
                                $this->_customProductTypeTemplateCode($product);
                }
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        $template
                        );
                $template->addStylesheet(
                        $this->configuration->getParameter('site_root_webpath') .
                        '/css/product_details.css');
                
                require($GLOBALS['configuration']->getParameter('ecomstore_template_path') .
                        '/' . $templateCode);
                
                $httpResponse->setContent($template->render());
                Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
        }
        
        
        function _customProductTemplate ( &$product )
        {
                $config =& $this->getConfiguration();
                $templateFile = 'products/custom/' . $product->getId() . '.tpl';
                        
                if ( file_exists($config->getParameter('ecomstore_template_path') . '/' . $templateFile) )
                {
                        return $templateFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTypeTemplate ( &$product )
        {
                $config =& $this->getConfiguration();
                $type =& $product->getType();
                
                $templateFile = 'products/types/' . strtolower(str_replace(' ', '_', $type->getName())) . '.tpl';
                        
                if ( file_exists($config->getParameter('ecomstore_template_path') . '/' . $templateFile) )
                {
                        return $templateFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTemplateCode ( &$product )
        {
                $config =& $this->getConfiguration();
                $templateCodeFile = 'products/custom/' . $product->getId() . '.php';
                        
                if ( file_exists($config->getParameter('ecomstore_template_path') . '/' . $templateCodeFile) )
                {
                        return $templateCodeFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTypeTemplateCode ( &$product )
        {
                $config =& $this->getConfiguration();
                $type =& $product->getType();
                
                $templateCodeFile = 'products/types/' . strtolower(str_replace(' ', '_', $type->getName())) . '.php';
                        
                if ( file_exists($config->getParameter('ecomstore_template_path') . '/' . $templateCodeFile) )
                {
                        return $templateCodeFile;
                }
                
                return NULL;
        }
}

?>
