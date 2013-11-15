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
 * @subpackage	EventBooking
 * @since 1.5
 */
class EventBookingModelLocation extends JModel
{				
	/**
	 * Documents data array
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
		$listLength = EventBookingHelper::getConfigValue('number_events');				
		if (!$listLength)
			$listLength = $mainframe->getCfg('list_limit');
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $listLength, 'int' );					
		$limitstart = JRequest::getVar('limitstart', 0 );		
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);		
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get Events data
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
		    $config = EventBookingHelper::getConfig() ;		    
		    $user = & JFactory::getUser();
		    $nullDate = $this->_db->getNullDate() ;
			$query = $this->_buildQuery();						
			$this->_db->setQuery($query);						
			$rows = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));											
			if ($user->get('id')) {
				$userId = $user->get('id');				
				for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
					$row = $rows[$i] ;
					$sql = 'SELECT COUNT(id) FROM #__eb_registrants WHERE user_id='.$userId.' AND event_id='.$row->id.' AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2))';
					$this->_db->setQuery($sql) ;
					$row->user_registered = $this->_db->loadResult() ;					
					//Canculate discount price					
					if ($config->show_discounted_price) {
					    $discount = 0 ;
					    if (($row->early_bird_discount_date != $nullDate) && ($row->date_diff >=0)) {
            		        if ($row->early_bird_discount_type == 1) {            		                        		           
            					$discount += $row->individual_price*$row->early_bird_discount_amount/100 ;						
            				} else {            				    
            					$discount += $row->early_bird_discount_amount ;
            				}            				
					    }
					    if ($row->discount > 0) {
            				if ($row->discount_type == 1) {
            					$discount += $discount*$row->discount/100 ;						
            				} else {
            					$discount += $row->discount ;
            				}
            			}
            			$row->individual_price = $row->individual_price - $discount ;            			
					}										
				}				
			} else {
			    //Calculate discounted price
			    if ($config->show_discounted_price) {			       
    			    for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
    					$row = $rows[$i] ;    									    					
    					if ($config->show_discounted_price) {
    					    $discount = 0 ;
    					    if (($row->early_bird_discount_date != $nullDate) && ($row->date_diff >=0)) {
                		        if ($row->early_bird_discount_type == 1) {            		                        		           
                					$discount += $row->individual_price*$row->early_bird_discount_amount/100 ;						
                				} else {            				    
                					$discount += $row->early_bird_discount_amount ;
                				}            				
    					    }    					    
                			$row->individual_price = $row->individual_price - $discount ;            			
    					}										
    				}			        			        			        			        			       
			    }
			}
						
			$this->_data = $rows ;
		}
		return $this->_data;
	}	
	/**
	 * Get total Events 
	 *
	 * @return int
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$where = $this->_buildContentWhere();
			$sql  = 'SELECT COUNT(*) FROM #__eb_events AS a '.$where;
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
		$query = 'SELECT a.*, DATEDIFF(a.early_bird_discount_date, NOW()) AS date_diff, c.name AS location_name, IFNULL(SUM(b.number_registrants), 0) AS total_registrants FROM  #__eb_events AS a '
			. ' LEFT JOIN #__eb_registrants AS b '
			. ' ON (a.id = b.event_id AND b.group_id=0 AND (b.published = 1 OR (b.payment_method LIKE "os_offline%" AND b.published != 2))) '
			. ' LEFT JOIN #__eb_locations AS c '
			. ' ON a.location_id = c.id '					
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
		$orderEvents = EventBookingHelper::getConfigValue('order_events');
		if ($orderEvents == 2) {
			$orderby = ' ORDER BY a.event_date ';
		} else {
			$orderby = ' ORDER BY a.ordering ';	
		}			
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
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events');
		$where = array() ;
		$locationId = JRequest::getInt('location_id', 0) ;
		$where[] = 'a.published = 1';
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $where[] = ' a.access IN ('.implode(',', $user->getAuthorisedViewLevels()).')' ;    
		} else {
		    $gid		= $user->get('aid', 0);
		    $where[] = ' a.access <= '.(int)$gid ;
		}		
		if ($locationId) {
			//$where[] = ' a.category_id = '.$categoryId ;						
			$where[] = ' a.location_id = ' .$locationId ;
		}
		if ($hidePastEvents) {
			$where[] = ' DATE(a.event_date) >= CURDATE() ';
		}
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );		
		return $where;
	}
	/**
	 * Get list of category
	 *
	 */
	function getLocation() {
		$locationId = JRequest::getInt('location_id', 0) ;
		$sql = 'SELECT * FROM #__eb_locations WHERE id='.$locationId;
		$this->_db->setQuery($sql) ;
		return $this->_db->loadObject();			
	}				
} 