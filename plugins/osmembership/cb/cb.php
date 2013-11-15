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

class plgOSMembershipCB extends JPlugin
{			
	public function __construct(& $subject, $config = array())
	{		
			
		parent::__construct($subject, $config);		
	}
	/**
	 * Run when a membership activated
	 * @param PlanOsMembership $row
	 */		
	function onMembershipActive($row) {		
		if (!file_exists(JPATH_ROOT.'/components/com_comprofiler/comprofiler.php')) {
			return ;
		}				
		require_once JPATH_ROOT.'/components/com_osmembership/helper/helper.php' ;
		$integration = OSMembershipHelper::getConfigValue('cb_integration');
		if ($row->user_id) {
			$db = JFactory::getDBO();
			$sql = 'SELECT count(*) FROM `#__comprofiler` WHERE `user_id` = '.$db->Quote($row->user_id);
			$db->setQuery($sql);
			$count = $db->loadResult();			
			if ($count) {
				return ;
			}		
			
			$sql = ' SHOW FIELDS FROM #__comprofiler ';
			$db->setQuery($sql) ;
			$fields = $db->loadObjectList();
			$fieldList = array();
			for ($i = 0 , $n = count($fields); $i < $n; $i++) {
				$field = $fields[$i];
				$fieldList[] = $field->Field;
			}
												
			//Get list of fields belong to table
			
			$sql = 'SELECT name, field_mapping FROM #__osmembership_fields WHERE field_mapping != "" AND field_mapping IS NOT NULL AND is_core = 1';
			$db->setQuery($sql);
			$fields = $db->loadObjectList();
			$fieldValues = array();						
		
			if (count($fields)) {
				foreach($fields as $field) {
					$fieldName = $field->field_mapping ;
					if ($fieldName && in_array($fieldName, $fieldList)) {
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
					if ($field->field_mapping && in_array($field->field_mapping, $fieldList)) {
						$fieldValues[$field->field_mapping] = $field->field_value ;
					}					
				}
			}

			
			$profile = new stdClass() ;
			$profile->id = $row->user_id ;
			$profile->user_id = $row->user_id ;
			$profile->firstname = $row->first_name ;
			$profile->lastname = $row->last_name ;
			$profile->avatarapproved = 1 ;
			$profile->confirmed = 1 ;
			$profile->registeripaddr =  htmlspecialchars($_SERVER['REMOTE_ADDR']) ;
			$profile->banned = 0 ;
			$profile->acceptedterms = 1 ;
			foreach ($fieldValues as $fieldName => $value) {
				$profile->{$fieldName} = $value ;
			}							
			$db->insertObject('#__comprofiler', $profile) ;

			//Update the block field in users table
			$sql = 'UPDATE  #__users SET `block` = 0 WHERE id='.$row->user_id;
			$db->setQuery($sql) ;
			$db->query();
			
			return true ;			
		}											
	}
	
	function onMembershipExpire($row) {
		$blockUser = $this->params->get('block_user_on_membership_expire', 0);
		if ($row->user_id && $blockUser) {
			require_once JPATH_ROOT.'/components/com_osmembership/helper/helper.php' ;
			$activePlanIds = OSMembershipHelper::getActiveMembershipPlans($row->user_id);
			if (count($activePlanIds) == 2 && $activePlanIds[1] == $row->plan_id) {
				$this->setCBAuth($row->user_id, 0) ;
			}			
		}	
	}
		
	function setCBAuth($user_id, $auth)
	{
		$auth = $auth ? 1 : 0;
		$user_id  = (int)$user_id;
		$db = JFactory::getDBO();
		$sql = "UPDATE `#__comprofiler` SET `approved` = $auth, `confirmed` = $auth, `acceptedterms` = $auth WHERE `user_id` = $user_id";
		$db->setQuery($sql);
		$db->query();
		if($db->getError()) die($db->getError());
	}		
}	