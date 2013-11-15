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
class EventBookingModelCategory extends JModel
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
            					$discount += $row->individual_price*$row->discount/100 ;						
            				} else {            				    
            					$discount += $row->discount ;
            				}
            			}            			            			 
            			$row->discounted_price = $row->individual_price - $discount ;          			
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
                			$row->discounted_price = $row->individual_price - $discount ;            			
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
		$categoryId = JRequest::getInt('category_id', 0) ;
		$where[] = 'a.published = 1';
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    $where[] = ' a.access IN ('.implode(',', $user->getAuthorisedViewLevels()).')' ;
		} else {
		    $gid		= $user->get('aid', 0);
		    $where[] = ' a.access <= '.(int)$gid ;   
		}		
		if ($categoryId) {
			//$where[] = ' a.category_id = '.$categoryId ;						
			$where[] = ' a.id IN (SELECT event_id FROM #__eb_event_categories WHERE category_id='.$categoryId.')' ;
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
	function getCategory() {
		$categoryId = JRequest::getInt('category_id', 0) ;
		$sql = 'SELECT * FROM #__eb_categories WHERE id='.$categoryId;
		$this->_db->setQuery($sql) ;
		return $this->_db->loadObject();			
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
			$sql = "SELECT id, name, parent FROM #__eb_categories WHERE id = ".$categoryId." AND published=1";
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
	
	
	################################################################
	#Functions used for calendar view
	
	################################################################
	
	/**
	 * Get JDate object of current time
	 *
	 * @return object JDate
	 */
	function _getNow() {		
		static $datenow = null;
		if (!isset($datenow)) {						
			$datenow =& JFactory::getDate("+0 seconds");
		}
		return $datenow;
	}
	/**
	 * Get array Year, Month, Day from current Request, fallback to current date
	 *
	 * @return array
	 */
	function _getYMD(){
		static $data;
		if (!isset($data)){
			$datenow = $this->_getNow();
			list($year, $month, $day) = explode('-', $datenow->toFormat('%Y-%m-%d'));
			$year	= min(2100,abs(intval(JRequest::getVar('year',	$year))));
			$month	= min(99,abs(intval(JRequest::getVar('month',	$month))));
			$day	= min(3650,abs(intval(JRequest::getVar('day',	$day))));
			if( $day <= '9' ) {
				$day = '0' . $day;
			}
			if( $month <= '9') {
				$month = '0' . $month;
			}
			$data = array();
			$data[]=$year;
			$data[]=$month;
			$data[]=$day;
		}
		return $data;
	}	
	
	function _listIcalEventsByMonth( $year, $month){
		$db = JFactory::getDBO();
		$user = & JFactory::getUser() ;
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events');
		$showMultipleDayEventInCalendar = EventBookingHelper::getConfigValue('show_multiple_days_event_in_calendar');
		$aid		= $user->get('aid', 0);
		$categoryId =  JRequest::getInt('category_id', 0) ;
		$startdate 	= mktime( 0, 0, 0,  $month,  1, $year );
		$enddate 	= mktime( 23, 59, 59,  $month, date( 't', $startdate), $year );
		$startdate = date('Y-m-d',$startdate)." 00:00:00";
		$enddate = date('Y-m-d',$enddate)." 23:59:59";
		
		$where = array() ;
		
		$where[] = 'a.`published` = 1';
		$where[] = "a.id IN (SELECT event_id FROM #__eb_event_categories WHERE category_id=$categoryId )";
		if ($showMultipleDayEventInCalendar) {
			$where[] = "((`event_date` BETWEEN '$startdate' AND '$enddate') OR (MONTH(event_end_date) = $month AND YEAR(event_end_date) = $year ))" ;
		} else {
			$where[] = "`event_date` BETWEEN '$startdate' AND '$enddate'" ;
		}
		
		if ($hidePastEvents) {
			$where[] = 'DATE(event_date) >= CURDATE()' ;
		}
		
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
			$where[] = "a.access IN (".implode(',', $user->getAuthorisedViewLevels()).")" ;
		} else {
			$where[] = "a.access <= $aid" ;
		}
		
		
		$query = 'SELECT a.*, SUM(b.number_registrants) AS total_registrants FROM #__eb_events AS a '
		.'LEFT JOIN #__eb_registrants AS b '
		.'ON (a.id = b.event_id ) AND b.group_id = 0 AND (b.published=1 OR (b.payment_method LIKE "os_offline%" AND b.published != 2)) '
		.'WHERE '.implode(' AND ', $where)
		.' GROUP BY a.id '
		.' ORDER BY a.event_date ASC, a.ordering ASC'
		;
		$db->setQuery($query);
		
		if ($showMultipleDayEventInCalendar) {
			$rows = $db->loadObjectList() ;
			$rowEvents = array() ;
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$arrDates = explode('-', $row->event_date) ;
				if ($arrDates[0] == $year && $arrDates[1] == $month) {
					$rowEvents[] = $row ;
				}
				$startDateParts = explode(' ', $row->event_date) ;
				$startTime = strtotime($startDateParts[0]) ;
				$startDateTime = strtotime($row->event_date) ;
				$endDateParts = explode(' ', $row->event_end_date) ;
				$endTime = strtotime($endDateParts[0]) ;
				$count = 0 ;
				while ($startTime < $endTime) {
					$count++ ;
					$rowNew = clone ($row) ;
					$rowNew->event_date = date('Y-m-d H:i:s', $startDateTime + $count*24*3600);
					$arrDates = explode('-', $rowNew->event_date) ;
					if ($arrDates[0] == $year && $arrDates[1] == $month) {
						$rowEvents[] = $rowNew ;
					}
					$startTime += 24*3600 ;
				}
			}
			return $rowEvents ;
		} else {
			return $db->loadObjectList() ;
		}												
	}		
	/**
	 * returns name of the day longversion
	 * @param	daynb		int		# of day
	 * @param	colored		bool	color sunday	[ new mic, because inside tooltips a color forces an error! ]
	 **/
	function _getDayName( $daynb, $colored = false ){

		$i = $daynb % 7; // modulo 7
		if( $i == '0' && $colored === true){
			$dayname = '<span class="sunday">' . $this->getDayName($i) . '</span>';
		}
		else if( $i == '6' && $colored === true){
			$dayname = '<span class="saturday">' . $this->getDayName($i) . '</span>';
		}
		else {
			$dayname = $this->getDayName($i);
		}
		return $dayname;
	}
	
	/**
	 * Returns name of the day longversion
	 * 
	 * @static
	 * @param	int		daynb	# of day
	 * @param	int		array, 0 return single day, 1 return array of all days
	 * @return	mixed	localised short day letter or array of names
	 **/
	function getDayName( $daynb=0, $array=0){
		static $days = null;
		if ($days === null) {
			$days = array();
			$days[0] = JText::_('EB_SUNDAY');
			$days[1] = JText::_('EB_MONDAY');
			$days[2] = JText::_('EB_TUESDAY');
			$days[3] = JText::_('EB_WEDNESDAY');
			$days[4] = JText::_('EB_THURSDAY');
			$days[5] = JText::_('EB_FRIDAY');
			$days[6] = JText::_('EB_SATURDAY');
		}
		if ($array == 1) {
			return $days;
		}
		$i = $daynb % 7; //
		return $days[$i];
	}
	/**
	 * Gets calendar data for use in main calendar and module
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $short - use true for module which only requires knowledge of if dat has an event
	 * @param boolean $veryshort - use true for module which only requires dates and nothing about events
	 * @return array - calendar data array
	 */
	function _getCalendarData( $year, $month, $day){				
		$rows = $this->_listIcalEventsByMonth( $year, $month);		
		$rowcount = count( $rows );		
		$data = array();
		$data['year'] = $year;
		$data['month'] = $month;
		$month = intval($month);
		if( $month <= '9' ) {
			$month = '0' . $month;
		}
		$data['startday'] = $startday = (int) EventBookingHelper::getConfigValue('calendar_start_date');		
		// get days in week
		$data["daynames"] = array();
		for( $i = 0; $i < 7; $i++ ) {
			$data["daynames"][$i] = $this->_getDayName(($i+$startday)%7, true );
		}		
		$data["dates"]=array();		
		//Start days
		$start = (( date( 'w', mktime( 0, 0, 0, $month, 1, $year )) - $startday + 7 ) % 7 );		
		// previous month
		$priorMonth = $month-1;
		$priorYear = $year;		
		if ($priorMonth <= 0) {
			$priorMonth += 12;
			$priorYear -= 1;
		}			
		$dayCount=0;
		for( $a = $start; $a > 0; $a-- ){
			$data["dates"][$dayCount] = array();
			$data["dates"][$dayCount]["monthType"] = "prior";
			$data["dates"][$dayCount]["month"] = $priorMonth;
			$data["dates"][$dayCount]["year"] = $priorYear;
			$data["dates"][$dayCount]['countDisplay'] = 0;
			$dayCount++;
		}
		sort($data["dates"]);
		//Current month
		$end = date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year ));
		for( $d = 1; $d <= $end; $d++ ){
			$data["dates"][$dayCount]=array();
			// utility field used to keep track of events displayed in a day!
			$data["dates"][$dayCount]['countDisplay']=0;
			$data["dates"][$dayCount]["monthType"]="current";
			$data["dates"][$dayCount]["month"]=$month;
			$data["dates"][$dayCount]["year"]=$year;		
						
			$t_datenow = $this->_getNow();
			$now_adjusted = $t_datenow->toUnix(true);
			if( $month == strftime( '%m', $now_adjusted)
			&& $year == strftime( '%Y', $now_adjusted)
			&& $d == strftime( '%d', $now_adjusted)) {
				$data["dates"][$dayCount]["today"]=true;
			}else{
				$data["dates"][$dayCount]["today"]=false;
			}
			$data["dates"][$dayCount]['d']=$d;						
			$data["dates"][$dayCount]['events'] = array();
			if( $rowcount > 0 ){
				foreach ($rows as $row) {
						$date_of_event = explode('-',$row->event_date);
						$date_of_event = (int)$date_of_event[2];						
						if ($d == $date_of_event ){							
							$i=count($data["dates"][$dayCount]['events']);
							$data["dates"][$dayCount]['events'][$i] = $row;
						}					
				}
			}
			
			$dayCount++;
		}		
		// followmonth
		$days 	= ( 7 - date( 'w', mktime( 0, 0, 0, $month + 1, 1, $year )) + $startday ) %7;
		$d		= 1;
		$followMonth = $month+1;
		$followYear = $year;
		if ($followMonth>12) {
			$followMonth-=12;
			$followYear+=1;
		}
		$data["followingMonth"]=array();
		for( $d = 1; $d <= $days; $d++ ) {
			$data["dates"][$dayCount]=array();
			$data["dates"][$dayCount]["monthType"]="following";
			$data["dates"][$dayCount]["month"]=$followMonth;
			$data["dates"][$dayCount]["year"]=$followYear;
			$data["dates"][$dayCount]['countDisplay']=0;
			$dayCount++;
		}
		return $data;		
	}	
} 