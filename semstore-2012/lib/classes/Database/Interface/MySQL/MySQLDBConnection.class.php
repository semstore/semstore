<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-22
 * @package Database.Abstraction
 */

require_once('Database/Interface/DBConnection.class.php');

require_once('Database/Interface/DBError.class.php');

class MySQLDBConnection extends DBConnection
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
        
        
	var $server = '';
	var $username = '';
	var $password = '';
	var $database = '';
	var $autoconnect = FALSE;
	var $sql = '' ;
        var $connection = NULL;
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function MySQLDBConnection ()
	{
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_MySQLDBConnection'.$numArgs),
                        $args); 
   	}
   
   	function _MySQLDBConnection0 ()
	{
		;
   	}
	
	function _MySQLDBConnection4 ($server, $username, $password, $database)
	{
		$this->server = $server;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->connection = NULL;
	}
	
	function _MySQLDBConnection5 ($server, $username, $password, $database, $autoconnect)
	{
		//$this($server, $username, $password);
		$this->server = $server;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->connection = NULL;
		
		$this->autoconnect = $autoconnect;
		
		if ($autoconnect == TRUE)
		{
			//return $this->connect();
                        $this->connect();
		}
	}
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getConnection ()
	{
		return $this->connection;	
	}
        
        
        /*
	 * Command Methods
	 */
        
        
        function connect ()
	{
                $connection = @mysql_connect($this->server, $this->username, $this->password, TRUE);
                if ( $connection == FALSE )
                {
                        $error =& new DBError(mysql_error());
                        return $error;
                }
                
                $this->connection = $connection;
                        
		if ( !mysql_select_db($this->database, $this->connection) )
                {
                        $error =& new DBError(mysql_error());
                        return $error;
                }
		
                //return $this->connection;
                return TRUE;
	}
	
	function disconnect ()
	{
		$status = mysql_close($this->connection);
		if ($status == 1)
		{
				$this->connection = 0;
		}
		return $status;
	}
	
	function &execute ($sql)
	{
                $matches = array();
		if ( preg_match('{^select}i', $sql, $matches) )
                {
                        return $this->select($sql);
                }
                else if ( preg_match('{^insert}i', $sql, $matches) )
                {
                        return $this->insert($sql);
                }
                else if ( preg_match('{^update}i', $sql, $matches) )
                {
                        return $this->update($sql);
                }
                else if ( preg_match('{^delete}i', $sql, $matches) )
                {
                        return $this->delete($sql);
                }
                
		if (is_null($this->connection))
		{
			$result = $this->connect();
                        if ( @@is_a($result, 'DBError') ||
                                @@is_subclass_of($result, 'DBError') )
                        {
                                return $result;
                        }
		}
		
		$this->sql = $sql;
                //print $sql."\n";
		$result = mysql_query($sql, $this->connection);
                if ( $result === TRUE )
                {
                        return TRUE;
                }
                else if ( is_resource($result) )
                {
                        $recordset =& new MySQLRowSet($result);
                        return $recordset;
                }
                else
                {
                        $error =& new DBError();
                        $error->setCode(mysql_errno($this->connection));
                        $error->setMessage(mysql_error($this->connection));
                        return $error;
                }
	}
        
        
        function &select ( $sql )
        {
                if (is_null($this->connection))
		{
                        $result = $this->connect();
                        if ( @@is_a($result, 'DBError') ||
                                @@is_subclass_of($result, 'DBError') )
                        {
                                return $result;
                        }
		}
                
                $this->sql = $sql;
                //print $sql."\n";
		$resId = mysql_query($sql, $this->connection);
                if ( !is_resource($resId) || $resId === FALSE )
                {
                        $error =& new DBError();
                        $error->setCode(mysql_errno($this->connection));
                        $error->setMessage(mysql_error($this->connection));
                        return $error;
                }
                
                $recordset =& new MySQLRowSet($resId);
                
		return $recordset;
        }
        
        
        function insert ( $sql )
        {
                if (is_null($this->connection))
		{
			$result = $this->connect();
                        if ( @@is_a($result, 'DBError') ||
                                @@is_subclass_of($result, 'DBError') )
                        {
                                return $result;
                        }
                        
		}
                
                $this->sql = $sql;
                //print $sql."\n";
                $result = mysql_query($sql, $this->connection);
                if ( $result === FALSE )
                {
                        $error =& new DBError();
                        $error->setCode(mysql_errno($this->connection));
                        $error->setMessage(mysql_error($this->connection));
                        return $error;
                }
                
                return $this->getLastInsertId();
        }
        
        
        function update ( $sql )
        {
                if (is_null($this->connection))
		{
			$result = $this->connect();
                        if ( @@is_a($result, 'DBError') ||
                                @@is_subclass_of($result, 'DBError') )
                        {
                                return $result;
                        }	
		}
                
                $this->sql = $sql;
                //print $sql."\n";
                
                $result = mysql_query($sql, $this->connection);
                if ( $result === FALSE )
                {
                        $error =& new DBError();
                        $error->setCode(mysql_errno($this->connection));
                        $error->setMessage(mysql_error($this->connection));
                        return $error;
                }
                
                return mysql_affected_rows($this->connection);
        }
        
        
        function delete ( $sql )
        {
                if (is_null($this->connection))
		{
			$result = $this->connect();
                        if ( @@is_a($result, 'DBError') ||
                                @@is_subclass_of($result, 'DBError') )
                        {
                                return $result;
                        }	
		}
                
                $this->sql = $sql;
                //print $sql."\n";
                
                $result = mysql_query($sql, $this->connection);
                if ( $result === FALSE )
                {
                        $error =& new DBError();
                        $error->setCode(mysql_errno($this->connection));
                        $error->setMessage(mysql_error($this->connection));
                        return $error;
                }
                
                return mysql_affected_rows($this->connection);
        }
        
        
        function getLastStatement ()
	{
		return $this->sql;	
	}
        
        
        function getLastInsertId ()
        {
                return @mysql_insert_id($this->getConnection());
        }
        
        
        function escapeString ( $string )
        {
                if ( is_numeric($string) )
                {
                        return $string;
                }
                else if ( !is_null($this->connection) )
                {
                        $string = mysql_real_escape_string(
                                $string,
                                $this->connection
                                );
                        
                        return $string;
                }
                else
                {
                        $string = mysql_escape_string($string);
                        
                        return $string;
                }
        }
}

?>
