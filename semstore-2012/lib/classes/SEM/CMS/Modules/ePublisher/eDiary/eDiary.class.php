<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.ePublisher.eDiary
 */

require_once('Storage/Storable.class.php');

class eDiary extends Storable
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
        var $name = '';
        var $description = '';
        var $timestamp = '';
        var $storageDriver = NULL;
        var $entries = NULL;
        var $attributeChangesCommitted = TRUE;
        var $entryChangesCommitted = TRUE;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eDiary ()
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
        
        
        
        function &getStorageDriver ()
        {
                return $this->storageDriver;
        }
        
        
        function setStorageDriver ( &$storageDriver )
        {
                $this->storageDriver = $storageDriver;
        }
        
        
        function getEntryChanges ()
        {
                return $this->entryChangesCommitted;
        }
        
        
        function setEntryChanges ( $changes )
        {
                $this->entryChangesCommitted = $changes;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        /*
        function getEntry ( $criteria, $storageDriver )
        {
                ;
        }
        
        
        function getEntries ( $criteria, $storageDriver )
        {
                ;
        }
        
        
        function getAllEntries ( $storageDriver )
        {
                ;
        }
        
        
        function getFirst ( $storageDriver )
        {
                ;
        }
        
        
        function getLast ( $storageDriver )
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
                        array( &$this, '_store'.$numArgs ),
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
        
        
        
        
        
        function getEntry ( $criteria )
        {
                ;
        }
        
        
        function getEntries ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(
                                &$this,
                                '_getEntries'.$numArgs
                                ),
                        $args
                );
        }
        
        
        function _getEntries0 ()
        {
                if ( is_null($this->entries) || !is_array($this->entries) )
                {
                        $storageDriver =& $this->storageDriver;
                        $entries =& $storageDriver->getEntries($this);
                        if ( @is_a($entries, 'DBError') ||
                                @is_subclass_of($entries, 'DBError') )
                        {
                                return $entries;
                        }
                        
                        $this->entries =& $entries;
                }
                 
                return $this->entries;
        }
        
        
        function _getEntries1 ( $criteria )
        {
                ;
        }
        
        
        function getFirstEntry ()
        {
                $storageDriver =& $this->storageDriver;
                
                return $storageDriver->getFirstEntry($this);
        }
        
        
        function getLastEntry ()
        {
                $storageDriver =& $this->storageDriver;
                
                return $storageDriver->getLastEntry($this);
        }
        
        
        function getNumberOfEntries ()
        {
                $this->getEntries();
                
                return (count($this->entries));
        }
        
        
        function addEntry ( $entry )
        {
                $this->getEntries();
                $this->entries[] =& $entry;
                $this->setEntriesChanges(TRUE);
        }
        
        
        function addEntries ( $entries )
        {
                foreach ( $entries as $entry )
                {
                        $this->addEntry($entry);
                }
                $this->setEntriesChanges(TRUE);
        }
        
        
        function addEntryAfter ( &$entry, $position )
        {
                $this->getEntries();
                if ( $position >= $this->getNumberOfEntries() )
                {
                        $this->addEntry($entry);
                }
                
                
                
                
                $this->setEntriesChanges(TRUE);
        }
        
        
        function _updateDiaryIntegrity ()
        {
                $this->_updateParentChildIntegrity();
                //$this->_updateDiaryEntrySequenceIntegrity();
        }
        
        
        function _updateParentChildIntegrity ()
        {
                $this->getEntries();
                foreach ( array_keys($this->entries) as $id )
                {
                        $entry =& $this->entries[$key];
                        $entry->setDiaryId($this->getId());
                }
                
                $this->setEntriesChanges(TRUE);
        }
        
        
        function _updateDiaryEntrySequenceIntegrity ()
        {
                $this->getEntries();
                foreach ( array_keys($this->entries) as $id )
                {
                        $entry =& $this->entries[$key];
                        $entry->setSequenceNumber($id);
                }
                
                $this->setEntriesChanges(TRUE);
        }
}

?>
