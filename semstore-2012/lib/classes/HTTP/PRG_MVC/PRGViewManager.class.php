<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-08
 */

class PRGViewManager extends SEMObject
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
        
        
        function STAGE_HANDLER_MAP () { return array(); }
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        var $objectIdName = 'oid';
        var $objectDataName = 'objdata';
        
        var $objectId = '';
        var $objectData = NULL;
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function PRGViewManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'PRGViewManager'.$numArgs),  $args);
        }
        
        
        function PRGViewManager0 ()
        {
                ;
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getObjectIdName ()
        {
                return $this->objectIdName;
        }
        
        
        function setObjectIdName ( $objectIdName )
        {
                $this->objectIdName = $objectIdName;
        }
        
        
        function getObjectDataName ()
        {
                return $this->objectDataName;
        }
        
        
        function setObjectDataName ( $objectDataName )
        {
                $this->objectDataName = $objectDataName;
        }
        
        
        function getObjectId ()
        {
                return $this->objectId;
        }
        
        
        function setObjectId ( $objectId )
        {
                $this->objectId = $objectId;
        }
        
        
        function &getObjectData ()
        {
                return $this->objectData;
        }
        
        
        function setObjectData ( &$objectData )
        {
                $this->objectData =& $objectData;
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
                $oidName = $this->getObjectIdName();
                $oid = $_REQUEST[$oidName];
                $this->setObjectId($oid);
                
                if ( !isset($oid) || $oid == '' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(),
                                get_class($this).'::run() -> No ObjectId found' .
                                'in HTTP request');
                        $this->doStage('start');
                }
                else
                {
                        /*
                        $tmpOId = $this->getObjectDataName() .
                                $this->getObjectId();
                        */
                        $tmpOId = $this->getObjectId();
                        $objectData =& $_SESSION[$tmpOId];
                        $this->setObjectData($objectData);
                        
                        if ( !is_object($objectData) )
                        {
                                Debug::debugMsg(DebugLevel::DEBUG(),
                                        get_class($this).'::run() -> No Object Data found' .
                                        ' for ' . "'$tmpOId'");
                                $this->doStage('start');
                        }
                        else
                        {
                                $stage = $objectData->getVar('stage');
                                if ( !isset($stage) || $stage == '' )
                                {
                                        Debug::debugMsg(DebugLevel::DEBUG(),
                                                get_class($this).'::run() -> No stage found');
                                        $this->doStage('start');
                                }
                                else
                                {
                                        $this->doStage($stage);
                                }
                        }
                }
        }
        
        
        function doStage ( $stage )
        {
                $handlers =& $this->STAGE_HANDLER_MAP();
                $view =& new $handlers[$stage];
                $view->setModel($this->getObjectData());
                $view->render();
        }
}


?>
