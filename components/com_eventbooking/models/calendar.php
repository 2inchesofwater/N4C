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
class EventBookingModelCalendar extends JModel
{
	/**
	 * Categories data array
	 *
	 * @var array
	 */
	var $_data = null;	

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()	{
		parent::__construct();				
	}
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

			$year	= min(2100, abs(intval(JRequest::getVar('year',	$year))));
			$month	= min(99, abs(intval(JRequest::getVar('month',	$month))));
			$day	= min(3650, abs(intval(JRequest::getVar('day',	$day))));
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
		
    /**
     * 
     * Get list of events by current month
     * @param int $year
     * @param int $month
     */
	function _listIcalEventsByMonth( $year, $month){
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events');
		$showMultipleDayEventInCalendar = EventBookingHelper::getConfigValue('show_multiple_days_event_in_calendar');			
		$db = JFactory::getDBO();
		$user = & JFactory::getUser() ;
		$aid		= $user->get('aid', 0);
		$startdate 	= mktime( 0, 0, 0,  $month,  1, $year );
		$enddate 	= mktime( 23, 59, 59,  $month, date( 't', $startdate), $year );
		$startdate = date('Y-m-d',$startdate)." 00:00:00";
		$enddate = date('Y-m-d',$enddate)." 23:59:59";
		$where = array() ;
		$where[] = 'a.`published` = 1';
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
		$data['startday'] = $startday = (int) EventBookingHelper::getConfigValue('calendar_start_date') ;		
		// get days in week
		$data["daynames"] = array();
		for( $i = 0; $i < 7; $i++ ) {
			$data["daynames"][$i] = $this->_getDayName(($i + $startday)%7, true );
		}		
		$data["dates"] = array();		
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
			$data["dates"][$dayCount] = array();
			// utility field used to keep track of events displayed in a day!
			$data["dates"][$dayCount]['countDisplay'] = 0;
			$data["dates"][$dayCount]["monthType"] = "current";
			$data["dates"][$dayCount]["month"] = $month;
			$data["dates"][$dayCount]["year"] = $year;		
						
			$t_datenow = $this->_getNow();
			$now_adjusted = $t_datenow->toUnix(true);
			if( $month == strftime( '%m', $now_adjusted)
			&& $year == strftime( '%Y', $now_adjusted)
			&& $d == strftime( '%d', $now_adjusted)) {
				$data["dates"][$dayCount]["today"] = true;
			}else{
				$data["dates"][$dayCount]["today"] = false;
			}
			$data["dates"][$dayCount]['d'] = $d;						
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
	/**
	 * list event by week
	 *
	 * @param unknown_type $year
	 * @param unknown_type $month
	 * @return unknown
	 */
	function _listIcalEventsByWeek(){
		
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events');
		$db = JFactory::getDBO();
		$user = & JFactory::getUser() ;
		$aid		= $user->get('aid', 0);
		
		// get first day of week of today
		$day = 0; 
		$week_number = date('W',time()); 
		$year = date('Y',time());
		$date = date('Y-m-d', strtotime($year."W".$week_number.$day));
		

		$first_day_of_week 	= JRequest::getVar('date',$date);
		$last_day_of_week 	= date('Y-m-d',strtotime("+6 day", strtotime($first_day_of_week)));
		$startdate 			= $first_day_of_week." 00:00:00";
		$enddate 			= $last_day_of_week." 23:59:59";
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
    		if ($hidePastEvents) {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND DATE(event_date) >= CURDATE() AND a.access IN(".implode(',', $user->getAuthorisedViewLevels()).") "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;
    		} else {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND a.access IN (".implode(',', $user->getAuthorisedViewLevels()).") "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;	
    		}
		} else {
    		if ($hidePastEvents) {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND DATE(event_date) >= CURDATE() AND a.access <= $aid "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;
    		} else {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND a.access <= $aid "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;	
    		}   
		}		
					
		$db->setQuery($query);
		$events = $db->loadObjectList();

		$eventArr = array() ;				
		foreach ($events as $event) {
			$eventArr[date('w',strtotime($event->event_date))][] = $event;
		}
		
		return $eventArr ;
	}	
	/**
	 * list events for day
	 *
	 */
	function _listIcalEventsByDaily(){
		$hidePastEvents = EventBookingHelper::getConfigValue('hide_past_events');
		$db = JFactory::getDBO();
		$user = & JFactory::getUser() ;
		$aid		= $user->get('aid', 0);
		
		$day 	= JRequest::getVar('day',date('Y-m-d', time()));
		$startdate 			= $day." 00:00:00";
		$enddate 			= $day." 23:59:59";
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
		    if ($hidePastEvents) {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND DATE(event_date) >= CURDATE() AND a.access IN (".implode(',', $user->getAuthorisedViewLevels()).") "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;
    		} else {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND a.access IN (".implode(',', $user->getAuthorisedViewLevels()).") "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;	
    		}  
		} else {
    		if ($hidePastEvents) {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND DATE(event_date) >= CURDATE() AND a.access <= $aid "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;
    		} else {
    			$query = " SELECT * FROM #__eb_events AS a " 
    				." WHERE (`published` = 1) AND (`event_date` BETWEEN '$startdate' AND '$enddate') AND a.access <= $aid "				
    				." ORDER BY event_date ASC, ordering ASC"
    				;	
    		}   
		}		
					
		$db->setQuery($query);
		$events = $db->loadObjectList();
		
		return $events;
	}			
}
?>