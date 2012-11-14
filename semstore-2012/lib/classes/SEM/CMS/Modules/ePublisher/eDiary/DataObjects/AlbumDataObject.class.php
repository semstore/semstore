<?php

/**
 * @author Chris Wooldridge
 * @version 1.0
 * @date 2005-11-02
 * @package SEM.ePublisher.eDiary.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class AlbumDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function TABLE () { return 'albums'; }
		function PRIMARY_KEY () { return 'id'; }
		function FIELD_LIST () { return array(
                'id',
                'name',
                'description',
                'masterimage'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
				'masterimage' => 'masterimage'
                ); }
                
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
        
        
		var $id = NULL;
        var $name = '';
        var $description = '';
		var $masterimage = '';        
        
        /*
         *
	 * Constructors
         *
	 */
        
        
        function AlbumDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_AlbumDataObject'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _AlbumDataObject0 ()
        {
                ;
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getId ()
        {
                return $this->id;
        }
        
        
        function setId ( $id )
        {
                $this->id = ($id);
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function setName ( $name )
        {
               $this->name = $name;
        }
        
        
        function getDescription ()
        {
                return $this->description;
        }
        
        
        function setDescription ( $description )
        {
                $this->description = $description;
        }
              
        function getMasterimage ()
        {
                return $this->masterimage;
        }
        
        
        function setMasterimage ( $masterimage )
        {
                $this->masterimage = $masterimage;
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
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new AlbumDataObject();
                
                return $obj;
        }
        
        
        function _preinsert ( &$connection )
        {
                $this->id = $this->getNextAvailableId($connection);
        }
}

?>
