<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

jimport('joomla.application.component.model');
/**
 * Event Booking Registrant Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelRegistrant extends JModel
{
	/**
	 * Event id
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Event data
	 *
	 * @var array
	 */
	var $_data = null;
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
		$array = JRequest::getVar('cid', array(0), '', 'array');
		$edit	= JRequest::getVar('edit',true);
		if($edit)
			$this->setId((int)$array[0]);
	}
	/**
	 * Method to set the registrant identifier
	 *
	 * @access	public
	 * @param	int registrant identifier
	 */
	function setId($id)
	{
		// Set event id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	/**
	 * Method to get a package
	 *
	 * @since 1.5
	 */
	function &getData()
	{		
		if (empty($this->_data)) {
			if ($this->_id)
				$this->_loadData();
			else 
				$this->_initData();	
		}							
		return $this->_data;
	}
	/**
	 * Method to store a registrant
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store(&$data)
	{	
		jimport('joomla.filesystem.file') ;	
		$row = & $this->getTable('EventBooking', 'Registrant');
		$isNew = false ;
		if ($data['id']) {
			//We will need to calculate total amount here now
			$row->load($data['id']);									
		}			
		else {
			$isNew = true ;
			$row->payment_method = 'os_offline' ;
			$row->register_date = date('Y-m-d');		
			$rate = EventBookingHelper::getRegistrationRate($data['event_id'], $data['number_registrants']) ;			
			$row->total_amount = $row->amount = $rate*$data['number_registrants'] ;			
		}				
		$row->bind($data);
		$row->store();
		
		if (EB_AFFILIATE) {
    		if ($row->published == 1) {
    		        $sql = "SELECT id, coupon_id FROM #__eb_registrants WHERE id=$row->id AND payment_method LIKE 'os_offline%' AND check_coupon = 0";
    				$this->_db->setQuery($sql) ;
    				$coupons = $this->_db->loadObjectList();
    				if (count($coupons)){
    					foreach ($coupons as $coupon) {
    						
    						$sql = " UPDATE #__eb_registrants SET check_coupon = 1 WHERE id = $coupon->id";
    						$this->_db->setQuery($sql) ;
    						$this->_db->query();
    						
    						$sql = 'UPDATE #__eb_coupons SET used = used + 1 WHERE id='.(int)$coupon->coupon_id ;
    						$this->_db->setQuery($sql) ;
    						$this->_db->query();
    					}
    				}
    		}   
		}
						
		$registrationId = $row->id ;
		if (!$isNew) {//Incase editing function, we will save custom field value and registrants
			if ($row->number_registrants > 1) {
				$jcFields = new JCFields($row->event_id, false, 1) ;							
			} else {
				$jcFields = new JCFields($row->event_id, false, 0) ;
			}
			$jcFields->saveFieldValues($row->id) ;
			if ($row->is_group_billing && (strpos($row->payment_method , 'os_offline') !== false)) {
				$sql = "UPDATE #__eb_registrants SET published='$row->published' WHERE group_id=".$row->id ;			
				$this->_db->setQuery($sql);
				$this->_db->query() ;
			}			
			if ($row->number_registrants > 1) {
				//Load all member custom fields
				$jcFields = new JCFields($row->event_id, 0, 2) ;
				$ids = JRequest::getVar('ids', array(), 'post');
				$fields = array('event_id', 'first_name', 'last_name', 'organization',
								'address', 'address2', 'city', 'state',
								'country', 'zip', 'phone', 'fax', 'email', 'comment'										
				) ;	
				for ($i = 0 , $n = count($ids) ; $i < $n ; $i++) {
					$memberId = $ids[$i] ;
					$row = & $this->getTable('EventBooking', 'Registrant');				
					$row->load($memberId);
					$memberData = array() ;
					foreach ($fields as $field) {
    					if ($field == 'event_id') {
                            $memberData[$field] = JRequest::getInt($field, 0, 'post');
                        } else {
                            $memberData[$field] = JRequest::getVar($field.'_'.$memberId, '', 'post');    
                        }
					}													
					$row->bind($memberData);
					$row->store();
					//Store custom field information for this member
					$jcFields->saveMemberFieldValues($memberId) ;
				}
			}															
		} else {
			if ($row->number_registrants > 1) {
				for ($i = 0 ; $i < $row->number_registrants; $i++) {
					$rowMember = & $this->getTable('EventBooking', 'Registrant');
					$rowMember->event_id = $row->event_id ;
					$rowMember->group_id = $row->id ;
					$rowMember->store();					
				}
			}
		}
			
		//Update total registration price when edit registrant 
		
		$row = & $this->getTable('EventBooking', 'Registrant');
		$row->load($registrationId);
		
		//We will need to check
		
		$sql = 'SELECT COUNT(id) FROM #__eb_registrants WHERE group_id='.$row->id;
		$this->_db->setQuery($sql) ;
		$total = $this->_db->loadResult() ;			
		$rate = EventBookingHelper::getRegistrationRate($row->event_id, $row->number_registrants) ;
				
		if ($total > 0) {//Group registration												
			//$feeFields = new JCFields($row->event_id, false, 2) ;
			$feeAmount = JCFields::canculateGroupFee($row->id) + JCFields::calculateFee($row->event_id, 1) ;
			$totalAmount = $rate*$row->number_registrants + $feeAmount ;									
		} else {			
			$feeAmount = JCFields::calculateFee($row->event_id, 0) ;
			$totalAmount = $rate*$row->number_registrants + $feeAmount ;
		}
						
		$row->total_amount = $totalAmount ;
		$row->amount = $row->total_amount - $row->discount ;
		$row->store() ;
		$data['id'] = $row->id ;
		return true;
	}
	/**
	 * Init event data
	 *
	 */
	function _initData() {
		$row = & $this->getTable('EventBooking', 'Registrant');
		$row->event_id = JRequest::getInt('event_id', 0) ;					
		$this->_data = $row ;
	}
	/**
	 * Load event data
	 *
	 */
	function _loadData() {
		$sql = 'SELECT * FROM #__eb_registrants WHERE id='.$this->_id;
		$this->_db->setQuery($sql);			
		$this->_data = $this->_db->loadObject();
	}
	/**
	 * Method to remove registrants 
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */			
	function delete($cid = array())
	{		
		$db = & JFactory::getDBO() ;
		$row = JTable::getInstance('EventBooking', 'Registrant') ;							
		if (count($cid)) {
			foreach ($cid as $registrantId) {
				$row->load($registrantId);
				if ($row->group_id > 0) {
					$sql = 'UPDATE #__eb_registrants SET number_registrants = number_registrants -1 WHERE id='.$row->group_id ;
					$db->setQuery($sql);
					$db->query() ;
					$sql = 'SELECT number_registrants FROM #__eb_registrants WHERE id='.$row->group_id ;
					$db->setQuery($sql);
					$numberRegistrants = (int) $db->loadResult() ;
					if ($numberRegistrants == 0) {
						//Delete this registration record
						$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id ='.$row->group_id ;
						$db->setQuery($sql);
						$db->query() ;
						$sql = 'DELETE FROM #__eb_registrants WHERE id = '.$row->group_id ;
						$db->setQuery($sql) ;
						$db->query() ;
					}
				}
			}			
			$cids = implode(',', $cid) ;
			$sql = 'SELECT id FROM #__eb_registrants WHERE group_id IN ('.$cids.')'; 
			$db->setQuery($sql) ;
			$cid = array_merge($cid, $db->loadResultArray()) ;
			$registrantIds = implode(',', $cid) ;		
			$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id IN ('.$registrantIds.')';
			$db->setQuery($sql) ;
			$db->query();
			$sql = 'DELETE FROM #__eb_registrants WHERE id IN ('.$registrantIds.')';
			$db->setQuery($sql) ;
			$db->query();				
		}		
		return true;
	}
	/**
	 * Publish / unpublish a registrant 
	 *
	 * @param array $cid
	 * @param int $state
	 */
	function publish($cid, $state) {
		$cids = implode(',', $cid);
		$sql = " UPDATE #__eb_registrants SET published=$state WHERE id IN ($cids) OR group_id IN ($cids) AND payment_method LIKE 'os_offline%' ";
		$this->_db->setQuery($sql) ;
		if (!$this->_db->query())
			return false;
		if (EB_AFFILIATE) {
		    if ($state == 1){
				$sql = "SELECT id, coupon_id FROM #__eb_registrants WHERE id IN ($cids) AND payment_method LIKE 'os_offline%' AND check_coupon = 0";
				$this->_db->setQuery($sql) ;
				$coupons = $this->_db->loadObjectList();
				if (count($coupons)){
					foreach ($coupons as $coupon) {
						
						$sql = " UPDATE #__eb_registrants SET check_coupon = 1 WHERE id = $coupon->id";
						$this->_db->setQuery($sql) ;
						$this->_db->query();
						
						$sql = 'UPDATE #__eb_coupons SET used = used + 1 WHERE id='.(int)$coupon->coupon_id ;
						$this->_db->setQuery($sql) ;
						$this->_db->query();
					}
				}
			}
		}	
		return true ;
	}		
}