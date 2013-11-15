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
 * Event Booking Component Field Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelField extends JModel
{
	/**
	 * Field id
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Field data
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
	 * Method to set the field identifier
	 *
	 * @access	public
	 * @param	int field identifier
	 */
	function setId($id)
	{
		// Set field id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	/**
	 * Method to get a field
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
	 * Method to store a field
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store(&$data)
	{	
		$db = & JFactory::getDBO();	
		$row = & $this->getTable('EventBooking', 'Field');	
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}					
		if (!$row->id) {
			$sql = ' SELECT MAX(ordering) + 1 AS ordering FROM #__eb_fields ';
			$this->_db->setQuery($sql) ;
			$row->ordering = $this->_db->loadResult();	
			if ($row->ordering == 0)
				$row->ordering = 1 ;
		}
		if (!isset($data['event_id']) || $data['event_id'][0] == -1) {
			$row->event_id = -1 ;
		} else {
			$row->event_id = 1 ;
		}		
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		$sql = 'DELETE FROM #__eb_field_events WHERE field_id='.$row->id;
		$db->setQuery($sql) ;
		$db->query();
		if ($row->event_id != -1) {
			if (isset($data['event_id'])) {
				$eventIds = $data['event_id'] ;
				for ($i = 0 , $n = count($eventIds); $i < $n ; $i++) {
					$eventId = $eventIds[$i] ;
					$sql = "INSERT INTO #__eb_field_events(field_id, event_id) VALUES($row->id, $eventId);";
					$db->setQuery($sql) ;
					$db->query();
				}
			}
		}				
		return true;
	}
	/**
	 * Init field data
	 *
	 */
	function _initData() {
		$field = new stdClass ;		
		$field->id = null ;		
		$field->event_id = -1 ;
		$field->name = null ;
		$field->title = null ;
		$field->field_type = null ;
		$field->display_in = 0 ;
		$field->description = null ;				
		$field->required = null ;
		$field->values = null ;
		$field->default_values = null ;
		$field->fee_field = 0 ;
		$field->fee_values = null ;
		$field->rows = null ;
		$field->cols = null ;
		$field->size = 25 ;
		$field->css_class = "inputbox" ;				
		$field->published = 1 ;		
		$field->datatype_validation = 0 ;
		$field->fee_formula = null ;
		$field->field_mapping = null ;
		$this->_data = $field ;
	}
	/**
	 * Load field data
	 *
	 */
	function _loadData() {
		$sql = 'SELECT * FROM #__eb_fields WHERE id='.$this->_id;
		$this->_db->setQuery($sql);			
		$this->_data = $this->_db->loadObject();
	}
	/**
	 * Method to remove  fields
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
			//Delete data from field values table
			$sql = 'DELETE FROM #__eb_field_values WHERE field_id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false ;
			//Delete from field events table	
			$sql = 'DELETE FROM #__eb_field_events WHERE field_id IN ('.$cids.')';
			$this->_db->setQuery($sql) ;
			$this->_db->query();	
			//Delete from fields table
			$sql = 'DELETE FROM #__eb_fields WHERE id IN ('.$cids.')';
			$this->_db->setQuery($sql);
			if (!$this->_db->query())
				return false;			
		}
		return true;
	}
	/**
	 * Publish or unpublish a field
	 *
	 * @param int $id
	 * @param int $state
	 */
	function publish($cid, $state) {
		$cids = implode(',', $cid) ;		
		$sql = 'UPDATE #__eb_fields SET published='.$state. ' WHERE id IN ('.$cids .' )';
		$this->_db->setQuery($sql);
		if ($this->_db->query())
			return true ;
		else 
			return false ;					
	}
	/**
	 * Change require status
	 *
	 * @param array $cid
	 * @param int $state
	 * @return boolean
	 */
	function required($cid, $state) {
		$cids = implode(',', $cid) ;		
		$sql = 'UPDATE #__eb_fields SET required='.$state. ' WHERE id IN ('.$cids .' )';
		$this->_db->setQuery($sql);
		if ($this->_db->query())
			return true ;
		else 
			return false ;					
	}
	/**
	 * Save the order of fields
	 *
	 * @param array $cid
	 * @param array $order
	 */
	function saveOrder($cid, $order) {
		$row =& JTable::getInstance('EventBooking', 'Field');				
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );						
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}		
		return true;	
	}	
	/**
	 * Change ordering of an album
	 *
	 */
	function move($direction) {
		$row =& JTable::getInstance('EventBooking', 'Field');
		$row->load($this->_id);		
		if (!$row->move( $direction, ' published >= 0 ')) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		$row->reorder();
		return true;
	}
	/**
	 * Copy a field
	 *
	 * @param int $id
	 */	
	function copy($id) {
		$rowOld = & JTable::getInstance('EventBooking', 'Field');
		$rowOld->load($id) ;
		$row = & JTable::getInstance('EventBooking', 'Field');
		$data = JArrayHelper::fromObject($rowOld) ; 
		$row->bind($data) ;
		$row->id = 0 ;
		$row->title = 'Copy of '.$row->title ;
		$row->store() ;
		$sql = "INSERT INTO #__eb_field_events(field_id, event_id) SELECT $row->id, event_id FROM #__eb_field_events WHERE field_id=".$rowOld->id ;
		$this->_db->setQuery($sql) ;
		$this->_db->query();
		return $row->id ;	
	}
}