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
class plgOSMembershipUser extends JPlugin
{
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */
	function onMembershipActive($row) {
		$db = JFactory::getDbo();
		if ($row->user_id > 0) {
			$user = JFactory::getUser($row->user_id) ;
			$user->set('block', 0);
			$user->save(true) ;
		}
		return true ;
	}
	/**
	 * Run when a membership expiried, remove the user from entered group
	 * @param PlanOsMembership $row
	 */
	function onMembershipExpire($row) {		
		$params = $this->params	 ;
		if ($row->user_id) {
			$blockAccount = $params->get('block_account_when_expired', 0);
			if ($blockAccount) {
				$user = JFactory::getUser($row->user_id) ;
				$user->set('block', 0);
				$user->save(true) ;				
			}	
		}		
		return true ;
	}
}
