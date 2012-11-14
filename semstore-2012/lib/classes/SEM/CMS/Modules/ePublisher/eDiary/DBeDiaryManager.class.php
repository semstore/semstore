<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.ePublisher.eDiary
 */

require_once('SEM/ePublisher/eDiary/eDiaryManager.class.php');

class DBeDiaryManager extends eDiaryManager
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
        
        
        var $dbProtocol = 'mysql';
        var $dbServer = 'localhost';
        var $dbPort = '3306';
        var $dbUsername = '';
        var $dbPassword = '';
        var $dbDatabase = '';
        var $dbConnection = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function DBeDiaryManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_DBeDiaryManager'.$numArgs ),
                        $args);
        }
        
        
        function DBeDiaryManager0 ()
        {
                ;
        }
        
        
        function DBeDiaryManager1 ( $options )
        {
                ;
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getDBProtocol ()
        {
                return $this->dbProtocol;
        }
        
        
        function _setDBProtocol ( $dbProtocol )
        {
                $this->dbProtocol =& $dbProtocol;
        }
        
        
        function getDBServer ()
        {
                return $this->dbServer;
        }
        
        
        function _setDBServer ( $dbServer )
        {
                $this->dbServer = $dbServer;
        }
        
        
        function getDBPort ()
        {
                return $this->dbPort;
        }
        
        
        function _setDBPort ( $dbPort )
        {
                $this->dbPort = $dbPort;
        }
        
        
        function getDBUsername ()
        {
                return $this->dbUsername;
        }
        
        
        function _setDBUsername ( $dbUsername )
        {
                $this->dbUsername = $dbUsername;
        }
        
        
        function getDBPassword ()
        {
                return $this->getDBPassword;
        }
        
        
        function _setDBPassword ()
        {
                $this->dbPassword =& $dbPassword;
        }
        
        
        function getDBDatabase ()
        {
                return $this->dbDatabase;
        }
        
        
        function _setDBDatabase ( $dbDatabase )
        {
                $this->dbDatabase = $dbDatabase;
        }
        
        
        function &getDBConnection ()
        {
                return $this->dbConnection;
        }
        
        
        function _setDBConnection ( &$connection )
        {
                $this->dbConnection =& $connection;
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
        
        
        function _connect ()
        {
                if ( $this->getDBConnection() != NULL )
                {
                        return TRUE;
                }
                
                $uri = DBConnection::BuildUri(
                        $this->getDBProtocol(), $this->getDBServer(),
                        $this->getDBPort(), $this->getDBUsername(),
                        $this->getDBPassword(), $this->getDBDatabase()
                        );
                $object =& DBConnection::create($uri);
                
                if ( @is_subclass_of($object, 'DBConnection') )
                {
                        $this->_setDBConnection($object);
                        return TRUE;
                }
                
                return $object;
        }
        
        
        function &createDiary ()
        {
                $diary =& new DBeDiary();
                return $diary;
        }
        
        
        /*
        function &createDiary ( $name )
        {
                ;
        }
        */
        
        
        function &removeDiary ( &$diary )
        {
                ;
        }
        
        
        function &findDiary ( $id )
        {
                return DBeDiary::findDiary( $id, $this->getDBConnection() );
        }
}

?>
