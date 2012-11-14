<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-24
 * @package SEM.MySEM
 */

require_once('SEMObject.class.php');
require_once('Session/Session.class.php');

require_once('SEM/MySEM/User.class.php');

class MySEMUtils extends SEMObject
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
        
        
        function MySEMUtils ()
        {
                die('Abstract class - cannot be instantiated');
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
                if ( Session::get('startTime') == NULL ||
                        Session::get('startTime') == '' )
                {
                        MySEMUtils::initialiseSession();
                }
                elseif ( Session::get('lastAccessTime') < time() - 10*24*60*60 )
                {
                        MySEMUtils::logout();
                        Session::reset();
                        MySEMUtils::initialiseSession();
                }
                elseif ( Session::get('lastAccessTime') < time() - 60*60 )
                {
                        MySEMUtils::logout();
                }
                
                Session::put('lastAccessTime', time());
                Session::gc();
        }
        
        
        function initialiseSession ()
        {
                Session::put('startTime', time());
                Session::put('lastAccessTime', time());
        }
        
        
        function isLoggedIn ()
        {
                if ( Session::get('loggedIn') == TRUE )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function &getLoggedInUser ( &$connection )
        {
                $uid = Session::get('userId');
                if ( is_null($uid) || $uid == '' )
                {
                        return NULL;
                }
                
                $user =& User::findFirst(
                        array('id' => $uid),
                        $connection);
                
                return $user;
        }
        
        
        function authenticateUser ( &$connection, $login, $password )
        {
                $user =& User::findFirst(
                        array('username' => $login),
                        $connection);
                if ( !is_object($user) )
                {
                        return FALSE;
                }
                
                if ( $user->getPassword() == md5($password) )
                {
                        return TRUE;
                }
                else
                {
                        return FALSE;
                }
        }
        
        
        function getUserWithLogin ( &$connection, $login )
        {
                $user =& User::findFirst(
                        array('username' => $login),
                        $connection);
                if ( !is_object($user) )
                {
                        return FALSE;
                }
                
                return $user;
        }
        
        
        function loginUser ( &$user )
        {
                Session::put('user', $user);
                Session::put('userId', $user->getId());
                Session::put('loggedIn', TRUE);
                Session::put('logInTime', time());
                Session::put('loggedIn', TRUE);
        }
        
        
        function logout ()
        {
                Session::put('user', NULL);
                Session::put('userId', NULL);
                Session::put('loggedIn', FALSE);
                
                Session::reset();
        }
}

?>
