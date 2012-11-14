<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-11
 * @package SEM.CMS
 */

require_once('Session/Session.class.php');

require_once('SEM/CMS/CMSException.class.php');
require_once('SEM/CMS/CMSUser.class.php');

class CMSUtils
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
        
        
        function CMSCapability ()
        {
                die('abstract');
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
        
        
        function isLoggedIn ()
        {
                if ( Session::get('cmsLoggedIn') == TRUE )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function &getLoggedInCMSUser ( &$connection )
        {
                $uid = Session::get('cmsUserId');
                if ( is_null($uid) || $uid == '' )
                {
                        return NULL;
                }
                
                $user =& CMSUser::findFirst(
                        array('id' => $uid),
                        $connection);
                
                return $user;
        }
        
        
        function authenticateUser ( &$connection, $login, $password )
        {
                $user =& CMSUser::findFirst(
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
                $user =& CMSUser::findFirst(
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
                Session::put('cmsUser', $user);
                Session::put('cmsUserId', $user->getId());
                Session::put('cmsLoggedIn', TRUE);
                Session::put('cmsLogInTime', time());
                Session::put('cmsLoggedIn', TRUE);
        }
        
        
        function logout ()
        {
                Session::put('cmsUser', NULL);
                Session::put('cmsUserId', NULL);
                Session::put('cmsLoggedIn', FALSE);
                
                Session::reset();
        }
        
        
        function checkSession ()
        {
                if ( Session::get('startTime') == NULL ||
                        Session::get('startTime') == '' )
                {
                        CMSUtils::initialiseSession();
                }
                elseif ( Session::get('lastAccessTime') < time() - 10*24*60*60 )
                {
                        CMSUtils::logout();
                        Session::reset();
                        CMSUtils::initialiseSession();
                }
                elseif ( Session::get('lastAccessTime') < time() - 60*60 )
                {
                        CMSUtils::logout();
                }
                
                Session::put('lastAccessTime', time());
                //Session::gc();
        }
        
        
        function initialiseSession ()
        {
                Session::put('startTime', time());
                Session::put('lastAccessTime', time());
        }
        
        
        /* CMS URM Class Methods */
        function createCapability ( $capname, &$connection, $strict = FALSE )
        {
                if ( CMSUtils::capabilityWithNameExists($capname,
                        $connection) )
                {
                        if ( $strict )
                        {
                                // Need to throw some sort of exception;
                        }
                        else
                        {
                                return CMSUtils::findCapabilityWithName(
                                        $capname, $connection);
                        }
                }
                
                $capability =& new CMSCapability();
                $capability->setConnection($connection);
                $capability->setName($capname);
                $res = $capability->commit();
                if ( $res !== TRUE )
                {
                        return $res;
                }
                
                return $capability;
        }
        
        
        function findCapabilityWithName ( $capname, &$connection )
        {
                $capability =& CMSCapability::findFirst(
                        array('name' => $capname),
                        $connection);
                
                return $capability;
        }
        
        
        function capabilityWithNameExists ( $capname, &$connection )
        {
                $capability =
                        CMSUtils::findCapabilityWithName($rolename,
                        $connection);
                
                if ( CMSException::isException($capability) )
                {
                        return $capability;
                }
                elseif ( Exception::isException($capability) )
                {
                        return $capability;
                }
                
                if ( is_null($capability) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function createRole ( $rolename, &$connection, $strict = FALSE )
        {
                if ( CMSUtils::roleWithNameExists($rolename,
                        $connection) )
                {
                        if ( $strict )
                        {
                                // Need to throw some sort of exception;
                        }
                        else
                        {
                                return CMSUtils::findRoleWithName(
                                        $rolename, $connection);
                        }
                }
                
                $role =& new CMSRole();
                $role->setConnection($connection);
                $role->setName($rolename);
                $res = $role->commit();
                if ( $res !== TRUE )
                {
                        return $res;
                }
                
                return $role;
        }
        
        
        function findRoleWithName ( $rolename, &$connection )
        {
                $role =& CMSRole::findFirst(
                        array('name' => $rolename),
                        $connection);
                
                return $role;
        }
        
        
        function roleWithNameExists ( $rolename, &$connection )
        {
                $role = CMSUtils::findRoleWithName($rolename, $connection);
                
                if ( CMSException::isException($role) )
                {
                        return $role;
                }
                elseif ( Exception::isException($role) )
                {
                        return $role;
                }
                
                if ( is_null($role) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function grantCapabilityToRole ()
        {
                ;
        }
        
        
        function &createUser ( $username, &$connection, $strict = FALSE )
        {
                if ( CMSUtils::userWithUsernameExists($username,
                        $connection) )
                {
                        if ( $strict )
                        {
                                // Need to throw some sort of exception;
                        }
                        else
                        {
                                return CMSUtils::findUserWithUsername(
                                        $username, $connection);
                        }
                }
                
                $user =& new CMSUser();
                $user->setConnection($connection);
                $user->setUsername($username);
                $res = $user->commit();
                if ( $res !== TRUE )
                {
                        return $res;
                }
                
                return $user;
        }
        
        
        function findUserWithUsername ( $username, &$connection )
        {
                $user =& CMSUser::findFirst(
                        array('username' => $username),
                        $connection);
                
                return $user;
        }
        
        
        function userWithUsernameExists ( $username, &$connection )
        {
                $user = CMSUtils::findUserWithUsername($username, $connection);
                
                if ( CMSException::isException($user) )
                {
                        return $user;
                }
                elseif ( Exception::isException($user) )
                {
                        return $user;
                }
                
                if ( is_null($user) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function grepArrayKeys ( $arr, $pattern )
        {
                $matches = array();
                foreach ( array_keys($arr) as $arrkey )
                {
                        if ( preg_match($pattern, $arrkey) === 1 )
                        {
                                $matches[] = $arrkey;
                        }
                }
                
                //print_r($matches);
                
                return $matches;
        }
        
        
        function pager ( &$pagerArray, $criteria, $options )
        {
                // Normalize options array
                
                if ( !in_array($options['nextURI'], array(0, 1), TRUE) )
                {
                        $options['nextURI'] = 1;
                }
                
                if ( !in_array($options['prevURI'], array(0, 1), TRUE) )
                {
                        $options['prevURI'] = 1;
                }
                
                if ( !in_array($options['totalHits'], array(0, 1), TRUE) )
                {
                        $options['totalHits'] = 1;
                }
                
                if ( !in_array($options['hitsPerPage'], array(0, 1), TRUE) )
                {
                        $options['hitsPerPage'] = 1;
                }
                
                if ( !in_array($options['totalPages'], array(0, 1), TRUE) )
                {
                        $options['totalPages'] = 1;
                }
                
                if ( !in_array($options['pageList'], array(0, 1), TRUE) )
                {
                        $options['pageList'] = 1;
                }
                
                if ( preg_match('|^(\d+)$|', $options['numPagesBeforeCurrent']) != 1 )
                {
                        $options['numPagesBeforeCurrent'] = 5;
                }
                
                if ( preg_match('|^(\d+)$|', $options['numPagesAfterCurrent']) != 1 )
                {
                        $options['numPagesAfterCurrent'] = 5;
                }
                
                if ( !in_array($options['criteria'], array(0, 1), TRUE) )
                {
                        $options['criteria'] = 1;
                }
                
                // Process search criteria
                
                $st = 0;
                $mh = 10;
                $rcount = $criteria['rcount'];
                
                if ( preg_match('|^(\d+)$|', ($st = $criteria['st'])) != 1  )
                {
                        $st = 0;
                }
                
                if ( preg_match('|^(\d+)$|', ($mh = $criteria['mh'])) != 1  )
                {
                        $mh = 10;
                }
                
                // Build pager
                
                $pagerArray = array();
                
                $pageCount = floor($rcount/$mh) + ($rcount % $mh > 0 ? 1 : 0);
                $currentPage = floor($st/$mh) + 1;
                
                $firstPagerPage = 
                        ( ($firstPagerPage = $currentPage - $options['numPagesBeforeCurrent']) <= 0 ?
                                1 : $firstPagerPage );
                $lastPagerPage =
                        ( ($lastPagerPage = $currentPage + $options['numPagesAfterCurrent']) >= $pageCount ?
                                $pageCount : $lastPagerPage );
                
                
                if ( $options['nextURI'] )
                {
                        $pagerArray['nextURI'] = '';
                }
                
                if ( $options['prevURI'] )
                {
                        $pagerArray['prevURI'] = '';
                }
                
                if ( $options['totalHits'] )
                {
                        $pagerArray['totalHits'] = $rcount;
                }
                
                if ( $options['hitsPerPage'] )
                {
                        $pagerArray['hitsPerPage'] = $mh;
                }
                
                if ( $options['totalPages'] )
                {
                        $pagerArray['totalPages'] = $pageCount;
                }
                
                if ( $options['pageList'] )
                {
                        $pages = array();
                        for ( $i = $firstPagerPage; $i <= $lastPagerPage; $i++ )
                        {
                                $st = ($i - 1)  * $mh;
                                
                                $newCriteria = $criteria;
                                $newCriteria['st'] = $st;
                                $array_map_key = create_function(
                                        '$arr',
                                        '$newarr = array(); ' .
                                        'foreach ( $arr as $key => $value ) { $newarr[] = $key."=".$value; } ' .
                                        'return $newarr;');
                                $strCriteria = join('&amp;',
                                        $array_map_key($newCriteria));
                                
                                
                                $pages[$i] = array();
                                $pages[$i]['is_current'] =
                                        ( $i == $currentPage ? 1 : 0 );
                                $pages[$i]['is_first'] =
                                        ( $i == $firstPagerPage ? 1 : 0 );
                                $pages[$i]['is_last'] =
                                        ( $i == $lastPagerPage ? 1 : 0 );
                                $pages[$i]['is_prev'] =
                                        ( $i == $currentPage - 1 ? 1 : 0 );
                                $pages[$i]['is_next'] =
                                        ( $i == $currentPage + 1 ? 1 : 0 );
                                $pages[$i]['uri'] = $strCriteria;
                        }
                        
                        $pagerArray['pages'] = $pages;
                }
                
                if ( $options['criteria'] )
                {
                        $pagerArray['criteria'] = $criteria;
                }
                
                //print_r($pagerArray);
                
                return TRUE;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
