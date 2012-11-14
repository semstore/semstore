<?php

/**
 * @author Generated by Data Object Generator
 * @version 1.0
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class product_gallery_imageDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
	function TABLE () { return 'product_gallery_image'; }
	function PRIMARY_KEY () { return 'id'; }
	
        function FIELD_LIST () { return array(
                 'id',
                 'idx',
                 'thumbnail',
                 'image',
                 'gallery_id',
                ); }
                
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'idx' => 'idx',
                'thumbnail' => 'thumbnail',
                'image' => 'image',
                'gallery_id' => 'gallery_id',
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
        /*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
	var $id = '';
	var $idx = '';
	var $thumbnail = '';
	var $image = '';
	var $gallery_id = '';

        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
	 
	 
        function product_gallery_imageDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, '_product_gallery_imageDataObject'.$numArgs),
                        $args);
        }
        
        
        function _product_gallery_imageDataObject0 ()
        {
                $this->_initialize();
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
	 
	 
	function setid( $tempid )
	{	
		$this->id = $tempid;
	}
	
	function getid()
	{	
		return $this->id;
	}
	
	function setidx( $tempidx )
	{	
		$this->idx = $tempidx;
	}
	
	function getidx()
	{	
		return $this->idx;
	}
	
	function setthumbnail( $tempthumbnail )
	{	
		$this->thumbnail = $tempthumbnail;
	}
	
	function getthumbnail()
	{	
		return $this->thumbnail;
	}
	
	function setimage( $tempimage )
	{	
		$this->image = $tempimage;
	}
	
	function getimage()
	{	
		return $this->image;
	}
	
	function setgallery_id( $tempgallery_id )
	{	
		$this->gallery_id = $tempgallery_id;
	}
	
	function getgallery_id()
	{	
		return $this->gallery_id;
	}
	

        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new product_gallery_imageDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->setid($connection->getLastInsertId());
        }
        
}

?>