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

class plgOSMembershipJomSocial extends JPlugin
{	
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		JFactory::getLanguage()->load('plg_osmembership_jomsocial', JPATH_ADMINISTRATOR);			
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
		return array('title' => JText::_('PLG_OSMEMBERSHIP_JOMSOCIAL_SETTINGS'),							
					'form' => $form
		) ;				
	}

	/**
	 * Store setting into database
	 * @param PlanOsMembership $row
	 * @param Boolean $isNew true if create new plan, false if edit
	 */
	function onAfterSaveSubscriptionPlan($row, $data,$isNew) {
		// $row of table osmembership_groups
		$params = new JRegistry($row->params);		
		$params->set('jomsocial_group_ids'			, implode(',',$data['jomsocial_group_ids']));
		$params->set('jomsocial_expried_group_ids'	, implode(',',$data['jomsocial_expried_group_ids']));		
		$row->params = $params->toString();
		
		$row->store();
	}
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */		
	function onMembershipActive($row) {		
		if ($row->user_id) {
			$db = & JFactory::getDbo() ;
			$sql = 'SELECT COUNT(*) FROM #__community_users WHERE userid='.$row->user_id ;
			$db->setQuery($sql);
			$count = $db->loadResult();
			if ($count) {
				return ;
			}			
						
			$sql = 'INSERT INTO #__community_users(userid) VALUES('.$row->user_id.')';
			$db->setQuery($sql);
			$db->query();
			
			$sql = 'SELECT id, fieldcode FROM #__community_fields WHERE published=1 AND fieldcode != ""' ;
			$db->setQuery($sql);
			$rowFields = $db->loadObjectList();
			$fieldList = array();
			foreach ($rowFields as $rowField) {
				$fieldList[$rowField->fieldcode] = $rowField->id ; 
			}

			
			$sql = 'SELECT name, field_mapping FROM #__osmembership_fields WHERE field_mapping != "" AND field_mapping IS NOT NULL AND is_core = 1';
			$db->setQuery($sql);
			$fields = $db->loadObjectList();
			$fieldValues = array();
			
			if (count($fields)) {
				foreach($fields as $field) {
					$fieldName = $field->field_mapping ;
					if ($fieldName) {
						$fieldValues[$fieldName] = $row->{$field->name} ;
					}
				}
			}
				
			$sql = 'SELECT a.field_mapping, b.field_value FROM #__osmembership_fields AS a '
			.' INNER JOIN #__osmembership_field_value AS b '
			.' ON a.id = b.field_id '
			.' WHERE b.subscriber_id='.$row->id
			
			;
			$db->setQuery($sql);
			$fields = $db->loadObjectList();
			if (count($fields)) {
				foreach($fields as $field) {
					if ($field->field_mapping) {
						$fieldValues[$field->field_mapping] = $field->field_value ;
					}
				}
			}			
									
			if (count($fieldValues)) {
				foreach($fieldValues as $fieldCode => $fieldValue) {
					if (isset($fieldList[$fieldCode])) {
						$fieldId = $fieldList[$fieldCode] ;
						if ($fieldId) {
							$fieldValue = $db->quote($fieldValue);
							$sql = "INSERT INTO #__community_fields_values(user_id, field_id, `value`, `access`) VALUES($row->user_id, $fieldId, $fieldValue, 1)";
							$db->setQuery($sql);
							$db->query();
							echo $db->getQuery();
						}
					}							
				}	
			}
			
			$plan =  &JTable::getInstance('Osmembership','Plan');
			$plan->load($row->plan_id);
			$params = new JRegistry($plan->params);					
			$groups = explode(',', $params->get('jomsocial_group_ids'));
			if (count($groups)) {
				$sql = 'REPLACE INTO `#__community_groups_members` (`memberid`,`groupid`,`approved`,`permissions`) VALUES ';
					
				$values = array();
				foreach($groups as $group) {
					$values[] = '('.$db->Quote($row->user_id).', '.$db->Quote($group).', 1, 1)';
				}
					
				$sql .= implode(', ', $values);
					
				$db->setQuery($sql);
				$db->query();
			}											
		}
				
		return true ;
	}
	/**
	 * Run when a membership expiried die
	 * @param PlanOsMembership $row
	 */		
	function onMembershipExpire($row) {
		if ($row->user_id) {
			$plan =  &JTable::getInstance('Osmembership','Plan');
			$plan->load($row->plan_id);
			$params = new JRegistry($plan->params);							
			$groups = explode(',', $params->get('jomsocial_expried_group_ids'));
			if (count($groups)) {
				$db = & JFactory::getDbo() ;
				foreach ($groups as $group) {
					$sql = 'DELETE FROM #__community_groups_members WHERE groupid='.$group.' AND memberid='.$row->user_id ;
					$db->setQuery($sql);
					$db->query();
				}
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
		$jomsocial_group_ids 			= explode(',',$params->get('jomsocial_group_ids', ''));
		$jomsocial_expried_group_ids 	= explode(',',$params->get('jomsocial_expried_group_ids', ''));	

		$db = & JFactory::getDbo() ;
		$sql = 'SELECT id, name FROM #__community_groups WHERE published = 1 ORDER BY name ';
		$db->setQuery($sql);

		$options = array();
		$options[] = JHTML::_('select.option', 0, JText::_('Choose Groups'), 'id', 'name');
		$options = array_merge($options, $db->loadObjectList()) ;		
	?>	
		<table class="admintable adminform" style="width: 90%;">
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_JOMSOCIAL_ASSIGN_TO_GROUPS'); ?>
					</td>
					<td>
						<?php
							echo JHTML::_('select.genericlist', $options, 'jomsocial_group_ids[]', ' multiple="multiple" size="6" ', 'id', 'name', $jomsocial_group_ids); 							
						?>
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_JOMSOCIAL_ASSIGN_TO_GROUPS_EXPLAIN'); ?>
					</td>
				</tr>
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_JOMSOCIAL_REMOVE_FROM_GROUPS'); ?>
					</td>
					<td>
						<?php
							echo JHTML::_('select.genericlist', $options, 'jomsocial_expried_group_ids[]', ' multiple="multiple" size="6" ', 'id', 'name', $jomsocial_expried_group_ids);
						?>						
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_JOMSOCIAL_REMOVE_FROM_GROUPS_EXPLAIN'); ?>
					</td>
				</tr>	
		</table>	
	<?php							
	}
}	