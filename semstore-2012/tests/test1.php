<?php

/*** Set the path to our code library :: Start ***/
$includePathFileFound = FALSE;
for ( $i = 0; $i < 20 && !$includePathFileFound; $i++ )
{
        if ( is_file('./lib/include/include_path.inc.php') )
        {
                require('./lib/include/include_path.inc.php');
                $includePathFileFound = TRUE;
        }
        else
        {
                $dir = getcwd();
                chdir('..');
                if ( $dir == getcwd() )
                {
                        die('Could not set the include path.');
                }
        }
}
if ( !$includePathFileFound )
{
        die('Could not set the include path.');
}
/*** Set the path to our code library :: End ***/

require('envprep.inc.php');
require_once('HTTP/RequestParameters.class.php');
require_once('SEM/eComStore/Product.class.php');
require_once('SEM/eComStore/ProductGlobalAttributeGroup.class.php');
require_once('SEM/eComStore/ProductGlobalAttribute.class.php');

//Session::start();

$product =& Product::findFirst(
        array('id' => 1),
        $GLOBALS['dbConnection'] );

$groups =& $product->getProductGlobalAttributeGroups();
foreach ( array_keys($groups) as $index )
{
        $group =& $groups[$index];
        print "\nGroup Name: " . $group->getName();
        print "\nPosition: " . $group->getIndex();
        $attributes =& $group->getAttributes();
        foreach ( array_keys($attributes) as $index )
        {
                $attribute = $attributes[$index];
                print "\n\tAttribute Name: " . $attribute->getName();
                print "\n\tAttribute Value: " . $attribute->getValue();
                print "\n\tPosition: " . $attribute->getIndex();
                print "\n\n";
        }
        print "\n\n";
}

Out::flush();
Debug::flush();

?>
