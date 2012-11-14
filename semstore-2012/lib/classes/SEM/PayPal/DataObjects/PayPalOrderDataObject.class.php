<?php

/**
 * @author Adam Dowling (adam@semsolutions.co.uk)
 * @version 1.0
 * @date 2005-09-06
 */

require_once('Database/Abstraction/AttributeMappedDataObject.class.php');

require_once('Sites/Queille/DataObjects/EventsDataObject.class.php');
//require_once('Sites/AES/DataObjects/Customer.class.php');

class PayPalOrderDataObject extends AttributeMappedDataObject
{
        /*
	 * Class Constants
	 */
	
        
        function TABLE () { return 'orders'; }
	function PRIMARY_KEY () { return 'orderid'; }
	function FIELD_LIST () { return array(
                'orderid',
                'adulttickets',
                'adultticketprice',
                'childtickets',
                'childticketprice',
                'roomid',
                'totalprice',
                'donationAmount',
                'giftaiddonation',
                'adulteventticketcount',
                'childeventticketcount',
                'selectedeventid',
                'buyingtent',
                'tentoccupants'
                ); }
        
        function ATTRIBUTE2FIELD_MAP () { return array(
                'orderid' => 'orderid',
                'adulttickets' => 'adulttickets',
                'adultticketprice' => 'adultticketprice',
                'childtickets' => 'childtickets',
                'childticketprice' => 'childticketprice',
                'roomid' => 'roomid',
                'totalprice' => 'totalprice',
                'donationAmount' => 'donationAmount',
                'giftaiddonation' => 'giftaiddonation',
                'adulteventticketcount' => 'adulteventticketcount',
                'childeventticketcount' => 'childeventticketcount',
                'selectedeventid' => 'selectedeventid',
                'buyingtent' => 'buyingtent',
                'tentoccupants' => 'tentoccupants'
                ); }
        
        function ATTRIBUTE2FIELD_CONV () { return array(); }
        function FIELD2ATTRIBUTE_CONV () { return array(); }
        
        /*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
	var $orderid = NULL;
	var $adulttickets = 0;
        var $adultticketprice = 0;
	var $childtickets = 0;
	var $childticketprice = 0;
	var $roomid = 0;
	var $totalprice = 0;	
	var $donationAmount = 0;
        var $giftaiddonation = 0;
        var $adulteventticket = 0;
	var $selectedeventid = 0;
        var $buyingtent = 0;
	var $tentoccupants = 0;
	var $roomid = 0;
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function PayPalOrderDataObject ()
        {
                $numArgs = func_num_args();
                $args = func_get_args();

                call_user_func_array(
                        array(&$this, '_PayPalOrderDataObject'.$numArgs),
                        $args );
        }
        
        
        function _PayPalOrderDataObject0 ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getOrderId ()
        {
                return $this->orderid;
        }
        
        
        function setOrderId ( $id )
        {
                $this->orderid = $id;
        }
        
        
        function getAdultTickets ( )
        {
        	return $this->adulttickets;
        }
        
        function setAdultTickets ( $tickets )
        {
        	$this->adulttickets = $tickets;
        }
        
        function setAdultTicketPrice ( $price )
        {
        	$this->adultticketprice = $price;
        }
        
        function getAdultTicketPrice ( )
        {
        	return $this->adultticketprice;
        }
        
        function getChildTickets ( )
        {
        	return $this->childtickets;
        }
        
        function setChildTickets ( $tickets )
        {
        	$this->childtickets = $tickets;
        }
        
        function getChildTicketPrice ( )
        {
        	return $this->childticketprice;
        }
        
        function setChildTicketPrice ( $price )
        {
        	$this->childticketprice = $price ;
        }
        
        function setRoomId ( $roomid )
        {
        	$this->roomid = $roomid;
        }
        
        function getRoomId ( )
        {
        	return $this->roomid;
        }
        
        function setTotalPrice ( $price )
        {
        	$this->totalprice = $price;
        }
        
        function getTotalPrice ( )
        {
        	return $this->totalprice;
        }
        
        function setDonationAmount ( $amount )
        {
        	$this->donationAmount = $amount;
        }
        
        function getDonationAmount ( )
        {
        	return $this->donationAmount;
        }
        
        function setGiftAidDonation ( $donation )
        {
        	$this->giftaiddonation = $donation;
        }
        
        function getGiftAidDonation ( )
        {
        	return $this->giftaiddonation;
        }
        
        function setAdultEventTicketCount ( $ticketcount )
        {
        	$this->adulteventticketcount = $ticketcount;
        }
        
        function getAdultEventTicketCount ( )
        {
        	return $this->adulteventticketcount;
        }
        
        
        function setChildEventTicketCount ( $ticketcount )
        {
        	$this->childeventticketcount = $ticketcount;
        }
        
        function getChildEventTicketCount ( )
        {
        	return $this->childeventticketcount;
        }
        
        function setSelectedEventId ( $event )
        {
        	$this->selectedeventid = $event;
        }
        
        function getSelectedEventId ( )
        {
        	return $this->selectedeventid;
        }
        
        function setBuyingTent ( $tent )
        {
        	$this->buyingtent = $tent;
        }
        
        function getBuyingTent ( )
        {
        	return $this->buyingtent;
        }
        
        function setTentOccupants ( $occupants )
        {
        	$this->tentoccupants = $occupants;
        }
        
        function getTentOccupants ( )
        {
        	return $this->tentoccupants;
        }
        
        
	function getSelectedEventName ( )
	{
		$event =& new EventsDataObject();
		
		$event =& $event->lookup(array('id' => $this->getSelectedEventId()), $GLOBALS['dbConnection']);
		
		if ( @is_a($event, 'eventsdataobject') )
		{
		return $event->getEventName();
		}
	}
        
        
        /*
	 * Command Methods
	 */
        
        
        function &_instantiateDataObject ()
        {
                $obj =& new PayPalOrderDataObject();
                
                return $obj;
        }
        
        
        function _postinsert ( &$connection )
        {
                $this->orderid = $connection->getLastInsertId();
        }
}

?>
