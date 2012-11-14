<?php

$config =& $GLOBALS['config'];

$config['db_dbms'] = 'mysql';
$config['db_server'] = 'localhost';
$config['db_username'] = 'semstore';
$config['db_password'] = '53m5t0r3';
$config['db_database'] = 'semstore';

$config['db_conn_str'] = $config['db_dbms'] . '://' .
                        $config['db_server'] . '/' .
                        $config['db_database'] .
                        '?username=' . $config['db_username'] .
                        '&password=' . $config['db_password'];

?>
