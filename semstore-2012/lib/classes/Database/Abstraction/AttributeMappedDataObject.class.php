<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package Database.Abstraction
 */

require_once('Database/Abstraction/DataObject.class.php');

class AttributeMappedDataObject extends DataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function ATTRIBUTE2FIELD_MAP () { return array(); }
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
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
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AttributeMappedDataObject ()
	{
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_AttributeMappedDataObject'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _AttributeMappedDataObject0 ()
        {
                die("Class '" . get_class($this) . "' is abstract and cannot be" .
                        " instantiated.");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new AttributeMappedDataObject();
                
                return $obj;
        }
        
        
        function &createDataObject ( $row, &$connection )
        {
                $dataObject =& $this->_instantiateDataObject();
                $attributes =& $this->fieldData2AttributeData($row, $connection);
                $dataObject->_setAttributes($attributes);
                
                return $dataObject;
        }
        
        
        function &fieldData2AttributeData ( $row, &$connection )
        {
                $attributes = array();
                
                foreach ( $row as $field => $value )
                {
                        $attribValue = $value;
                        $attribute = $this->getField2AttributeMapping($field);
                        
                        // If field needs to be converted before being stored
                        // in mapped attribute then convert it.
                        $field2AttrConv = $this->getField2AttributeConv($field);
                        if (isset($field2AttrConv))
                        {
                                $attribValue = call_user_func(
                                        array(&$this, $field2AttrConv),
                                        $value, $connection);
                        }
                        
                        $attributes[$attribute] = $attribValue;
                }
                
                return $attributes;
        }
        
        
        function getField2AttributeMapping ( $field )
	{
		$attribute = "";
		foreach ($this->ATTRIBUTE2FIELD_MAP() as $mappedAttribute => $mappedField)
		{
			if ($field == $mappedField)
			{
				$attribute = $mappedAttribute;
				break;	
			}
		}
                
		return $attribute;
	}
        
        
        function getAttribute2FieldMapping ( $attribute )
	{
		$tempAttributeMap = $this->ATTRIBUE2FIELD_MAP();
		return $tempAttributeMap[$attribute];
	}
	
        
        function getAttribute2FieldConvMap ()
        {
                return $this->ATTRIBUTE2FIELD_CONV();
        }
        
        
        function getAttribute2FieldConv ( $attribute )
        {
                $tempAttrConvMap = $this->getAttribute2FieldConvMap();
                return $tempAttrConvMap[$attribute];
        }
        
        
        function getField2AttributeConvMap ()
        {
                return $this->FIELD2ATTRIBUTE_CONV();
        }
        
        
        function getField2AttributeConv ( $field )
        {
                $tempFieldConvMap = $this->getField2AttributeConvMap();
                return $tempFieldConvMap[$field];
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function _store0 ()
        {
		$status = 0;
		
		// If entry in database with same Primary Key then update else insert new.
                
		if ($this->existsInDB($this->getConnection(),
						$this->TABLE(),
						$this->PRIMARY_KEY(),
						$this->{$this->getField2AttributeMapping($this->PRIMARY_KEY())}))
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
        
        
        function _insert ( &$connection )
        {
                $fieldData = $this->attributeData2FieldData($connection);
                $sql = $this->buildInsertSQL($fieldData, $connection);
                
                //print $sql;
                
                $recordset =& $connection->insert($sql);
                
                return is_object($recordset);
        }
        
        
        function _update ( &$connection )
        {
                $fieldData = $this->attributeData2FieldData($connection);
                $sql = $this->buildUpdateSQL($fieldData, $connection);
                
                //print $sql;
                
                $recordset =& $connection->update($sql);
                
                return is_object($recordset);
        }
        
        
        function &attributeData2FieldData ( &$connection )
        {
                $fields = array();
                
                foreach ( $this->FIELD_LIST() as $field )
                {
                        /*
                        $value = $this->{$field};
                        $fieldValue = $value;
                        $attribute = $this->getField2AttributeMapping($field);
                        */
                        $attribute = $this->getField2AttributeMapping($field);
                        $value = $this->{$attribute};
                        $fieldValue = $value;
                        
                        // If attribute needs to be converted before being stored
                        // in mapped db field then convert it.
                        $attr2FieldConv = $this->getAttribute2FieldConv($attribute);
                        if (isset($attr2FieldConv))
                        {
                                $fieldValue = call_user_func(
                                        array(&$this, $attr2FieldConv),
                                        $value, $connection);
                        }
                        
                        $fields[$field] = $fieldValue;
                }
                
                return $fields;
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
                        	$this->{$this->getField2AttributeMapping(
                                        $this->PRIMARY_KEY())} . "'"; 
                }
		else 
		{
			print_r ( 'No Primary Key' );
			die();
		}
                return $sql;
        }
}

?>
