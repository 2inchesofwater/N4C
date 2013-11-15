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
 * Event Booking Component Event Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelReminder extends JModel
{	
	/**
	 * Constructor function	 
	 */			
	function __construct() {
		parent::__construct();			
	}
	/**
	 * Send reminder
	 */	
	function sendReminder($numberEmailSendEachTime = 0) {	
	    if (version_compare(JVERSION, '1.6.0', 'ge'))
	        $param = null ;
	    else 
	        $param = 0 ;    				
		$config = EventBookingHelper::getConfig();
		if (!$numberEmailSendEachTime)
			$numberEmailSendEachTime = 15 ;	  
		$jconfig = new JConfig();				
		$db = & JFactory::getDBO();			
		$fromEmail =  $jconfig->mailfrom ;
		$fromName = $jconfig->fromname ;		
		$sql = 'SELECT a.id, a.first_name, a.last_name, a.email, a.register_date, a.transaction_id, b.id as event_id, b.title AS event_title, b.event_date '
			.' FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b '
			.' ON a.event_id = b.id '
			.' WHERE a.published=1 AND a.is_reminder_sent = 0 AND b.enable_auto_reminder=1 AND (DATEDIFF(b.event_date, NOW()) <= b.remind_before_x_days) AND (DATEDIFF(b.event_date, NOW()) >=0) ORDER BY b.event_date, a.register_date '
			.' LIMIT '.$numberEmailSendEachTime
		;
		$db->setQuery($sql) ;		
		$rows = $db->loadObjectList() ;		
		$subject = $config->reminder_email_subject ;
		$body = $config->reminder_email_body ;	

		$ids = array() ;
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
			$row = $rows[$i] ;
			$ids[] = $row->id ;
			$emailSubject = $subject ;
			$emailSubject = str_replace('[EVENT_TITLE]', $row->event_title , $emailSubject) ;
			$emailBody = $body ;			
			$replaces = array() ;
			$replaces['event_date'] = JHTML::_('date', $row->event_date, $config->event_date_format, $param);
			$replaces['first_name'] = $row->first_name ;
			$replaces['last_name'] = $row->last_name ;
			$replaces['event_title'] = $row->event_title ;					
			foreach ($replaces as $key=>$value) {
				$emailBody = str_replace('['.strtoupper($key).']', $value, $emailBody) ;
			}						
			JUtility::sendMail($fromEmail, $fromName, $row->email, $emailSubject, $emailBody, 1); 			
		}	
		
		if (count($ids)) {
			$sql = 'UPDATE #__eb_registrants SET is_reminder_sent = 1 WHERE id IN ('.implode(',', $ids).')';
			$db->setQuery($sql) ;
			$db->query() ;	
		}
												
	}	
} 