<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-08-01
 */

class FtpAgent extends SEMObject
{
        /*
	 * Class Constants
	 */
	
        
	/*
	 * Class Variables
	 */
        
        
        /*
	 * Instance Variables
	 */
        
        
        var $connectionId = NULL;
        var $server = 'localhost';
        var $port = 21;
        var $userId = '';
        var $password = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function FtpAgent ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'FtpAgent'.$numArgs),  $args);
        }
        
        
        function FtpAgent0 ()
        {
                $this->_initialise();
        }
        
        
        function FtpAgent3 ( $server, $userId, $password )
        {
                $this->_initialise();
                $this->setServer($server);
                $this->setUserId($userId);
                $this->setPassword($password);
        }
        
        
        function FtpAgent4 ( $server, $port, $userId, $password )
        {
                $this->_initialise();
                $this->setServer($server);
                $this->setPort($port);
                $this->setUserId($userId);
                $this->setPassword($password);
        }
        
        
        function _initialise ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getConnectionId ()
        {
                return $this->connectionId;
        }
        
        
        function setConnectionId ( $connectionId )
        {
                $this->connectionId = $connectionId;
        }
        
        
        function getServer ()
        {
                return $this->server;
        }
        
        
        function setServer ( $server )
        {
                $this->server = $server;
        }
        
        
        function getPort ()
        {
                return $this->port;
        }
        
        
        function setPort ( $port )
        {
                $this->port = $port;
        }
        
        
        function getUserId ()
        {
                return $this->userId;
        }
        
        
        function setUserId ( $userId )
        {
                $this->userId = $userId;
        }
        
        
        function getPassword ()
        {
                return $this->password;
        }
        
        
        function setPassword ( $password )
        {
                $this->password = $password;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function connect ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, 'connect'.$numArgs),  $args);
        }
        
        
        function connect0 ()
        {
                $connId = ftp_connect($this->getServer(), $this->getPort());
                $this->setConnectionId($connId);
                ftp_login($connId, $this->getUserId(), $this->getPassword());
        }
        
        
        function connect3 ( $server, $userId, $password )
        {
                $this->setServer($server);
                $this->setUserId($userId);
                $this->setPassword($password);
                $this->connect();
        }
        
        
        function connect4 ( $server, $port, $userId, $password )
        {
                $this->setServer($server);
                $this->setPort($port);
                $this->setUserId($userId);
                $this->setPassword($password);
                $this->connect();
        }
        
        
        function mkdir ( $dir )
        {
                return ftp_mkdir($this->getConnectionId(), $dir);
        }
        
        
        function chdir ( $dir )
        {
                return ftp_chdir($this->getConnectionId(), $dir);
        }
        
        
        function chmod ( $perms, $file )
        {
                $chmod_cmd="CHMOD $perms $file"; 
                $chmod = ftp_site($this->getConnectionId(), $chmod_cmd);
                
                return $chmod;
        }
        
        
        function get ( $remoteFile, $localFile, $mode )
        {
                if ( $mode == FTP_BINARY )
                {
                        ftp_put( $this->getConnectionId(), $localFile, $remoteFile,
                                FTP_BINARY);
                }
                else
                {
                        ftp_put( $this->getConnectionId(), $localFile, $remoteFile,
                                FTP_ASCII);
                }
        }
        
        
        function put ( $localFile, $remoteFile, $mode )
        {
                if ( $mode == FTP_BINARY )
                {
                        ftp_put( $this->getConnectionId(), $remoteFile, $localFile,
                                FTP_BINARY);
                }
                else
                {
                        ftp_put( $this->getConnectionId(), $remoteFile, $localFile,
                                FTP_ASCII);
                }
        }
        
        
        function disconnect ()
        {
                return ftp_close($this->getConnectionId());
        }
        
        
        function enablePassiveMode ()
        {
                ftp_pasv( $this->getConnectionId(), TRUE );
        }
        
        
}

?>
