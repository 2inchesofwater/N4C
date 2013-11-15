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
 * EventBooking Component Category Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelCategory extends JModel
{
	/**
	 * Category ID
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Category data
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
	 * Method to set the category identifier
	 *
	 * @access	public
	 * @param	int category identifier
	 */
	function setId($id)
	{
		// Set category id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	/**
	 * Method to get an category data
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
	 * Method to store a category
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store(&$data)
	{				
		$row = & $this->getTable('EventBooking', 'Category');
		if ($data['id']) {		
			$row->load($data['id']);
		}						
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}		
		if (!$row->id) {
			$where = '`parent` = ' . (int) $row->parent ;
			$row->ordering = $row->getNextOrder( $where );
		}		
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}				
		$data['id'] = $row->id ;
		return true;
	}
	/**
	 * Method to remove categories
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
			$sql = 'DELETE FROM #__eb_categories WHERE id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false;			
		}		
		return true;
	}
	/**
	 * Load the data
	 *
	 */
	function _loadData() {
		$sql = 'SELECT * FROM #__eb_categories WHERE id='.$this->_id;
		$this->_db->setQuery($sql);			
		$this->_data = $this->_db->loadObject();
	}
	/**
	 * Init Category data
	 *
	 */
	function _initData() {
		$row = new stdClass ;
		$row->id = 0;
		$row->parent = 0;
		$row->name = null ;			
		$row->layout = null ;
		$row->access = 0 ;
		$row->description = null;		
		$row->ordering = 0;		
		$row->published = 1;
		$this->_data = $row ;		
	}
	/**
	 * Publish the selected categories
	 *
	 * @param array $cid
	 * @return boolean
	 */
	function publish($cid, $state) {
		if (count($cid)) {
			$cids =  implode(',', $cid);
			$sql = 'UPDATE #__eb_categories SET published = '.$state.' WHERE id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false;
		} 
		return true;
	}
	/**
	 * Save the order of categories
	 *
	 * @param array $cid
	 * @param array $order
	 */
	function saveOrder($cid, $order) {
		$row =& JTable::getInstance('EventBooking', 'Category');
		$groupings = array();
		// update ordering values
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
			// track parents
			$groupings[] = $row->parent;
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}
		// execute updateOrder for each parent group
		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
			$row->reorder('parent = '.(int) $group);
		}
		return true;	
	}	
	/**
	 * Change ordering of a category
	 *
	 */
	function move($direction) {
		$row =& JTable::getInstance('EventBooking', 'Category');
		$row->load($this->_id);		
		if (!$row->move( $direction, ' parent = '.(int) $row->parent.' AND published >= 0 ' )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
	/**
	 * Copy category
	 *
	 */
	function copy($id) {
		$rowOld =& JTable::getInstance('EventBooking', 'Category');
		$row = & JTable::getInstance('EventBooking', 'Category');
		$rowOld->load($id) ;
		$data = JArrayHelper::fromObject($rowOld) ;
		$data['id'] = 0 ;
		$data['name'] = $data['name']. ' Copy' ;
		//Get next ordering
		$sql = 'SELECT MAX(ordering + 1) FROM #__eb_categories WHERE parent='.$rowOld->parent;
		$this->_db->setQuery($sql) ;
		$data['ordering'] = $this->_db->loadResult();
		$row->bind($data) ;
		$row->store();
		return true ;
	}
}