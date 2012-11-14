<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('IO/BufferedDebugStream.class.php');
require_once('IO/DebugLevel.class.php');

class HTMLDebugStream extends BufferedDebugStream
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
        
        
        function HTMLDebugStream ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'HTMLDebugStream'.$numArgs),  $args);
        }
        
        
        function HTMLDebugStream0 ()
        {
                $this->debugLevel = DebugLevel::OFF();
        }
        
        
        function HTMLDebugStream1 ( $debugLevel )
        {
                $this->debugLevel = $debugLevel;
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
        
        
        function flush ()
        {
                if ( $this->debugLevel == DebugLevel::OFF() )
                {
                        return;
                }
                
                print "\n".'<!-- Debugging Output :: Start'."\n\n";
                print $this->buffer;
                $this->reset();
                print "\n".'Debugging Output :: End -->'."\n";
        }
}

?>
