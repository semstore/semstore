<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-09-07
 */

require_once('SEMObject.class.php');

class DBConfiguration extends SEMObject
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
        
        
        var $dbConnection = NULL;
        var $parameterCache = array();
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function DBConfiguration ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this,
                                '_DBConfiguration'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _DBConfiguration0 ()
        {
                $this->_initialize();
        }
        
        
        function _DBConfiguration1 ( &$dbConnection )
        {
                $this->_initialize();
                $this->setDBConnection($dbConnection);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getDBConnection ()
        {
                return $this->dbConnection;
        }
        
        
        function setDBConnection ( &$dbConnection )
        {
                $this->dbConnection =& $dbConnection;
        }
        
        
        function &_getParameterCache ()
        {
                return $this->parameterCache;
        }
        
        
        function _setParameterCache ( $parameterCache )
        {
                $this->parameterCache = $parameterCache;
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
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function _cacheParameter ( $parameter, $value )
        {
                $this->parameterCache[$parameter] = $value;
        }
        
        
        function _checkCacheForParameter ( $parameter )
        {
                if ( array_key_exists($parameter,
                        $this->parameterCache)
                        )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function _getCachedParameter ( $parameter )
        {
                return $this->parameterCache[$parameter];
        }
        
        
        function getParameter ( $param )
        {
                if ( $this->_checkCacheForParameter($param) )
                {
                        return $this->_getCachedParameter($param);
                }
                
                $sql = sprintf(
                        'SELECT parameter_name, parameter_value ' .
                        'FROM configuration ' .
                        "WHERE parameter_name = '%s'",
                        $param
                        );
                
                $dbConn =& $this->getDBConnection();
                $rowset =& $dbConn->execute($sql);
                if ( @@is_a($rowset, 'DBError') || 
                        @@is_subclass_of($rowset, 'DBError') )
                {
                        return $rowset;
                }
                
                if ( !is_object($rowset) || !$rowset->next() )
                {
                        //print "blah";
                        return NULL;
                }
                
                $row =& $rowset->getRowHash();
                //print_r($row);
                $paramValue = $row['parameter_value'];
                
                $paramValue = $this->_makeSubstitutions($paramValue);
                
                $this->_cacheParameter($param, $paramValue);
                
                return $paramValue;
        }
        
        
        function _makeSubstitutions ( $paramValue )
        {
                $tempParamValue = $paramValue;
                
                $matches = array();
                preg_match_all('{\{([^\}]+)\}}', $tempParamValue, $matches);
                $subparams = array_unique($matches[1]);
                foreach ( $subparams as $subparam )
                {
                        $subparamValue = $this->getParameter(
                                $subparam);
                        $tempParamValue = str_replace('${'.$subparam.'}',
                                $subparamValue,
                                $tempParamValue);
                }
                
                return $tempParamValue;
        }
        
        
        function setParameter ( $param, $value )
        {
                $currentParamVal = $this->getParameter($param);
                if ( !is_null($currentParamVal) )
                {
                        // Update
                        $sql = sprintf(
                                'UPDATE configuration ' .
                                "SET parameter_value = '%s' ".
                                "WHERE parameter_name = '%s'",
                                $value,
                                $param
                                );
                        
                        $dbConn =& $this->getDBConnection();
                        $rowset =& $dbConn->execute($sql);
                }
                else
                {
                        // Insert
                        $sql = sprintf(
                                'INSERT INTO configuration ' .
                                "(parameter_name, parameter_value) ".
                                "VALUE ('%s', '%s')",
                                $param,
                                $value
                                );
                        
                        $dbConn =& $this->getDBConnection();
                        $rowset =& $dbConn->execute($sql);
                }
        }
        
        
        function deleteParameter ( $param )
        {
                $currentValue =& $this->getParamter($param);
                if ( !is_null($currentValue) )
                {
                        $sql = sprintf(
                                'DELETE FROM configuration ' .
                                "WHERE parameter_name = '%s'",
                                $param
                                );
                        
                        $dbConn =& $this->getDBConnection();
                        $rowset =& $dbConn->execute($sql);
                }
                
                return $currentValue;
        }
}

?>
