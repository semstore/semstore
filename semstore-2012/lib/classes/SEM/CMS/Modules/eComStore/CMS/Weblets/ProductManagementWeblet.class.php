<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/CMSUtils.class.php');

class ProductManagementWeblet extends Weblet
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
        
        
        var $configurator = NULL;
        var $connection = NULL;
        
        /* Configuration Variables :: Start */
        
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $formErrors = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ProductManagementWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ProductManagementWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _ProductManagementWeblet0 ()
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
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new ProductManagementWebletWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                Session::putRef('pmWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('pmWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('pmWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        return $this->_capture_details_submit();
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        return $this->_confirm_details_submit();
                }
                else
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $view = $httpRequest->getParameter('view');
                
                $searchTerms = '';
                $numResults = 20;
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_management/index.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                /*
                //$sql = 'ORDER BY name LIMIT 20';
                $sql = 'ORDER BY name';
                $products =& Product::find($sql, $this->getConnection());
                $template->assign('products', $products);
                */
                
                $searchCriteria = array(
                        'st' => (!is_null($_REQUEST['st']) && $_REQUEST['st'] != '' ? $_REQUEST['st'] : 0),
                        'mh' => (!is_null($_REQUEST['mh']) && $_REQUEST['mh'] != '' ? $_REQUEST['mh'] : 10),
                        );
                        
                if ( !is_null($httpRequest->getParameter('productName')) )
                {
                     $searchCriteria['productName'] = $httpRequest->getParameter('productName');
                      
                     $template->assign('searchValue', $httpRequest->getParameter('productName'));
                }
                        
                $searchResults = array();
                $pagerArray = array();
                $options = array();
                $this->paginatedSearch($searchCriteria, $searchResults, $pagerArray, $options);
                $template->assign('products', $searchResults);
                $template->assign('searchPager', $pagerArray);
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'eComStore',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/'
                                ),
                        array(
                                'name' => 'Products &amp Categories',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                )
                        );
                
                return $breadcrumb;
        }
        
        
        function paginatedSearch (
                $searchCriteria, &$results, &$pagerArray, $options )
        {
                $rcount = $this->search($searchCriteria, $results);
                return CMSUtils::pager($pagerArray,
                        array(
                                'st' => $searchCriteria['st'],
                                'mh' => $searchCriteria['mh'],
                                'rcount' => $rcount,
                                'productName' => $searchCriteria['productName']
                                ),
                        $options);
        }
        
        
        function search ( &$searchCriteria, &$results )
        {
                // Execute search
                
                $dbConnection =& $this->getConnection();
                
                $sql = '';
                $sql = 'SELECT COUNT(id) FROM product' .
                        ' WHERE parent_id IS NULL';
                
                if ( $searchCriteria['productName'] != '' && !is_null($searchCriteria['productName']) )
                {
                        $sql.= ' AND name LIKE "%'.
                                $dbConnection->escapeString(
                                $searchCriteria['productName']).'%"';
                }
                
                $sql.=' ORDER By name';
                
                $res = NULL;
                $res =& $dbConnection->select($sql);
                $res->first();
                $row =& $res->getRowArray();
                $rcount = $row[0];
                
                
                //
                
                $sql = '';
                $sql = 'WHERE parent_id IS NULL';
                

                if ( $searchCriteria['productName'] != '' && !is_null($searchCriteria['productName']) )
                {
                        $sql.= ' AND name LIKE "%'.
                                $dbConnection->escapeString(
                                $searchCriteria['productName']).'%"';
                }
                
                $sql .=' ORDER BY name';
                if ( $searchCriteria['st'] > 0 && $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['st'] . ', '.
                                $searchCriteria['mh'];
                }
                elseif ( $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['mh'];
                }
                
                $results = Product::find($sql, $this->getConnection());
                
                //
                
                return $rcount;
        }
}


?>
