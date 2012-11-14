<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-09-08
 */

require_once('HTTP/PRG_MVC/PRGModel.class.php');

class PRGSessionModel extends PRGModel
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
        
        
        var $vars = array();
        
        
	/**
         *
	 * Constructors
         *
	 */
        
        
        function PRGSessionModel ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'PRGSessionModel'.$numArgs),  $args);
        }
        
        
        function PRGSessionModel0 ()
        {
                $this->_initialize();
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
        
        
        function _initialize ()
        {
                $this->setObjectCreationTime(time());
        }
        
        
        function getVar ( $varname )
        {
                return $this->vars[$varname];
        }
        
        
        function setVar ( $varname, $var )
        {
                $this->vars[$varname] = $var;
        }
        
        
        function &getVarByRef ( $varname )
        {
                return $this->vars[$varname];
        }
        
        
        function setVarbyRef ( $varname, &$var )
        {
                $this->vars[$varname] =& $var;
        }
        
        
        function destroyVar ( $varname )
        {
                unset($this->vars[$varname]);
        }
        
        
        function asArray ()
        {
                return $this->vars;
        }
}

?>
