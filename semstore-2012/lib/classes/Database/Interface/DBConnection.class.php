<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 2.0
 * @date 2005-06-22
 * @package Database.Interface
 */

require_once('SEMObject.class.php');
//require_once('Database/Interface/RecordSet.class.php');
require_once('Database/Interface/DBRowSet.class.php');
require_once('Database/Interface/DBError.class.php');

class DBConnection extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        /**
         * The name of the remote end-point
         * @var string
         */
        var $server = '';
        
        /**
         * The connections remote port
         * @var int
         */
        var $port = 0;
        
        /**
         * The username to use when connecting the the server
         * @var string
         */
	var $username = '';
        
        /**
         * The password to use when connecting to the server
         * @var string
         */
	var $password = '';
        
        /**
         * The database that is currently being used 
         * @var string
         */
	var $database = '';
        
        /**
         * Whether a connection should be established with the server when
         * a instance of this classes is constructed
         * @var bool
         */
	var $autoconnect = FALSE;
        
        /**
         * The last sql statement that was executed
         * @var string
         */
	var $sql = '' ;
        
        /**
         * The connection resource
         * @var resource
         */
        var $connection = NULL;
        
        
        /*
	 * Class Methods
	 */
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return object
         */
        function &create ( $uri )
        {
                //print $uri;
                
                $rexp = '{^(.+?)://(.+?)/(.+?)\?username=(.+?)&password=(.+?)$}';
                
                $matches = array();
                if ( preg_match($rexp, $uri, $matches) )
                {
                        //print "subblah1";
                        
                        //print_r($matches);
                        
                        $protocol = $matches[1];
                        $server = $matches[2];
                        $database = $matches[3];
                        $username = $matches[4];
                        $password = $matches[5];
                        
                        $portrexp = '{^(.+?):(.+?)$}';
                        if ( preg_match($portrexp, $server, $matches) )
                        {
                                //print_r($matches);
                                
                                $server = $matches[1];
                                $port = $matches[2];
                        }
                        
                        $class = ucfirst($protocol.'DBConnection');
                        $instance =& new $class();
                        $instance->server = $server;
                        $instance->port = $port;
                        $instance->database = $database;
                        $instance->username = $username;
                        $instance->password = $password;
                        
                        //print "subblah2";
                        
                        //print_r($instance);
                        
                        return $instance;
                }
                
                //return new MysqlDBConnection();
                
                return NULL;
        }
        
        
        function BuildUri ( $protocol, $server, $port, $username,
                $password, $database)
        {
                $uri = $protocol . '://' . $server . ':' . $port . '/' .
                        $database . '?username=' . $username .
                        '&password=' . $password;
                
                return $uri;
        }
        
        
        function isError ( &$obj )
        {
                if ( @@is_a($obj, 'DBError') || @@is_subclass_of($obj, 'DBError') )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        /*
	 * Constructors
	 */
        
        
        function DBConnection ()
	{
                die();
   	}
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getServer ()
        {
                return $this->server;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setServer ( $server )
        {
                $this->server = $server;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getPort ()
        {
                return $this->port;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setPort ( $port )
        {
                $this->port = $port;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getUsername ()
        {
                return $this->username;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setUsername ( $username )
        {
                $this->username = $username;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getPassword ()
        {
                return $this->password;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getDatabase ()
        {
                return $this->database;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setDatabase ( $database )
        {
                $this->database = $database;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getAutoconnect ()
        {
                return $this->autoconnect;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setAutoconnect ( $connect )
        {
                $this->autoconnect = $autoconnect;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function getSQLStatement ()
        {
                return $this->sql;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setSQLStatement ( $sql )
        {
                $this->sql = $sql;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _getConnection ()
        {
                return $this->connection;
        }
        
        
        /**
         * Returns the unix timetsamp representing the creation time of this
         * object.
         *
         * @access public
         * @return int
         */
        function _setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
                
        
        
        /*
	 * Command Methods
	 */
        
	
        /**
         * Connects to the server with the given information.
         *
         * Connects to the server with the given information.  TRUE is returned
         * if the connection was successfully established or an instance of
         * DBError if unsuccessful.
         * 
         * @access public
         * @return mixed
         */
	function connect ()
	{
		die('Abstract method invoked');
	}
	
        
        /**
         * Disconnects from the server
         *
         * Disconnects from the server.  TRUE is returned
         * if the connection was successfully disconnected or an instance of
         * DBError if unsuccessful.
         * 
         * @access public
         * @return mixed
         */
	function disconnect ()
	{
		die('Abstract method invoked');
	}
	
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
	function &execute ( $sql )
	{
                $matches = array();
		if ( preg_match('{select}i', $sql, $matches) )
                {
                        return $this->select($sql);
                }
                else if ( preg_match('{insert}i', $sql, $matches) )
                {
                        return $this->insert($sql);
                }
                else if ( preg_match('{update}i', $sql, $matches) )
                {
                        return $this->update($sql);
                }
                else
                {
                        return $this->select($sql);
                }
	}
	
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function &select ( $sql )
        {
                die('Abstract method invoked');
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function insert ( $sql )
        {
                die('Abstract method invoked');
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function update ( $sql )
        {
                die('Abstract method invoked');
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function delete ( $sql )
        {
                die('Abstract method invoked');
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
	function getLastStatement ()
	{
		die('Abstract method invoked');
	}
	
        
        function getLastInsertId ()
        {
                die('Abstract method invoked');
        }
        
        
        /**
         * Call methods of the return values of other methods
         * 
         * @access public
         * @param array $methods
         * @param bool $recursive
         * @return mixed
         */
        function escapeString ( $string )
        {
                die('Abstract method invoked');
        }
}

?>