<?php
/**
 * @version		1.0.0
 * @package		Joomla
 * @subpackage	OS Membership Plugins
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die ;

class plgOSMembershipDocman extends JPlugin
{	
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		
		JFactory::getLanguage()->load('plg_osmembership_docman', JPATH_ADMINISTRATOR);
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_osmembership/tables');
	}
	/**
	 * Render setting form
	 * @param PlanOSMembership $row
	 */
	function onEditSubscriptionPlan($row) {	
		if (!is_dir(JPATH_ADMINISTRATOR.'/components/com_docman')){
			return array('title' => JText::_('PLG_OSMEMBERSHIP_DOCMAN_DOCMAN_SETTINGS'),							
					'form' => JText::_('Please install component docman')
			) ;
		}		
		ob_start();
		$this->_drawSettingForm($row);		
		$form = ob_get_contents();	
		ob_end_clean();	

		return array('title' => JText::_('PLG_OSMEMBERSHIP_DOCMAN_DOCMAN_SETTINGS'),							
					'form' => $form
		) ;				
	}

	/**
	 * Store setting into database, in this case, use params field of plans table
	 * @param PlanOsMembership $row
	 * @param Boolean $isNew true if create new plan, false if edit
	 */
	function onAfterSaveSubscriptionPlan($row, $data,$isNew) {
		// $row of table osmembership_plans
		$params = new JRegistry($row->params);		
		$params->set('docman_group_ids'			, implode(',',$data['docman_group_ids']));
		$params->set('docman_expried_group_ids'	, implode(',',$data['docman_expried_group_ids']));
		$row->params = $params->toString();
		
		$row->store();
	}
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */		
	function onMembershipActive($row) {
		$db = JFactory::getDbo();
		$plan =  &JTable::getInstance('Osmembership','Plan');
		$plan->load($row->plan_id);
		$params = new JRegistry($plan->params);		
		$docman_group_ids = $params->get('docman_group_ids', '');		
		if ($docman_group_ids != ''){
			$query = "SELECT * FROM #__docman_groups WHERE `groups_id` IN ($docman_group_ids) ";
			$db->setQuery($query);
			$groups = $db->loadObjectList();			
			if (count($groups)){
				foreach ($groups as $group) {
					if ($group->groups_members) {
						$group->groups_members 		= explode(',', $group->groups_members);
					} else {
						$group->groups_members = array() ;
					}					
					$group->groups_members[] 	=  $row->user_id;
					array_unique($group->groups_members);
					$group->groups_members 		= implode(',', $group->groups_members);					
					$db->updateObject('#__docman_groups', $group, 'groups_id');
				}
			}
		}
	}
	/**
	 * Run when a membership expiried, remove the user from entered group
	 * @param PlanOsMembership $row
	 */		
	function onMembershipExpire($row) {
		$db = JFactory::getDbo();
		$plan =  &JTable::getInstance('Osmembership','Plan');
		$plan->load($row->plan_id);
		$params = new JRegistry($plan->params);		
		$docman_expried_group_ids = $params->get('docman_expried_group_ids', '');
		if ($docman_expried_group_ids != ''){				
			$query = "SELECT * FROM #__docman_groups WHERE `groups_id` IN ($docman_expried_group_ids) ";
			$db->setQuery($query);
			$groups = $db->loadObjectList();
			if (count($groups)){
				foreach ($groups as $group) {
					if ($group->groups_members) {
						$group->groups_members = explode(',',$group->groups_members);
						$group->groups_members = array_diff($group->groups_members,array($row->user_id));
						array_unique($group->groups_members);
						$group->groups_members = implode(',',$group->groups_members);
						$db->updateObject('#__docman_groups',$group,'groups_id');
					}					
				}
			}
		}
		
	}	
	/**
	 * Display form allows users to change settings on subscription plan add/edit screen 
	 * @param object $row
	 */	
	function _drawSettingForm($row) {
		$params = new JRegistry($row->params);		
		$docman_group_ids 			= explode(',',$params->get('docman_group_ids', ''));
		$docman_expried_group_ids 	= explode(',',$params->get('docman_expried_group_ids', ''));
		
		$db = JFactory::getDbo();
		$db->setQuery("SELECT `groups_id` AS value, `groups_name` AS text FROM #__docman_groups");
		$option_docman = $db->loadObjectList();
	?>
		<table class="admintable adminform" style="width: 90%;">
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_DOCMAN_ASSIGN_TO_DOCMAN_GROUPS'); ?>
					</td>
					<td>
						<?php echo JHtml::_('select.genericlist', $option_docman, 'docman_group_ids[]', 'class="inputbox" multiple="multiple" size="10"','value','text', $docman_group_ids)?>
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_DOCMAN_ASSIGN_TO_DOCMAN_GROUPS_EXPLAIN'); ?>
					</td>
				</tr>
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_DOCMAN_REMOVE_FROM_DOCMAN_GROUPs'); ?>
					</td>
					<td>
						<?php echo JHtml::_('select.genericlist', $option_docman, 'docman_expried_group_ids[]', 'class="inputbox" multiple="multiple" size="10"', 'value', 'text', $docman_expried_group_ids)?>
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_DOCMAN_REMOVE_FROM_DOCMAN_GROUPs_EXPLAIN'); ?>
					</td>
				</tr>	
		</table>	
	<?php							
	}
}	