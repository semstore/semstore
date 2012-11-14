<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-11-02
 * @package SEM.ePublisher.eDiary.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class eDiaryDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function TABLE () { return 'ediary'; }
	function PRIMARY_KEY () { return 'id'; }
	function FIELD_LIST () { return array(
                'id',
                'name',
                'description',
                'timestamp'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'id' => 'id',
                'name' => 'name',
                'description' => 'description',
                'timestamp' => 'timestamp'
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
        var $timestamp = '';
        
        
        /*
         *
	 * Constructors
         *
	 */
        
        
        function eDiaryDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_eDiaryDataObject'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _eDiaryDataObject0 ()
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
                $this->id = $id;
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
        
        
        function getTimestamp ()
        {
                return $this->timestamp;
        }
        
        
        function setTimestamp ( $timestamp )
        {
                $this->timestamp = $timestamp;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &lookupAllGalleries ( &$connection )
        {
                $GALLERY_CLASS =& new Gallery();
                $galleries =& $GALLERY_CLASS->lookupArray(
                        array(),
                        $connection);
                
                return $galleries;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new eDiaryDataObject();
                
                return $obj;
        }
        
        
        function _preinsert ( &$connection )
        {
                $this->id = $this->getNextAvailableId($connection);
        }
        
        
        function &lookupImage ( $imageId )
        {
                return NULL;
        }
        
        
        function &lookupImages ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                return call_user_func_array(
                        array(
                                &$this,
                                '_lookupImages'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function &_lookupImages0 ()
        {
        
                /*
                $dbConn =& $this->getConnection();
                $sql = 'SELECT id, order_in_set' .
                        ' FROM gallery_image' .
                        ' WHERE gallery_id = '. $this->getId() .
                        ' ORDER BY order_in_set';
                //print $sql;
                $rowset =&
                        $dbConn->execute($sql);
                
                $images = array();
                $IMAGE_CLASS =& new GalleryImage();
                while ( $rowset->next() )
                {
                        $row =& $rowset->getRowHash();
                        //print $row['id'];
                        $image =& $IMAGE_CLASS->lookup(
                                array( 'id' => $row['id'] ),
                                $this->getConnection()
                                );
                        array_push($images, $image);
                }
                
                return $images;
                */
                
                return $this->lookupImages(0, 0);
        }
        
        
        function &_lookupImages1 ( $limit )
        {
                return $this->lookupImages(0, $limit);
        }
        
        
        function &_lookupImages2 ( $start, $limit )
        {
                $dbConn =& $this->getConnection();
                $sql = 'SELECT id, order_in_set' .
                        ' FROM gallery_image' .
                        ' WHERE gallery_id = ' . $this->getId();
                if ( $start > 0 )
                {
                        $sql .= ' AND id >= ' . $start;
                }
                
                $sql .= ' ORDER BY order_in_set';
                if ( $limit > 0 )
                {
                        $sql .= ' LIMIT ' . $limit;
                }
                
                //print $sql;
                $rowset =&
                        $dbConn->execute($sql);
                
                $images = array();
                $IMAGE_CLASS =& new GalleryImage();
                while ( $rowset->next() )
                {
                        $row =& $rowset->getRowHash();
                        //print $row['id'];
                        $image =& $IMAGE_CLASS->lookup(
                                array( 'id' => $row['id'] ),
                                $this->getConnection()
                                );
                        array_push($images, $image);
                }
                
                return $images;
        }
        
        
        function getImageCount ()
        {
                $sql = "SELECT COUNT(*)" .
                        " FROM " . GalleryImage::TABLE();
                $dbConn =& $this->getConnection();
                $rowset =& $dbConn->execute($sql);
                $rowset->first();
                $row =& $rowset->getRowArray();
                
                return $row[0];
        }
        
        
        function &lookupFirstImage ()
        {
                $sql = "SELECT id".
                        " FROM " . GalleryImage::TABLE() .
                        " ORDER BY order_in_set";
                $dbConn =& $this->getConnection();
                $rowset =& $dbConn->execute($sql);
                $rowset->first();
                $row =& $rowset->getRowHash();
                
                $IMAGE_CLASS =& new GalleryImage();
                $image =& $IMAGE_CLASS->lookup(
                        array('id' => $row['id']),
                        $this->getConnection()
                        );
                
                return $image;
        }
        
        
        function &lookupLastImage ()
        {
                $sql = "SELECT id".
                        " FROM " . GalleryImage::TABLE() .
                        " ORDER BY order_in_set DESC";
                $dbConn =& $this->getConnection();
                $rowset =& $dbConn->execute($sql);
                $rowset->first();
                $row =& $rowset->getRowHash();
                
                $IMAGE_CLASS =& new GalleryImage();
                $image =& $IMAGE_CLASS->lookup(
                        array('id' => $row['id']),
                        $this->getConnection()
                        );
                
                return $image;
        }
        
        
        function &lookupPreviousImage ( $image )
        {
                if ( is_object($image) )
                {
                        return $this->_lookupPreviousImageFromObject($image);
                }
                else
                {
                        return $this->_lookupPreviousImageFromId($image);;
                }
        }
        
        
        function &_lookupPreviousImageFromObject ( &$image )
        {
                return $this->_lookupPreviousImageFromId($image->getId());
        }
        
        
        function &_lookupPreviousImageFromId ( $imageId )
        {
                $sql = "SELECT id".
                        " FROM " . GalleryImage::TABLE() .
                        " WHERE id < " . $imageId .
                        " ORDER BY order_in_set DESC";
                $dbConn =& $this->getConnection();
                $rowset =& $dbConn->execute($sql);
                $rowset->first();
                $row =& $rowset->getRowHash();
                
                $IMAGE_CLASS =& new GalleryImage();
                $image =& $IMAGE_CLASS->lookup(
                        array('id' => $row['id']),
                        $this->getConnection()
                        );
                
                return $image;
        }
        
        
        function &lookupNextImage ( $image )
        {
                if ( is_object($image) )
                {
                        return $this->_lookupNextImageFromObject($image);
                }
                else
                {
                        return $this->_lookupNextImageFromId($image);;
                }
        }
        
        
        function &_lookupNextImageFromObject ( &$image )
        {
                return $this->_lookupNextImageFromId($image->getId());
        }
        
        
        function &_lookupNextImageFromId ( $imageId )
        {
                $sql = "SELECT id".
                        " FROM " . GalleryImage::TABLE() .
                        " WHERE id > " . $imageId .
                        " ORDER BY order_in_set";
                $dbConn =& $this->getConnection();
                $rowset =& $dbConn->execute($sql);
                $rowset->first();
                $row =& $rowset->getRowHash();
                
                $IMAGE_CLASS =& new GalleryImage();
                $image =& $IMAGE_CLASS->lookup(
                        array('id' => $row['id']),
                        $this->getConnection()
                        );
                
                return $image;
        }
        
        
        function isFirstImage ( $image )
        {
                if ( is_object($image) )
                {
                        return $this->_isFirstImageFromObject($image);
                }
                else
                {
                        return $this->_isFirstImageFromId($image);;
                }
        }
        
        
        function _isFirstImageFromObject ( &$image )
        {
                return $this->_isFirstImageFromId($image->getId());
        }
        
        
        function _isFirstImageFromId ( $imageId )
        {
                $fImage = $this->lookupFirstImage();
                
                if ( $imageId == $fImage->getId() )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function isLastImage ( $image )
        {
                if ( is_object($image) )
                {
                        return $this->_isLastImageFromObject($image);
                }
                else
                {
                        return $this->_isLastImageFromId($image);;
                }
        }
        
        
        function _isLastImageFromObject ( &$image )
        {
                return $this->_isLastImageFromId($image->getId());
        }
        
        
        function _isLastImageFromId ( $imageId )
        {
                $lImage = $this->lookupLastImage();
                
                if ( $imageId == $lImage->getId() )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
}

?>
