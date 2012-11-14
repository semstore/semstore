<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-14
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEMException.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');
//require_once('SEM/CMS/Modules/eComStore/ProductAttribute.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeAttributeGroup.class.php');
//require_once('SEM/CMS/Modules/eComStore/ProductSpecificAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductImages.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductSpecialOffersDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/FeaturedProductDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductSuggested.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductFile.class.php');

class Product extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function VAT_RATE () { return 1.175; }
        function PRODUCT_IS_VAT_EXEMPT () { return 2; }
        function PRICE_IS_VAT_EXCLUSIVE () { return 1; }
        function PRICE_IS_VAT_INCLUSIVE () { return 0; }
        
        
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
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function Product ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Product'.$numArgs),
                        $args);
        }
        
        
        function _Product0 ()
        {
                $this->_initialise();
                $do =& new ProductDataObject();
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
        
        
        
        
        
        function getId ()
        {
                return $this->cachedDataObject->getId();
        }
        
        
        function setId ( $id )
        {
                $this->cachedDataObject->setId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getCode ()
        {
                return $this->cachedDataObject->getCode();
        }
        
        
        function setCode ( $code )
        {
                $this->cachedDataObject->setCode($code);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getTypeId ()
        {
                return $this->cachedDataObject->getTypeId();
        }
        
        
        function setTypeId ( $id )
        {
                $this->cachedDataObject->setTypeId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getName ()
        {
                return $this->cachedDataObject->getName();
        }
        
        
        function setName ( $name )
        {
                $this->cachedDataObject->setName($name);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getDescription ()
        {
                return $this->cachedDataObject->getDescription();
        }
        
        
        function setDescription ( $description )
        {
                $this->cachedDataObject->setDescription($description);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        
        function getPrice ()
        {
                return $this->cachedDataObject->getPrice();
        }
        
        
        function setPrice ( $price )
        {
                /*
                $priceToUse = '';
        
                if ( $this->getIsExVat() === TRUE )
                {
                        $priceToUse = $price;
                }
                else
                {
                        $priceToUse = round($price * $this->VAT_RATE(), 2);
                }
                */
                $priceToUse = $price;
                
                $this->cachedDataObject->setPrice($priceToUse);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getVatStatus ()
        {
                return $this->cachedDataObject->getVatStatus();
        }
        
        
        function setVatStatus ( $status )
        {
                if ( $status == $this->PRODUCT_IS_VAT_EXEMPT() )
                {
                        $this->cachedDataObject->setVatStatus(
                                $this->PRODUCT_IS_VAT_EXEMPT());
                        $this->_setCachedDataObjectChanged(TRUE);
                }
                elseif ( $status == $this->PRICE_IS_VAT_INCLUSIVE() )
                {
                        $this->cachedDataObject->setVatStatus(
                                $this->PRICE_IS_VAT_INCLUSIVE());
                        $this->_setCachedDataObjectChanged(TRUE);
                }
                elseif ( $status == $this->PRICE_IS_VAT_EXCLUSIVE() )
                {
                        $this->cachedDataObject->setVatStatus(
                                $this->PRICE_IS_VAT_EXCLUSIVE());
                        $this->_setCachedDataObjectChanged(TRUE);
                }
                else
                {
                        $this->cachedDataObject->setVatStatus(
                                $this->PRICE_IS_VAT_INCLUSIVE());
                        $this->_setCachedDataObjectChanged(TRUE);
                }
        }
        
        
        function getDateTimeAdded ()
        {
                return $this->cachedDataObject->getDateTimeAdded();
        }
        
        
        function setDateTimeAdded ( $dtAdded )
        {
                $this->cachedDataObject->setDateTimeAdded($dtAdded);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getParentId ()
        {
                return $this->cachedDataObject->getParentId();
        }
        
        
        function setParentId ( $id )
        {
                $this->cachedDataObject->setParentId($id);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getOnSale ()
        {
                return $this->cachedDataObject->getOnSale();
        }
        
        
        function setOnSale ( $bool )
        {
                $this->cachedDataObject->setOnSale($bool);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $products = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $product =& new Product();
                        $product->_setCachedDataObject($do);
                        $product->setConnection($connection);
                        $products[] =& $product;
                }
                
                return $products;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $product =& new Product();
                $product->_setCachedDataObject($do);
                $product->setConnection($connection);
                
                return $product;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function onSale ()
        {
                return (
                        $this->getOnSale() == TRUE || $this->getOnSale() == 1 ?
                        TRUE : FALSE );
                        
        }
        
        
        function getIsExVat ()
        {
                if ( $this->getVatStatus() ===
                        $this->PRICE_IS_VAT_EXCLUSIVE() )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        function setIsExVat ( $bool )
        {
                $this->cachedDataObject->setVatStatus($bool);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function commit ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commitSelf();
                }
                
                return TRUE;
        }
        
        
        function _commitSelf ()
        {
                $do =& $this->_getCachedDataObject();
                
                $connection =& $this->getConnection();
                $result =& $do->store($connection);
                
                if ( @@is_a('DBError', $result) ||
                        @@is_subclass_of('DBError', $result ) )
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
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        $this->removeSubproducts();
                        $this->removeImages();
                        $this->removeGlobalAttributes();
                        $this->removeTypeAttributes();
                        $this->removeFromCategories();
                }
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
        }
        
        
        function removeSubproducts ()
        {
                $subproducts =& $this->getSubproducts();
                foreach ( array_keys($subproducts) as $index )
                {
                        $subproduct =& $subproducts[$index];
                        $subproduct->remove();
                }
        }
        
        
        function removeImages ()
        {
                $images =& $this->getImages();
                if ( !is_null($images) )
                {
                        $images->remove();
                }
        }
        
        
        function removeGlobalAttributes ()
        {
                $globalGroups =& $this->getProductGlobalAttributeGroups();
                foreach ( array_keys($globalGroups) as $index )
                {
                        $group =& $globalGroups[$index];
                        $group->remove();
                }
        }
        
        
        function removeTypeAttributes ()
        {
                $typeGroups =& $this->getProductTypeAttributeGroups();
                
                if ( is_null($typeGroups) )
                {
                        return;
                }
                
                foreach ( array_keys($typeGroups) as $index )
                {
                        $group =& $typeGroups[$index];
                        $group->remove();
                }
        }
        
        
        function removeFromCategories ()
        {
                ProductCategory::RemoveProductFromAllCategories(
                        $this, $this->getConnection()
                        );
        }
        
        
        function &getType ()
        {
                return ProductType::findFirst(
                        array('id' => $this->getTypeId()),
                        $this->getConnection() );
        }
        
        
        function &getAttributeGroups ()
        {
                $groups = array();
                
                $globalGroups = & $this->getProductGlobalAttributeGroups();
                foreach ( array_keys($globalGroups) as $index )
                {
                        $groups[] =& $globalGroups[$index];
                }
                
                
                $typeGroups = & $this->getProductTypeAttributeGroups();
                foreach ( array_keys($typeGroups) as $index )
                {
                        $groups[] =& $typeGroups[$index];
                }
                
                
                /*
                $localGroups = & $this->getProductSpecificAttributeGroups();
                foreach ( array_keys($localGroups) as $index )
                {
                        $groups[] =& $localGroups[$index];
                }
                */
                
                return $groups;
        }
        
        
        function &getProductGlobalAttributeGroups ()
        {
                return ProductGlobalAttributeGroup::getGroups(
                        $this, $this->getConnection() );
        }
        
        
        function &getProductTypeAttributeGroups ()
        {
                $type =& $this->getType();
                
                if ( is_null($type) )
                {
                        return NULL;
                }
                
                return ProductTypeAttributeGroup::getGroups(
                        $this, $type, $this->getConnection() );
        }
        
        
        function &getProductSpecificAttributeGroups ()
        {
                return ProductSpecificAttributeGroup::findForProduct(
                        $this, $this->getConnection() );
        }
        
        
        function getProductAttributeGroupWithName ( $name )
        {
                $groups =& $this->getAttributeGroups();
                
                foreach ( array_keys($groups) as $key )
                {
                        $group =& $groups[$key];
                        if ( $group->getName() == $name )
                        {
                                return $group;
                        }
                }
                
                return NULL;
        }
        
        
        function getProductGlobalAttributeGroupWithName ( $name )
        {
                $groups =& $this->getProductGlobalAttributeGroups();
                
                foreach ( array_keys($groups) as $key )
                {
                        $group =& $groups[$key];
                        if ( $group->getName() == $name )
                        {
                                return $group;
                        }
                }
                
                return NULL;
        }
        
        
        function getProductTypeAttributeGroupWithName ( $name )
        {
                $groups =& $this->getProductTypeAttributeGroups();
                
                foreach ( array_keys($groups) as $key )
                {
                        $group =& $groups[$key];
                        if ( $group->getName() == $name )
                        {
                                return $group;
                        }
                }
                
                return NULL;
        }
        
        
        function getProductSpecificAttributeGroupWithName ( $name )
        {
                $groups =& $this->getProductSpecificAttributeGroups();
                
                foreach ( array_keys($groups) as $key )
                {
                        $group =& $groups[$key];
                        if ( $group->getName() == $name )
                        {
                                return $group;
                        }
                }
                
                return NULL;
        }
        
        
        function isVatExempt ()
        {
                if ( $this->getVatStatus() == $this->PRODUCT_IS_VAT_EXEMPT() )
                {
                        return TRUE;
                }
                return FALSE;
        }
        
        
        function priceExVat ()
        {
                if ( $this->getVatStatus() ==
                        $this->PRICE_IS_VAT_EXCLUSIVE() || 
                        $this->getVatStatus() ==
                        $this->PRODUCT_IS_VAT_EXEMPT() )
                {
                        return $this->getPrice();
                }
                else
                {
                        return round($this->getPrice() * (40/47), 2);
                }
        }
        
        
        function priceIncVat ()
        {
                if ( $this->getVatStatus() ==
                        $this->PRICE_IS_VAT_INCLUSIVE() ||
                        $this->getVatStatus() ==
                        $this->PRODUCT_IS_VAT_EXEMPT() )
                {
                        return $this->getPrice();
                }
                else
                {
                        return round($this->getPrice() * $this->VAT_RATE(), 2);
                }
        }
        
        
        function formattedPrice ()
        {
                if ( $this->getVatStatus() ==
                        $this->PRICE_IS_VAT_INCLUSIVE() )
                {
                        return sprintf('%.02f', $this->priceIncVat()/100);
                }
                elseif ( $this->getVatStatus() ==
                        $this->PRICE_IS_VAT_EXCLUSIVE() )
                {
                        return sprintf('%.02f', $this->priceExVat()/100);
                }
                elseif ( $this->getVatStatus() ==
                        $this->PRODUCT_IS_VAT_EXEMPT() )
                {
                        return sprintf('%.02f', $this->priceExVat()/100);
                }
                else
                {
                        return sprintf('%.02f', $this->priceExVat()/100);
                }
        }
        
        
        function formattedPriceExVat ()
        {
                return sprintf('%.02f', $this->priceExVat()/100);
        }
        
        
        function formattedPriceIncVat ()
        {
                return sprintf('%.02f', $this->priceIncVat()/100);
        }
        
        
        function &getImages ()
        {
                return ProductImages::findFirst(
                        array('product_id' => $this->getId()),
                        $this->getConnection());
        }
        
        
        function getThumbnail ()
        {
                $images =& $this->getImages();
                if ( is_null($images) )
                {
                        return '';
                }
                
                return $images->getBrowserThumbnailImage();
        }
        
        
        function getProductDetailsPageImage ()
        {
                $images =& $this->getImages();
                if ( is_null($images) )
                {
                        return '';
                }
                
                return $images->getProductDetailsPageImage();
        }
        
        
        function getProductBasketImage ()
        {
                $images =& $this->getImages();
                if ( is_null($images) )
                {
                        return '';
                }
                
                return $images->getBasketImage();
        }
        
        
        function getFullsizeImage ()
        {
                $images =& $this->getImages();
                if ( is_null($images) )
                {
                        return '';
                }
                
                return $images->getProductImage();
        }
        
        
        function getCategories ()
        {
                $sql = 'FROM product_category, product_category_link' .
                        ' WHERE product_category.id = product_category_link.category_id' .
                        ' AND product_category_link.product_id = ' . $this->getId();
                
                return ProductCategory::find($sql, $this->getConnection());
        }
        
        
        function &getParentProduct ()
        {
                return Product::findFirst(
                        array('id' => $this->getParentId()),
                        $this->getConnection()
                        );
        }
        
        
        function &getSubproducts ()
        {
                return Product::find(
                        array('parent_id' => $this->getId()),
                        $this->getConnection()
                        );
        }
        
        
        function &getSubproductsOnSale ()
        {
                return Product::find(
                        array('parent_id' => $this->getId(),
                                'on_sale' => 1),
                        $this->getConnection()
                        );
        }
        
        
        function isSpecialOffer ()
        {
                $DO_CLASS =& new ProductSpecialOffersDataObject();
                $specialOffer =& $DO_CLASS->lookup(
                        array('product_id' => $this->getId()),
                        $this->getConnection());
                
                if ( is_null($specialOffer) )
                {
                        return FALSE;
                }
                
                if ( Exception::isException($specialOffer) )
                {
                        return $specialOffer;
                }
                
                return TRUE;
        }
        
        
        function setSpecialOffer ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $DO_CLASS =& new ProductSpecialOffersDataObject();
                        $specialOffer =& $DO_CLASS->lookup(
                                array('product_id' => $this->getId()),
                                $this->getConnection());
                        
                        if ( Exception::isException($specialOffer) )
                        {
                                return $specialOffer;
                        }
                        
                        if ( Object::isInstanceOf($specialOffer,
                                'ProductSpecialOffersDataObject') )
                        {
                                return TRUE;
                        }
                        
                        $specialOffer =& new ProductSpecialOffersDataObject();
                        $specialOffer->setConnection($this->getConnection());
                        $specialOffer->setProductId($this->getId());
                        $specialOffer->store();
                        
                        return TRUE;
                }
                
                
                $DO_CLASS =& new ProductSpecialOffersDataObject();
                $specialOffer =& $DO_CLASS->lookup(
                        array('product_id' => $this->getId()),
                        $this->getConnection());
                
                if ( Exception::isException($specialOffer) )
                {
                        return $specialOffer;
                }
                
                if ( Object::isInstanceOf($specialOffer,
                        'ProductSpecialOffersDataObject') )
                {
                        return $specialOffer->delete();
                        return TRUE;
                }
                
                return TRUE;
        }
        
        
        function isFeaturedProduct ()
        {
                $DO_CLASS =& new FeatureProductDataObject();
                $featured =& $DO_CLASS->lookup(
                        array('product_id' => $this->getId()),
                        $this->getConnection());
                
                if ( is_null($featured) )
                {
                        return FALSE;
                }
                
                if ( Exception::isException($featured) )
                {
                        return $featured;
                }
                
                return TRUE;
        }
        
        
        function setFeaturedProduct ( $bool )
        {
                if ( $bool === TRUE || $bool == 1 )
                {
                        $DO_CLASS =& new FeatureProductDataObject();
                        $featured =& $DO_CLASS->lookup(
                                array('product_id' => $this->getId()),
                                $this->getConnection());
                        
                        if ( Exception::isException($featured) )
                        {
                                return $featured;
                        }
                        
                        if ( Object::isInstanceOf($featured,
                                'FeatureProductDataObject') )
                        {
                                return TRUE;
                        }
                        
                        $featured =& new FeatureProductDataObject();
                        $featured->setConnection($this->getConnection());
                        $featured->setProductId($this->getId());
                        $featured->store();
                        
                        return TRUE;
                }
                
                
                $DO_CLASS =& new FeatureProductDataObject();
                $featured =& $DO_CLASS->lookup(
                        array('product_id' => $this->getId()),
                        $this->getConnection());
                
                if ( Exception::isException($featured) )
                {
                        return $featured;
                }
                
                if ( Object::isInstanceOf($featured,
                        'FeatureProductDataObject') )
                {
                        return $featured->delete();
                        return TRUE;
                }
                
                return TRUE;
        }
        
        function getSuggestedProductLinks ( )
        {
                  $productLinks =& ProductSuggested::find(
                          array('productid' => $this->getId()),
                          $this->getConnection());
                          
                  return $productLinks;
        }
        
        
        function &getSuggestedProducts ()
        {
                  $productLinks =& ProductSuggested::find(
                          array('productid' => $this->getId()),
                          $this->getConnection());
                  
                  if ( is_null($productLinks) )
                  {
                        return false;
                  }
                  
                  $products = array();
                  
                  foreach ( $productLinks as $productLink )
                  {
                        $products[] =& Product::findFirst(
                                array('id' => $productLink->getSuggestedProductId()),
                                $this->getConnection());
                  }
                  
                  return $products;
        }
        
        function &getProductFiles ( )
        {
                  $productFiles =& ProductFile::find(
                          array('product_id' => $this->getId()),
                          $this->getConnection());
                  
                  if ( is_null($productFiles) )
                  {
                        return false;
                  }
                  
                  return $productFiles;
        }
        
        
        function isSuggestedProductsOnSale ( )
        {
                  $productLinks =& ProductSuggested::find(
                          array('productid' => $this->getId()),
                          $this->getConnection());
                  
                  if ( is_null($productLinks) )
                  {
                        return false;
                  }
                                    
                  foreach ( $productLinks as $productLink )
                  {
                        $product =& Product::findFirst(
                                array('id' => $productLink->getSuggestedProductId()),
                                $this->getConnection());
                        
                        if ( !is_null($product) )
                        {
                              if ( $product->getOnSale() == true )
                              {
                                    return true;
                              }
                        }
                        
                  }
                  
                  return false;
        }
        
        
        function &copyToProduct ( $attributes, $copyAttributes = TRUE,
                $copySubproducts = TRUE )
        {
                $type =& $this->getType();
                
                $newProduct =& new Product();
                $newProduct->setName($attributes['name']);
                $newProduct->setTypeId($type->getId());
                $newProduct->setCode($attributes['code']);
                $newProduct->setPrice($attributes['price']);
                $newProduct->setVatStatus($attributes['vatStatus']);
                $newProduct->setDescription($attributes['description']);
                $newProduct->setDateTimeAdded($attributes['dateTimeAdded']);
                $newProduct->setConnection($this->getConnection());
                $newProduct->commit();
                
                if ( $copyAttributes )
                {
                        $productAttributeGroups =&
                                $this->getAttributeGroups();
                        $newProductAttributeGroups =&
                                $newProduct->getAttributeGroups();
                        
                        foreach ( array_keys($productAttributeGroups)
                                as $productAttributeGroupsKey)
                        {
                                $productAttributeGroup =&
                                        $productAttributeGroups[
                                        $productAttributeGroupsKey];
                                
                                foreach ( array_keys($newProductAttributeGroups)
                                        as $newProductAttributeGroupsKey)
                                {
                                        $newProductAttributeGroup =&
                                                $newProductAttributeGroups[
                                                $newProductAttributeGroupsKey];
                                        if ( $productAttributeGroup->getId() ==
                                                $newProductAttributeGroup->getId() )
                                        {
                                                $productAttributeGroupAttributes =&
                                                        $productAttributeGroup->getAttributes();
                                                $newProductAttributeGroupAttributes =&
                                                        $newProductAttributeGroup->getAttributes();
                                                
                                                foreach ( array_keys($productAttributeGroupAttributes)
                                                        as $productAttributeGroupAttributesKey)
                                                {
                                                        $productAttributeGroupAttribute =&
                                                                $productAttributeGroupAttributes[$productAttributeGroupAttributesKey];
                                                        
                                                        foreach ( array_keys($newProductAttributeGroupAttributes)
                                                                as $newProductAttributeGroupAttributesKey)
                                                        {
                                                                $newProductAttributeGroupAttribute =&
                                                                        $newProductAttributeGroupAttributes[
                                                                        $newProductAttributeGroupAttributesKey];
                                                                if ( $productAttributeGroupAttribute->getAttributeId() ==
                                                                        $newProductAttributeGroupAttribute->getAttributeId() )
                                                                {
                                                                        $newProductAttributeGroupAttribute->setValue(
                                                                                $productAttributeGroupAttribute->getValue());
                                                                        $newProductAttributeGroupAttribute->commit();
                                                                }
                                                        }
                                                }
                                        }
                                }
                        }
                }
                
                
                if ( $copySubproducts )
                {
                        $subproducts =& $this->getSubproducts();
                        foreach ( array_keys($subproducts) as 
                                $subproductsKey )
                        {
                                $subproduct =&
                                        $subproducts[$subproductsKey];
                                $newProduct->createSubproductFromSubproduct(
                                        $subproduct);
                        }
                }
                
                
                return $newProduct;
        }
        
        
        function &createSubproductFromSubproduct ( &$subproduct )
        {
                $type =& $this->getType();
                
                $newSubproduct =& new Product();
                $newSubproduct->setName($subproduct->getName());
                $newSubproduct->setTypeId($type->getId());
                $newSubproduct->setCode($subproduct->getCode());
                $newSubproduct->setPrice($subproduct->getPrice());
                $newSubproduct->setVatStatus($subproduct->getVatStatus());
                $newSubproduct->setDescription($subproduct->getDescription());
                $newSubproduct->setDateTimeAdded($subproduct->getDateTimeAdded());
                $newSubproduct->setParentId($subproduct->getParentId());
                $newSubproduct->setConnection($this->getConnection());
                $newSubproduct->commit();
                
                $subproductAttributeGroups =&
                        $this->getAttributeGroups();
                $newSubproductAttributeGroups =&
                        $newSubproduct->getAttributeGroups();
                
                foreach ( array_keys($subproductAttributeGroups)
                        as $subproductAttributeGroupsKey)
                {
                        $subproductAttributeGroup =&
                                $subproductAttributeGroups[
                                $subproductAttributeGroupsKey];
                        
                        foreach ( array_keys($newSubproductAttributeGroups)
                                as $newSubproductAttributeGroupsKey)
                        {
                                $newSubproductAttributeGroup =&
                                        $newSubproductAttributeGroups[
                                        $newSubproductAttributeGroupsKey];
                                if ( $subproductAttributeGroup->getId() ==
                                        $newSubproductAttributeGroup->getId() )
                                {
                                        $subproductAttributeGroupAttributes =&
                                                $subproductAttributeGroup->getAttributes();
                                        $newSubproductAttributeGroupAttributes =&
                                                $newSubproductAttributeGroup->getAttributes();
                                        
                                        foreach ( array_keys($subproductAttributeGroupAttributes)
                                                as $subproductAttributeGroupAttributesKey)
                                        {
                                                $subproductAttributeGroupAttribute =&
                                                        $subproductAttributeGroupAttributes[$subproductAttributeGroupAttributesKey];
                                                
                                                foreach ( array_keys($newSubproductAttributeGroupAttributes)
                                                        as $newSubproductAttributeGroupAttributesKey)
                                                {
                                                        $newSubproductAttributeGroupAttribute =&
                                                                $newSubproductAttributeGroupAttributes[
                                                                $newSubproductAttributeGroupAttributesKey];
                                                        if ( $subproductAttributeGroupAttribute->getAttributeId() ==
                                                                $newSubproductAttributeGroupAttribute->getAttributeId() )
                                                        {
                                                                $newSubproductAttributeGroupAttribute->setValue(
                                                                        $subproductAttributeGroupAttribute->getValue());
                                                                $newSubproductAttributeGroupAttribute->commit();
                                                        }
                                                }
                                        }
                                }
                        }
                }
                
                return $newSubproduct;
        }
        
        
        function &copyToSubproduct ( $attributes, $copyAttributes = TRUE )
        {
                if ( is_null($this->getParentId()) )
                {
                        return FALSE;
                }
                
                $type =& $this->getType();
                
                $newSubproduct =& new Product();
                $newSubproduct->setName($attributes['name']);
                $newSubproduct->setTypeId($type->getId());
                $newSubproduct->setCode($attributes['code']);
                $newSubproduct->setPrice($attributes['price']);
                $newSubproduct->setVatStatus($attributes['vatStatus']);
                $newSubproduct->setDescription($attributes['description']);
                $newSubproduct->setDateTimeAdded($attributes['dateTimeAdded']);
                $newSubproduct->setParentId($attributes['parentId']);
                $newSubproduct->setConnection($this->getConnection());
                $newSubproduct->commit();
                
                if ( !$copyAttributes )
                {
                        return $newSubproduct;
                }
                
                $subproductAttributeGroups =&
                        $this->getAttributeGroups();
                $newSubproductAttributeGroups =&
                        $newSubproduct->getAttributeGroups();
                
                foreach ( array_keys($subproductAttributeGroups)
                        as $subproductAttributeGroupsKey)
                {
                        $subproductAttributeGroup =&
                                $subproductAttributeGroups[
                                $subproductAttributeGroupsKey];
                        
                        foreach ( array_keys($newSubproductAttributeGroups)
                                as $newSubproductAttributeGroupsKey)
                        {
                                $newSubproductAttributeGroup =&
                                        $newSubproductAttributeGroups[
                                        $newSubproductAttributeGroupsKey];
                                if ( $subproductAttributeGroup->getId() ==
                                        $newSubproductAttributeGroup->getId() )
                                {
                                        $subproductAttributeGroupAttributes =&
                                                $subproductAttributeGroup->getAttributes();
                                        $newSubproductAttributeGroupAttributes =&
                                                $newSubproductAttributeGroup->getAttributes();
                                        
                                        foreach ( array_keys($subproductAttributeGroupAttributes)
                                                as $subproductAttributeGroupAttributesKey)
                                        {
                                                $subproductAttributeGroupAttribute =&
                                                        $subproductAttributeGroupAttributes[$subproductAttributeGroupAttributesKey];
                                                
                                                foreach ( array_keys($newSubproductAttributeGroupAttributes)
                                                        as $newSubproductAttributeGroupAttributesKey)
                                                {
                                                        $newSubproductAttributeGroupAttribute =&
                                                                $newSubproductAttributeGroupAttributes[
                                                                $newSubproductAttributeGroupAttributesKey];
                                                        if ( $subproductAttributeGroupAttribute->getAttributeId() ==
                                                                $newSubproductAttributeGroupAttribute->getAttributeId() )
                                                        {
                                                                $newSubproductAttributeGroupAttribute->setValue(
                                                                        $subproductAttributeGroupAttribute->getValue());
                                                                $newSubproductAttributeGroupAttribute->commit();
                                                        }
                                                }
                                        }
                                }
                        }
                }
                
                return $newSubproduct;
        }
}

?>
