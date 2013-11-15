<?php
/**
 * @version		1.0.0
 * @package		Joomla
 * @subpackage	OS Membership
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die ;

class plgOSMembershipJoomlagroups extends JPlugin
{	
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		JFactory::getLanguage()->load('plg_osmembership_joomlagroups', JPATH_ADMINISTRATOR);			
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_osmembership/tables');
	}
	/**
	 * Render settings from
	 * @param PlanOSMembership $row
	 */
	function onEditSubscriptionPlan($row) {	
		ob_start();
			$this->_drawSettingForm($row);		
			$form = ob_get_contents();	
		ob_end_clean();		
		return array('title' => JText::_('PLG_OSMEMBERSHIP_JOOMLA_GROUPS_SETTINGS'),							
					'form' => $form
		) ;				
	}

	/**
	 * Store setting into database
	 * @param PlanOsMembership $row
	 * @param Boolean $isNew true if create new plan, false if edit
	 */
	function onAfterSaveSubscriptionPlan($row, $data,$isNew) {
		$params = new JRegistry($row->params);		
		$params->set('joomla_group_ids'			, implode(',',$data['joomla_group_ids']));
		$params->set('joomla_expried_group_ids'	, implode(',',$data['joomla_expried_group_ids']));		
		$row->params = $params->toString();
		
		$row->store();
	}
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */		
	function onMembershipActive($row) {		
		if ($row->user_id) {
			$user = & JFactory::getUser($row->user_id);
			$currentGroups  = $user->get('groups') ;			
			$plan =  &JTable::getInstance('Osmembership','Plan');
			$plan->load($row->plan_id);
			$params = new JRegistry($plan->params);
			$groups = explode(',', $params->get('joomla_group_ids'));
			$currentGroups = array_unique(array_merge($currentGroups, $groups)) ;
			$user->set('groups', $currentGroups);
			$user->save(true);					
		}						
	}
	/**
	 * Run when a membership expiried die
	 * @param PlanOsMembership $row
	 */		
	function onMembershipExpire($row) {
		if ($row->user_id) {
			if (version_compare(JVERSION, '1.6.0', 'ge')) {
				$user = & JFactory::getUser($row->user_id);
				$currentGroups  = $user->get('groups') ;			
				$plan =  &JTable::getInstance('Osmembership','Plan');
				$plan->load($row->plan_id);
				$params = new JRegistry($plan->params);				
								
				$groups = explode(',', $params->get('joomla_expried_group_ids'));
				$currentGroups = array_unique(array_diff($currentGroups, $groups)) ;	
								
				$user->set('groups', $currentGroups);
				$user->save(true);
			} else {
				#Joomla 1.5, implement it later
			}
		}		
	}
	/**
	 * Display form allows users to change setting for this subscription plan 
	 * @param object $row
	 * 
	 */	
	function _drawSettingForm($row) {
		// $row of table osmembership_plans
		$params = new JRegistry($row->params);		
		$joomla_group_ids 			= explode(',',$params->get('joomla_group_ids', ''));
		$joomla_expried_group_ids 	= explode(',',$params->get('joomla_expried_group_ids', ''));		
	?>	
		<table class="admintable adminform" style="width: 90%;">
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_JOOMLA_ASSIGN_TO_JOOMLA_GROUPS'); ?>
					</td>
					<td>
						<?php
							if (version_compare(JVERSION, '1.6.0', 'ge')) {
								echo JHtml::_('access.usergroup', 'joomla_group_ids[]', $joomla_group_ids,  ' multiple="multiple" size="6" ', false) ;
							} else {
								
							}
						?>
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_JOOMLA_ASSIGN_TO_JOOMLA_GROUPS_EXPLAIN'); ?>
					</td>
				</tr>
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_JOOMLA_REMOVE_FROM_JOOMLA_GROUPS'); ?>
					</td>
					<td>
						<?php
							if (version_compare(JVERSION, '1.6.0', 'ge')) {
								echo JHtml::_('access.usergroup', 'joomla_expried_group_ids[]', $joomla_expried_group_ids, ' multiple="multiple" size="6" ', false) ;
							} else {
							
							}
						?>						
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_JOOMLA_REMOVE_FROM_JOOMLA_GROUPS_EXPLAIN'); ?>
					</td>
				</tr>	
		</table>	
	<?php							
	}
}	