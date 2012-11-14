<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('IO/OutputStream.class.php');

class BufferedOutputStream extends OutputStream
{
        /**
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/**
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/**
         *
	 * Instance Variables
         *
	 */
        
        
        var $buffer = '';
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function BufferedOutputStream ()
        {
                ;
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /**
         *
	 * Command Methods
         *
	 */
        
        
        function write ( $str )
        {
                $this->buffer .= $str;
        }
        
        
        function writeln ( $str )
        {
                $this->write($str."\n");
        }
        
        
        function flush ()
        {
                print $this->buffer;
                $this->reset();
        }
        
        
        function reset ()
        {
                $this->buffer = '';
        }
}

?>
