<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.ePublisher.eDiary
 */

require_once('Storage/Storable.class.php');

class eDiaryEntry extends Storable
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
        
        
        var $id = NULL;
        var $title = '';
        var $entryText = '';
        var $timestamp = '';
        var $storageDriver = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eDiaryEntry ()
        {
                ;
        }
        
        
        /*
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
        
        
        function getTitle ()
        {
                return $this->title;
        }
        
        
        function setTitle ( $title )
        {
                $this->title = $title;
        }
        
        
        function getEntryText ()
        {
                return $this->entryText;
        }
        
        
        function setEntryText ( $entryText )
        {
                $this->entryText = $entryText;
        }
        
        
        function getTimestamp ()
        {
                return $this->timestamp;
        }
        
        
        function setTimestamp ( $timestamp )
        {
                $this->timestamp = $timestamp;
        }
        
        
        function getDiaryId ()
        {
                return $this->diaryId;
        }
        
        
        function setDiaryId ( $diaryId )
        {
                $this->diaryId = $diaryId;
        }
        
        
        
        function &getStorageDriver ()
        {
                return $this->storageDriver;
        }
        
        
        function setStorageDriver ( &$storageDriver )
        {
                $this->storageDriver = $storageDriver;
        }
        
        
        function &getEntries ()
        {
                ;
        }
        
        
        function setEntries ( &$entries )
        {
                ;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        /*
        function getNextEntry ( $storageDriver )
        {
                ;
        }
        */
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function store ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(
                                &$this,
                                '_store'.$numArgs
                                ),
                        $args
                );
        }
        
        
        function _store0 ()
        {
                $this->store($this->getStorageDriver());
        }
        
        
        function _store ( &$storageDriver )
        {
                return $storageDriver->store($this);
        }
        
        
        function &retrieve ()
        {
                return NULL;
        }
        
        
        function remove ()
        {
                return $storageDriver->store($this);
        }
        
        
        
        
        function getNextEntry ()
        {
                ;
        }
        
        
        function getFormattedDate ( $format )
        {
                return gmdate($format, $this->getTimestamp());
        }
}

?>
