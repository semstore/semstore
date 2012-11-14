<?php

$GLOBALS['bmconfig']['site_root_path'] =
        '/home/httpd/vhosts/justecommerce.co.uk_development/httpdocs';

$GLOBALS['bmcofig']['mail_host'] = 'mail.semstudio.co.uk';
$GLOBALS['bmcofig']['mail_port'] = 25;
$GLOBALS['bmcofig']['mail_auth'] = 1;
$GLOBALS['bmcofig']['mail_username'] = 'bugmaster';
$GLOBALS['bmcofig']['mail_password'] = 'bugm45t3r';

$GLOBALS['bmconfig']['email_from'] = 'mailer@semstudio.co.uk';
$GLOBALS['bmconfig']['email_recipient'] = 'bugmaster@semstudio.co.uk';
$GLOBALS['bmconfig']['email_subject'] = 'justecommerce_development';

$GLOBALS['bmconfig']['trusted_ips'] = array('62.49.153.98',
        '62.49.153.100');

$GLOBALS['bmconfig']['trusted_ep_file'] = 
        $GLOBALS['bmconfig']['site_root_path'] . 
        '/lib/include/trustederrorpage.html';
$GLOBALS['bmconfig']['standard_ep_file'] = 
        $GLOBALS['bmconfig']['site_root_path'] .
        '/lib/include/standarderrorpage.html';
$GLOBALS['bmconfig']['errorTypes'] = array (
        E_ERROR              => 'Error',
        E_WARNING            => 'Warning',
        E_PARSE              => 'Parsing Error',
        E_NOTICE            => 'Notice',
        E_CORE_ERROR        => 'Core Error',
        E_CORE_WARNING      => 'Core Warning',
        E_COMPILE_ERROR      => 'Compile Error',
        E_COMPILE_WARNING    => 'Compile Warning',
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING      => 'User Warning',
        E_USER_NOTICE        => 'User Notice',
        E_STRICT            => 'Runtime Notice',
        E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
        );
$GLOBALS['bmconfig']['reportableErrors'] = array(
        E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);


function bugmasterErrorHandler ( $errno, $errmsg, $filename, $linenum, $vars )
{
        if ( !in_array($errno, $GLOBALS['bmconfig']['reportableErrors']) )
        {
                return TRUE;
        }
        
        // Oops somethings gone wrong.  Lets deal with it.
        require_once('Mail.php');
        
        // Do we recognise the error and can we recover from it?
        
        // Not implemented.
        
        
        // Mail a bug report
        
        $mailer = Mail::factory('smtp',
                array(
                        'host' => $GLOBALS['bmcofig']['mail_host'],
                        'port' => $GLOBALS['bmcofig']['mail_port'],
                        'auth' => $GLOBALS['bmcofig']['mail_auth'],
                        'username' => $GLOBALS['bmcofig']['mail_username'],
                        'password' => $GLOBALS['bmcofig']['mail_password']));
        $recipients = $GLOBALS['bmconfig']['email_recipient'];
        $headers = array(
                'From' => $GLOBALS['bmconfig']['email_from'],
                'To' => $GLOBALS['bmconfig']['email_recipient'],
                'Subject' => $GLOBALS['bmconfig']['email_subject']);
        $errorReport =
                bugmasterErrorDump($errno, $errmsg, $filename, $linenum);
        
        $mailer->send($recipients, $headers, $body);
        
        // Lets throw a pretty error page up if the visiting user is from a
        // trusted IP address.
        
        if ( array_search(
                $_SERVER['REMOTE_ADDR'],
                $GLOBALS['bmconfig']['trusted_ips']) !== FALSE )
        {
                $error = '<pre>' . $errorReport . '</pre>';
                bugmasterTrustedErrorPage(
                        $GLOBALS['bmconfig']['trusted_ep_file'],
                        $error);
        }
        else
        {
                $message = $errorReport;
                bugmasterStandardErrorPage(
                        $GLOBALS['bmconfig']['standard_ep_file'],
                        $message);
        }
}


function bugmasterErrorDump ( $errno, $errmsg, $filename, $linenum )
{
        $message = 'Error report generated on ' .
                gmdate('jS F Y \a\t H:i:s') . "\n\n" .
                "Errno: " . $GLOBALS['bmconfig']['error_types'][$errorno] . "\n" .
                "Errmsg: $errmsg\n" .
                "Filename: $filename\n" .
                "Linenum: $linenum\n\n" .
                '$_SERVER = ' . print_r($_SERVER, TRUE) . "\n\n" .
                '$_ENV = ' . print_r($_SERVER, TRUE) . "\n\n" .
                '$GLOBALS = ' . print_r($GLOBALS, TRUE) . "\n\n" .
                '$_SESSION = ' . print_r($_SESSION, TRUE) . "\n\n";
        
        return $message;
}


function bugmasterTrustedErrorPage ( $epfile, $errorsub )
{
        $contents = file_get_contents($epfile);
        $contents = str_replace('<!-- Errors here -->', $errorsub, $contents);
        
        print $contents;
}


function bugmasterStandardErrorPage ( $epfile, $message )
{
        $contents = file_get_contents($epfile);
        $contents = str_replace('<!-- Message here -->', $message, $contents);
        
        print $contents;
}

?>
