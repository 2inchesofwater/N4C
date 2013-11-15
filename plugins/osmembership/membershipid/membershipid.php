<?php
/**
 * @version		1.1.1
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
class plgOSMembershipMembershipId extends JPlugin
{
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */
	function onMembershipActive($row) {
		$db = JFactory::getDbo();
		if (!$row->membership_id) {
			$row->membership_id = OSMembershipHelper::getMembershipId();
			$row->store();			
		}
							
		return true ;
	}	
}
