<?php

//first fetch table name

echo 'Please enter a database name: ';
$dbname = trim(fgets(STDIN));


echo 'Please enter your database username: ';
$dbusername = trim(fgets(STDIN));


echo 'Please enter your database password: ';
$dbpassword = trim(fgets(STDIN));

echo 'Please enter a table name: ';
$tablename = trim(fgets(STDIN)); // reads one line from STDIN


//db details


//connect to db
$mysql_connection = mysql_connect('localhost', $dbusername, $dbpassword) or die('Could not connect to database server! '.mysql_error());

mysql_select_db($dbname , $mysql_connection) or die ('The database does not exist: '.mysql_error());

//fetch field names
$fields = mysql_query("SHOW COLUMNS FROM ".$tablename, $mysql_connection) or die ('The table does not exist: '.mysql_error());

//create array of fields
if (mysql_num_rows($fields) > 0) 
{
   while ($row = mysql_fetch_assoc($fields)) {
	$fieldlistarray[] = $row;
   }
}
else
{
	die("No fields are in this table! ".mysql_error().'\n');
}

//find primary key

for ($i=0; $i<count($fieldlistarray); $i++)
{
	if ( $fieldlistarray[$i][Key] == 'PRI')
	{
	$primarykey = $fieldlistarray[$i][Field];
	}
}

$tablename = ucfirst($tablename);


//create header stuff
$dataobjectCode = '<?php

/**
 * @author 
 * @version 1.0
 * @date ' . date('Y-m-d') . '
 * @package 
 */

require_once(\'Database/Abstraction/AttributeMappedDataObject.class.php\');

class '.$tablename.'DataObject extends AttributeMappedDataObject
{
        /*
         *
         * Class Constants
         *
         */
        
        
        function TABLE () { return \''.strtolower($tablename).'\'; }
        function PRIMARY_KEY () { return \''.$primarykey.'\'; }
        
        function FIELD_LIST () { return array('."\n";
        
for ($i=0; $i<count($fieldlistarray); $i++)
{
	$dataobjectCode = $dataobjectCode.'                \''.$fieldlistarray[$i][Field]."',\n";
}

$dataobjectCode = $dataobjectCode.'                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array('."\n";


for ($i=0; $i<count($fieldlistarray); $i++)
{
	$dataobjectCode = $dataobjectCode.'                \''.fixFieldName($fieldlistarray[$i][Field], false).'\' => \''.$fieldlistarray[$i][Field]."',\n";
}
$dataobjectCode = $dataobjectCode.'                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        
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
        
        
';

for ($i=0; $i<count($fieldlistarray); $i++)
{
	$dataobjectCode = $dataobjectCode.'	var $'.fixFieldName($fieldlistarray[$i][Field], false).' = \'\';'."\n";
}


$dataobjectCode = $dataobjectCode.'
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
         * Constructors
         *
         */
	
	
        function '.$tablename.'DataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();
                call_user_func_array(
                        array(&$this, \'_'.$tablename.'DataObject\'.$numArgs),
                        $args);
        }
        
        
        function _'.$tablename.'DataObject0 ()
        {
                $this->_initialize();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
	 
	 
';

//fixes field names
function fixFieldName ( $name, $notlower = true )
{
        //remove underscore if exists
        $strloc = strpos($name, '_');
        
        $newname = "";
        
        if ( $strloc !== false )
        {
                $underscoreSplit = split('_', $name);
                
                $first = true;
                
                foreach ( $underscoreSplit as $split )
                {
                        if ( $first == true )
                        {
                                $newname .= $split;
                                $first = false;
                        }
                        else
                        {
                                $newname .= ucfirst($split);
                        }
                }
        }
        else
        {
                $newname = $name;
        }
        
        if ( $notlower == true )
        {
                $newname = ucfirst($newname);
        }
        
        return $newname;
}




for ( $i=0; $i < count($fieldlistarray); $i++)
{
	$dataobjectCode = $dataobjectCode.'	function get'.fixFieldName($fieldlistarray[$i][Field]).' ()
	{
		return $this->'.fixFieldName($fieldlistarray[$i][Field], false).';
	}
        
        
        function set'.fixFieldName($fieldlistarray[$i][Field]).' ( $temp'.$fieldlistarray[$i][Field].' )
	{
		$this->'.fixFieldName($fieldlistarray[$i][Field], false).' = $temp'.$fieldlistarray[$i][Field].';
	}
	
';
}

$dataobjectCode = $dataobjectCode.'
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new '.$tablename.'DataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->set'.$primarykey.'($connection->getLastInsertId());
        }
}

?>
';


define('FILE_APPEND', 1);
function file_put_contents($n, $d, $flag = false) {
   $mode = ($flag == FILE_APPEND || strtoupper($flag) == 'FILE_APPEND') ? 'a' : 'w';
   $f = @fopen($n, $mode);
   if ($f === false) {
       return 0;
   } else {
       if (is_array($d)) $d = implode($d);
       $bytes_written = fwrite($f, $d);
       fclose($f);
       return $bytes_written;
   }
}

echo "Data Object has been created as ".$tablename."DataObject.class.php\n";


//save to file
file_put_contents($tablename."DataObject.class.php",$dataobjectCode);

?>
