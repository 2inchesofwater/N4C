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
 * EventBooking Component Registrants Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelHistory extends JModel
{
	/**
	 * Registrants data array
	 *
	 * @var array
	 */
	var $_data = null;
	/**
	 * Registrants total
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
		$limitstart = JRequest::getInt('limitstart', 0);
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	/**
	 * Method to get registrants data
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
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	/**
	 * Method to get the total number of registrants
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
			$sql  = 'SELECT COUNT(*) FROM #__eb_registrants AS a '.$where;
			$this->_db->setQuery($sql);
			$this->_total = $this->_db->loadResult();
		}
		return $this->_total;
	}
	/**
	 * Method to get a pagination object for the fields
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
		$query = 'SELECT a.*, b.title, b.event_date FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b ON a.event_id=b.id '
			. $where
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
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'registrant_filter_order',		'filter_order',		'a.register_date',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'DESC',				'word' );		
		$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;		
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
		$eventId			= $mainframe->getUserStateFromRequest( $option.'event_id',			'event_id',			0,				'int' );
		$search				= JString::strtolower( $search );
		$user = & JFactory::getUser() ;
		$where = array();
		$where[] = ' (a.published=1 OR a.payment_method LIKE "os_offline%") ' ;		
		$where[] = ' (a.user_id ='.$user->get('id').' OR a.email="'.$user->get('email').'")';
		if ($eventId)
			$where[] = ' a.event_id='.$eventId ;				
		if ($search) {
			$where[] = '(LOWER(a.first_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false ).' OR LOWER(a.last_name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false ).')';
		}							
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
		return $where;
	}	
}