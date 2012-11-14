<?php

$timeserver = 'extntp1.inf.ed.ac.uk';
$socket = '123';
$fp = fsockopen($timeserver, $socket, $err, $errstr, 5);
        # parameters: server, socket, error code, error text, timeout
if ($fp)
{
        fputs($fp,"\n");
        $timevalue = fread($fp,49);
        print $timevalue;
        fclose($fp); # close the connection
}
else
{
        die("Couldn't connect");
}

exit();

?>
