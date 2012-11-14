<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-23
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/Product.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductCategoryDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/ProductCategoryLinkDataObject.class.php');

class ProductCategory extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function FIRST_LEFT () { return 1; }
        
        
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
        
        
        function ProductCategory ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_ProductCategory'.$numArgs),
                        $args);
        }
        
        
        function _ProductCategory0 ()
        {
                $this->_initialise();
                $do =& new ProductCategoryDataObject();
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
        
        
        function getImage ()
        {
                return $this->cachedDataObject->getImage();
        }
        
        
        function setImage ( $image )
        {
                $this->cachedDataObject->setImage($image);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getIndex ()
        {
                return $this->cachedDataObject->getIndex();
        }
        
        
        function setIndex ( $index )
        {
                $this->cachedDataObject->setIndex($index);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getParentId ()
        {
                return $this->cachedDataObject->getParentId();
        }
        
        
        function setParentId ( $parentId )
        {
                $this->cachedDataObject->setParentId($parentId);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getLeft ()
        {
                return $this->cachedDataObject->getLeft();
        }
        
        
        function setLeft ( $left )
        {
                $this->cachedDataObject->setLeft($left);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getRight ()
        {
                return $this->cachedDataObject->getRight();
        }
        
        
        function setRight ( $right )
        {
                $this->cachedDataObject->setRight($right);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new ProductCategoryDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $categories = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $category =& new ProductCategory();
                        $category->setConnection($connection);
                        $category->_setCachedDataObject($do);
                        $categories[] =& $category;
                }
                
                return $categories;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new ProductCategoryDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $category =& new ProductCategory();
                $category->setConnection($connection);
                $category->_setCachedDataObject($do);
                
                return $category;
        }
        
        
        function IsEmptyTree ( &$connection )
        {
                $sql = 'SELECT COUNT(*) FROM product_category';
                $rowset = $connection->select($sql);
                $rowset->first();
                $row =& $rowset->getRowArray();
                
                $count = $row[0];
                
                return $count == 0;
        }
        
        
        function &getRootCategories ( &$connection )
        {
                $sql = 'WHERE ISNULL(parent_id) ORDER BY lft';
                
                return ProductCategory::find($sql, $connection);
        }
        
        
        function AddRootCategoryAtStart ( &$newCategory, &$connection )
        {
                ;
        }
        
        
        function AddRootCategoryAtEnd ( &$newCategory, &$connection )
        {
                if ( ProductCategory::IsEmptyTree($connection) )
                {
                        return ProductCategory::_AddRootToEmptyTree(
                                $newCategory, $connection
                                );
                }
                
                $roots =& ProductCategory::getRootCategories($connection);
                $lastRoot =& end($roots);
                
                $newCategory->setParentId(NULL);
                $newCategory->setLeft($lastRoot->getRight() + 1);
                $newCategory->setRight($lastRoot->getRight() + 2);
                $newCategory->setConnection($connection);
                $newCategory->commit();
                
                return TRUE;
        }
        
        
        function AddRootCategoryAtPosition ( &$newCategory, $position,
                &$connection )
        {
                ;
        }
        
        
        function _AddRootToEmptyTree ( &$category, &$connection )
        {
                $category->setParentId(NULL);
                $category->setLeft(ProductCategory::FIRST_LEFT());
                $category->setRight(ProductCategory::FIRST_LEFT()+1);
                $category->setConnection($connection);
                $category->commit();
                
                return TRUE;
        }
        
        
        function RemoveRootCategoryAtStart ( &$category )
        {
                ;
        }
        
        
        function RemoveRootCategoryAtEnd ( &$category )
        {
                ;
        }
        
        
        function RemoveRootCategoryAtPosition ( &$category, $position )
        {
                ;
        }
        
        
        function RemoveRootCategory ( &$category )
        {
                ;
        }
        
        
        function RemoveProductFromAllCategories ( &$product, &$connection )
        {
                $DO_CLASS =& new ProductCategoryLinkDataObject();
                $links =& $DO_CLASS->lookupArray(
                        array('product_id' => $product->getId()),
                        $connection
                        );
                
                if ( is_array($links) )
                {
                        foreach ( array_keys($links) as $index )
                        {
                                $link =& $links[$index];
                                $link->delete();
                        }
                        return TRUE;
                }
                
                return FALSE;
        }
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function commit ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commitCategoryDetails();
                }
                
                return TRUE;
        }
        
        
        function _commitCategoryDetails ()
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
                
                $connection =& $this->getConnection();
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        $this->removeChildCategories();
                        $this->removeAllProducts();
                        $this->recache();
                }
                
                
                
                if ( $this->isRootCategory() )
                {
                        $this->cachedDataObject->delete($connection);
                        
                        $sql = 'UPDATE product_category ' .
                        'SET lft = lft - 2, rgt = rgt - 2 ' .
                        'WHERE lft > ' . $this->getRight();
                        $res = $connection->update($sql);
                }
                else
                {
                        $this->cachedDataObject->delete($connection);
                        
                        $sql = 'UPDATE product_category ' .
                        'SET lft = lft - 2 ' .
                        'WHERE lft > ' . $this->getRight();
                        $res = $connection->update($sql);
                        
                        $sql = 'UPDATE product_category ' .
                        'SET rgt = rgt - 2 ' .
                        'WHERE rgt > ' . $this->getRight();
                        $res = $connection->update($sql);
                }
                
                return TRUE;
        }
        
        
        function removeChildCategories ()
        {
                $subcategories =& $this->getChildCategories();
                foreach ( array_keys($subcategories) as $index )
                {
                        $subcategories[$index]->remove();
                }
                
                return TRUE;
        }
        
        
        function isRootCategory ()
        {
                return $this->getParentId() == NULL;
        }
        
        
        function &getChildCategories ()
        {
                $sql = 'WHERE parent_id = ' . $this->getId() .
                        ' ORDER BY lft';
                
                return ProductCategory::find(
                        $sql, $this->getConnection() );
        }
        
        function getChildCategoryCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE parent_id = %s',
                        ProductCategoryDataObject::TABLE(),
                        $this->getId());
                $connection =& $this->getConnection();
                $result =& $connection->execute($sql);
                if ( is_null($result) )
                {
                        return 0;
                }
                elseif ( @@is_a($result, 'DBError') ||
                        @@is_subclass_of($result, 'DBError') )
                {
                        return $result;
                }
                
                $result->first();
                $row =& $result->getRowArray();
                
                if ( is_null($row) || !is_array($row) )
                {
                        return 0;
                }
                
                return $row[0];
        }
        
        
        function countChildCategories ()
        {
                return $this->getChildCategoryCount();
        }
        
        
        function &getSubcategories ()
        {
                $sql = 'WHERE parent_id = ' . $this->getId() .
                        ' ORDER BY lft';
                
                return ProductCategory::find(
                        $sql, $this->getConnection() );
        }
        
        
        function isEmpty ()
        {
                return $this->getSubcategoryCount() == 0;
        }
        
        
        function getSubcategoryCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE parent_id = %s',
                        ProductCategoryDataObject::TABLE(),
                        $this->getId());
                $connection =& $this->getConnection();
                $result =& $connection->execute($sql);
                if ( is_null($result) )
                {
                        return 0;
                }
                elseif ( @@is_a($result, 'DBError') ||
                        @@is_subclass_of($result, 'DBError') )
                {
                        return $result;
                }
                
                $result->first();
                $row =& $result->getRowArray();
                
                if ( is_null($row) || !is_array($row) )
                {
                        return 0;
                }
                
                return $row[0];
        }
        
        
        function addSubcategoryAtStart ( &$category )
        {
                ;
        }
        
        
        function addSubcategoryAtEnd ( &$category )
        {
                if ( $this->isEmpty() )
                {
                        return $this->_addSubcategoryToEmptyCategory(
                                $category );
                }
                
                $parent =& $this;
                $lastchild =& $this->getLastChildCategory();
                $connection =& $this->getConnection();
                
                $sql = 'UPDATE product_category ' .
                        'SET rgt = rgt + 2 ' .
                        'WHERE rgt > ' . $lastchild->getRight();
                $res = $connection->update($sql);
                
                
                $sql = 'UPDATE product_category ' .
                        'SET lft = lft + 2 '.
                        'WHERE lft > ' . $lastchild->getRight();
                $res = $connection->update($sql);
                
                $category->setParentId($parent->getId());
                $category->setLeft($lastchild->getRight() + 1);
                $category->setRight($lastchild->getRight() + 2);
                $category->setConnection($connection);
                $category->commit();
                
                return TRUE;
        }
        
        
        function _addSubcategoryToEmptyCategory ( &$category )
        {
                $parent =& $this;
                $connection =& $this->getConnection();
                
                $sql = 'UPDATE product_category ' .
                        'SET rgt = rgt + 2 ' .
                        'WHERE rgt >= ' . $parent->getRight();
                $res = $connection->update($sql);
                
                
                $sql = 'UPDATE product_category ' .
                        'SET lft = lft + 2 ' .
                        'WHERE lft > ' . $parent->getRight();
                $res = $connection->update($sql);
                
                $category->setParentId($parent->getId());
                $category->setLeft($parent->getLeft() + 1);
                $category->setRight($parent->getLeft() + 2);
                $category->setConnection($connection);
                $category->commit();
                
                return TRUE;
        }
        
        
        function addSubcategoryAtPosition ( &$newCategory, $position )
        {
                if ( $pos > $this->getSubcategoryCount() )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Make space for new category
                $sql = 'UPDATE product_category SET idx = idx + 1' .
                        ' WHERE parent_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newCategory->setIndex($pos);
                $newCategory->setParentId($this->getId());
                $newCategory->setConnection($connection);
                $newCategory->commit();
                
                return TRUE;
        }
        
        
        function &getProducts ()
        {
                $sql = sprintf('FROM product, product_category_link ' .
                'WHERE product.id = product_category_link.product_id ' .
                'AND product_category_link.category_id = %s ' .
                'ORDER BY product.name',
                $this->getId()
                );
                
                $products =& Product::find($sql, $this->getConnection());
                
                return $products;
        }
        
        
        function &getProductsOnSale ()
        {
                $sql = sprintf('FROM product, product_category_link ' .
                'WHERE product.id = product_category_link.product_id ' .
                'AND product_category_link.category_id = %s ' .
                'AND product.on_sale = 1 ' .
                'ORDER BY product.name',
                $this->getId()
                );
                
                $products =& Product::find($sql, $this->getConnection());
                
                return $products;
        }
        
        
        function getProductCount ()
        {
                ;
        }
        
        
        function addProduct ( $product )
        {
                $DO_CLASS =& new ProductCategoryLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('product_id' => $product->getId(),
                                'category_id' => $this->getId()),
                        $this->getConnection()
                        );
                
                if ( @@is_a($link, 'ProductCategoryLinkDataObject') )
                {
                        return;
                }
                
                $link =& new ProductCategoryLinkDataObject();
                $link->setProductId($product->getId());
                $link->setCategoryId($this->getId());
                $link->store($this->getConnection());
                
                return;
        }
        
        
        function removeProduct ( $product )
        {
                $DO_CLASS =& new ProductCategoryLinkDataObject();
                $link =& $DO_CLASS->lookup(
                        array('product_id' => $product->getId(),
                                'category_id' => $this->getId()),
                        $this->getConnection()
                        );
                
                if ( @@is_a($link, 'ProductCategoryLinkDataObject') )
                {
                        $link->delete();
                        return ;
                }
                
                return ;
        }
        
        
        function removeAllProducts ()
        {
                $sql = 'DELETE FROM product_category_link ' .
                        'WHERE category_id = ' . $this->getId();
                $connection =& $this->getConnection();
                $res =& $connection->delete($sql);
                
                return TRUE;
        }
        
        
        function &getParentCategory ()
        {
                return ProductCategory::findFirst(
                        array('id' => $this->getParentId()),
                        $this->getConnection()
                        );
        }
        
        
        function &getAncestorCategories ()
        {
                $ancestors = array();
                
                $sql = sprintf('WHERE lft < %s AND rgt > %s ORDER BY lft',
                        $this->getLeft(),
                        $this->getRight() );
                $ancestors =& ProductCategory::find(
                        $sql,
                        $this->getConnection()
                        );
                
                return $ancestors;
        }
        
        
        function &getAncestorCategoriesOldestFirst ()
        {
                return array_reverse($this->getAncestorCategories());
        }
        
        
        function hasDescendant ( &$category )
        {
                if ( !is_object($category) )
                {
                        return FALSE;
                }
                
                $ancestors =& $category->getAncestorCategories();
                
                foreach ( $ancestors as $ancestor )
                {
                        if ( $ancestor->getId() == $this->getId() )
                        {
                                return TRUE;
                        }
                }
                
                return FALSE;
        }
        
        
        function &getFirstChildCategory ()
        {
                $subcategories =& $this->getSubcategories();
                if ( count($subcategories) == 0 )
                {
                        return NULL;
                }
                
                return $subcategories[0];
        }
        
        
        function &getLastChildCategory ()
        {
                $subcategories =& $this->getSubcategories();
                if ( count($subcategories) == 0 )
                {
                        return NULL;
                }
                $reversed = array_reverse($subcategories);
                
                return $reversed[0];
        }
        
        
        function recache ()
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getId()),
                        $this->getConnection()
                        );
                $this->setLeft($category->getLeft());
                $this->setRight($category->getRight());
                $this->setParentId($category->getParentId());
        }
}

?>
