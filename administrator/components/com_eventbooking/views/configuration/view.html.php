<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

jimport( 'joomla.application.component.view');
/**
 * HTML View class for Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingViewConfiguration extends JView
{
	function display($tpl = null)
	{		
		$db = & JFactory::getDBO();
		$config = $this->get('Data');
		$options = array() ;
		$options[] =  JHTML::_('select.option', 0, JText::_('EB_NO_INTEGRATION')) ;
		$options[] = JHTML::_('select.option', 1 , JText::_('EB_CB')) ;
		$options[] = JHTML::_('select.option', 2 , JText::_('EB_JS')) ;
		
		$lists['cb_integration'] = JHTML::_('select.genericlist', $options,  'cb_integration', ' class="inputbox" ', 'value' , 'text' , $config->cb_integration);						
		$lists['user_registration'] = JHTML::_('select.booleanlist', 'user_registration', '', $config->user_registration);
		$lists['use_https'] = JHTML::_('select.booleanlist', 'use_https', '', $config->use_https);		
		$lists['collect_member_information'] = JHTML::_('select.booleanlist', 'collect_member_information', '', $config->collect_member_information);
		$lists['show_pending_registrants'] = JHTML::_('select.booleanlist', 'show_pending_registrants', '', $config->show_pending_registrants);
				
		$lists['event_custom_field'] = JHTML::_('select.booleanlist', 'event_custom_field', '', $config->event_custom_field);
		
		$lists['multiple_booking'] = JHTML::_('select.booleanlist', 'multiple_booking', '', $config->multiple_booking);		
		$lists['prevent_duplicate_registration'] = JHTML::_('select.booleanlist', 'prevent_duplicate_registration', '', $config->prevent_duplicate_registration);
		
		
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('EB_SUNDAY'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_MONDAY'));
		$lists['calendar_start_date'] = JHTML::_('select.genericlist', $options, 'calendar_start_date', ' class="inputbox" ', 'value', 'text', $config->calendar_start_date);
						
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('EB_NO_NO'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_FREE_EVENT_ONLY'));
		$options[] = JHTML::_('select.option', 2, JText::_('EB_PAID_EVENT_ONLY'));
		$options[] = JHTML::_('select.option', 3, JText::_('EB_BOTH_FREE_AND_PAID'));
		$lists['enable_captcha'] = JHTML::_('select.genericlist', $options, 'enable_captcha', ' class="inputbox" ', 'value', 'text', $config->enable_captcha );													
		$lists['fix_next_button'] = JHTML::_('select.booleanlist', 'fix_next_button', '', $config->fix_next_button);		
		$lists['fix_term_and_condition_popup'] = JHTML::_('select.booleanlist', 'fix_term_and_condition_popup', '', $config->fix_term_and_condition_popup);
		$lists['activate_recurring_event'] = JHTML::_('select.booleanlist', 'activate_recurring_event', '', $config->activate_recurring_event);
		
		$lists['fix_breadcrumbs'] = JHTML::_('select.booleanlist', 'fix_breadcrumbs', '', $config->fix_breadcrumbs);
							
		$sql = 'SELECT id, title FROM #__content WHERE `state` = 1 ORDER BY title ';
		$db->setQuery($sql) ;
		$rows = $db->loadObjectList();
		$options = array() ;
		$options[] = JHTML::_('select.option', 0 , JText::_('EB_SELECT_ARTICLE'), 'id', 'title') ;
		$options = array_merge($options, $rows) ;		
		$lists['article_id'] = JHTML::_('select.genericlist', $options, 'article_id', ' class="inputbox" ', 'id', 'title', $config->article_id) ;				
		$lists['active_term'] = JHTML::_('select.booleanlist', 'accept_term', '', $config->accept_term);
		$lists['term_condition_by_event'] = JHTML::_('select.booleanlist', 'term_condition_by_event', '', $config->term_condition_by_event);
		$lists['display_state_dropdown'] = JHTML::_('select.booleanlist', 'display_state_dropdown', '', $config->display_state_dropdown);		
		$lists['hide_past_events'] = JHTML::_('select.booleanlist', 'hide_past_events', '', $config->hide_past_events);		
		$lists['enable_coupon'] = JHTML::_('select.booleanlist', 'enable_coupon', '', $config->enable_coupon);
		$lists['enable_tax'] = JHTML::_('select.booleanlist', 'enable_tax', '', $config->enable_tax);

		$options = array() ;
		$options[] = JHTML::_('select.option', 1, JText::_('EB_ORDERING'));
		$options[] = JHTML::_('select.option', 2, JText::_('EB_EVENT_DATE'));
		$lists['order_events'] = JHTML::_('select.genericlist', $options, 'order_events', '  class="inputbox" ', 'value', 'text', $config->order_events);		
														
				
		//Get list of country
		$sql = 'SELECT name AS value, name AS text FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql);		
		$rowCountries = $db->loadObjectList();
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_DEFAULT_COUNTRY'));
		$options = array_merge($options, $rowCountries);
		$lists['country_list'] = JHTML::_('select.genericlist', $options, 'default_country', '', 'value', 'text', $config->default_country);								
		//Theme configuration
		
		
		$options = array() ;		
		$options[] = JHTML::_('select.option', 'default', JText::_('EB_DEFAULT'));
		$options[] = JHTML::_('select.option', 'fire', JText::_('EB_FIRE'));
		$options[] = JHTML::_('select.option', 'leaf', JText::_('EB_LEAF'));		
		//$options[] = JHTML::_('select.option', 'ocean', JText::_('EB_OCEAN'));
		$options[] = JHTML::_('select.option', 'sky', JText::_('EB_SKY'));
		$options[] = JHTML::_('select.option', 'tree', JText::_('EB_TREE'));		
		
		$lists['calendar_theme'] = JHTML::_('select.genericlist', $options, 'calendar_theme', ' class="inputbox" ', 'value', 'text', $config->calendar_theme);
		$lists['show_event_time'] = JHTML::_('select.booleanlist', 'show_event_time', '', $config->show_event_time);
		$lists['activate_deposit_feature'] = JHTML::_('select.booleanlist', 'activate_deposit_feature', '', $config->activate_deposit_feature);
		$lists['activate_waitinglist_feature'] = JHTML::_('select.booleanlist', 'activate_waitinglist_feature', '', $config->activate_waitinglist_feature);
				
									
		$lists['show_empty_cat'] = JHTML::_('select.booleanlist', 'show_empty_cat', '', $config->show_empty_cat);
		$lists['show_number_events'] = JHTML::_('select.booleanlist', 'show_number_events', '', $config->show_number_events);
		$lists['show_capacity'] = JHTML::_('select.booleanlist', 'show_capacity', '', $config->show_capacity);
		$lists['show_registered'] = JHTML::_('select.booleanlist', 'show_registered', '', $config->show_registered);
		$lists['show_available_place'] = JHTML::_('select.booleanlist', 'show_available_place', '', $config->show_available_place);		
		$lists['show_list_of_registrants'] = JHTML::_('select.booleanlist', 'show_list_of_registrants', '', $config->show_list_of_registrants);
		$lists['process_plugin'] = JHTML::_('select.booleanlist', 'process_plugin', '', $config->process_plugin);
		$lists['show_cat_decription_in_table_layout'] = JHTML::_('select.booleanlist', 'show_cat_decription_in_table_layout', '', $config->show_cat_decription_in_table_layout);				
		$lists['show_price_in_table_layout'] = JHTML::_('select.booleanlist', 'show_price_in_table_layout', '', $config->show_price_in_table_layout);					
		$lists['show_cat_decription_in_calendar_layout'] = JHTML::_('select.booleanlist', 'show_cat_decription_in_calendar_layout', '', $config->show_cat_decription_in_calendar_layout);				
		$lists['display_message_for_full_event'] = JHTML::_('select.booleanlist', 'display_message_for_full_event', '', $config->display_message_for_full_event);
		$lists['show_event_date'] = JHTML::_('select.booleanlist', 'show_event_date', '', $config->show_event_date);
		$lists['show_location_in_category_view'] = JHTML::_('select.booleanlist', 'show_location_in_category_view', '', $config->show_location_in_category_view);
		$lists['show_fb_like_button'] = JHTML::_('select.booleanlist', 'show_fb_like_button', '', $config->show_fb_like_button);
		$lists['show_social_bookmark'] = JHTML::_('select.booleanlist', 'show_social_bookmark', '', $config->show_social_bookmark);		
		$lists['show_invite_friend'] = JHTML::_('select.booleanlist', 'show_invite_friend', '', $config->show_invite_friend);		
		$lists['show_price_for_free_event'] = JHTML::_('select.booleanlist', 'show_price_for_free_event', '', $config->show_price_for_free_event);		
		$lists['include_group_billing_in_csv_export'] = JHTML::_('select.booleanlist', 'include_group_billing_in_csv_export', '', isset($config->include_group_billing_in_csv_export) ? $config->include_group_billing_in_csv_export : 1);
		$lists['include_group_billing_in_registrants'] = JHTML::_('select.booleanlist', 'include_group_billing_in_registrants', '', isset($config->include_group_billing_in_registrants) ? $config->include_group_billing_in_registrants : 1 );		
		$lists['include_group_members_in_csv_export'] = JHTML::_('select.booleanlist', 'include_group_members_in_csv_export', '', isset($config->include_group_members_in_csv_export) ? $config->include_group_members_in_csv_export : 0);
		$lists['include_group_members_in_registrants'] = JHTML::_('select.booleanlist', 'include_group_members_in_registrants', '', isset($config->include_group_members_in_registrants) ? $config->include_group_members_in_registrants : 0 );
		$lists['show_event_location_in_email'] = JHTML::_('select.booleanlist', 'show_event_location_in_email', '', $config->show_event_location_in_email );		
		$lists['show_discounted_price'] = JHTML::_('select.booleanlist', 'show_discounted_price', '', $config->show_discounted_price);
		$lists['activate_weekly_calendar_view'] = JHTML::_('select.booleanlist', 'activate_weekly_calendar_view', '', $config->activate_weekly_calendar_view);
		$lists['activate_daily_calendar_view'] = JHTML::_('select.booleanlist', 'activate_daily_calendar_view', '', $config->activate_daily_calendar_view);		
		$lists['show_coupon_code_in_registrant_list'] = JHTML::_('select.booleanlist', 'show_coupon_code_in_registrant_list', '', $config->show_coupon_code_in_registrant_list);		
		$lists['show_multiple_days_event_in_calendar'] = JHTML::_('select.booleanlist', 'show_multiple_days_event_in_calendar', '', $config->show_multiple_days_event_in_calendar);
		
		//Fields configuration				
		$lists['s_lastname'] = JHTML::_('select.booleanlist', 's_lastname', '', $config->s_lastname);
		$lists['r_lastname'] = JHTML::_('select.booleanlist', 'r_lastname', '', $config->r_lastname);		
		$lists['s_organization'] = JHTML::_('select.booleanlist', 's_organization', '', $config->s_organization);
		$lists['r_organization'] = JHTML::_('select.booleanlist', 'r_organization', '', $config->r_organization);
		$lists['s_address'] = JHTML::_('select.booleanlist', 's_address', '', $config->s_address);
		$lists['r_address'] = JHTML::_('select.booleanlist', 'r_address', '', $config->r_address);		
		$lists['s_address2'] = JHTML::_('select.booleanlist', 's_address2', '', $config->s_address2);
		$lists['r_address2'] = JHTML::_('select.booleanlist', 'r_address2', '', $config->r_address2);
		$lists['s_city'] = JHTML::_('select.booleanlist', 's_city', '', $config->s_city);
		$lists['r_city'] = JHTML::_('select.booleanlist', 'r_city', '', $config->r_city);
		$lists['s_state'] = JHTML::_('select.booleanlist', 's_state', '', $config->s_state);
		$lists['r_state'] = JHTML::_('select.booleanlist', 'r_state', '', $config->r_state);
		$lists['s_zip'] = JHTML::_('select.booleanlist', 's_zip', '', $config->s_zip);
		$lists['r_zip'] = JHTML::_('select.booleanlist', 'r_zip', '', $config->r_zip);
		$lists['s_country'] = JHTML::_('select.booleanlist', 's_country', '', $config->s_country);
		$lists['r_country'] = JHTML::_('select.booleanlist', 'r_country', '', $config->r_country);
		$lists['s_phone'] = JHTML::_('select.booleanlist', 's_phone', '', $config->s_phone);
		$lists['r_phone'] = JHTML::_('select.booleanlist', 'r_phone', '', $config->r_phone);
		$lists['s_fax'] = JHTML::_('select.booleanlist', 's_fax', '', $config->s_fax);
		$lists['r_fax'] = JHTML::_('select.booleanlist', 'r_fax', '', $config->r_fax);
		$lists['s_comment'] = JHTML::_('select.booleanlist', 's_comment', '', $config->s_comment);
		$lists['r_comment'] = JHTML::_('select.booleanlist', 'r_comment', '', $config->r_comment);
		
		//Group fields configuration
		
		$lists['gs_lastname'] = JHTML::_('select.booleanlist', 'gs_lastname', '', $config->gs_lastname);
		$lists['gr_lastname'] = JHTML::_('select.booleanlist', 'gr_lastname', '', $config->gr_lastname);		
		$lists['gs_organization'] = JHTML::_('select.booleanlist', 'gs_organization', '', $config->gs_organization);
		$lists['gr_organization'] = JHTML::_('select.booleanlist', 'gr_organization', '', $config->gr_organization);
		$lists['gs_address'] = JHTML::_('select.booleanlist', 'gs_address', '', $config->gs_address);
		$lists['gr_address'] = JHTML::_('select.booleanlist', 'gr_address', '', $config->gr_address);		
		$lists['gs_address2'] = JHTML::_('select.booleanlist', 'gs_address2', '', $config->gs_address2);
		$lists['gr_address2'] = JHTML::_('select.booleanlist', 'gr_address2', '', $config->gr_address2);
		$lists['gs_city'] = JHTML::_('select.booleanlist', 'gs_city', '', $config->gs_city);
		$lists['gr_city'] = JHTML::_('select.booleanlist', 'gr_city', '', $config->gr_city);
		$lists['gs_state'] = JHTML::_('select.booleanlist', 'gs_state', '', $config->gs_state);
		$lists['gr_state'] = JHTML::_('select.booleanlist', 'gr_state', '', $config->gr_state);
		$lists['gs_zip'] = JHTML::_('select.booleanlist', 'gs_zip', '', $config->gs_zip);
		$lists['gr_zip'] = JHTML::_('select.booleanlist', 'gr_zip', '', $config->gr_zip);
		$lists['gs_country'] = JHTML::_('select.booleanlist', 'gs_country', '', $config->gs_country);
		$lists['gr_country'] = JHTML::_('select.booleanlist', 'gr_country', '', $config->gr_country);
		$lists['gs_phone'] = JHTML::_('select.booleanlist', 'gs_phone', '', $config->gs_phone);
		$lists['gr_phone'] = JHTML::_('select.booleanlist', 'gr_phone', '', $config->gr_phone);
		$lists['gs_fax'] = JHTML::_('select.booleanlist', 'gs_fax', '', $config->gs_fax);
		$lists['gr_fax'] = JHTML::_('select.booleanlist', 'gr_fax', '', $config->gr_fax);
		$lists['gs_email'] = JHTML::_('select.booleanlist', 'gs_email', '', $config->gs_email);
		$lists['gr_email'] = JHTML::_('select.booleanlist', 'gr_email', '', $config->gr_email);
		$lists['gs_comment'] = JHTML::_('select.booleanlist', 'gs_comment', '', $config->gs_comment);
		$lists['gr_comment'] = JHTML::_('select.booleanlist', 'gr_comment', '', $config->gr_comment);
				
		#Waitinglist fields configuration
		
		$lists['swt_lastname'] = JHTML::_('select.booleanlist', 'swt_lastname', '', $config->swt_lastname);
		$lists['rwt_lastname'] = JHTML::_('select.booleanlist', 'rwt_lastname', '', $config->rwt_lastname);		
		$lists['swt_organization'] = JHTML::_('select.booleanlist', 'swt_organization', '', $config->swt_organization);
		$lists['rwt_organization'] = JHTML::_('select.booleanlist', 'rwt_organization', '', $config->rwt_organization);
		$lists['swt_address'] = JHTML::_('select.booleanlist', 'swt_address', '', $config->swt_address);
		$lists['rwt_address'] = JHTML::_('select.booleanlist', 'rwt_address', '', $config->rwt_address);		
		$lists['swt_address2'] = JHTML::_('select.booleanlist', 'swt_address2', '', $config->swt_address2);
		$lists['rwt_address2'] = JHTML::_('select.booleanlist', 'rwt_address2', '', $config->rwt_address2);
		$lists['swt_city'] = JHTML::_('select.booleanlist', 'swt_city', '', $config->swt_city);
		$lists['rwt_city'] = JHTML::_('select.booleanlist', 'rwt_city', '', $config->rwt_city);
		$lists['swt_state'] = JHTML::_('select.booleanlist', 'swt_state', '', $config->swt_state);
		$lists['rwt_state'] = JHTML::_('select.booleanlist', 'rwt_state', '', $config->rwt_state);
		$lists['swt_zip'] = JHTML::_('select.booleanlist', 'swt_zip', '', $config->swt_zip);
		$lists['rwt_zip'] = JHTML::_('select.booleanlist', 'rwt_zip', '', $config->rwt_zip);
		$lists['swt_country'] = JHTML::_('select.booleanlist', 'swt_country', '', $config->swt_country);
		$lists['rwt_country'] = JHTML::_('select.booleanlist', 'rwt_country', '', $config->rwt_country);
		$lists['swt_phone'] = JHTML::_('select.booleanlist', 'swt_phone', '', $config->swt_phone);
		$lists['rwt_phone'] = JHTML::_('select.booleanlist', 'rwt_phone', '', $config->rwt_phone);
		$lists['swt_fax'] = JHTML::_('select.booleanlist', 'swt_fax', '', $config->swt_fax);
		$lists['rwt_fax'] = JHTML::_('select.booleanlist', 'rwt_fax', '', $config->rwt_fax);
		$lists['swt_comment'] = JHTML::_('select.booleanlist', 'swt_comment', '', $config->swt_comment);
		$lists['rwt_comment'] = JHTML::_('select.booleanlist', 'rwt_comment', '', $config->rwt_comment);
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_NO_MAPPING'));		
		if ($config->cb_integration > 0) {
    		if ($config->cb_integration == 1) {
    		     //Get list of CB fields   
    		     $sql = 'SELECT name AS `value`, name AS `text` FROM #__comprofiler_fields WHERE `table` = "#__comprofiler" AND published=1' ;
    		     $db->setQuery($sql) ;
    		     $options = array_merge($options, $db->loadObjectList()) ;    		     
    		} else {
    		    //Get list of Jomsocial field code 
    		    $sql = 'SELECT fieldcode AS `value`, fieldcode AS `text` FROM #__community_fields WHERE published=1 AND fieldcode != ""';
    		    $db->setQuery($sql) ;
    		    $options = array_merge($options, $db->loadObjectList()) ;    		    
    		}   
    		$fields = array('m_firstname', 'm_lastname', 'm_organization', 'm_address', 'm_address2', 'm_city', 'm_state', 'm_zip', 'm_country', 'm_country', 'm_phone', 'm_fax') ;
    		foreach ($fields as $field) {
    		    $lists[$field] = JHTML::_('select.genericlist', $options, $field, 'class="inputbox"', 'value', 'text', $config->{$field});
    		}
		}				
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_POSITION'));
		$options[] = JHTML::_('select.option', 0, JText::_('EB_BEFORE_AMOUNT'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_AFTER_AMOUNT'));
		
		$lists['currency_position'] = JHTML::_('select.genericlist', $options, 'currency_position', ' class="inputbox"', 'value', 'text', $config->currency_position);

		#SEF setting
		
		$lists['insert_menu_title'] = JHTML::_('select.booleanlist', 'insert_menu_title', '', $config->insert_menu_title);
		$lists['insert_event_id'] = JHTML::_('select.booleanlist', 'insert_event_id', '', $config->insert_event_id);
		$lists['insert_event_title'] = JHTML::_('select.booleanlist', 'insert_event_title', '', $config->insert_event_title);
		$lists['insert_category_id'] = JHTML::_('select.booleanlist', 'insert_category_id', '', $config->insert_category_id);
		$options = array() ;
		$options[] = JHTML::_('select.option', 0, JText::_('EB_ALL_NESTED_CATEGORIES'));
		$options[] = JHTML::_('select.option', 1, JText::_('EB_ONLY_LAST_ONE'));
		$lists['insert_category'] = JHTML::_('select.genericlist', $options, 'insert_category', ' class="inputbox"', 'value', 'text', $config->insert_category);
				
		
		//Get tab object
		jimport('joomla.html.pane');		
		$tabConfig = array('useCookies' => 1);
		$tabs = JPane::getInstance('Tabs', $tabConfig);				
		$this->assignRef('lists',		$lists);
		$this->assignRef('config',		$config);		
		$this->assignRef('tabs', $tabs);		
		parent::display($tpl);			
	}
}