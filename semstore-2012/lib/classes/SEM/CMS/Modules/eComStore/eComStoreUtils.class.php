<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-10
 * @package SEM.CMS.Modules.eComStore.
 */

require_once('SEMObject.class.php');

require_once('Net/Ftp.class.php');

require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalProductAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalProductAttribute.class.php');

class eComStoreUtils extends SEMObject
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
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function eComStoreUtils ()
        {
                die("Class 'eComStoreUtils' is abstract and cannot be instantiated");
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &categoryId2Category ( $categoryId, &$connection )
        {
                return ProductCategory::findFirst(
                        array('id' => $categoryId),
                        $connection);
        }
        
        
        function &typeId2Type ( $typeId, &$connection )
        {
                return ProductType::findFirst(
                        array('id' => $typeId),
                        $connection);
        }
        
        
        /*
        function &subtypeId2Subtype ( $subtypeId, &$connection )
        {
                return ProductSubtype::findFirst(
                        array('id' => $subtypeId),
                        $connection);
        }
        */
        
        
        function &productId2Product ( $productId, &$connection )
        {
                return Product::findFirst(
                        array('id' => $productId),
                        $connection);
        }
        
        
        function &findProductGlobalAttributeGroups ( &$connection )
        {
                $sql = 'ORDER BY idx';
                return ProductGlobalProductAttributeGroup::find(
                        $sql, $connection );
        }
        
        
        function &findProductTypes ( &$connection )
        {
                $sql = 'ORDER BY name';
                return ProductType::find(
                        $sql, $connection );
        }
        
        
        function &randomProductSelection ( $connection = NULL,
                $categories = NULL, $types = NULL,
                $sortBy = NULL, $sortType = NULL,
                $start = NULL, $limit = NULL,
                $dedupe = TRUE, $includeSubproducts = FALSE,
                $onlyProductsOnSale = TRUE )
        {
                $sql = '';
                
                if ( $dedupe )
                {
                        $sql .= 'SELECT DISTINCT(product.id) ';
                }
                else
                {
                        $sql .= 'SELECT product.id ';
                }
                
                $sql .= 'FROM product';
                if ( !is_null($categories) )
                {
                        $sql .= ', product_category_link, product_category';
                }
                
                if ( !is_null($types) )
                {
                        $sql .= ', product_type';
                }
                
                
                $sql .= ' WHERE';
                $firstClause = TRUE;
                
                if ( is_array($categories) && $count($categories) > 1 )
                {
                        $categoryConstraints = array();
                        foreach ( array_keys($categories) as $categoryId )
                        {
                                $category =& $categories[$categoryId];
                                $categoryConstraints []=
                                        ' product_category.lft >= ' . $category->getLeft() .
                                        ' AND product_category.rgt <= ' . $category->getRight();
                        }
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND (';
                        }
                        else
                        {
                                $sql .= ' (';
                                $firstClause = FALSE;
                        }
                        
                        $sql .= join(' OR ', $categoryConstraints) . ' )';
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_array($categories) == 1 )
                {
                        $category =& $categories[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_object($categories) )
                {
                        $category =& $categories;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                
                if ( is_array($types) > 1 )
                {
                        ;
                }
                elseif ( is_array($types) == 1 )
                {
                        $type = $types[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                elseif ( is_object($types) )
                {
                        $type = $types;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                
                
                if ( !$includeSubproducts )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' ISNULL(product.parent_id)';
                }
                
                
                if ( $onlyProductsOnSale )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.on_sale = 1';
                }
                
                
                if ( !is_null($sortBy) )
                {
                        $sql .= ' ORDER BY ' . $sortBy . ' ' . $sortType;
                }
                
                
                if ( !is_null($limit) )
                {
                        if ( is_null($start) )
                        {
                                $sql .= ' LIMIT ' . $limit;
                        }
                        else
                        {
                                $sql .= ' LIMIT ' . $start . ', ' . $limit;
                        }
                }
                
                
                //print $sql;
                
                $res =& $connection->select($sql);
                if ( @is_a($res, 'DBError') || @is_subclass_of($res, 'DBError') )
                {
                        die($res->toString());
                }
                
                $products = array();
                while ( $res->next() )
                {
                        $row = $res->getRowArray();
                        $product =& Product::findFirst(
                                array('id' => $row[0]),
                                $connection);
                        $products[] =& $product;
                }
                
                $res->free();
                
                return $products;
        }
        
        
        function searchForProducts ( $connection = NULL,
                $categories = NULL, $types = NULL,
                $sortBy = NULL, $sortType = NULL,
                $start = NULL, $limit = NULL,
                $qterms = NULL, $dedupe = TRUE, $includeSubproducts = FALSE,
                $onlyProductsOnSale = TRUE )
        {
                $sql = '';
                
                if ( $dedupe )
                {
                        $sql .= 'SELECT DISTINCT(product.id) ';
                }
                else
                {
                        $sql .= 'SELECT product.id ';
                }
                
                $sql .= 'FROM product';
                if ( !is_null($categories) )
                {
                        $sql .= ', product_category_link, product_category';
                }
                
                if ( !is_null($types) )
                {
                        $sql .= ', product_type';
                }
                
                
                $sql .= ' WHERE';
                $firstClause = TRUE;
                
                if ( is_array($categories) && $count($categories) > 1 )
                {
                        $categoryConstraints = array();
                        foreach ( array_keys($categories) as $categoryId )
                        {
                                $category =& $categories[$categoryId];
                                $categoryConstraints []=
                                        ' product_category.lft >= ' . $category->getLeft() .
                                        ' AND product_category.rgt <= ' . $category->getRight();
                        }
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND (';
                        }
                        else
                        {
                                $sql .= ' (';
                                $firstClause = FALSE;
                        }
                        
                        $sql .= join(' OR ', $categoryConstraints) . ' )';
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_array($categories) == 1 )
                {
                        $category =& $categories[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_object($categories) )
                {
                        $category =& $categories;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                
                if ( is_array($types) > 1 )
                {
                        ;
                }
                elseif ( is_array($types) == 1 )
                {
                        $type = $types[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                elseif ( is_object($types) )
                {
                        $type = $types;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                
                
                if ( !$includeSubproducts )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' ISNULL(product.parent_id)';
                }
                
                
                if ( $onlyProductsOnSale )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.on_sale = 1';
                }
                
                
                if ( !is_null($sortBy) )
                {
                        $sql .= ' ORDER BY ' . $sortBy . ' ' . $sortType;
                }
                
                
                if ( !is_null($limit) )
                {
                        if ( is_null($start) )
                        {
                                $sql .= ' LIMIT ' . $limit;
                        }
                        else
                        {
                                $sql .= ' LIMIT ' . $start . ', ' . $limit;
                        }
                }
                
                
                //print $sql;
                $res =& $connection->select($sql);
                if ( @is_a($res, 'DBError') || @is_subclass_of($res, 'DBError') )
                {
                        die($res->toString());
                }
                
                $products = array();
                while ( $res->next() )
                {
                        $row = $res->getRowArray();
                        $product =& Product::findFirst(
                                array('id' => $row[0]),
                                $connection);
                        $products[] =& $product;
                }
                
                $res->free();
                
                return $products;
        }
        
        
        function countSearchForProducts ( $connection = NULL,
                $categories = NULL, $types = NULL,
                $sortBy = NULL, $sortType = NULL,
                $start = NULL, $limit = NULL,
                $qterms = NULL, $dedupe = TRUE, $includeSubproducts = FALSE,
                $onlyProductsOnSale = TRUE )
        {
                $sql = '';
                
                if ( $dedupe )
                {
                        $sql .= 'SELECT COUNT(DISTINCT(product.id)) ';
                }
                else
                {
                        $sql .= 'SELECT COUNT(product.id) ';
                }
                
                $sql .= 'FROM product';
                if ( !is_null($categories) )
                {
                        $sql .= ', product_category_link, product_category';
                }
                
                if ( !is_null($types) )
                {
                        $sql .= ', product_type';
                }
                
                
                $sql .= ' WHERE';
                $firstClause = TRUE;
                
                if ( is_array($categories) && $count($categories) > 1 )
                {
                        $categoryConstraints = array();
                        foreach ( array_keys($categories) as $categoryId )
                        {
                                $category =& $categories[$categoryId];
                                $categoryConstraints []=
                                        ' product_category.lft >= ' . $category->getLeft() .
                                        ' AND product_category.rgt <= ' . $category->getRight();
                        }
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND (';
                        }
                        else
                        {
                                $sql .= ' (';
                                $firstClause = FALSE;
                        }
                        
                        $sql .= join(' OR ', $categoryConstraints) . ' )';
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_array($categories) == 1 )
                {
                        $category =& $categories[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                elseif ( is_object($categories) )
                {
                        $category =& $categories;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight();
                        $sql .= ' AND product_category.id = product_category_link.category_id' .
                                ' AND product_category_link.product_id = product.id';
                }
                
                if ( is_array($types) > 1 )
                {
                        ;
                }
                elseif ( is_array($types) == 1 )
                {
                        $type = $types[0];
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                elseif ( is_object($types) )
                {
                        $type = $types;
                        
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.type_id = ' . $type->getId();
                }
                
                
                if ( !$includeSubproducts )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' ISNULL(product.parent_id)';
                }
                
                
                if ( $onlyProductsOnSale )
                {
                        if ( !$firstClause )
                        {
                                $sql .= ' AND';
                        }
                        else
                        {
                                $firstClause = FALSE;
                        }
                        
                        $sql .= ' product.on_sale = 1';
                }
                
                
                if ( !is_null($sortBy) )
                {
                        $sql .= ' ORDER BY ' . $sortBy . ' ' . $sortType;
                }
                
                
                if ( !is_null($limit) )
                {
                        if ( is_null($start) )
                        {
                                $sql .= ' LIMIT ' . $limit;
                        }
                        else
                        {
                                $sql .= ' LIMIT ' . $start . ', ' . $limit;
                        }
                }
                
                
                //print $sql;
                $res =& $connection->select($sql);
                if ( @is_a($res, 'DBError') || @is_subclass_of($res, 'DBError') )
                {
                        die($res->toString());
                }
                
                if ( !$res->first() )
                {
                        return 0;
                }
                
                $row = $res->getRowArray();
                $count = $row[0];
                $res->free();
                
                return $count;
        }
        
        
        
        
        function &productSearch ( $terms, &$category, $start, $limit,
                $sortField, $sortType, &$connection )
        {
                $sql = '';
                if ( !is_null($category) )
                {
                        $sql = 'FROM product, product_category, product_category_link' .
                                ' WHERE product_category.lft >= ' . $category->getLeft() .
                                ' AND product_category.rgt <= ' . $category->getRight() .
                                ' AND product_category_link.product_id = product.id ' .
                                ' AND ';
						
                        $rules = array();
                        foreach ( $terms as $term )
                        {
                                $rules []= 'product.name LIKE "%'.$term.'%"';
                        }
                        $sql .= join(' AND ', $rules).' OR ';
                        
                        $description_rules = array();
                        foreach ( $terms as $term )
                        {
                                $description_rules []= 'product.description LIKE "%'.$term.'%"';
                        }
                        
                        $sql .= join(' AND ', $description_rules);						
                        if ( isset($sortField ) )
                        {
                                $sql .= ' ORDER BY ' . $sortField;
                                if ( isset($sortType) )
                                {
                                        $sql .= ', ' . $sortType;
                                }
                        }
                        
                        if ( isset($limit) )
                        {
                                if ( isset($start) )
                                {
                                        $sql .= ' LIMIT ' . $start . ', ' . $limit;
                                }
                                else
                                {
                                        $sql .= ' LIMIT ' . $limit;
                                }
                        }
                }
                else
                {
                        $sql = 'FROM product WHERE ';
                        $rules = array();
                        foreach ( $terms as $term )
                        {
                                $rules []= 'product.name LIKE "%'.$term.'%"';
                        }
                        $sql .= join(' AND ', $rules).' OR ';
                        
						
                        $description_rules = array();
                        foreach ( $terms as $term )
                        {
                                $description_rules []= 'product.description LIKE "%'.$term.'%"';
                        }
                        $sql .= join(' AND ', $description_rules);						
					
						
                        if ( isset($sortField ) )
                        {
                                $sql .= ' ORDER BY ' . $sortField;
                                if ( isset($sortType) )
                                {
                                        $sql .= ', ' . $sortType;
                                }
                        }
                        
                        if ( isset($limit) )
                        {
                                if ( isset($start) )
                                {
                                        $sql .= ' LIMIT ' . $start . ', ' . $limit;
                                }
                                else
                                {
                                        $sql .= ' LIMIT ' . $limit;
                                }
                        }
                }
                
                
                //print $sql;
                
                $products =& Product::find($sql, $connection);
                
                //print '<pre>'.print_r($products,TRUE).'</pre>';
                
                return $products;
        }
        
        
        
        
        
        
        
        
        function &getProductCategorySpecialOfferProducts ( $category,
                $start, $limit, $sortField, $sortType )
        {
                return NULL;
        }
        
        
        
        
        
        
        
        
        
        
        
        function &getProductTypeProducts ( $type,
                $start, $limit, $sortField, $sortType, &$connection )
        {
                $products = array();
                
                $sql = 'FROM product, product_subtype ' .
                        'WHERE product.subtype_id = product_subtype.id ';
                
                if ( is_object($type) ) 
                {
                        $sql .= 'AND product_subtype.type_id = ' . $type->getId();
                }
                else
                {
                        $sql .= 'AND product_subtype.type_id = ' . $type;
                }
                
                $sql .= ' AND ISNULL(product.parent_id) ';
                
                if ( isset($limit) )
                {
                        if ( isset($start) )
                        {
                                $sql .= ' LIMIT ' . $limit;
                        }
                        else
                        {
                                $sql .= ' LIMIT ' . $start . ', ' . $limit;
                        }
                }
                
                if ( isset($sortField ) )
                {
                        $sql .= ' ORDER BY ' . $sortField . ', ' . $sortType;
                }
                
                //print $sql;
                
                $products =& Product::find($sql, $connection);
                
                return $products;
        }
        
        
        function &getProductSubtypeProducts ( $subtype,
                $start, $limit, $sortField, $sortType, &$connection )
        {
                $products = array();
                
                $sql = '';
                
                if ( is_object($subtype) )
                {
                        $sql = 'WHERE subtype_id = ' . $subtype->getId();
                }
                else
                {
                        $sql = 'WHERE subtype_id = ' . $subtype;
                }
                
                $sql .= ' AND ISNULL(product.parent_id) ';
                
                if ( isset($limit) )
                {
                        if ( isset($start) )
                        {
                                $sql .= ' LIMIT ' . $limit;
                        }
                        else
                        {
                                $sql .= ' LIMIT ' . $start . ', ' . $limit;
                        }
                }
                
                if ( isset($sortField ) )
                {
                        $sql .= ' ORDER BY ' . $sortField . ', ' . $sortType;
                }
                
                //print $sql;
                
                $products =& Product::find($sql, $connection);
                
                return $products;
        }
        
        
        function parseStringToPence ( $str )
        {
                if ( preg_match('{^[0-9]+$}', $str) > 0 )
                {
                        $pence = $str * 100;
                        return $pence;
                }
                elseif ( preg_match('{^([0-9]+)\.([0-9]{2})$}',
                        $str, $matches) > 0 )
                {
                        $pence = ($matches[1] *100) + $matches[2];
                        return $pence;
                }
                
                return NULL;
        }
        
        
        
        
        
        function simpleXor ( $str, $key )
        {
                $xorstr = '';
                
                $keys = array();
                for ( $i = 0; $i < strlen($key); $i++ )
                {
                        $keys[$i] = substr($key, $i, 1);
                }
                
                
                for( $i = 0; $i < strlen($str); $i++ )
                {
                        $xorStr .= chr(ord(substr($str, $i, 1))
                                ^ ($keys[$i % strlen($key)]));
                }
                
                return $xorStr;
        }
        
        
        function authenticateCustomer ( $email, $password, &$connection )
        {
                $sql = sprintf("SELECT COUNT(*) FROM customer " .
                        "WHERE username = '%s' " . 
                        "AND BINARY password = '%s'",
                        $connection->escapeString($email),
                        $connection->escapeString(md5($password)) );
                
                $result =& $connection->select($sql);
                
                if ( !@is_subclass_of($result, 'DBRowSet') )
                {
                        return $result;
                }
                
                $result->first();
                $row =& $result->getRowArray();
                
                return $row[0] == 1;
        }
        
        
        function &findCustomerWithId ( $id, &$connection )
        {
                return Customer::findFirst(array('id' => $id),
                        $connection);
        }
        
        
        function &findCustomerWithEmail ( $email, &$connection )
        {
               return Customer::findFirst( array('email' => $email),
                        $connection);
        }
        
        
        function &findProductWithName ( $name, &$connection )
        {
                $product =& Product::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $product;
        }
        
        
        function productWithNameExists ( $name, &$connection )
        {
                $product =&
                        eComStoreUtils::findProductWithName($name, $connection);
                
                if ( is_null($product) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function &findProductGlobalAttributeGroupWithName ( $name, &$connection )
        {
                $group =& ProductGlobalProductAttributeGroup::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $group;
        }
        
        
        function productGlobalAttributeGroupWithNameExists ( $name, &$connection )
        {
                $group =&
                        eComStoreUtils::findProductGlobalAttributeGroupWithName(
                                $name, $connection);
                
                if ( is_null($group) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function &findProductGlobalAttributeWithName ( $name, &$connection )
        {
                $attribute =& ProductGlobalProductAttribute::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $attribute;
        }
        
        
        function productGlobalAttributeWithNameExists ( $name, &$connection )
        {
                $attribute =&
                        eComStoreUtils::findProductGlobalAttributeWithName(
                                $name, $connection);
                
                if ( is_null($attribute) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function &findProductTypeWithName ( $name, &$connection )
        {
                $type =& ProductType::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $type;
        }
        
        
        function productTypeWithNameExists ( $name, &$connection )
        {
                $type =&
                        eComStoreUtils::findProductTypeWithName(
                                $name, $connection);
                
                if ( is_null($type) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function &findProductTypeAttributeGroupWithName ( $name, &$connection )
        {
                $group =& ProductTypeProductAttributeGroup::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $group;
        }
        
        
        function productTypeAttributeGroupWithNameExists ( $name, &$connection )
        {
                $group =&
                        eComStoreUtils::findProductTypeAttributeGroupWithName(
                                $name, $connection);
                
                if ( is_null($group) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        function &findProductTypeAttributeWithName ( $name, &$connection )
        {
                $attribute =& ProductTypeProductAttribute::findFirst(
                        array('name' => $name),
                        $connection);
                
                return $attribute;
        }
        
        function &findProductTypeAttributeWithNameInGroup ( $name, $groupId, &$connection )
        {
                $attribute =& ProductTypeProductAttribute::findFirst(
                        array('name' => $name,
                              'group_id' => $groupId),
                        $connection);
                
                return $attribute;
        }
        
        function productTypeAttributeWithNameExists ( $name, $groupId, &$connection )
        {
                $attribute =&
                        eComStoreUtils::findProductTypeAttributeWithNameInGroup(
                                $name, $groupId, $connection);
                
                if ( is_null($attribute) )
                {
                        return FALSE;
                }
                
                return TRUE;
        }
        
        
        
        
        
	/* Author Chris Wooldridge */

	function newlyAddedItems ( &$connection )
	{
		$products = array();
                
                $sql = 'FROM product ' .
                        'WHERE 1 ORDER BY dt_added ASC LIMIT 5';
		
		$products =& Product::find($sql, $connection);

		print_r ( $products );
		die();
                
                return $output;
	
	}


        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
