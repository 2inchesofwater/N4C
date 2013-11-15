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
 * EventBooking Component Categories Model
 *
 * @package		Joomla
 * @subpackage	EventBooking
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
		$listLength = EventBookingHelper::getConfigValue('number_categories');				
		if (!$listLength)
			$listLength = $mainframe->getCfg('list_limit');
		$limit		= $mainframe->getUserStateFromRequest( $option.'categorires.list.limit', 'limit', $listLength, 'int' );		//
		$limitstart	= JRequest::getInt('limitstart', 0) ;		
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
			$query = $this->_buildQuery();			
			$this->_db->setQuery($query);					
			$rows = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));			
			for ($i  = 0 , $n = count($rows) ; $i < $n ; $i++) {				
				$row = &$rows[$i] ;
				$sql = 'SELECT COUNT(*) FROM #__eb_categories WHERE parent = '.$row->id.' AND published=1 ';
				$this->_db->setQuery($sql) ;
				$row->total_categories = $this->_db->loadResult();
				$row->total_events = EventBookingHelper::getTotalEvent($row->id) ;				
			}
			$this->_data = $rows;								
		}
		return $this->_data;
	}	
	/**
	 * Get total Categories 
	 *
	 * @return int
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$where = $this->_buildContentWhere();
			$sql  = 'SELECT COUNT(*) FROM #__eb_categories AS a '.$where;
			$this->_db->setQuery($sql);
			$this->_total = $this->_db->loadResult();
		}		
		return $this->_total;
	}
	/**
	 * Method to get a pagination object for the donors
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
		$query = 'SELECT a.* FROM #__eb_categories AS a '										
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
		$orderby = ' ORDER BY a.ordering ';		
		return $orderby;
	}
	/**
	 * Build the where clause
	 *
	 * @return string
	 */
	function _buildContentWhere()
	{
		$user = & JFactory::getUser() ;		
		$where = array() ;		
		$categoryId = JRequest::getInt('category_id', 0) ;					
		$where[] = ' a.parent = '.$categoryId ;
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $where[] = ' a.access IN ('.implode(',', $user->getAuthorisedViewLevels()).')' ;
		} else {
		    $gid		= $user->get('aid', 0);    
		    $where[] = ' a.access <= '.(int)$gid ;    
		}					
		$where[] = ' a.published = 1 ' ;					
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
		return $where;
	}		
	/**
	 * Get parent categories and store them in an array
	 *
	 * @return array
	 */
	function getParentCategories(){
		$categoryId = JRequest::getInt('category_id', 0);
		$parents = array();		
		while ( true ){
			$sql = 'SELECT id, name, parent FROM #__eb_categories WHERE id = '.$categoryId.' AND published=1 ';
			$this->_db->setQuery( $sql );
			$row = $this->_db->loadObject();
			if ($row){
				$sql = 'SELECT COUNT(*) FROM #__eb_categories WHERE parent='.$row->id.' AND published = 1 ';
				$this->_db->setQuery($sql) ;
				$total = $this->_db->loadResult();
				$row->total_children = $total ;				
				$parents[] = $row ;
				$categoryId = $row->parent ;				
			} else {							
			 	break;
			}			
		}
		return $parents ;	
	}		
}