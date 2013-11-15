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
 * Event Booking Component Configuration Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelConfiguration extends JModel
{
	/**
	 * Containing all config data,  store in an object with key, value
	 *
	 * @var object
	 */
	var $_data = null;
	
	function __construct() {
		parent::__construct();
	}	
	/**
	 * Get configuration data
	 *
	 */
	function getData() {
		if (empty($this->_data)) {
			$config = new stdClass ;
			$sql = 'SELECT config_key, config_value FROM #__eb_configs';
			$this->_db->setQuery($sql);
			$rows = $this->_db->loadObjectList();
			if (count($rows)) {
				for ($i = 0, $n = count($rows); $i < $n; $i++) {
					$row = $rows[$i];
					$key = $row->config_key;
					$value = $row->config_value;
					$config->$key = stripslashes($value);						
				}	
			} else {
				$config = new stdClass() ;				 																																
			}
			$this->_data = $config;		
		}			
		return $this->_data ;
	}
	/**
	 * Store the configuration data
	 *
	 * @param array $post
	 */
	function store($data) {
		$row = & $this->getTable('EventBooking', 'Config');		
		$sql = 'TRUNCATE TABLE #__eb_configs';
		$this->_db->setQuery($sql);
		$this->_db->query();
		foreach ($data as $key=>$value) {
			$row->id = 0 ;
			$row->config_key = $key ;
			$row->config_value = $value ;
			$row->store();			
		}
		return true;
	}
}