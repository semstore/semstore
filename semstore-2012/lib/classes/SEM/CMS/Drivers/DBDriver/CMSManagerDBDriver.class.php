<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Drivers.DBDriver
 */

require_once('SEM/CMS/CMSManager.class.php');

/* Implementations of CMS Abstractions :: Start */
require_once('SEM/CMS/Drivers/DBDriver/DBUser.class.php');
/* Implementations of CMS Abstractions :: End */

/* DataObjects :: Start */
require_once('SEM/CMS/Drivers/DBDriver/DataObjecsts/UserDataObject.class.php');
/* DataObjects :: End */

/* SEM SCL :: Start */
require_once('SEM/SimpleConstraintLogic/OpAnd.class.php');
require_once('SEM/SimpleConstraintLogic/OpOr.class.php');
require_once('SEM/SimpleConstraintLogic/OpEqualTo.class.php');
require_once('SEM/SimpleConstraintLogic/OpNotEqualTo.class.php');
require_once('SEM/SimpleConstraintLogic/OpLess.class.php');
require_once('SEM/SimpleConstraintLogic/OpGreater.class.php');
require_once('SEM/SimpleConstraintLogic/OpGreaterOrEqualTo.class.php');
require_once('SEM/SimpleConstraintLogic/OpLessOrEqualTo.class.php');
/* SEM SCL :: End */

class CMSManagerDBDriver extends CMSManager
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
        
        
        var $protocol = '';
        var $server = '';
        var $port = 0;
        var $database = '';
        var $username = '';
        var $password = '';
        var $dbConnection = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CMSManagerDBDriver ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSManagerDBDriver'.$numArgs),
                        $args);
        }
        
        
        function _CMSManagerDBDriver0 ()
        {
                ;
        }
        
        
        function _CMSManagerDBDriver1 ( $options )
        {
                foreach ( $options as $option => $value )
                {
                        $this->$option = $value;
                }
                
                $dbConnection =& DBConnection::create(
                        DBConnection::BuildUri($this->getProtocol(),
                        $this->getServer(),
                        $this->getPort(),
                        $this->getUsername(),
                        $this->getPassword(),
                        $this->getDatabase())
                        );
                
                $this->_setDBConnection($dbConnection);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getProtocol ()
        {
                return $this->protocol;
        }
        
        
        function _setProtocol ( $protocol )
        {
                $this->protocol = $protocol;
        }
        
        
        function getServer ()
        {
                return $this->server;
        }
        
        
        function _setServer ( $server )
        {
                $this->server = $server;
        }
        
        
        function getPort ()
        {
                return $this->port;
        }
        
        
        function _setPort ( $port )
        {
                $this->port = $port;
        }
        
        
        function getDatabase ()
        {
                return $this->database;
        }
        
        
        function _setDatabase ( $database )
        {
                $this->database = $database;
        }
        
        
        function getUsername ()
        {
                return $this->username;
        }
        
        
        function _setUsername ( $username )
        {
                $this->username = $username;
        }
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        function &getDBConnection ()
        {
                return $this->dbConnection;
        }
        
        
        function _setDBConnection ( &$dbConnection )
        {
                $this->dbConnection =& $dbConnection;
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
        
        
        /* User :: Begin */
        function &newUser ()
        {
                die('abstract');
        }
        
        
        function &_newUser0 ()
        {
                $user =& new DBUser();
                $user->setDriver($this);
                
                return $user;
        }
        
        
        function &_newUser1 ( $username )
        {
                die('abstract');
        }
        
        
        function &findUser ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_findUser'.$numArgs),
                        $args);
        }
        
        
        function &_findUser0 ()
        {
                die('abstract');
        }
        
        
        function &_findUser1 ( $criteria )
        {
                return DBUser::findFirst( $criteria, $this );
        }
        
        
        function &findUsers ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_findUsers'.$numArgs),
                        $args);
        }
        
        
        function &_findUsers0 ()
        {
                return DBUser::find( array(), $this );
        }
        
        
        function &_findUsers1 ( $criteria )
        {
                return DBUser::find( $criteria, $this );
        }
        
        
        function &_findUsers2 ( $criteria, $sort )
        {
                die('abstract');
        }
        
        
        function &_findUsers3 ( $criteria, $sort, $limit )
        {
                die('abstract');
        }
        /* User :: End */
}

?>
