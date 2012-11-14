<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-08
 */

class PRGController extends SEMObject
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        function ACTION_HANDLER_MAP () { return array(); }
        function DEFAULT_HANDLER () { return 'default'; }
        function VIEW_PAGE () { return ''; }
        
        
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
        
        
        var $objectIdName = 'oid';
        var $objectDataName = 'objdata';
        
        var $objectId = '';
        var $objectData = NULL;
        
        var $model = NULL;
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function PRGController ()
        {
                die("Class '".get_class($this)."' is abstract and cannot be".
                        " instantiated.");
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
        
        
        function &getModel ()
        {
                return $this->model;
        }
        
        
        function setModel ( &$model )
        {
                $this->model =& $model;
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
                        $oid = $this->generateObjectId();
                        $this->setObjectId($oid);
                        $model =& new PRGSessionModel();
                        $model->setVar($this->getObjectIdName(), $oid);
                        $this->setModel($model);
                        $this->callHandler($this->DEFAULT_HANDLER());
                }
                else
                {
                        $model =& $_SESSION[$oid];
                        $this->setModel($model);
                        $action = $_REQUEST['action'];
                        if ( !isset($action) || $action == '' )
                        {
                                $this->callHandler($this->DEFAULT_HANDLER());
                        }
                        else
                        {
                                $this->callActionHandler($action);
                        }
                }
                
                $_SESSION[$this->getObjectId()] =& $this->getModel();
                redirect($this->VIEW_PAGE().'?'.$this->getObjectIdName().
                        '='.$this->getObjectId());
        }
        
        
        function generateObjectId ()
        {
                $str = $this->getObjectDataName() . date('His', time());
                return $str;
        }
        
        
        function callHandler ( $handler )
        {
                call_user_func( array(&$this, $handler) );
        }
        
        
        function callActionHandler ( $action )
        {
                $handlers = $this->ACTION_HANDLER_MAP();
                $this->callHandler($handlers[$action]);
        }
}

?>
