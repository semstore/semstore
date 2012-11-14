<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-11-02
 * @package SEM.ePublisher.eDiary.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class GalleryImageDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function TABLE () { return 'images'; }
		function PRIMARY_KEY () { return 'id'; }
		function FIELD_LIST () { return array(
                'id',
                'name',
                'description',
                'approved',
				'alt',
				'filename',
				'thumbnail',
				'albumid'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
                'approved' => 'approved',
				'alt' => 'alt',
				'filename' => 'filename',
				'thumbnail' => 'thumbnail',
				'albumid' => 'albumid'
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
		var $albumid = '';
        var $name = '';
        var $description = '';
        var $approved = '';
		var $alt = '';
		var $filename = '';
		var $thumbnail = '';
        
        
        /*
         *
	 * Constructors
         *
	 */
        
        
        function GalleryImageDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_GalleryImageDataObject'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _GalleryImageDataObject0 ()
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
        
        function getAlbumid ()
        {
                return $this->albumid;
        }
        
        
        function setAlbumid ( $albumid )
        {
                $this->albumid = ($albumid);
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
              
        function getApproved ()
        {
                return $this->approved;
        }
        
        
        function setApproved ( $approved )
        {
                $this->approved = $approved;
        }
        
		function getAlt ()
        {
                return $this->alt;
        }
        
        
        function setAlt ( $alt )
        {
                $this->alt = $alt;
        }		
		
		function getFilename ()
        {
                return $this->filename;
        }
        
        
        function setFilename ( $filename )
        {
                $this->filename = $filename;
        }
        
		function getThumbnail ()
        {
                return $this->thumbnail;
        }
        
        
        function setThumbnail ( $thumbnail )
        {
                $this->thumbnail = $thumbnail;
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
                $obj =& new GalleryImageDataObject();
                
                return $obj;
        }
        
        
        function _preinsert ( &$connection )
        {
                $this->id = $this->getNextAvailableId($connection);
        }
}

?>
