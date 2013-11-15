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
 * Events Booking Events Model
 *
 * @package		Joomla
 * @subpackage	Events Booking
 * @since 1.5
 */
class EventBookingModelEvents extends JModel
{
	/**
	 * Events data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Events total
	 *
	 * @var integer
	 */
	var $_total = null;
	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;

		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get events data
	 *
	 * @access public
	 * @return array
	 */
	
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$rows = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			for ($i = 0 , $n = count($rows) ; $i < $n; $i++) {
				$row = & $rows[$i] ;
				$sql = 'SELECT a.name FROM #__eb_categories AS a INNER JOIN #__eb_event_categories AS b ON a.id = b.category_id WHERE event_id='.$row->id ;
				$this->_db->setQuery($sql) ;				
				$row->category_name = implode(' | ', $this->_db->loadResultArray()) ;			
			} 
			$this->_data = $rows ;									
		}
		return $this->_data;
	}

	/**
	 * Method to get the total number of events
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$where = $this->_buildContentWhere() ;
			$sql = 'SELECT COUNT(*) FROM #__eb_events AS a '.$where;
			$this->_db->setQuery($sql);
			$this->_total = $this->_db->loadResult();			
		}
		return $this->_total;
	}
	/**
	 * Method to get a pagination object for the events
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}	
	/**
	 * Build the select clause
	 *
	 * @return string
	 */
	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();
		$query = 'SELECT a.*,  SUM(c.number_registrants) AS total_registrants FROM #__eb_events AS a '			
			.' LEFT JOIN #__eb_registrants AS c '
			.' ON (a.id = c.event_id AND c.group_id = 0 AND (c.published=1 OR (c.payment_method LIKE "os_offline%" AND c.published != 2))) ' 
			. $where
			.' GROUP BY a.id '
			. $orderby
		;
		return $query;
	}
	/**
	 * Build order by clause for the select command
	 *
	 * @return string order by clause
	 */
	function _buildContentOrderBy()
	{
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'event_filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );		
		$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir.', a.event_date';		
		return $orderby;
	}
	/**
	 * Build the where clause
	 *
	 * @return string
	 */
	function _buildContentWhere()
	{
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;
		$db					=& JFactory::getDBO();		
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$categoryId				= $mainframe->getUserStateFromRequest( $option.'category_id',			'category_id',			0,				'int' );
		$locationId				= $mainframe->getUserStateFromRequest( $option.'location_id',			'location_id',			0,				'int' );				
		$pastEvent				= $mainframe->getUserStateFromRequest( $option.'past_event',			'past_event',			1,				'int' );
		$filter_state		= $mainframe->getUserStateFromRequest( $option.'events_filter_state',		'filter_state',		'');
		$search				= JString::strtolower( $search );
		$where = array();			
		if ($search) {
			$where[] = 'LOWER(a.title) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}		
		if ($categoryId) {
			$where[] = ' a.id IN (SELECT event_id FROM #__eb_event_categories WHERE category_id='.$categoryId.')' ;		
		}
		if ($locationId)
			$where[] = ' a.location_id = '.$locationId ;
		if (!$pastEvent) {
		    $where[] = ' DATE(a.event_date) >= CURDATE() ';
		}
				
		if (is_numeric($filter_state)) {
			$where[] = ' a.published = '.(int) $filter_state ;
		}
			
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
		
		return $where;
	}
}