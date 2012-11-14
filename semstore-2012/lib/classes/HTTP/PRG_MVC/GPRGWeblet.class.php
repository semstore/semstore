<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-10-25
 */

require_once('HTTP/Weblet.class.php');

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
        
        
        var $oidParamName = '';
        var $oid = '';
        var $state = NULL;
        var $stageHandlers = array();
        var $actionHandlers = array();
        var $defStage = '';
        var $defAction = '';
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
        
        
        function getStrictPRGMode ()
        {
                return $this->strictPRGMode;
        }
        
        
        function setStrictPRGMode ( $strictPRGMode )
        {
                $this->strictPRGMode = $strictPRGMode;
        }
        
        function &getState ()
        {
                return $this->state;
        }
        
        
        function setState ( &$state )
        {
                $this->state =& $state;
        }
        
        
        function getStageHandlers ()
        {
                return $this->stageHandlers;
        }
        
        
        function setStageHandlers ( $handlers )
        {
                $this->stageHandlers = $handlers;
        }
        
        
        function getActionHandlers ()
        {
                
                return $this->actionHandlers;
        }
        
        
        function setActionHandlers ( $handlers )
        {
                $this->actionHandlers = $handlers;
        }
        
        
        function getDefaultStage ()
        {
                return $this->defStage;
        }
        
        
        function setDefaultStage ( $stage )
        {
                $this->defStage = $stage;
        }
        
        
        function getDefaultAction ()
        {
                return $this->defAction;
        }
        
        
        function setDefaultAction ( $action )
        {
                $this->defAction = $action;
        }
        
        
        function getDefaultRedirect ()
        {
                return $this->redirect;
        }
        
        
        function setDefaultRedirect ( $redirect )
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
        
        
        /*
        function doPost ()
        {
                get ObjectId
                if ( ObjectId not found )
                {
                        if ( ObjectId required )
                        {
                                fail;
                        }
                        else
                        {
                                if ( default set )
                                {
                                        use default;
                                }
                                else
                                {
                                        fail;
                                }
                                
                        }
                }
                else
                {
                        ;
                }
                
                
                get object;
                if ( object null )
                {
                        fail;
                }
        }
        
        
        */
        
        
        function doPost ()
        {
                /*
                $oidParam = $this->getObjectIdParamName();
                $oid = RequestParams::getParam($oidParam);
                if ( is_null($oid) )
                {
                        ;
                }
                else
                {
                        ;
                }
                */
                
                $this->_run();
        }
        
        
        function doGet ()
        {
                $this->_run();
        }
        
        
        function _run ()
        {
                $state =& $this->_retrieveState();
                if ( is_null($state) )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::_run() -> Creating new state.'
                                );
                        $state =& $this->_createState();
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::_run() -> Initializing state.'
                                );
                        $this->_initState($state);
                }
                $this->setState($state);
                
                $action = RequestParams::getParam('action');
                if ( !is_null($action) )
                {
                        if ( $this->strictPRGMode() == FALSE )
                        {
                                $this->_runController();
                        }
                        else if ( strtolower($_SERVER['REQUEST_METHOD'])
                                == 'post' )
                        {
                                $this->_runController();
                        }
                        else
                        {
                                // Run Default View;
                        }
                }
                else
                {
                        $this->runView();
                }
                
                
                
        }
        
        
        function _retrieveState ()
        {
                $oidParamName = $this->getObjectIdParamName();
                Debug::debugMsg(DebugLevel::DEBUG(),
                        get_class($this).'::_retrieveState() -> Object ID Param' .
                        " Name retrieved was '$oidParamName'");
                $oid = RequestParams::getParam($oid);
                Debug::debugMsg(DebugLevel::DEBUG(),
                        get_class($this).'::_retrieveState() -> Object ID' .
                        " retrieved was '$oid'");
                if ( $this->objectIdIsRequired() )
                {
                        return NULL;
                }
                
                $oid = $this->getDefaultObjectId();
                Debug::debugMsg(DebugLevel::DEBUG(),
                        get_class($this).'::_retrieveState() -> Setting Object ID' .
                        " to the default Object ID '$oid'");
                $state =& Session::getRef($oid);
                if ( !is_object($state) )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                        get_class($this).'::_retrieveState() -> State was NULL'
                        );
                        return NULL;
                }
                
                Debug::debugMsg(DebugLevel::DEBUG(),
                        get_class($this).'::_retrieveState() -> State found.'
                        );
                return $state;
        }
        
        
        function &_createState ()
        {
                $state =& new PRGSessionModel();
                
                return $state;
        }
        
        
        function _initState ( &$state )
        {
                ;
        }
        
        
        /*
        function runController ()
        {
                ;
        }
        
        
        function runView ()
        {
                ;
        }
        */
        
        /*
        function run ()
        {
                $oidValue = $_REQUEST[$this->getObjectId()];
                if ( !isset($oidValue) || $oidValue == '' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> No ObjectId found' .
                                'in HTTP request');
                        $state =& $this->initState();
                        $oidValue = $this->generateObjectId($state);
                        $this->setObjectIdValue($oidValue);
                        $state->setVar($this->getObjectId(),
                                $this->getObjectIdValue());
                        $this->setState($state);
                        //$_SESSION[$oidValue] =& $state;
                        Session::putRef($this->getObjectIdValue(), $this->getState());
                        
                        $redirect = $this->callAction($this->getDefaultAction());
                        SiteUtils::redirect($redirect);
                
                        return;
                }
                
                $this->setObjectIdValue($oidValue);
                //$state =& $_SESSION[$oidValue];
                $state =& Session::getRef($this->getObjectIdValue());
                
                if ( !is_object($state) )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> No stage found');
                        $state =& $this->initState();
                        $oidValue = $this->generateObjectId($state);
                        $this->setObjectIdValue($oidValue);
                        $state->setVar($this->getObjectId(),
                                $this->getObjectIdValue());
                        $this->setState($state);
                        
                        $redirect = $this->callAction($this->getDefaultAction());
                        SiteUtils::redirect($redirect);
                        
                        return;
                }
                
                $this->setState($state);
                if ( strtolower($_SERVER['REQUEST_METHOD']) == 'post' )
                {
                        $this->runController();
                }
                else
                {
                        $this->runView();
                }
        }
        */
        
        
        function runView ()
        {
                $state =& $this->getState();
                $stage = $state->getVar('stage');
                if ( !isset($stage) || $stage == '' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::runView() -> No stage found');
                        $this->callStage($this->getDefaultStage());
                        
                        return;
                }
                
                Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this)."::runView() -> Calling stage '$stage'");
                $this->callStage($stage);
        }
        
        
        function runController ()
        {
                $action = $_REQUEST['action'];
                if ( !isset($action) || $action == '' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::runController() -> No action found');
                        $redirect =  $this->callAction($this->getDefaultAction());
                }
                else
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this)."::runController() -> Calling action '$action'");
                        $redirect = $this->callAction($action);
                }
                
                //$_SESSION[$this->getObjectIdValue()] =& $this->getState();
                Session::putRef($this->getObjectIdValue(), $this->getState());
                SiteUtils::redirect($redirect);
        }
        
        
        function initState ()
        {
                ;
        }
        
        
        function generateObjectId ( &$state )
        {
                return '';
        }
        
        
        function callStage ( $stage )
        {
                $handlers = $this->getStageHandlers();
                $this->callStageHandler(
                        $handlers[$stage]);
        }
        
        
        function callStageHandler ( $handler )
        {
                call_user_func( array(&$this, $handler) );
        }
        
        
        function callAction ( $action )
        {
                $handlers = $this->getActionHandlers();
                //print_r($handlers);
                $redirect = $this->callActionHandler(
                        $handlers[$action]);
                
                return $redirect;
        }
        
        
        function callActionHandler ( $handler )
        {
                $redirect = call_user_func( array(&$this, $handler) );
                return $redirect;
        }
        
        
        function addStageHandler ( $stage, $handler )
        {
                $handlers = $this->getStageHandlers();
                $handlers[$stage] = $handler;
                $this->setStageHandlers($handlers);
        }
        
        
        function addActionHandler ( $action, $handler )
        {
                $handlers = $this->getActionHandlers();
                $handlers[$action] = $handler;
                $this->setActionHandlers($handlers);
        }
        
        
        function strictPRGMode ()
        {
                return $this->getStrictPRGMode();
        }
}

?>
