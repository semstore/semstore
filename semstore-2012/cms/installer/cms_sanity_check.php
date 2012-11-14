<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-11
 * @package 
 */

require_once('./CMSSanityCheck.class.php');

$sc =& new CMSSanityCheck();
$report = $sc->run();

foreach ( $report as $line )
{
        writeOut($line);
}

exit();

function writeOut ( $line )
{
        if ( !isset($_SERVER['SERVER_PROTOCOL']) ||
                $_SERVER['SERVER_PROTOCOL'] == '' )
        {
                print $line;
        }
        else
        {
                print nl2br($line);
        }
}


?>
