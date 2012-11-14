<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-07
 */

class WebApp extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
        var $PAGES = array();
        var $ACTIONS = array();
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $dbConnection = NULL;
        //var $debugMsgs = array();
        //var $session =& $_SESSION;
        
        /*
	 * Class Methods
	 */
        
        
        function getPages ()
        {
                return $this->PAGES;
        }
        
        
        function getActions ()
        {
                return $this->ACTIONS;
        }
        
        
        function isValidPage ( $page )
        {
                $valid = false;
                foreach ( $this->getPages() as $pg )
                {
                        if ( $page == $pg )
                        {
                                $valid = true;
                                break;
                        }
                }
        
                return $valid;
        }
        
        
        function isValidAction ( $action )
        {
                $valid = false;
                foreach ( $this->getActions() as $act )
                {
                        if ( $action == $act )
                        {
                                $valid = true;
                                break;
                        }
                }
        
                return $valid;
        }
        
        
        /*
	 * Constructors
	 */
        
        
        function WebApp ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'WebApp'.$numArgs),  $args);
        }
        
        
        function WebApp0 ()
        {
                $this->initialise();
        }
        
        
        function initialise ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
	
        
	function getConnection ()
        {
                return $this->dbConnection;
        }
        
        
        function setConnection ( $dbConnection )
        {
                $this->dbConnection = $dbConnection;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function debugMsg ( $level, $message )
        {
                if ( $level >= $this->getDebugLevel() )
                {
                        $this->_addDebugMsg($level, $message);
                }
        }
        
        
        function _addDebugMsg ( $level, $message )
        {
                //$msgs = $this->debugMsgs;
                //array_push($msgs, $message);
                //$this->debugMsgs = $msgs;
                debugMsg( $level, $message ); 
        }
        
        
        function run ()
        {
                $this->init();
                $this->debugMsg($this->DEBUG, "\n--- HTTP Request Parameters :: Start ---\n\n" .
                        print_r($_REQUEST, TRUE) .
                        "\n--- HTTP Request Parameters :: End ---\n\n");
                $this->debugMsg($this->DEBUG, "\n--- Session Parameters :: Start ---\n\n" .
                        print_r($_SESSION, TRUE) .
                        "\n--- Session Parameters :: End ---\n\n");
                
                //if ( isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == "POST") )
                //{
                        if ( isset($_REQUEST['action']) && $_REQUEST['action'] != '' )
                        {
                                $this->debugMsg($this->DEBUG, "Calling action '"
                                        . $_REQUEST['action'] . "'");
                                $this->callAction($_REQUEST['action']);
                        }
                        else
                        {
                                $this->debugMsg($this->DEBUG, "Calling default" . 
                                        " action 'start'");
                                $this->callAction('act_start');
                        }
                //}
                //else
                //{
                //        $this->callAction('act_start');
                //}
                
                $this->debugMsg($this->DEBUG, "\n--- HTTP Response Headers :: Start ---\n\n" .
                        print_r(apache_response_headers(), TRUE) .
                        "\n--- HTTP Response Headers :: End ---\n\n");
                
                $GLOBALS['outputStream']->flush();
                $this->_dumpDebug();
        }
        
        
        function init ()
        {
                ;
        }
        
        
        function render ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array( array( &$this, 'render'.$numArgs),  $args);
        }
        
        
        function render1 ( $page )
        {
                $this->render( $page, array() );
        }
        
        
        function render2 ( $page, &$errors )
        {
                if ( $this->isValidPage( $page ) )
                {
                        call_user_func( array( &$this, 'page_'.$page), &$errors );
                }
        }
        
        
        function callAction ( $action )
        {
                if ( $this->isValidAction( $action ) )
                {
                        call_user_func( array( &$this, 'act_'.$action) );
                }
                else
                {
                        $this->debugMsg($this->DEBUG, "Can't find action '"
                                . $_REQUEST['action']."' - calling default"
                                . " 'start' action instead");
                        call_user_func( array( &$this, 'act_start') );
                }
        }
        
        
        function _dumpDebug ()
        {
                /*
                $msgs = $this->debugMsgs;
                print "\n\n<!--\n\n";
                print "\t\t DEBUG SECTION \t\t";
                print "\n\n";
                foreach ( $msgs as $msg )
                {
                        print $msg;
                }
                print "\n\n-->\n\n";
                */
                
                $GLOBALS['debugStream']->flush();
        }
        
        
        function sessionStore ( $name, $value )
        {
                //$this->session[$name] =& $value;
                $_SESSION[$name] = $value;
        }
        
        
        function sessionStoreRef ( $name, &$value )
        {
                $_SESSION[$name] =& $value;
        }
        
        
        function sessionRetrieve ( $name )
        {
                //return $this->session[$name];
                return $_SESSION[$name];
        }
        
        
        function &sessionRetrieveRef ( $name )
        {
                return $_SESSION[$name];
        }
        
        
        function sessionRemove ( $name )
        {
                return session_unregister($name);
        }
        
        
        function genericFormError ()
        {
                print "Generic Form Error";
                return;
        }
        
        
        function genericFormExpirationError ()
        {
                print "Generic Form Expiration Error";
                return;
        }
        
        
}

?>
