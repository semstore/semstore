<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-10-29
 * @package SEM.CMS.Modules.eComStore
 */

require_once('SEMObject.class.php');

require_once('SEM/CMS/Modules/eComStore/DataObjects/PaymentDataObject.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentType.class.php');
require_once('SEM/CMS/Modules/eComStore/PaymentTypeAttributeGroup.class.php');

class Payment extends SEMObject
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
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
         * Constructors
         *
         */
        
        
        function Payment ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_Payment'.$numArgs),
                        $args);
        }
        
        
        function _Payment0 ()
        {
                $this->_initialise();
                $do =& new PaymentDataObject();
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
	
	
        function setId ( $tempid )
	{	
		$this->cachedDataObject->setId($tempid);
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
	
	
	function getOrderId ()
	{	
		return $this->cachedDataObject->getOrderId();
	}
	
	
        function setOrderId ( $temporder_id )
	{	
		$this->cachedDataObject->setOrderId($temporder_id);
                $this->_setCachedDataObjectChanged(TRUE);
	}
	
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function &find ( $criteria, &$connection )
        {
                $DO =& new PaymentDataObject();
                $doArr =& $DO->lookupArray($criteria, $connection);
                $payments = array();
                foreach ( array_keys($doArr) as $index )
                {
                        $do =& $doArr[$index];
                        $payment =& new Payment();
                        $payment->setConnection($connection);
                        $payment->_setCachedDataObject($do);
                        $payments[] =& $payment;
                }
                
                return $payments;
        }
        
        
        function &findFirst ( $criteria, &$connection )
        {
                $DO =& new PaymentDataObject();
                $do =& $DO->lookup($criteria, $connection);
                
                if ( is_null($do) )
                {
                        return NULL;
                }
                
                $payment =& new Payment();
                $payment->setConnection($connection);
                $payment->_setCachedDataObject($do);
                
                return $payment;
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
                        array(&$this, '_commit'.$numArgs),
                        $args);
        }
        
        
        function _commit0 ()
        {
                if ( $this->getCachedDataObjectChanged() )
                {
                        $this->_commitPaymentDetails();
                }
                
                return TRUE;
        }
        
        
        function _commit1 ( &$connection )
        {
                $this->setConnection($connection);
                $this->commit();
        }
        
        
        function _commitPaymentDetails ()
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
                
                $connection =& $this->getConnection();
                
                // Remove dependants
                if ( $maintainIntegrity )
                {
                        ;
                }
                
                return TRUE;
        }
        
        
        function &getType ()
        {
                return PaymentType::findFirst(
                        array('id' => $this->getTypeId()),
                        $GLOBALS['dbConnection']);
        }
        
        
        function &getAttributeGroups ()
        {
                $type =& $this->getType();
                
                if ( is_null($type) )
                {
                        return NULL;
                }
        
                
                return PaymentTypeAttributeGroup::getGroups(
                        $this, $type, $this->getConnection() );
        }
        
        
        function getAttributeGroupWithName ( $name )
        {
                $groups =& $this->getPaymentTypeAttributeGroups();
                
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
        
        
        function &getAttribute ( $name )
        {
                $attributeGroups =& $this->getAttributeGroups();
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        return $attribute;
                                }
                        }
                }
                
                return NULL;
        }
        
        
        function getAttributeValue ( $name )
        {
                $attributeGroups =& $this->getAttributeGroups();
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        return $attribute->getValue();
                                }
                        }
                }
                
                return NULL;
        }
        
        
        function setAttributeValue ( $name, $value )
        {
                $attributeGroups =& $this->getAttributeGroups();
                
                
                foreach ( array_keys($attributeGroups) as $attributeGroupsKey )
                {
                        $attributeGroup =&
                                $attributeGroups[$attributeGroupsKey];
                        $attributes =& $attributeGroup->getAttributes();
                        
                        
                        foreach ( array_keys($attributes) as $attributesKey )
                        {
                                $attribute =& $attributes[$attributesKey];
                                if ( $attribute->getName() == $name )
                                {
                                        $attribute->setValue($value);
                                        $attribute->commit();
                                        return TRUE;
                                }
                        }
                }
                
                return FALSE;
        }
}

?>
