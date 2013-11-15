<?php
/**
 * @version		1.5.1
 * @package		Joomla
 * @subpackage	OS Membership Plugins
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die ;

class plgOSMembershipAcymailing extends JPlugin
{	
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		
		JFactory::getLanguage()->load('plg_osmembership_acymailing', JPATH_ADMINISTRATOR);
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_osmembership/tables');
	}
	/**
	 * Render setting form
	 * @param PlanOSMembership $row
	 */
	function onEditSubscriptionPlan($row) {	
		if (!is_dir(JPATH_ADMINISTRATOR.'/components/com_acymailing')){
			return array('title' => JText::_('PLG_OSMEMBERSHIP_ACYMAILING_LIST_SETTINGS'),							
					'form' => JText::_('Please install component Acymailing')
			) ;
		}		
		ob_start();
		$this->_drawSettingForm($row);		
		$form = ob_get_contents();	
		ob_end_clean();	

		return array('title' => JText::_('PLG_OSMEMBERSHIP_ACYMAILING_LIST_SETTINGS'),							
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
		$params->set('acymailing_list_ids'			, implode(',', $data['acymailing_list_ids']));
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
		$listIds = $params->get('acymailing_list_ids', '');		
		if ($listIds != ''){
			require_once JPATH_ADMINISTRATOR.'/components/com_acymailing/helpers/helper.php';
			$userClass = acymailing_get('class.subscriber');
			//Check to see whether the current users has been added as subscriber or not			
			$subId = $db->loadResult();					
			$subId = $userClass->subid($row->email);
			if (!$subId) {				
				$myUser = new stdClass();				
				$myUser->email = $row->email ;				
				$myUser->name = $row->first_name.' '.$row->last_name ;
				$myUser->userid = $row->user_id ;	 				
				$subscriberClass = acymailing_get('class.subscriber');				
				$subid = $subscriberClass->save($myUser); //this				
				$subId = $db->insertId();
			}								
			$listIds = explode(',', $listIds) ;			
			$newSubscription = array();			
			foreach($listIds as $listId){
				$newList = array();
				$newList['status'] = 1;
				$newSubscription[$listId] = $newList;
			}														
														
			$userClass->saveSubscription($subId, $newSubscription);									
		}
	}		
	/**
	 * Display form allows users to change settings on subscription plan add/edit screen 
	 * @param object $row
	 */	
	function _drawSettingForm($row) {
		require_once JPATH_ADMINISTRATOR.'/components/com_acymailing/helpers/helper.php';
		$params = new JRegistry($row->params);		
		$listIds 			= explode(',',$params->get('acymailing_list_ids', ''));									
		$listClass = acymailing_get('class.list');		
		$allLists = $listClass->getLists();				
	?>
		<table class="admintable adminform" style="width: 90%;">
				<tr>
					<td width="220" class="key">
						<?php echo  JText::_('PLG_OSMEMBERSHIP_ACYMAILING_ASSIGN_TO_LIST_USER'); ?>
					</td>
					<td>
						<?php echo JHtml::_('select.genericlist', $allLists, 'acymailing_list_ids[]', 'class="inputbox" multiple="multiple" size="10"','listid', 'name', $listIds)?>
					</td>
					<td>
						<?php echo JText::_('PLG_OSMEMBERSHIP_ACYMAILING_ASSIGN_TO_LIST_USER_EXPLAIN'); ?>
					</td>
				</tr>
		</table>	
	<?php							
	}
}	