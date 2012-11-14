<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-25
 * @package HTTP
 */

require_once('HTTP/Weblet.class.php');
require_once('Web/RequestParams.class.php');
require_once('Web/Site/SiteUtils.class.php');
require_once('HTTP/PRG_MVC/PRGSessionModel.class.php');

class GPRGWeblet extends Weblet
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
        
        
        var $processingModel = 'strict';
        var $storesState = TRUE;
        var $dynamicState = TRUE;
        var $createStateAutomatically = TRUE;
        var $oidParamName = 'oid';
        var $oid = '';
        var $staticOid = NULL;
        var $state = NULL;
        var $viewHandlers = array();
        var $actionHandlers = array();
        var $defaultView = '';
        var $defaultAction = '';
        var $redirect = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function GPRGWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_GPRGWeblet'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getProcessingModel ()
        {
                return $this->processingModel;
        }
        
        
        function setProcessingModel ( $model )
        {
                $this->processingModel = $model;
        }
        
        
        function getStoresState ()
        {
                return $this->storesState;
        }
        
        
        function setStoresState ( $bool )
        {
                $this->storesState = $bool;
        }
        
        
        function getDynamicState ()
        {
                return $this->dynamicState;
        }
        
        
        function setDynamicState ( $bool )
        {
                $this->dynamicState = $bool;
        }
        
        
        function getRetrieveStateAutomatically ()
        {
                return $this->retrieveStateAutomatically;
        }
        
        
        function setRetrieveStateAutomatically ( $bool )
        {
                $this->retrieveStateAutomatically = $bool;
        }
        
        
        function getCreateStateAutomatically ()
        {
                return $this->createStateAutomatically;
        }
        
        
        function setCreateStateAutomatically ( $bool )
        {
                $this->createStateAutomatically = $bool;
        }
        
        
        function getStrictPRG ()
        {
                return $this->strictPRG;
        }
        
        
        function setStrictPRG ( $bool )
        {
                $this->strictPRG = $bool;
        }
        
        
        function getObjectIdParamName ()
        {
                return $this->oidParamName;
        }
        
        
        function setObjectIdParamName ( $oidParamName )
        {
                $this->oidParamName = $oidParamName;
        }
        
        
        function getObjectId ()
        {
                return $this->oid;
        }
        
        
        function setObjectId ( $objectId )
        {
                $this->oid = $objectId;
        }
        
        
        function getStaticObjectId ()
        {
                return $this->staticOid;
        }
        
        
        function setStaticObjectId ( $objectId )
        {
                $this->staticOid = $objectId;
        }
        
        
        function &getState ()
        {
                return $this->state;
        }
        
        
        function setState ( &$state )
        {
                $this->state =& $state;
        }
        
        
        function getViewHandlers ()
        {
                return $this->viewHandlers;
        }
        
        
        function setViewHandlers ( $handlers )
        {
                $this->viewHandlers = $handlers;
        }
        
        
        function getActionHandlers ()
        {
                
                return $this->actionHandlers;
        }
        
        
        function setActionHandlers ( $handlers )
        {
                $this->actionHandlers = $handlers;
        }
        
        
        function getDefaultMethod ()
        {
                return $this->defaultMethod;
        }
        
        
        function setDefaultMethod ( $method )
        {
                $this->defaultMethod = $method;
        }
        
        
        function getDefaultView ()
        {
                return $this->defaultView;
        }
        
        
        function setDefaultView ( $view )
        {
                $this->defaultView = $view;
        }
        
        
        function getDefaultAction ()
        {
                return $this->defaultAction;
        }
        
        
        function setDefaultAction ( $action )
        {
                $this->defaultAction = $action;
        }
        
        
        function getRedirect ()
        {
                return $this->redirect;
        }
        
        
        function setRedirect ( $redirect )
        {
                $this->redirect = $redirect;
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
        
        
        function doPost ()
        {
                $this->_run();
        }
        
        
        function doGet ()
        {
                $this->_run();
        }
        
        
        function _run ()
        {
                if ( $this->getProcessingModel() == 'strict' )
                {
                        $this->_processAsStrict();
                }
                elseif ( $this->getProcessingModel() == 'non-strict' )
                {
                        $this->_processAsNonStrict();
                }
                else
                {
                        $this->_processAsStrict();
                }
        }
        
        
        function _processAsStrict ()
        {
                if ( $this->storesState() )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                'Stores state');
                        if ( !$this->dynamicState() )
                        {
                                Debug::debugMsg(DebugLevel::DEBUG(),
                                        'State is static');
                                $state =& $this->_retrieveStateUsingStaticId();
                                // Use static id to get state;
                                if ( is_null($state) )
                                {
                                        if ( $this->automaticallyCreateState() )
                                        {
                                                $state =& $this->_createState();
                                                $state =& $this->_initialiseState($state);
                                                $objectId = $this->getStaticObjectId($state);
                                                $this->setObjectId($objectId);
                                                $state->setVar('oid', $objectId);
                                                $this->setState($state);
                                                Session::putRef($this->getObjectId(),
                                                        $this->getState());
                                        }
                                        else
                                        {
                                                die("Don't know what to do :-(");
                                        }
                                }
                                $this->setState($state);
                        }
                        else
                        {
                                Debug::debugMsg(DebugLevel::DEBUG(),
                                        'State is dynanimc');
                                $state =& $this->_retrieveStateUsingQSParam();
                                if ( is_null($state) )
                                {
                                        Debug::debugMsg(DebugLevel::DEBUG(),
                                                'Not state found using object id form query string');
                                        if ( $this->automaticallyCreateState() )
                                        {
                                                $state = $this->_createState();
                                                $state = $this->_initialiseState($state);
                                                //$this->_initialiseState($state);
                                                $objectId = $this->generateObjectId($state);
                                                $this->setObjectId($objectId);
                                                $state->setVar('oid', $objectId);
                                                $this->setState($state);
                                                Session::putRef($this->getObjectId(),
                                                        $this->getState());
                                        }
                                        else
                                        {
                                                die("Don't know what to do :-(");
                                        }
                                }
                                $this->setState($state);
                        }
                }
                
                
                if ( strtolower($_SERVER['REQUEST_METHOD']) == 'post' )
                {
                        $redirect = $this->_processStrictAction();
                        Session::putRef($this->getObjectId(),
                                $this->getState());
                        SiteUtils::redirect($redirect);
                }
                else
                {
                        $this->_processStrictView();
                        /*
                        Session::putRef($this->getObjectId(),
                                $this->getState());
                                */
                }
        }
        
        
        function &_retrieveStateUsingStaticId ()
        {
                $staticId = $this->getStaticObjectId();
                if ( isset($staticId) || $staticId != '' )
                {
                        $this->setObjectId($staticId);
                        return $this->_retrieveStateWithId($staticId);
                }
                
                return NULL;
        }
        
        
        function &_retrieveStateUsingQSParam ()
        {
                $oidParamName =& $this->getObjectIdParamName();
                $oid = RequestParams::getParam($oidParamName);
                if ( isset($oid) || $oid != '' )
                {
                        $this->setObjectId($oid);
                        return $this->_retrieveStateWithId($oid);
                }
                
                return NULL;
        }
        
        
        function &_retrieveStateWithId ( $id )
        {
                $state =& Session::getRef( $id );
                return $state;
        }
        
        
        function _processStrictAction ()
        {
                $action =& $this->_retrieveActionFromQS();
                if ( !is_null($action) )
                {
                        return $this->callAction($action);
                }
                
                $action =& $this->_retrieveActionFromState();
                if ( !is_null($action) )
                {
                        return $this->callAction($action);
                }
                
                return $this->callDefaultAction();
        }
        
        
        function _retrieveActionFromQS ()
        {
                $action = RequestParams::getParam('action');
                if ( isset($action) && $action != '' )
                {
                        return $action;
                }
                
                return NULL;
        }
        
        
        function _retrieveActionFromState ()
        {
                $state =& $this->getState();
                if ( is_null($state) )
                {
                        return NULL;
                }
                
                $action = $state->getVar('action');
                if ( isset($action) && $action != '' )
                {
                        return $action;
                }
                
                return NULL;
        }
        
        
        function _processStrictView ()
        {
                $view =& $this->_retrieveViewFromQS();
                if ( !is_null($view) )
                {
                        return $this->callView($view);
                }
                
                $view =& $this->_retrieveViewFromState();
                if ( !is_null($view) )
                {
                        return $this->callView($view);
                }
                
                return $this->callDefaultView();
        }
        
        
        function _retrieveViewFromQS ()
        {
                $view = RequestParams::getParam('view');
                if ( isset($view) && $view != '' )
                {
                        return $view;
                }
                
                return NULL;
        }
        
        
        function _retrieveViewFromState ()
        {
                $state =& $this->getState();
                if ( is_null($state) )
                {
                        return NULL;
                }
                
                $view = $state->getVar('view');
                if ( isset($view) && $view != '' )
                {
                        return $view;
                }
                
                return NULL;
        }
        
        
        function _processAsNonStrict ()
        {
                ;
        }
        
        
        function &_createState ()
        {
                $state =& new PRGSessionModel();
                
                return $state;
        }
        
        
        function &_initialiseState ( &$state )
        {
                return $state;
        }
        
        
        function generateObjectId ( &$state )
        {
                return '';
        }
        
        
        function dynamicState ()
        {
                return $this->getDynamicState();
        }
        
        
        function storesState ()
        {
                return $this->getStoresState();
        }
        
        
        function automaticallyRetrieveState ()
        {
                return $this->getRetrieveStateAutomatically();
        }
        
        
        function automaticallyCreateState ()
        {
                return $this->getCreateStateAutomatically();
        }
        
        
        function isStrictPRG ()
        {
                return $this->getStrictPRG();
        }
        
        
        function callView ( $view )
        {
                $handlers = $this->getViewHandlers();
                $this->callViewHandler(
                        $handlers[$view]);
        }
        
        
        function callDefaultView ()
        {
                $this->callView($this->getDefaultView());
        }
        
        
        function callViewHandler ( $handler )
        {
                call_user_func( array(&$this, $handler) );
        }
        
        
        function callAction ( $action )
        {
                $handlers = $this->getActionHandlers();
                $redirect = $this->callActionHandler(
                        $handlers[$action]);
                
                return $redirect;
        }
        
        
        function callDefaultAction ()
        {
                return $this->callAction($this->getDefaultAction());
        }
        
        
        function callActionHandler ( $handler )
        {
                $redirect = call_user_func( array(&$this, $handler) );
                return $redirect;
        }
        
        
        function addViewHandler ( $view, $handler )
        {
                $handlers = $this->getViewHandlers();
                $handlers[$view] = $handler;
                $this->setViewHandlers($handlers);
        }
        
        
        function addActionHandler ( $action, $handler )
        {
                $handlers = $this->getActionHandlers();
                $handlers[$action] = $handler;
                $this->setActionHandlers($handlers);
        }
}

?>
