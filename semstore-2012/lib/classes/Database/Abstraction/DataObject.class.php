<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 2.0
 * @date 2005-08-23
 * @package Database.Abstraction
 */

require_once('SEMObject.class.php');

require_once('Database/Abstraction/DataObjectError.class.php');

require_once('Database/Interface/DBConnection.class.php');
require_once('Database/Interface/DBRowSet.class.php');
require_once('Database/Interface/DBError.class.php');


class DataObject extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function TABLE () { return "dataObject"; }
        function PRIMARY_KEY () { return ""; }
        function FIELD_LIST () { return array(); }
        
        
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
        
        
        var $dbConnection = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function DataObject ()
	{
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this,'_DataObject'.$numArgs),
                        $args);
        }
        
        
        function _DataObject0 ()
        {
                die("Class '" . get_class($this) . "' is abstract and cannot be" .
                        " instantiated.");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function setConnection ( &$dbConn )
	{
		$this->dbConnection =& $dbConn;
	}
	
        
	function &getConnection ()
	{
		return $this->dbConnection;	
	}
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        /* Lookup single entity :: Start */
        function &lookup ( $criteria, &$connection )
        {
                if ( is_string($criteria) )
                {
                        return $this->lookupUsingSQL($criteria, $connection);
                }
                elseif ( is_array($criteria) )
                {
                        return $this->lookupUsingAttributeArray(
                                $criteria, $connection);
                }
                
                return NULL;
        }
        
        
        function &lookupUsingSQL ( $sql, &$connection )
        {
                $dataObject =& $this->_lookupUsingSQL($sql, $connection);
                if ( is_object($dataObject) )
                {
                        $dataObject->_postlookup($connection);
                }
                
                return $dataObject;
        }
        
        
        function &lookupUsingAttributeArray ( $attributes, &$connection )
        {
                $dataObject =& $this->_lookupUsingAttributeArray($attributes, $connection);
                if ( is_object($dataObject) )
                {
                        $dataObject->_postlookup($connection);
                }
                
                return $dataObject;
        }
        
        
        function &_lookupUsingSQL ( $sql, &$connection )
        {
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->_lookupUsingSQL()");	
		}
                
                $dataObject = NULL;
                
                //$sql = 'SELECT * FROM ' . $this->TABLE() . ' ' . $sqlWhere;
                $sql = $this->_completeSelectSQL($sql) . ' LIMIT 1';
           
                
                $rowset =& $connection->select($sql);
                if ( @@is_a($rowset, 'DBError') ||
                        @@is_subclass_of($rowset, 'DBError') )
		{
			//die("From " . get_class($this) . "->_lookupUsingSQL() --> Unable to execute SQL statement: " . $sql);
                        die("From " . get_class($this) .
                                "->_lookupUsingSQL() --> Unable to execute SQL statement: " .
                                $sql . ".\nReason: " . $rowset->toString());
		}
                if ( $rowset->first() )
                {
                        $row =& $rowset->getRowHash();
                        $dataObject =& $this->createDataObject($row, $connection);
                        $dataObject->setConnection($connection);
                }
                
                return $dataObject;
        }
        
        
        function &_lookupUsingAttributeArray ( $attributes, &$connection )
        {
                /*
                if (count($attributes) == 0)
		{
			die("No attributes to look up passed to " . get_class($this) . "->lookup()");
		}
                */
		
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->_lookupUsingAttributeArray()");	
		}
                
                $sql = $this->attributeArray2SQL($attributes, $connection);
                return $this->_lookupUsingSQL($sql, $connection);
        }
        /* Lookup single entity :: End */
        
        
        
        
        
        /* Lookup array of entities :: Start */
        function &lookupArray ( $criteria, &$connection )
	{
                if ( is_string($criteria) )
                {
                        return $this->lookupArrayUsingSQL(
                                $criteria, $connection);
                }
                elseif ( is_array($criteria) )
                {
                        return $this->lookupArrayUsingAttributeArray(
                                $criteria, $connection);
                }
                
                return NULL;
        }
        
        
        function &lookupArrayUsingSQL ( $sql, &$connection )
	{
                $dataObjects =& $this->_lookupArrayUsingSQL($sql, $connection);
                if ( is_array($dataObjects) )
                {
                        for ( $i = 0; $i < count($dataObjects); $i++ )
                        {
                                $dataObjects[$i]->_postlookup($connection);
                        }
                }
                
                return $dataObjects;
        }
        
        
        function &lookupArrayUsingAttributeArray ( $attributes, &$connection )
	{
                $dataObjects =& $this->_lookupArrayUsingAttributeArray($attributes, $connection);
                if ( is_array($dataObjects) )
                {
                        for ( $i = 0; $i < count($dataObjects); $i++ )
                        {
                                $dataObjects[$i]->_postlookup($connection);
                        }
                }
                
                return $dataObjects;
        }
        
        
        function &_lookupArrayUsingSQL ( $sql, &$connection )
        {
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->_lookupArrayUsingSQL()");	
		}
                
                $dataObjects = array();
                
		//$sql = 'SELECT * FROM ' . $this->TABLE() . ' ' . $sqlWhere;
                $sql = $this->_completeSelectSQL($sql);
                
                //print $sql;
                
                $rowset =& $connection->select($sql);
		if ( !is_object($rowset) )
		{
			die("From " . get_class($this) . "->_lookupArrayUsingSQL() --> Unable to execute SQL statement: " . $sql);	
		}
		if ($rowset->getRowCount() > 0)
		{
                        while ( $rowset->next() )
                        {
                                $row =& $rowset->getRowHash();
                                $dataObject =& $this->createDataObject($row, $connection);
                                $dataObject->setConnection($connection);
                                array_push($dataObjects, $dataObject);
                        }
		}
		
		return $dataObjects;
	}
        
        
        function &_lookupArrayUsingAttributeArray ( $attributes, &$connection )
        {
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->_lookupArrayUsingAttributeArray()");	
		}
                
		$sql = $this->attributeArray2SQL($attributes, $connection);
                return $this->_lookupArrayUsingSQL($sql, $connection);
	}
        /* Lookup array of entities :: Start */
        
        
        
        
        
        /* Lookup auxiliary methods :: Start */
        function _completeSelectSQL ( $sql )
        {
                $compSql = '';
                
                $aliases = array();
                if ( preg_match('{^WHERE}i', $sql) > 0 )
                {
                        $aliases = $this->FIELD_LIST();
                }
                else
                {
                        foreach ( $this->FIELD_LIST() as $field )
                        {
                                $aliases[] = $this->TABLE().'.'.$field .
                                        ' AS ' . $field;
                        }
                }
                
                $compSql = 'SELECT ' .
                                implode(', ', $aliases);
                
                if ( preg_match('{^FROM}i', $sql) == 0 )
                {
                        $compSql .= ' FROM '.$this->TABLE();
                }
                
                $compSql .= ' '.$sql;
                
                return $compSql;
        }
        
        
        function attributeArray2SQL ( $attributes, &$connection )
        {
                $attributeCount = 0;
		//$sql = "SELECT * FROM " . $this->TABLE();
                if ( count($attributes) > 0 )
                {
                        //$sql .= " WHERE";
                        $sql = 'WHERE';
                        foreach ($attributes as $field => $value)
                        {
                                if ($attributeCount > 0)
                                {
                                        $sql .= " AND";	
                                }
                                $sql .= " " . $field . " = ";
                                if ( is_null($value) )
                                {
                                        $sql .= 'NULL';
                                }
                                elseif ( !is_numeric($value) )
                                {
                                        $sql .= "'" .
                                                $connection->escapeString($value
                                                        ) . "'";
                                }
                                else
                                {
                                        $sql .= $value;
                                }
                                $attributeCount++;
                        }
                }
                
                return $sql;
        }
        /* Lookup auxiliary methods :: Start */
        
        
        
        
        function buildInsertSQL ( $fields, &$connection )
        {
                $sql = '';
                $sqlFields = '';
                $sqlFieldVals = '';
                $first = TRUE;
                foreach ( $fields as $field => $value )
                {
                        if ( !$first )
                        {
                                $sqlFields .= ", " . $field;
                                $sqlFieldVals .= ", ";
                                if ( is_null($value) )
                                {
                                        $sqlFieldVals .= 'NULL';
                                }
                                elseif ( !is_numeric($value) )
                                {
                                        $sqlFieldVals .= "'" .
                                                $connection->escapeString(
                                                        $value) . "'";
                                }
                                else
                                {
                                        $sqlFieldVals .= $value;
                                }
                        }
                        else
                        {
                                $sqlFields = $field;
                                //$sqlFieldVals = "'" . $value . "'";
                                if ( is_null($value) )
                                {
                                        $sqlFieldVals .= 'NULL';
                                }
                                elseif ( !is_numeric($value) )
                                {
                                        $sqlFieldVals .= "'" .
                                                $connection->escapeString(
                                                        $value) . "'";
                                }
                                else
                                {
                                        $sqlFieldVals .= $value;
                                }
                                $first = FALSE;
                        }
                }
                
                $sql = "INSERT INTO " . $this->TABLE() .
                        " (" . $sqlFields . ") VALUES " .
                        "(" . $sqlFieldVals . ")";
                
                return $sql;
        }
        
        
        function buildUpdateSQL ( $fields, &$connection )
        {
                $sql = '';
                
                $sqlFields = '';
                $first = TRUE;
                foreach ( $fields as $field => $value )
                {
                        if ( !$first )
                        {
                                $sqlFields .= ", " . $field . "= ";
                                if ( is_null($value) )
                                {
                                        $sqlFields .= 'NULL';
                                }
                                elseif ( !is_numeric($value) )
                                {
                                        $sqlFields .= "'" .
                                                $connection->escapeString(
                                                        $value) . "'";
                                }
                                else
                                {
                                        $sqlFields .= $value;
                                }
                        }
                        else
                        {
                                $sqlFields = $field . "= ";
                                if ( is_null($value) )
                                {
                                        $sqlFields .= 'NULL';
                                }
                                elseif ( !is_numeric($value) )
                                {
                                        $sqlFields .= "'" .
                                                $connection->escapeString(
                                                        $value) . "'";
                                }
                                else
                                {
                                        $sqlFields .= $value;
                                }
                                $first = FALSE;
                        }
                }
                if ( $this->PRIMARY_KEY() != '' )
		{
                	$sql = "UPDATE " . $this->TABLE() .
                        	" SET " . $sqlFields . " WHERE " .
                        	$this->PRIMARY_KEY() . " = '" .
                        	$this->{$this->PRIMARY_KEY()} . "'"; 
                }
		else 
		{
			print_r ( 'No Primary Key' );
			die();
		}
                return $sql;
        }
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new DataObject();
                
                return $obj;
        }
        
        
        function &createDataObject ( $row, &$connection )
        {
                $dataObject =&$this->_instantiateDataObject();
                $dataObject->_setAttributes($row);
                
                return $dataObject;
        }
        
        
        function existsInDB ( $connection, $table, $primaryKey, $pkValue )
	{
		$sql = "SELECT * FROM " . $table . " WHERE " . $primaryKey . " = ";
                if ( is_null($pkValue) )
                {
                        $sql .= 'NULL';
                }
                elseif ( !is_numeric($pkValue) )
                {
                        $sql .= "'" .
                                $connection->escapeString($pkValue) . "'";
                }
                else
                {
                        $sql .= $pkValue;
                }
                
                //print $sql;

		$rowset =& $connection->execute($sql);
		if ($rowset->getRowCount() > 0)
		{
			return true;
		}
		
		return false;
	}
	
	
        function uniqueInDB ( $connection, $table, $primaryKey, $pkValue )
	{
		$sql = "SELECT * FROM " . $table . " WHERE " . $primaryKey . " = '";
                if ( is_null($pkValue) )
                {
                        $sql .= 'NULL';
                }
                elseif ( !is_numeric($pkValue) )
                {
                        $sql .= "'" .
                                $connection->escapeString($pkValue) . "'";
                }
                else
                {
                        $sql .= $pkValue;
                }
                
                //print $sql;
                
		$rowset = $connection->execute($sql);
		$status = false;
		$rowset =& $connection->execute($sql);
		if ($rowset->getRowCount() == 1)
		{
			return true;
		}
		
		return false;
	}
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function _postlookup ( &$connection )
        {
                ;
        }
        
        
        function store ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_store'.$numArgs),
                        $args);
        }
        
        
        function _store0 ()
        {
		$status = 0;
		
		// If entry in database with same Primary Key then update else insert new.
		
		if ($this->existsInDB($this->getConnection(),
						$this->TABLE(),
						$this->PRIMARY_KEY(),
						$this->{$this->PRIMARY_KEY()}))
		{
			// Update db entry
			$status = $this->update($this->getConnection());
		}
		else
		{
			// Insert new db entry
                        $status = $this->insert($this->getConnection());
		}
		
		return $status;
	}
        
        
        function _store1 ( &$connection )
	{
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->store()");	
		}
                
                $this->setConnection($connection);
                return $this->store();
        }
        
        
        function insert ( &$connection )
        {
                $this->_preinsert($connection);
                $status = $this->_insert($connection);
                $this->_postinsert($connection);
                
                return $status;
        }
        
        
        function _preinsert ( &$connection )
        {
                ;
        }
        
        
        function _insert ( &$connection )
        {
                $fields = array();
                foreach ( $this->FIELD_LIST() as $field )
                {
                        $fields[$field] = $this->{$field};
                }
                
                $sql = $this->buildInsertSQL($fields, $connection);
                //print $sql;
                $rowset =& $connection->insert($sql);
                if ( @@is_a($rowset, 'DBError') ||
                        @@is_subclass_of($rowset, 'DBError') )
		{
                        die("From " . get_class($this) .
                                "->_insert() --> Unable to execute SQL statement: " .
                                $sql . ".\nReason: " . $rowset->toString());
		}
                
                return is_object($rowset);
        }
        
        
        function _postinsert ( &$connection )
        {
                ;
        }
        
        
        function update ( &$connection )
        {
                $this->_preupdate($connection);
                $status = $this->_update($connection);
                $this->_postupdate($connection);
                
                return $status;
        }
        
        
        function _preupdate ( &$connection )
        {
                ;
        }
        
        
        function _update ( &$connection )
        {
		$fields = array();
                foreach ( $this->FIELD_LIST() as $field )
                {
                        $fields[$field] = $this->{$field};
                }
                $sql = $this->buildUpdateSQL( $fields, $connection );
                //print $sql;
                $rowset =& $connection->update($sql);
                if ( @@is_a($rowset, 'DBError') ||
                        @@is_subclass_of($rowset, 'DBError') )
		{
                        die("From " . get_class($this) .
                                "->_update() --> Unable to execute SQL statement: " .
                                $sql . ".\nReason: " . $rowset->toString());
		}
                
                return is_object($rowset);
        }
        
        
        function _postupdate ( &$connection )
        {
                ;
        }
        
        
        /* */
        function &delete ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this,'_delete'.$numArgs),
                        $args );
        }
        
        
        function _delete0 ()
        {
		$sql = sprintf("DELETE FROM %s WHERE %s = %s",
                        $this->TABLE(), $this->PRIMARY_KEY(), $this->getId());
                
                $dbconn =& $this->getConnection();
                $res = $dbconn->delete($sql);
                
                return $res;
	}
        
        
        function _delete1 ( &$connection )
	{
		if ( (!is_object($connection)) || (!isset($connection)) )
		{
			die("No connection object passed to ". get_class($this) . "->delete()");	
		}
                
                $this->setConnection($connection);
                return $this->delete();
        }
        /* */
        
        
        function getNextAvailableId ( &$connection )
        {
                $sql = "SELECT MAX(id) FROM " . $this->TABLE();
                $rowset =& $connection->select($sql);
                 
                if ( $rowset->getRowCount() == 0 )
                {
                        return 0;
                }
 
                $rowset->first();
                $row =& $rowset->getRowArray();
                return $row[0] + 1;
        }
        
        
        function lockTableRead ()
        {
                $sql = sprintf('LOCK TABLES %s READ',
                        $this->TABLE()
                        );
                $connection =& $this->getConnection();
                $connection->execute($sql);
        }
        
        
        function lockTableWrite ()
        {
                $sql = sprintf('LOCK TABLES %s WRITE',
                        $this->TABLE()
                        );
                $connection =& $this->getConnection();
                $connection->execute($sql);
        }
        
        
        function unlockTable ()
        {
                $sql = 'UNLOCK TABLES';
                $connection =& $this->getConnection();
                $connection->execute($sql);
        }
}

?>
