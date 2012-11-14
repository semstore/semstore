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
require_once('Sites/JusteCommerce/SessionUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/eComStoreCMSUtils.class.php');
//require_once('PHP_Compat-1.5.0/Compat/Function/file_get_contents.php');


if ( strtolower($_SERVER['REQUEST_METHOD']) != 'post' ||
        $_POST['action'] == 'begin_upload')
{
?>
<html>
<head><title>SEM eCommerce Store CSV Upload Tool</title></head>
<body>
<p>Look its easy.  Just use this form to select the CSV file and click upload.</p>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multi-part/form-data">
<input name="action" value="begin_upload" type="hidden" />
<input name="csvfile" type="file" />
<button name="button" value="submit" type="submit">Submit</button>
</form>
</body>
</html>
<?php
}


print $_FILE['csvfile']['tmp_name'];
 
/*
//fetch file
$data = file_get_contents("/var/www/localhost/htdocs/ashleysdesign/httpdocs/lib/utils/catalog.csv");

$dataArray = split("\n", $data);

//remove first entry
$dataArray[0] = null;



function cleanUp ( $string )
{//cleans up string
      $newstring = str_replace("\"","",$string);
      $newstring = str_replace("£","",$newstring);
      return trim($newstring);
}







foreach ( $dataArray as $csvLine )
{
      $productData = split(",", $csvLine);
      
      $productCode = cleanUp($productData[3]);
      $productPrice = cleanUp($productData[5]) * 100;
      $imageName = cleanUp($productData[2]);
      $typeName = cleanUp($productData[18]);
      
      $metal = cleanUp($productData[6]);
      $dimensions = cleanUp($productData[7]);
      $mainstone = cleanUp($productData[8]);
      $otherstones = cleanUp($productData[9]);
      $quality = cleanUp($productData[10]);
      $diamondWeight = cleanUp($productData[11]);
      $mainStoneWeight = cleanUp($productData[12]);
      $otherStones = cleanUp($productData[14]);
      $certified = cleanUp($productData[19]);
      
      //must be a product if theres a product code and type
      if ( strlen($productCode) > 0 && strlen($typeName) > 0 )
      {
            //create product
            $newProduct = new Product();
            
            //code
            $newProduct->setCode($productCode);
            
            //price
            $newProduct->setPriceExVat($productPrice);
            
            //work out the type from type name
            $type =& ProductType::findFirst(array('name' => $typeName), $GLOBALS['dbConnection']);
            
            if ( is_null($type) )
            {
                  //no type, create new type
                  $type =& new ProductType();
                  $type->setName($typeName);
                  $type->setConnection($GLOBALS['dbConnection']);
                  $type->commit();
            }
             
             
            //fetch attribute refernces
            
            //fetch attribute group
            $typeAttributeGroup =& ProductTypeAttributeGroup::findFirst(array('type_id' => $type->getId()), $GLOBALS['dbConnection']);
            
            if ( is_null($typeAttributeGroup) )
            {
                  $typeAttributeGroup =& new ProductTypeAttributeGroup();
                  $typeAttributeGroup->setName("Details");
                  $typeAttributeGroup->setTypeId($type->getId());
                  $typeAttributeGroup->setIndex(0);
                  $typeAttributeGroup->setConnection($GLOBALS['dbConnection']);
                  $typeAttributeGroup->commit();
            }
            
            //retrieve attributes and create attributes if needed
            $ProductTypeAttributeDO =& new ProductTypeAttributeDataObject();
            
            $metalAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Metal', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            
            if ( is_null($metalAttribute) )
            {
                  $metalAttribute =& new ProductTypeAttributeDataObject();
                  $metalAttribute->setName("Metal");
                  $metalAttribute->setIndex(0);
                  $metalAttribute->setGroupId($typeAttributeGroup->getId());
                  $metalAttribute->store($GLOBALS['dbConnection']);
            }
            
            $dimensionAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Dimensions', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($dimensionAttribute) )
            {
                  $dimensionAttribute =& new ProductTypeAttributeDataObject();
                  $dimensionAttribute->setName("Dimensions");
                  $dimensionAttribute->setIndex(0);
                  $dimensionAttribute->setGroupId($typeAttributeGroup->getId());
                  $dimensionAttribute->store($GLOBALS['dbConnection']);
            }
            
            $mainstoneAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Main stone', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($mainstoneAttribute) )
            {            
                  $mainstoneAttribute =& new ProductTypeAttributeDataObject();
                  $mainstoneAttribute->setName("Main stone");
                  $mainstoneAttribute->setIndex(0);
                  $mainstoneAttribute->setGroupId($typeAttributeGroup->getId());
                  $mainstoneAttribute->store($GLOBALS['dbConnection']);
            }
                  
            $otherstonesAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Other stones', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($otherstonesAttribute) )
            {            
                  $otherstonesAttribute =& new ProductTypeAttributeDataObject();
                  $otherstonesAttribute->setName("Other stones");
                  $otherstonesAttribute->setIndex(0);
                  $otherstonesAttribute->setGroupId($typeAttributeGroup->getId());
                  $otherstonesAttribute->store($GLOBALS['dbConnection']);
            }
            
            $qualityAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Quality', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($qualityAttribute) )
            {    
                  $qualityAttribute =& new ProductTypeAttributeDataObject();
                  $qualityAttribute->setName("Quality");
                  $qualityAttribute->setIndex(0);
                  $qualityAttribute->setGroupId($typeAttributeGroup->getId());
                  $qualityAttribute->store($GLOBALS['dbConnection']);
            }
            
            $diamondWeightAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Diamond Weight', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($diamondWeightAttribute) )
            {                
                  $diamondWeightAttribute =& new ProductTypeAttributeDataObject();
                  $diamondWeightAttribute->setName("Diamond Weight");
                  $diamondWeightAttribute->setIndex(0);
                  $diamondWeightAttribute->setGroupId($typeAttributeGroup->getId());
                  $diamondWeightAttribute->store($GLOBALS['dbConnection']);
            }
            
            $mainstoneWeightAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Main Stone Weight', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($mainstoneWeightAttribute) )
            {            
                  $mainstoneWeightAttribute =& new ProductTypeAttributeDataObject();
                  $mainstoneWeightAttribute->setName("Main Stone Weight");
                  $mainstoneWeightAttribute->setIndex(0);
                  $mainstoneWeightAttribute->setGroupId($typeAttributeGroup->getId());
                  $mainstoneWeightAttribute->store($GLOBALS['dbConnection']);
            }
            
            $otherStonesAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Other Stones Weight', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($otherStonesAttribute) )
            { 
                  $otherStonesAttribute =& new ProductTypeAttributeDataObject();
                  $otherStonesAttribute->setName("Other Stones Weight");
                  $otherStonesAttribute->setIndex(0);
                  $otherStonesAttribute->setGroupId($typeAttributeGroup->getId());
                  $otherStonesAttribute->store($GLOBALS['dbConnection']);
            }
            
            
            $certifiedAttribute = $ProductTypeAttributeDO->lookup(array('name' => 'Certification', 'group_id' => $typeAttributeGroup->getId()), $GLOBALS['dbConnection']);
            if ( is_null($certifiedAttribute) )
            { 
                  $certifiedAttribute =& new ProductTypeAttributeDataObject();
                  $certifiedAttribute->setName("Certification");
                  $certifiedAttribute->setIndex(0);
                  $certifiedAttribute->setGroupId($typeAttributeGroup->getId());
                  $certifiedAttribute->store($GLOBALS['dbConnection']);
            }
                   
            $category = ProductCategory::findFirst(array('name' => $type->getName()), $GLOBALS['dbConnection']);
      
            //also create new category of same name if doesnt exist
            if ( is_null($category) )
            {
                  $category =& new ProductCategory();
                  $category->setName($typeName);
                  $category->setConnection($GLOBALS['dbConnection']);
                  ProductCategory::AddRootCategoryAtEnd(
                          $category,
                          $GLOBALS['dbConnection']);
                  //$category->commit();
            }

            $newProduct->setTypeId($type->getId());
            $newProduct->setOnsale(1);
            
            //generate name
            $newName = $metal." ". $diamondWeight." ". $mainstone  . " ". $typeName ;
            $newProduct->setName( $newName );
            $newProduct->setDateTimeAdded(date('Y-m-d H:i:s'));
            $newProduct->setConnection($GLOBALS['dbConnection']);
            $newProduct->commit();
            
            //create attribute values
            
            //metal
            $metalAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $metalAttributeLink->setValue($metal);
            $metalAttributeLink->setAttributeId($metalAttribute->getId());
            $metalAttributeLink->setProductId($newProduct->getId());
            $metalAttributeLink->store($GLOBALS['dbConnection']);
            
            //dimension
            $dimensionAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $dimensionAttributeLink->setValue($dimensions);
            $dimensionAttributeLink->setAttributeId($dimensionAttribute->getId());
            $dimensionAttributeLink->setProductId($newProduct->getId());
            $dimensionAttributeLink->store($GLOBALS['dbConnection']);
            
            //mainstone
            $mainstoneAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $mainstoneAttributeLink->setValue($mainstone);
            $mainstoneAttributeLink->setAttributeId($mainstoneAttribute->getId());
            $mainstoneAttributeLink->setProductId($newProduct->getId());
            $mainstoneAttributeLink->store($GLOBALS['dbConnection']);
                        
            //otherstonesAttribute
            $otherstonesAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $otherstonesAttributeLink->setValue($otherstones);
            $otherstonesAttributeLink->setAttributeId($otherstonesAttribute->getId());
            $otherstonesAttributeLink->setProductId($newProduct->getId());
            $otherstonesAttributeLink->store($GLOBALS['dbConnection']);            
            
            //quality
            $qualityAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $qualityAttributeLink->setValue($quality);
            $qualityAttributeLink->setAttributeId($qualityAttribute->getId());
            $qualityAttributeLink->setProductId($newProduct->getId());
            $qualityAttributeLink->store($GLOBALS['dbConnection']);
            
            //diamond weight
            $diamondWeightAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $diamondWeightAttributeLink->setValue($diamondWeight);
            $diamondWeightAttributeLink->setAttributeId($diamondWeightAttribute->getId());
            $diamondWeightAttributeLink->setProductId($newProduct->getId());
            $diamondWeightAttributeLink->store($GLOBALS['dbConnection']);
            
            //main stone weight
            $mainstoneWeightAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $mainstoneWeightAttributeLink->setValue($mainStoneWeight);
            $mainstoneWeightAttributeLink->setAttributeId($mainstoneWeightAttribute->getId());
            $mainstoneWeightAttributeLink->setProductId($newProduct->getId());
            $mainstoneWeightAttributeLink->store($GLOBALS['dbConnection']);
            
            //other stones
            $otherstonesAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $otherstonesAttributeLink->setValue($otherStones);
            $otherstonesAttributeLink->setAttributeId($otherstonesAttribute->getId());
            $otherstonesAttributeLink->setProductId($newProduct->getId());
            $otherstonesAttributeLink->store($GLOBALS['dbConnection']);
            
            //certified
            $certifiedAttributeLink =& new ProductTypeAttributeLinkDataObject();
            $certifiedAttributeLink->setValue($certified);
            $certifiedAttributeLink->setAttributeId($certifiedAttribute->getId());
            $certifiedAttributeLink->setProductId($newProduct->getId());
            $certifiedAttributeLink->store($GLOBALS['dbConnection']);
             
            //link to category
            $category->addProduct($newProduct);
            //$categoryLink =& new ProductCategoryLinkDataObject();
            //$categoryLink->setCategoryId($category->getId());
            //$categoryLink->setProductId($newProduct->getId());
            //$categoryLink->store($GLOBALS['dbConnection']);
            
            //now sort out the images
            
            //generate path to original image
            $originalImage = "/var/www/localhost/htdocs/ashleysdesign/httpdocs/catalogimages/".$imageName.".jpg";
            
            if ( file_exists( $originalImage ) )
            {
                  //file exists, create correct sized images
                  
                  $productImages = new ProductImages();
                  $productImages->setProductId($newProduct->getId());
                  
                  //copy image
                  
                  //product image png
                  eComStoreCMSUtils::createProductImage(
                              $originalImage,
                              "/var/www/localhost/htdocs/ashleysdesign/httpdocs/images/products/".'prd'.$newProduct->getId().'.png'
                              );
                  $productImages->setProductImage('prd'.$newProduct->getId().'.png');
                  
                  
                  //product browser thumbnail
                  eComStoreCMSUtils::createProductBrowserThumbnail(
                              $originalImage,
                              "/var/www/localhost/htdocs/ashleysdesign/httpdocs/images/products/".'prd'.$newProduct->getId().'_tn.png'
                              );
                  $productImages->setBrowserThumbnailImage(
                              'prd'.$newProduct->getId().'_tn.png');
                  
                  //create product details page 
                  eComStoreCMSUtils::createProductDetailsPageImage(
                              $originalImage,
                              "/var/www/localhost/htdocs/ashleysdesign/httpdocs/images/products/".'prd'.$newProduct->getId().'_small.png'
                              );
                  $productImages->setProductDetailsPageImage(
                              'prd'.$newProduct->getId().'_small.png');
                  
                  //create basket image
                  eComStoreCMSUtils::createBasketImage(
                              $originalImage,
                              "/var/www/localhost/htdocs/ashleysdesign/httpdocs/images/products/".'prd'.$newProduct->getId().'_bsk.png'
                              );
                  $productImages->setBasketImage(
                              'prd'.$newProduct->getId().'_bsk.png');                  
                  
                  $productImages->setConnection($GLOBALS['dbConnection']);
                  $productImages->commit();
            }
            
            
      }
}
*/

?>
