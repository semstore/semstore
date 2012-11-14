<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.ePublisher.eDiary
 */

require_once('SEMObject.class.php');

class eDiaryManager extends SEMObject
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
        
        
        var $storageDriver = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eDiaryManager ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_eDiaryManager'.$numArgs ),
                        $args);
        }
        
        
        function _eDiaryManager0 ()
        {
                ;
        }
        
        
        function _eDiaryManager1 ( &$storageDriver )
        {
                $this->setStorageDriver($storageDriver);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getStorageDriver ()
        {
                return $this->storageDriver;
        }
        
        
        function setStorageDriver ( &$storageDriver )
        {
                $this->storageDriver =& $storageDriver;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &factory ( $storageDriver )
        {
                $manager =& new eDiaryManager( $storageDriver );
                
                return $manager;
        }
        
        
        function &_retrieveDiary2 ( $criteria, $storageDriver )
        {
                return $storageDriver->retrieveDiary($criteria);
        }
        
        
        function &_retrieveDiaries2 ( $criteria, $storageDriver )
        {
                return $storageDriver->retrieveDiaries($criteria);
        }
        
        
        function &_retrieveDiaryEntry2 ( $criteria, $storageDriver )
        {
                return $storageDriver->retrieveDiaryEntry($criteria);
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &createDiary ()
        {
                $eDiary =& new eDiary();
                $eDiary->setStorageDriver($this->getStorageDriver());
                
                return $eDiary;
        }
        
        
        /*
        function &createDiary ( $name )
        {
                ;
        }
        */
        
        function &removeDiary ( &$diary )
        {
                ;
        }
        
        
        function &findDiary ( $id )
        {
                ;
        }
        
        
        function &retrieveDiary ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_retrieveDiary'.$numArgs),
                        $args
                        );
        }
        
        
        function &_retrieveDiary1 ( $criteria )
        {
                return $this->retrieveDiary($criteria,
                        $this->getStorageDriver());
        }
        
        
        function &retrieveDiaries ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_retrieveDiaries'.$numArgs),
                        $args
                        );
        }
        
        
        function &_retrieveDiaries1 ( $criteria )
        {
                return $this->retrieveDiaries($criteria,
                        $this->getStorageDriver());
        }
        
        
        function &retrieveDiaryEntry ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array(&$this, '_retrieveDiaryEntry'.$numArgs),
                        $args
                        );
        }
        
        
        function &_retrieveDiaryEntry1 ( $criteria )
        {
                return $this->retrieveDiaryEntry($criteria,
                        $this->getStorageDriver());
        } 
}

?>
