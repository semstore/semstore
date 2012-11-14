<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('IO/DebugStream.class.php');
require_once('IO/DebugLevel.class.php');

class BufferedDebugStream extends DebugStream
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
        
        
        
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function BufferedDebugStream ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'BufferedDebugStream'.$numArgs),  $args);
                
        }
        
        
        function BufferedDebugStream0 ()
        {
                $this->debugLevel = DebugLevel::OFF();
        }
        
        
        function BufferedDebugStream1 ( $debugLevel )
        {
                $this->debugLevel = $debugLevel;
        }
        
        
        /**
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        var $debugLevel = 0;
        var $buffer = '';
        
        
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
        
        
        function debugMsg ( $level, $msg )
        {
                if ( $this->debugLevel == DebugLevel::OFF() )
                {
                        return;
                }
                
                if ( $level >= $this->debugLevel )
                {
                        $this->buffer .= $msg."\n";
                }
        }
        
        
        function flush ()
        {
                if ( $this->debugLevel == DebugLevel::OFF() )
                {
                        return;
                }
                
                print $this->buffer;
                $this->reset();
        }
        
        
        function reset ()
        {
                $this->buffer = '';
        }
}

?>
