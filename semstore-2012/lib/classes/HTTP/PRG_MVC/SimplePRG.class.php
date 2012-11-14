<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-09
 */

require_once('SEMObject.class.php');

require_once('Session/Session.class.php');
require_once('Web/Site/SiteUtils.class.php');

class SimplePRG extends SEMObject
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
        
        
        var $oid = '';
        var $oidValue = '';
        var $state = NULL;
        var $stageHandlers = array();
        var $actionHandlers = array();
        var $defStage = '';
        var $defAction = '';
        var $redirect = '';
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function SimplePRG ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'SimplePRG'.$numArgs),  $args);
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getObjectId ()
        {
                return $this->oid;
        }
        
        
        function setObjectId ( $oid )
        {
                $this->oid = $oid;
        }
        
        
        function getObjectIdValue ()
        {
                return $this->oidValue;
        }
        
        
        function setObjectIdValue ( $objectIdValue )
        {
                $this->oidValue = $objectIdValue;
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
}

?>
