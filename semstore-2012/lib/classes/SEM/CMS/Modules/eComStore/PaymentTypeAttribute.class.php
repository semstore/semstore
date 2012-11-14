<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/PaymentTypePaymentAttributeGroup.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentTypeAttributeDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentTypeAttributeGroupDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentTypeAttributeLinkDataObject.class.php');

class PaymentTypeAttribute extends SEMObject
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
        
        var $groupId = NULL;
        var $index = NULL;
        var $name = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function PaymentTypeAttribute ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_PaymentTypeAttribute'.$numArgs),
                        $args);
        }
        
        
        function _PaymentTypeAttribute0 ()
        {
                $this->_initialise();
                $do =& new PaymentTypeAttributeLinkDataObject();
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
        
        
        function getValue ()
        {
                return $this->cachedDataObject->getValue();
        }
        
        
        function setValue ( $value )
        {
                $this->cachedDataObject->setValue($value);
                $this->_setCachedDataObjectChanged(TRUE);
        }
        
        
        function getAttributeId ()
        {
                return $this->cachedDataObject->getAttributeId();
        }
        
        
        
        function getPaymentId ()
        {
                return $this->cachedDataObject->getPaymentId();
        }
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function getName ()
        {
                return $this->name;
        }
        
        
        function getIndex ()
        {
                return $this->index;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        function &getAttributes ( &$payment, $group, &$connection )
        {
                $attributes = array();
                
                $typeGroup =& PaymentTypePaymentAttributeGroup::findFirst(
                        array('id' => $group->getId()),
                        $this->getConnection() );
                $groupAttributes =& $typeGroup->getAttributes();
                $DO_CLASS =& new PaymentTypeAttributeLinkDataObject();
                foreach ( array_keys($groupAttributes) as $index )
                {
                        $groupAttribute =& $groupAttributes[$index];
                        $tmpDo =& $DO_CLASS->lookup(
                                array('payment_id' => $payment->getId(),
                                        'attribute_id' => $groupAttribute->getId()),
                                $connection );
                        
                        if ( !is_null($tmpDo) )
                        {
                                $attribute =& new PaymentTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $attribute->_setCachedDataObject($tmpDo);
                                $attributes[] =& $attribute;
                        }
                        else
                        {
                                $attribute =& new PaymentTypeAttribute();
                                $attribute->setConnection($connection);
                                $attribute->groupId = $groupAttribute->getGroupId();
                                $attribute->name = $groupAttribute->getName();
                                $attribute->index = $groupAttribute->getIndex();
                                $tmpDo =& new PaymentTypeAttributeLinkDataObject();
                                $tmpDo->setAttributeId($groupAttribute->getId());
                                $tmpDo->setPaymentId($payment->getId());
                                $attribute->_setCachedDataObject($tmpDo);
                                $attributes[] =& $attribute;;
                        }
                }
                
                return $attributes;
        }
        
        
        function &find ( $criteria, &$connection )
        {
                ;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                ;
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
                
                $this->id = $do->getId();
                $this->_setCachedDataObject($do);
                $this->_setCachedDataObjectChanged(FALSE);
        }
        
        
        function remove ()
        {
                if ( !is_object($this->cachedDataObject) )
                {
                        return FALSE;
                }
                
                $connection =& $this->getConnection();
                return $this->cachedDataObject->delete($connection);
        }
        
        
        function &getType ()
        {
                return PaymentType::findFirst(
                        array('id' => $this->getTypeId()),
                        $this->getConnection() );
        }
}

?>
