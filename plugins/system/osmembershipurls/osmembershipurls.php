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

class plgSystemOSMembershipUrls extends JPlugin
{
	function onAfterInitialise()
	{				
		$app = JFactory::getApplication() ;
		JFactory::getLanguage()->load('plg_osmembershipurls', JPATH_ADMINISTRATOR) ;		
		if ($app->isAdmin())
			return true ;	
		if (JPluginHelper::isEnabled('osmembership', 'urls')) {
			$db = & JFactory::getDbo() ;
			$currentUrl = trim(JURI::current()) ;			
			//remove www in the url
			$currentUrl = str_replace('www.', '', $currentUrl) ;		
			$siteURL = JURI::root() ;
			$siteURL = str_replace('www.', '', $siteURL) ;
			if ($siteURL == $currentUrl) {
				//Dont' prevent access to homepage
				return ;
			}
							
			$sql = 'SELECT DISTINCT plan_id FROM #__osmembership_urls WHERE url LIKE "'.$currentUrl.'%"';
			$db->setQuery($sql);
			$planIds = $db->loadResultArray() ;
			if (count($planIds)) {
				//Check to see the current user has an active subscription plans
				require_once JPATH_ROOT.'/components/com_osmembership/helper/helper.php';
				$activePlans = OSMembershipHelper::getActiveMembershipPlans();
				if (!count(array_intersect($planIds, $activePlans))) {
					//Get title of these subscription plans
					$sql = 'SELECT title FROM #__osmembership_plans WHERE id IN ('.implode(',', $planIds).') AND published=1 ORDER BY ordering';
					$db->setQuery($sql) ;
					$planTitles = $db->loadResultArray();
					$planTitles = implode(' OR ', $planTitles);
					$msg = JText::_('OS_MEMBERSHIP_URL_ACCESS_RESITRICTED');
					$msg = str_replace('[PLAN_TITLES]', $planTitles, $msg) ;		
					$redirectUrl = $this->params->get('redirect_url');
					if (!$redirectUrl) {
						$redirectUrl = JURI::root() ;
					}								
					JFactory::getApplication()->redirect($redirectUrl, $msg);			
				}				
			}			
		}
	}
}

