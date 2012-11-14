<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-14
 * @package Sites.JusteCommerce
 */

//require_once('SEMObject.class.php');
require_once('IO/DebugLevel.class.php');
require_once('Session/Session.class.php');

class SessionUtils
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
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function SessionUtils ()
        {
                die("Class 'SessionUtils' is abstract and cannot be instantiated.");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
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
        
        
        function checkSession ()
        {
                Debug::debugMsg(DebugLevel::DEBUG(), "SID (Before session_start): " . SID);
                
                // Start Session
                //session_start();
                Debug::debugMsg(DebugLevel::DEBUG(), "SID (After session_start): " . SID);
                Debug::debugMsg(DebugLevel::DEBUG(), "session_id: " . session_id());
                Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));
        
                // Check to see if we have started a new session or just restarted and old
                // session
                if ( !is_null(Session::get('lastAccessed')) &&
                        Session::get('lastAccessed') != '' )
                {
                        Debug::debugMsg(DebugLevel::DEBUG(), 'Session found.');
                        
                        
                        if ( time() > Session::get('lastAccessed') + (60 * 30) )
                        {
                                // older than 30 mins - logout
                                Debug::debugMsg(DebugLevel::DEBUG(), 'Session: 30 mins < t');
                                //session_regenerate_id();
                                Session::put('loggedIn', FALSE);
                                Session::put('lastAccessed', time());
                        }
                        else
                        {
                                // Current session
                                Debug::debugMsg(DebugLevel::DEBUG(),
                                        'Session is current ( < 10mins old).');
                                //session_regenerate_id();
                                Session::put('lastAccessed', time());
                        }
                }
                else
                {
                        // Its a new session.  Lets set the session start time
                        Debug::debugMsg(DebugLevel::DEBUG(), 'No session found.  Initialising a new session.');
                        SessionUtils::initSession();
                }
        }
        
        
        function initSession ()
        {
                Session::put('starttime', time());
                Session::put('lastAccessed', time());
                Session::put('loggedIn', FALSE);
                Session::put('loginTime', NULL);
                //Session::put('userId', NULL);
                Session::put('customerId', NULL);
                Session::put('customername', '');
        }
        
        
        function setLoggedIn ( &$customer )
        {
                Session::put('customerId', $customer->getId());
                Session::put('customername', $customer->getFirstname());
                Session::put('loggedIn', TRUE);
                Session::put('loginTime', time());
                
                setcookie('customername', $customer->getFirstname(), time()+60*60*24*30, '/');
        }
        
        
        function isLoggedIn ()
        {
                return Session::get('loggedIn') == TRUE;
        }
        
        
        function setLoggedOut ()
        {
                Session::put('customerId', '');
                Session::put('customername', '');
                Session::put('loggedIn', FALSE);
                Session::put('loginTime', NULL);
                
                $_SESSION = array();
                if (isset($_COOKIE[session_name()]))
                {
                        setcookie(session_name(), '', time()-42000, '/');
                }
        }
}

?>
