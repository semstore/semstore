<?php 

class X
{
        function X () 
        {
               ;
       }
}


class Y extends X
{
        function Y () 
        {
               ;
       }
}


class Z extends X
{
        function Z () 
        {
               ;
       }
}


$y = new Y();
$z = new Z();

print "Is Y a subclass of X? " . (is_subclass_of($y, 'X') ? 'Yes' : 'No');
print "Is Z a subclass of X? " . (is_subclass_of($z, 'X') ? 'Yes' : 'No');

?>
