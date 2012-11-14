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
require_once('SEM/eComStore/ProductCategory.class.php');

//Session::start();

$rootCategories =& ProductCategory::getRootCategories(
        $GLOBALS['dbConnection'] );

foreach ( array_keys($rootCategories) as $index )
{
        $category =& $rootCategories[$index];
        Out::writeOut("\nCategory Name: " . $category->getName());
        printTree($category, 1, $GLOBALS['dbConnection']);
}

Out::flush();
Debug::flush();

exit();

function printTree ( &$category, $indent, &$connection )
{
        $subcategories =& $category->getSubcategories();
        foreach ( array_keys($subcategories) as $index )
        {
                $subcategory =& $subcategories[$index];
                Out::writeOut("\n".str_repeat("\t", $indent).
                        "Category Name: " . $subcategory->getName()
                        );
                printTree($subcategory, $indent+1, $connection);
        }
}

?>
