<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-11-02
 * @package SEM.ePublisher.eDiary.DataObjects
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

class eDiaryEntryDataObject extends AttributeMappedDataObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function TABLE () { return 'wp_comments'; }
		function PRIMARY_KEY () { return 'comment_ID'; }
		function FIELD_LIST () { return array(
                'comment_ID',
                'comment_author',
                'comment_date',
                'comment_content',
				'comment_approved'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'comment_ID' => 'comment_ID',
                'title' => 'comment_author',
                'timestamp' => 'comment_date',
                'entry' => 'comment_content',
				'approved' => 'comment_approved'
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
        
        
		var $comment_ID = NULL;
        var $title = '';
        var $entry = '';
        var $timestamp = '';
		var $approved = "";
        
        
        /*
         *
	 * Constructors
         *
	 */
        
        
        function eDiaryEntryDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(
                                &$this,
                                '_eDiaryEntryDataObject'.$numArgs
                                ),
                        $args
                        );
        }
        
        
        function _eDiaryEntryDataObject0 ()
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
                return $this->comment_ID;
        }
        
        
        function setId ( $comment_ID )
        {
                $this->comment_ID = $comment_ID;
        }
        
        function getcomment_ID ()
        {
                return $this->comment_ID;
        }
        
        
        function setcomment_ID ( $comment_ID )
        {
                $this->comment_ID = $comment_ID;
        }		
		
        function getTitle ()
        {
                return $this->title;
        }
        
        
        function setTitle ( $title )
        {
               $this->title = $title;
        }
        
        
        function getEntry ()
        {
                return $this->entry;
        }
        
        
        function setEntry ( $entry )
        {
                $this->entry = $entry;
        }
              
        function getTimestamp ()
        {
                return $this->timestamp;
        }
        
        
        function setTimestamp ( $timestamp )
        {
                $this->timestamp = $timestamp;
        }
        
		function getApproved ()
        {
                return $this->approved;
        }
        
        
        function setApproved ( $approved )
        {
                $this->approved = $approved;
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
                $obj =& new eDiaryEntryDataObject();
                
                return $obj;
        }
        
        
        function getFormattedDate ( $format )
        {
                return gmdate($format, strtotime($this->getTimestamp()));
        }
}

?>
