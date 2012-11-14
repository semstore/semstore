<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentTypeAttributeGroupDataObject.class.php');

require_once('SEM/CMS/Modules/eComStore/PaymentType.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypePaymentAttribute.class.php');

class PaymentTypePaymentAttributeGroup extends SEMObject
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
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function PaymentTypePaymentAttributeGroup ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_PaymentTypePaymentAttributeGroup'.$numArgs),
                        $args);
        }
        
        
        function _PaymentTypePaymentAttributeGroup0 ()
        {
                $this->_initialise();
                $do =& new PaymentTypeAttributeGroupDataObject();
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
        
        
        function getIndex ()
        {
                return $this->cachedDataObject->getIndex();
        }
        
        
        function setIndex ( $index )
        {
                $this->cachedDataObject->setIndex($index);
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
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new PaymentTypeAttributeGroupDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $attributes = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $attribute =& new PaymentTypePaymentAttributeGroup();
                        $attribute->setConnection($connection);
                        $attribute->_setCachedDataObject($do);
                        $attributes[] =& $attribute;
                }
                
                return $attributes;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new PaymentTypeAttributeGroupDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $attribute =& new PaymentTypePaymentAttributeGroup();
                $attribute->setConnection($connection);
                $attribute->_setCachedDataObject($do);
                
                return $attribute;
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
                
                if ( @is_a('DBError', $result) ||
                        @is_subclass_of('DBError', $result ) )
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
                
                if ( $maintainIntegrity )
                {
                        $this->removeAttributes();
                }
                
                $idx = $this->getIndex();
                
                $connection =& $this->getConnection();
                $this->cachedDataObject->delete($connection);
                
                $sql = 'UPDATE payment_type_attribute_group ' .
                        'SET idx = idx - 1 ' .
                        'WHERE idx > ' . $idx;
                $res = $connection->update($sql);
                
                return TRUE;
        }
        
        
        function removeAttributes ()
        {
                $attributes =& $this->getAttributes();
                foreach ( array_keys($attributes) as $index )
                {
                        $attribute =& $attributes[$index];
                        $attribute->remove();
                }
        }
        
        
        function &getType ()
        {
                return PaymentType::findFirst(
                        array('id' => $this->getTypeId()),
                        $this->getConnection() );
        }
        
        
        function &getAttributes ()
        {
                $sql = 'WHERE group_id = ' . $this->getId() .
                        ' ORDER BY idx';
                return PaymentTypePaymentAttribute::find(
                        $sql, $this->getConnection());
        }
        
        
        function getAttributeCount ()
        {
                $sql = sprintf('SELECT COUNT(*) FROM %s WHERE group_id = %s',
                        PaymentTypeAttributeDataObject::TABLE(),
                        $this->getId());
                $connection =& $this->getConnection();
                $result =& $connection->execute($sql);
                if ( is_null($result) )
                {
                        return 0;
                }
                elseif ( @is_a($result, 'DBError') ||
                        @is_subclass_of($result, 'DBError') )
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
        
        
        function addAttributeAtStart ( &$newAttribute )
        {
                return $this->addAttributeAtPosition( $newAttribute, 0 );
        }
        
        
        function addAttributeAtEnd ( &$newAttribute )
        {
                $attributes =& $this->getAttributes();
                $index = count($attributes);
                
                return $this->addAttributeAtPosition( $newAttribute, $index );
        }
        
        
        function addAttributeAtPosition ( &$newAttribute, $pos )
        {
                if ( $pos > $this->getAttributeCount() )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                
                // Make space for new category
                $sql = 'UPDATE payment_type_attribute SET idx = idx + 1' .
                        ' WHERE group_id = ' . $this->getId() .
                        ' AND idx > ' . $pos;
                $result = $connection->update($sql);
                
                $newAttribute->setIndex($pos);
                $newAttribute->setGroupId($this->getId());
                $newAttribute->setConnection($connection);
                $newAttribute->commit();
                
                $type =& $this->getType();
                
                /* Create links in bridge table for all payments to this
                 * attribute.
                 */
                
                $sql = sprintf('INSERT INTO %s (%s, %s) SELECT %s, %s FROM %s WHERE %s = %s',
                        'payment_type_attribute_link',
                        'attribute_id',
                        'payment_id',
                        $newAttribute->getId(),
                        'id',
                        'payment',
                        'payment.type_id',
                        $type->getId()
                        );
                
                $res = $connection->insert($sql);
                
                
                return TRUE;
        }
        
        
        function &getAttributeWithName ( $name )
        {
                $attributes =& $this->getAttributes();
                
                foreach ( array_keys($attributes) as $key )
                {
                        $attribute =& $attributes[$key];
                        if ( $attribute->getName() == $name )
                        {
                                return $attribute;
                        }
                }
                
                return NULL;
        }
}

?>
