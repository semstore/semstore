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

echo 'Please enter a Site name: ';
$sitesname = trim(fgets(STDIN));

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
 *
 */

require_once(\'Object.class.php\');

require_once(\'Sites/'.$sitesname.'/DataObjects/'.$tablename.'DataObject.class.php\');

class '.$tablename.' extends Object
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
        
        
        var $connection = NULL;
        
        var $cachedDataObject = NULL;
        var $cachedDataObjectChanged = FALSE;
        
        ';


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
        
        
        function '.$tablename.' ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, \'_'.$tablename.'\'.$numArgs),
                        $args);
        }
        
        
        function _'.$tablename.'0 ()
        {
                $this->_initialise();
                $do =& new '.$tablename.'DataObject();
                $this->_setCachedDataObject($do);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
	
	
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        function &_getCachedDataObject ()
        {
                return $this->cachedDataObject;
        }
        
        
        function _setCachedDataObject ( &$dataObject )
        {
                $this->cachedDataObject =& $dataObject;
        }
        
        
        function getCachedDataObjectChanged ()
        {
                return $this->cachedDataObjectChanged;
        }
        
        
        function _setCachedDataObjectChanged ( $bool )
        {
                $this->cachedDataObjectChanged = $bool;
        }
        
        
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


function lcfirst ( $str )
{
        if ( $str == NULL || $str == '' )
        {
                return $str;
        }
        
        return strtolower(substr($str, 0 , 1)) . substr($str, 1);
}


for ($i=0; $i<count($fieldlistarray); $i++)
{
	$dataobjectCode = $dataobjectCode.'	function get'.fixFieldName($fieldlistarray[$i][Field]).' ()
	{	
		return $this->cachedDataObject->get'.fixFieldName($fieldlistarray[$i][Field]).'();
	}
	
	
        function set'.fixFieldName($fieldlistarray[$i][Field]).' ( $temp'.$fieldlistarray[$i][Field].' )
	{	
		$this->cachedDataObject->set'.fixFieldName($fieldlistarray[$i][Field]).'($temp'.$fieldlistarray[$i][Field].');
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
	
';
}
	 
$dataobjectCode = $dataobjectCode.'
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new '.$tablename.'DataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $'.lcfirst($tablename).'s = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $'.lcfirst($tablename).' =& new '.$tablename.'();
                        $'.lcfirst($tablename).'->setConnection($connection);
                        $'.lcfirst($tablename).'->_setCachedDataObject($do);
                        $'.lcfirst($tablename).'s[] =& $'.lcfirst($tablename).';
                }
                
                return $'.lcfirst($tablename).'s;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new '.$tablename.'DataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $'.lcfirst($tablename).' =& new '.$tablename.'();
                $'.lcfirst($tablename).'->setConnection($connection);
                $'.lcfirst($tablename).'->_setCachedDataObject($do);
                
                return $'.lcfirst($tablename).';
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function commit ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, \'_commit\'.$numArgs),
                        $args);
        }
        
        
        function _commit0 ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commit'.$tablename.'Details();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commit'.$tablename.'Details ()
        {
                $do =& $this->_getCachedDataObject();
                
                $connection =& $this->getConnection();
                
                $result =& $do->store($connection);
                
                if ( is_a(\'DBError\', $result) ||
                        is_subclass_of(\'DBError\', $result ) )
                {
                        return $result;
                }
                
                $this->setId($do->getId());
                $this->_setCachedDataObject($do);
                $this->_setCachedDataObjectChanged(FALSE);
        }
        
        
        function remove ( $maintainIntegrity = TRUE )
        {
                if ( !is_object($this->cachedDataObject) )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        ;
                }
                
                return TRUE;
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

echo "Data Object has been created as ".$tablename.".class.php\n";


//save to file
file_put_contents($tablename.".class.php",$dataobjectCode);

?>
