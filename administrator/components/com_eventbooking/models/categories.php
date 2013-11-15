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
 * Event Booking Component Categories Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelCategories extends JModel
{
	/**
	 * Categories data array
	 *
	 * @var array
	 */
	var $_data = null;	
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
	 * Method to get categories data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$parent = JRequest::getInt('parent', 0) ;
			$query = $this->_buildQuery();
			//We will build the data here
			$this->_db->setQuery($query);					
			$rows = $this->_db->loadObjectList();						
			$children = array();
			// first pass - collect children
			if (count($rows)) {
				foreach ($rows as $v )
				{
					$pt = $v->parent;
					$list = @$children[$pt] ? $children[$pt] : array();
					array_push( $list, $v );
					$children[$pt] = $list;
				}	
			}								
			$list = JHTML::_('menu.treerecurse', $parent, '', array(), $children, 9999);
			$total = count( $list );
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $total, $this->getState('limitstart'), $this->getState('limit') );	
			// slice out elements based on limits
			$list = array_slice( $list, $this->_pagination->limitstart, $this->_pagination->limit );
			$this->_data = $list ;												
		}
		return $this->_data;
	}	
	/**
	 * Get total categories 
	 *
	 * @return int
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$where = $this->_buildContentWhere() ;			
			$sql  = 'SELECT COUNT(*) FROM #__dms_categories AS a '.$where;
			$this->_db->setQuery($sql);
			$this->_total = $this->_db->loadResult();
		}		
		return $this->_total;
	}
	/**
	 * Method to get a pagination object for the categories
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
		$query = 'SELECT a.*, a.parent AS parent_id, a.name AS title, COUNT(b.id) AS total_events '
			. ' FROM #__eb_categories AS a '
			. ' LEFT JOIN #__eb_event_categories AS b '
			. ' ON a.id = b.category_id '					
			. $where
			. ' GROUP BY a.id '
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
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'category_filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );		
		$orderby = ' ORDER BY a.parent,  '.$filter_order.' '.$filter_order_Dir;		
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
		$search				= $mainframe->getUserStateFromRequest( $option.'categories_search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		$where = array();
		$filter_state		= $mainframe->getUserStateFromRequest( $option.'categories_filter_state',		'filter_state',		'');
		$parent  = JRequest::getInt('parent', 0, 'post'); 		
		if (is_numeric($filter_state)) {
			$where[] = ' a.published = '.(int) $filter_state ; 
		}
		if ($parent)
			$where[] = " a.parent = $parent ";					
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );		
		return $where;
	}	
}