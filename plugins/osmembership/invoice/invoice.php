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
class plgOSMembershipInvoice extends JPlugin
{
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */
	function onMembershipActive($row) {			
		if (!$row->invoice_number) {
			$row->invoice_number = OSMembershipHelper::getInvoiceNumber();
			$row->store();			
		}						
					
		return true ;
	}	
		
	function onAfterStoreSubscription($row) {
		if ($row->payment_method == 'os_offline' && !$row->invoice_number) {
			$row->invoice_number = OSMembershipHelper::getInvoiceNumber();
			$row->store();
		}
	}
}
