<?php
/**
 * @version		1.0.0
 * @package		Joomla
 * @subpackage	OS Membership
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2012 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die;
/**
 * OS Membership Reminder Plugin
 *
 * @package		Joomla
 * @subpackage	OS Membership
 */
class plgSystemOSMembershipReminder extends JPlugin
{
	function onAfterInitialise()
	{		
		jimport('joomla.filesystem.file');
		if (JFile::exists(JPATH_ROOT.'/components/com_osmembership/osmembership.php')) {			
			$lastRun = (int) $this->params->get('last_run', 0);
			$numberEmailSendEachTime = (int) $this->params->get('number_subscribers', 5);
			$currentTime = time() ;
			$numberMinutes = ($currentTime - $lastRun)/60 ;
			//This plugin win runs in each 30 minutes
			if ($numberMinutes >= 0) {
				require_once JPATH_ROOT.'/components/com_osmembership/helper/helper.php' ;
				$db = & JFactory::getDbo() ;											
				//First reminders emails				
				$sql = ' SELECT a.id, a.plan_id, a.first_name, a.last_name, a.email, a.to_date, DATEDIFF(to_date, NOW()) AS number_days, b.title AS plan_title FROM #__osmembership_subscribers AS a '
					.' INNER JOIN #__osmembership_plans AS b '
					.' ON a.plan_id = b.id '
					.' WHERE a.published = 1 AND a.first_reminder_sent = 0  AND (b.send_first_reminder > 0 AND b.send_first_reminder >= DATEDIFF(to_date, NOW())) '
					.' ORDER BY a.to_date '
					.' LIMIT '.$numberEmailSendEachTime							
				;

				$db->setQuery($sql) ;												
				$rows = $db->loadObjectList();
												
				OSMembershipHelper::sendFirstReminderEmails($rows);				
				//Second reminders email

				$sql = ' SELECT a.id, a.plan_id, a.first_name, a.last_name, a.email, a.to_date, DATEDIFF(to_date, NOW()) AS number_days, b.title AS plan_title FROM #__osmembership_subscribers AS a '
				.' INNER JOIN #__osmembership_plans AS b '
				.' ON a.plan_id = b.id '
				.' WHERE a.published = 1 AND a.second_reminder_sent = 0  AND (b.send_second_reminder > 0 AND b.send_second_reminder >= DATEDIFF(to_date, NOW())) '
				.' ORDER BY a.to_date '
				.' LIMIT '.$numberEmailSendEachTime
				;
								
				$db->setQuery($sql) ;
				$rows = $db->loadObjectList();
				OSMembershipHelper::sendSecondReminderEmails($rows);
												
				//Store last run time
				$this->params->set('last_run', $currentTime);
				$params = $this->params->toString();
				if (version_compare(JVERSION, '1.6.0', 'ge')) {
					$sql = 'SELECT extension_id FROM #__extensions WHERE `element`="osmembershipreminder" AND `folder`="system"';
					$db->setQuery($sql) ;
					$pluginId = $db->loadResult() ;
					$sql = 'UPDATE #__extensions SET params='.$db->quote($params).' WHERE extension_id='.$pluginId ;
					$db->setQuery($sql);
					$db->query();
				} else {
					$sql = 'SELECT id FROM #__plugins WHERE `element`="osmembershipreminder" AND `folder`="system"';
					$db->setQuery($sql) ;
					$pluginId = $db->loadResult() ;
					$sql = 'UPDATE #__plugins SET 	params='.$db->quote($params).' WHERE id='.$pluginId ;
					$db->setQuery($sql);
					$db->query();						
				}					
			}							
		}				
		return true ;		
	}
}
