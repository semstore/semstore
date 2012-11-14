<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-08-23
 */

require_once('SEMObject.class.php');
require_once('IO/DebugLevel.class.php');

class DebugStream extends SEMObject
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
        
        
        var $debugLevel = 0;
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function DebugStream ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'DebugStream'.$numArgs),  $args);
                
        }
        
        
        function DebugStream0 ()
        {                
                $this->debugLevel = DebugLevel::OFF();
        }
        
        
        function DebugStream1 ( $debugLevel )
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
        
        
        function debugMsg ( $level, $msg )
        {
                if ( $this->debugLevel == DebugLevel::OFF() )
                {
                        return;
                }
                
                if ( $level >= $this->debugLevel )
                {
                        print $msg."\n";;
                }
        }
        
        
        function flush ()
        {
                ;
        }
        
        
        function reset ()
        {
                ;
        }
}

?>
