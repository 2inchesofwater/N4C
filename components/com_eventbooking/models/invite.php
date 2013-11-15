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
class EventBookingModelInvite extends JModel
{	
	/**
	 * Constructor function
	 * Send invitation
	 */			
	function __construct() {
		parent::__construct();			
	}
	/**
	 * Send invitation	
	 */	
	function sendInvite($data) {
		$Itemid = (int) $data['Itemid'] ;
		$eventId = $data['event_id'] ;
		$config = EventBookingHelper::getConfig();
		$jconfig = new JConfig();				
		$db = & JFactory::getDBO();			
		$fromEmail =  $jconfig->mailfrom ;
		$fromName = $jconfig->fromname ;			
		$sql = "SELECT * FROM #__eb_events WHERE id=".$eventId ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();					
		$link = JURI::base().'index.php?option=com_eventbooking&task=view_event&event_id='.$eventId.'&Itemid='.$Itemid; 
		$eventLink = '<a href="'.$link.'">'.$link.'</a>';
		$replaces = array() ;		
		$replaces['event_title'] = $event->title ;				
		$replaces['sender_name'] = $data['name'] ;
		$replaces['PERSONAL_MESSAGE'] = $data['message'] ;
		$replaces['event_detail_link'] = $eventLink ;
		//Override config messages		
		$subject = $config->invitation_email_subject;
		$body = $config->invitation_email_body ;					
		$subject = str_replace('[EVENT_TITLE]', $event->title, $subject) ;		
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}																						
		$emails = explode("\r\n", $data['friend_emails']);
		$names = explode("\r\n", $data['friend_names']);		
		for ($i = 0 , $n = count($emails) ; $i < $n ; $i++) {
			$emailBody = $body ;
			$email = $emails[$i] ;
			$name = $names[$i] ;			
			if ($name && $email) {
				$emailBody = str_replace('[NAME]', $name, $emailBody) ;
				//Send emails here
				JUtility::sendMail($fromEmail, $fromName, $email, $subject, $emailBody, 1); 
			}
		}							
	}	
} 