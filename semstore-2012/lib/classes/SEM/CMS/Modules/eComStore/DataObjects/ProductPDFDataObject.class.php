<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.Modules.eComStore.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class ProductPDFDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_pdf'; }
        function PRIMARY_KEY () { return 'id'; }
        
        function FIELD_LIST () { return array(
                'id',
				'file'
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
				'pdf' => 'file'
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
        /*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
		var $id = NULL;
		var $pdf = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function ProductPDFDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductPDFDataObject'.$numArgs),
                        $args);
        }
        
        
        function _ProductPDFDataObject0 ()
        {
                $this->_initialize();
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = $id;
        }
        
		function getPDF ( )
		{
				return $this->pdf;
		}
		
		function setPDF ( $pdf )
		{
				$this->pdf = $pdf;
		}
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new ProductPDFDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setId($connection->getLastInsertId());
        }
}

?>
