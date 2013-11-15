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
 * Event Booking Waiting Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelWaiting extends JModel
{
	/**
	 * waiting id
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Waiting data
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
		// Set Waiting id and wipe data
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
		$row = & $this->getTable('EventBooking', 'WaitingList');
		if ($data['id']) {
			//We will need to calculate total amount here now
			$row->load($data['id']);					
		}			
		else {
			$row->register_date = date('Y-m-d');					
		}				
		$row->bind($data);
		$row->store();
		return true;
	}
	/**
	 * Init event data
	 *
	 */
	function _initData() {
		$row = & $this->getTable('EventBooking', 'WaitingList');
		$row->event_id = JRequest::getInt('event_id', 0) ;					
		$this->_data = $row ;
	}
	/**
	 * Load event data
	 *
	 */
	function _loadData() {
		$sql = 'SELECT * FROM #__eb_waiting_lists WHERE id='.$this->_id;
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
		if (count( $cid ))
		{			
			$cids =  implode(',', $cid);			
			$sql = 'DELETE FROM #__eb_waiting_lists WHERE id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false;			
		}		
		return true;
	}
}