<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-22
 * @package Utils
 */

class SEMObjectArrayIterator extends SEMObject
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
        
        
        var $arr = NULL;
        var $keys = NULL;
        var $index = NULL;
        
        
	/*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Constructors
         *
	 */
        
        
        function ObjectArrayIterator ( &$array )
        {
                $this->_initialise();
                $this->_setArray($array);
                $this->_setKeys(array_keys($array));
                $this->_setIndex(0);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &_getArray ()
        {
                return $this->arr;
        }
        
        
        function _setArray ( &$array )
        {
                $this->arr =& $array;
        }
        
        
        function &_getKeys ()
        {
                return $this->keys;
        }
        
        
        function _setKeys ( &$keys )
        {
                $this->keys = $keys;
        }
        
        
        function _getIndex ()
        {
                return $this->index;
        }
        
        
        function _setIndex ( $index )
        {
                $this->index = $index;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function hasNext ()
        {
                if ( $this->index <= count($this->keys)-1 )
                {
                        return TRUE;
                }
                
                
                return FALSE;
        }
        
        
        function next ()
        {
                if ( !$this->hasNext() )
                {
                        die('no more objects in array');
                }
                        
                $obj =& $this->arr[$this->keys[$this->index]];
                $this->index++;
                
                return $obj;
        }
}

?>
