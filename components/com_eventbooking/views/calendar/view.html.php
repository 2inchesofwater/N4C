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

jimport( 'joomla.application.component.view');
/**
 * HTML View class for the Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Booking
 * @since 1.0
 */
class EventbookingViewCalendar extends JView
{
	function display($tpl = null)
	{		
		#Add calendar theme	
		$config = EventBookingHelper::getConfig() ;
		$showCalendarMenu = $config->activate_weekly_calendar_view || $config->activate_daily_calendar_view ;
		$document = & JFactory::getDocument() ;
		if ($config->calendar_theme)
			$theme = $config->calendar_theme ;
		else 
			$theme = 'default' ;	
		$styleUrl = JURI::base(true).'/components/com_eventbooking/assets/css/themes/'.$theme.'.css';		
		$document->addStylesheet( $styleUrl, 'text/css', null, null );
		
		$this->assignRef('showCalendarMenu', $showCalendarMenu) ;
		$this->assignRef('config', $config) ;
		
		#Support Weekly and Daily
		$layout = $this->getLayout();
		if ($layout == 'weekly') {
			$this->_displayWeeklyView($tpl) ;
			return ;
		}else if ($layout == 'daily'){
			$this->_displayDailyView($tpl) ;
			return ;
		}				
		//We need to pass the month and year from menu parametter yet		
        $menus = JSite::getMenu();
		$menu = $menus->getActive();
		if (is_object($menu)) {
		    if (version_compare(JVERSION, '1.6.0', 'ge')) {
		        $params = new JRegistry() ;
		        $params->loadString($menu->params) ;
		    } else {
		        $params = new JParameter($menu->params) ;   
		    }				
		    $month = JRequest::getInt('month');
		    $year = JRequest::getInt('year');
		    if (!$month) {
		         $month = (int)$params->get('default_month', 0);
		         if ($month)
			        JRequest::setVar('month', $month) ;   
		    }
		    if (!$year) {
		        $year = (int) $params->get('default_year', 0);			
			    if ($year)
			        JRequest::setVar('year', $year) ;    
		    }								    
		}								
		$model = & $this->getModel('Calendar');
		list($year,$month,$day) = $model->_getYMD();		
		$this->data = $model->_getCalendarData($year, $month, $day );
		$this->month = $month;
		$this->year = $year;		
		$listmonth = array(JText::_('EB_JAN'), JText::_('EB_FEB'), JText::_('EB_MARCH'), JText::_('EB_APR'), JText::_('EB_MAY'), JText::_('EB_JUNE'), JText::_('EB_JULY'), JText::_('EB_AUG'), JText::_('EB_SEP'), JText::_('EB_OCT'),JText::_('EB_NOV'),JText::_('EB_DEC'));
		$option_month = array();
		foreach ($listmonth AS $key => $omonth){
			if ($key < 9){
				$value = "0".($key+1);
			}			
			else {
				 $value = $key + 1;
			}
			$option_month[] = JHTML::_('select.option',$value,$omonth);
		}
		$Itemid = JRequest::getVar('Itemid',0);		
		$javascript = 'onchange="cal_date_change(this.value,'.$year.', '.$Itemid.');"';		
		$this->search_month = JHTML::_('select.genericlist',$option_month,'month','class="regpro_calendar_months" '.$javascript,'value','text',$month); 
		unset($option_month); unset($value); unset($omonth);
		
		$option_year = array();
		$javascript = 'onchange="cal_date_change('.$month.',this.value, '.$Itemid.');"';	
		for ($i = $year-3; $i < ($year+5);$i++){
			$option_year[] = JHTML::_('select.option',$i,$i);
		}
		$this->search_year = JHTML::_('select.genericlist',$option_year,'year','class="regpro_calendar_years" '.$javascript,'value','text',$year);
		unset($option_year);		
		$this->assignRef('Itemid', $Itemid) ;
		
												
		parent::display($tpl);				
	}			
	/**
	 * display event for weekly
	 *
	 * @param string $tpl
	 */
	
	function _displayWeeklyView($tpl){	    
		$model = & $this->getModel('Calendar');
		$this->events = $model->_listIcalEventsByWeek();
						
		$day = 0; 
		$week_number = date('W',time()); 
		$year = date('Y',time());
				
		$date = date('Y-m-d', strtotime($year."W".$week_number.$day));
			
		$this->first_day_of_week 	= JRequest::getVar('date', $date);
		$this->Itemid = JRequest::getInt('Itemid', 0) ;		
		
		parent::display($tpl);	
	}
	
	/**
	 * 
	 * Display Daily layout for event
	 * @param string $tpl
	 */	
	function _displayDailyView($tpl){	    
		$model = & $this->getModel('Calendar');
		$this->events = $model->_listIcalEventsByDaily();
		$this->day 	= JRequest::getVar('day',date('Y-m-d', time()));
		$this->Itemid = JRequest::getInt('Itemid', 0) ;		
						
		parent::display($tpl);	
	}
	
	
}