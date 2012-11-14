<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-30
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductOrder.class.php');
require_once('SEM/CMS/CMSUtils.class.php');

class OrderManagementWeblet extends Weblet
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
        
        
        function OrderManagementWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_OrderManagementWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _OrderManagementWeblet0 ()
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
                ;
        }
        
        
        function _restoreWebletState ()
        {
                ;
        }
        
        
        function _destroyWebletState ()
        {
                ;
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
                
                
                $template =& new CMSTemplate('modules/ecomstore/orders-and-payments/orders.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                //$sql = 'ORDER BY name LIMIT 20';
                //$sql = 'ORDER BY date_placed LIMIT 1';
                //$orders =& ProductOrder::find($sql, $this->getConnection());
                //$template->assign('orders', $orders);
                
                $searchCriteria = array(
                        'st' => (!is_null($_REQUEST['st']) && $_REQUEST['st'] != '' ? $_REQUEST['st'] : 0),
                        'mh' => (!is_null($_REQUEST['mh']) && $_REQUEST['mh'] != '' ? $_REQUEST['mh'] : 10),
                        );
                        
                if ( !is_null($httpRequest->getParameter('orderId')) )
                {
                        $searchCriteria['orderId'] = $httpRequest->getParameter('orderId');
                        
                        $template->assign('searchValue', $httpRequest->getParameter('orderId'));
                }
                
                $searchResults = array();
                $pagerArray = array();
                $options = array();
                $this->paginatedSearch($searchCriteria, $searchResults, $pagerArray, $options);
                $template->assign('orders', $searchResults);
                $template->assign('searchPager', $pagerArray);
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $configuration =& $this->getConfigurator();
                
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
                                'name' => 'Orders &amp Payments',
                                'url' => $configuration->getParameter('cms_root_webpath') .
                                        '/ecomstore/orders-and-payments/'
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
                                'orderId' => $searchCriteria['orderId']
                                ),
                        $options);
        }
        
        
        function search ( &$searchCriteria, &$results )
        {
                // Execute search
                
                $dbConnection =& $this->getConnection();
                
                $sql = '';
                $sql = 'SELECT COUNT(id) FROM product_order';
                
                if ( $searchCriteria['orderId'] != '' && !is_null($searchCriteria['orderId']) )
                {
                        $sql.= ' WHERE id LIKE "%'.
                                $dbConnection->escapeString(
                                $searchCriteria['orderId']).'%"';
                }
                
                $sql.= ' ORDER BY date_placed';
                
                $res = NULL;
                $res =& $dbConnection->select($sql);
                $res->first();
                $row =& $res->getRowArray();
                $rcount = $row[0];
                
                
                //
                
                $sql = '';
                //$sql = 'WHERE parent_id IS NULL';
                

                if ( $searchCriteria['orderId'] != '' && !is_null($searchCriteria['orderId']) )
                {
                        $sql.= ' WHERE id LIKE "%'.
                                $dbConnection->escapeString(
                                $searchCriteria['orderId']).'%"';
                }
                
                $sql .= ' ORDER BY date_placed';
                if ( $searchCriteria['st'] > 0 && $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['st'] . ', '.
                                $searchCriteria['mh'];
                }
                elseif ( $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['mh'];
                }
                
                $results = ProductOrder::find($sql, $this->getConnection());
                
                //
                
                return $rcount;
        }
}


?>
