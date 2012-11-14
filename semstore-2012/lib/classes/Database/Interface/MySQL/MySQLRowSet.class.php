<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-06-22
 * @package Database.Interface.MySQL
 */

require_once('Database/Interface/DBRowSet.class.php');

class MySQLRowSet extends DBRowSet
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
        
        
        var $resourceId = NULL;
        var $sql = '' ;
        var $index = -1;
        var $recordset = array();
        var $rowCount = -1;
        
        
	/*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function MySQLRowSet ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array( array( &$this, '_MySQLRowSet'.$numArgs),  $args);
        }
        
        
        function _MySQLRowSet0 ()
        {
                ;
        }
        
        function _MySQLRowSet1 ( $rsetResId )
        {
                $this->resourceId = $rsetResId;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getRowCount ()
	{
		if ( $this->rowCount < 0 )
                {
                        $this->rowCount = mysql_num_rows($this->resourceId);
                }
                
                return $this->rowCount;
	}
        
        /*
	 * Command Methods
	 */
        
        
        function rowCount ()
	{
		return $this->getRowCount();
	}
        
        function next ()
        {
                if ( $this->getRowCount() == 0 )
                {
                        return false;
                }
                elseif ( $this->index >= $this->rowCount - 1 )
                {
                        return false;
                }
                
                $this->index++;
                if ( !is_array($this->recordset[$this->index]) )
                {
                        $row = mysql_fetch_assoc($this->resourceId);
                        $this->recordset[$this->index] = $row;
                }
                
                return true;
        }
        
        function previous ()
        {
                if ( $this->getRowCount() == 0 )
                {
                        return false;
                }
                elseif ( $this->index <= 0 )
                {
                        return false;
                }
                
                $this->index--;
                if ( !is_array($this->recordset[$this->index]) )
                {
                        $row = mysql_fetch_assoc($this->resourceId);
                        $this->recordset[$this->index] = $row;
                }
                
                return true;
        }
        
        function first ()
        {
                if ( $this->getRowCount() == 0 )
                {
                        return false;
                }
                
                $this->index = 0;
                if ( !is_array($this->recordset[$this->index]) )
                {
                        $row = mysql_fetch_assoc($this->resourceId);
                        $this->recordset[$this->index] = $row;
                }
                
                return true;
        }
        
        function last ()
        {
                if ( $this->getRowCount() == 0 )
                {
                        return false;
                }
                
                $this->index = $this->getRowCount() - 1;
                if ( !is_array($this->recordset[$this->index]) )
                {
                        $row = mysql_fetch_assoc($this->resourceId);
                        $this->recordset[$this->index] = $row;
                }
                
                return true;
        }
        
        function &getRowArray ()
        {
                $row = array();
                foreach ( $this->recordset[$this->index] as $fname => $fvalue )
                {
                        array_push($row, $fvalue);
                }
                
                return $row;
        }
	
	function &getRowHash ()
	{
                $row = $this->recordset[$this->index];
		return $row;
	}
        
        function getSqlStatement ()
	{
		return $this->sql;	
	}
        
        
        function free ()
        {
                mysql_free_result($this->resourceId);
        }
        
        
}


