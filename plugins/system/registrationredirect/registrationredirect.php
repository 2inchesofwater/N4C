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
class plgSystemRegistrationRedirect extends JPlugin
{
	function onAfterRoute()
	{		
		jimport('joomla.filesystem.file');
		if (JFile::exists(JPATH_ROOT.'/components/com_osmembership/osmembership.php')) {			
			$option = JRequest::getCmd('option');
			$task = JRequest::getCmd('task');
			$view = JRequest::getCmd('view') ;		
		}	

		if (($option == 'com_users' && $view == 'registration') || ($option == 'com_comprofiler' && $task == 'registers')) {
			$url = $this->params->get('redirect_url');
			if (!$url) {
				$Itemid = OSMembershipHelper::getItemid();
				$url = JRoute::_('index.php?option=com_osmembership&view=plans&Itemid='.$Itemid);				
			}
						
			JFactory::getApplication()->redirect($url);
		}
		
		return true ;		
	}
}
