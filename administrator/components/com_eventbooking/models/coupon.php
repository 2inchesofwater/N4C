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
 * EventBooking Component Coupon Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelCoupon extends JModel
{
	/**
	 * Coupon id
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Coupon data
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
	 * Method to set the Coupon identifier
	 *
	 * @access	public
	 * @param	int Coupon identifier
	 */
	function setId($id)
	{
		// Set Coupon id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	/**
	 * Method to get a Coupon
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
	 * Init Coupon data
	 *
	 */
	function _initData() {
		$coupon = new stdClass ;
		$coupon->id = 0;
		$coupon->code = '';
		$coupon->coupon_type = '';
		$coupon->discount = '';
		$coupon->event_id = 0;
		$coupon->times = '';
		$coupon->used = 0;
		$coupon->valid_from = null ;
		$coupon->valid_to = null ;
		$coupon->published = 1 ;		
		$this->_data = $coupon ;
	}
	/**
	 * Load Coupon data
	 *
	 */
	function _loadData(){
		$sql = 'SELECT * FROM #__eb_coupons WHERE id='.$this->_id;
		$this->_db->setQuery($sql);			
		$this->_data = $this->_db->loadObject();
	}	
	/**
	 * Method to store a Coupon
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store(&$data){	
		$row = & $this->getTable('EventBooking', 'Coupon');	
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}		
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}		
		return true;
	}	
	/**
	 * Method to remove  Coupons
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function delete($cid = array()){		
		if (count( $cid ))
		{
			$cids =  implode(',', $cid);
			$sql = 'DELETE FROM #__eb_coupons WHERE id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false;			
		}
		return true;
	}	
	/**
	 * Change status of the selected coupons
	 *
	 * @param int $id
	 * @param int $state
	 */
	function publish($cid, $state){
		if (count($cid)) {
			$cids = implode(',', $cid) ;
			$sql = 'UPDATE #__eb_coupons SET published='.$state. ' WHERE id IN('.$cids.')';
			$this->_db->setQuery($sql);
			$this->_db->query();
			return true ;	
		} else {
			return false ;	
		}				
	}		
}