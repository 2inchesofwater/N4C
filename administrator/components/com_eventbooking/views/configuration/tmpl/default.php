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

JToolBarHelper::title(   JText::_( 'EB_CONFIGURATION' ), 'generic.png' );
JToolBarHelper::save('save_configuration');	
JToolBarHelper::cancel();	
$editor = & JFactory::getEditor() ;
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<?php
		echo $this->tabs->startPane('content-pane');
		echo $this->tabs->startPanel(JText::_('EB_GENERAL'),'general-page');
	?>
		<table class="admintable" style="width:100%;">					
			<tr>
				<td  class="key" style="width:18%">
					<?php echo JText::_('EB_INTEGRATION'); ?>
				</td>
				<td width="30%">
					<?php echo $this->lists['cb_integration']; ?>
				</td>
				<td>
					&nbsp;					
				</td>
			</tr>			
            <tr>
        		<td  class="key">
        			<?php echo JText::_('EB_USER_REGISTRATION_INTEGRATION'); ?>
        		</td>
        		<td>
        			<?php echo $this->lists['user_registration']; ?>
        		</td>
        		<td>
        			<?php echo JText::_('EB_REGISTRATION_INTEGRATION_EXPLAIN'); ?>
        		</td>
        	</tr>            	
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_CALENDAR_START_DATE'); ?>
				</td>
				<td>
					<?php echo $this->lists['calendar_start_date']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>	
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_ACTIVATE_DEPOSIT_FEATURE'); ?>
				</td>
				<td>
					<?php echo $this->lists['activate_deposit_feature']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_ACTIVATE_DEPOSIT_FEATURE_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_ACTIVATE_WAITINGLIST_FEATURE'); ?>
				</td>
				<td>
					<?php echo $this->lists['activate_waitinglist_feature']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_ACTIVATE_WAITINGLIST_FEATURE_EXPLAIN'); ?>
				</td>
			</tr>						
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_EVENT_CUSTOM_FIELD'); ?>
				</td>
				<td>
					<?php echo $this->lists['event_custom_field']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_EVENT_CUSTOM_FIELD_EXPLAIN'); ?> 
				</td>
			</tr>								
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_MULTIPLE_BOOKING'); ?>
				</td>
				<td>
					<?php echo $this->lists['multiple_booking']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_MULTIPLE_BOOKING_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_PREVENT_DUPLICATE'); ?>
				</td>
				<td>
					<?php echo $this->lists['prevent_duplicate_registration']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_PREVENT_DUPLICATE_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_STATE_DROPDOWN'); ?>
				</td>
				<td>
					<?php echo $this->lists['display_state_dropdown']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_STATE_DROPDOWN_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_ENABLE_CAPTCHA'); ?>
				</td>
				<td>
					<?php echo $this->lists['enable_captcha']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_CAPTCHA_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_ENABLE_COUPON'); ?>
				</td>
				<td>
					<?php echo $this->lists['enable_coupon']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_COUNPON_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
        		<td  class="key">
        			<?php echo JText::_('EB_SHOW_PENDING_REGISTRANTS'); ?>
        		</td>
        		<td>
        			<?php echo $this->lists['show_pending_registrants']; ?>
        		</td>
        		<td>
        			<?php echo JText::_('EB_SHOW_PENDING_REGISTRANTS_EXPLAIN'); ?>
        		</td>
        	</tr>     
			<tr>
				<td class="key">
					<?php echo JText::_('EB_ENABLE_TAX'); ?>
				</td>
				<td>
					<?php echo $this->lists['enable_tax']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>			
			<tr>				
				<td class="key">
					<?php echo JText::_('EB_TAX_RATE'); ?>
				</td>
				<td>						
					<input type="text" name="tax_rate" class="inputbox" value="<?php echo $this->config->tax_rate ; ?>" />
				</td>
				<td>
					%
				</td>					
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_COLLECT_MEMBER_INFORMATION'); ?>
				</td>
				<td>
					<?php echo $this->lists['collect_member_information']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_COLLECT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_INCLUDE_GROUP_BILLING_IN_CSV_EXPORT'); ?>
				</td>
				<td>
					<?php echo $this->lists['include_group_billing_in_csv_export']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_INCLUDE_GROUP_BILLING_IN_CSV_EXPORT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_INCLUDE_GROUP_BILLING_IN_REGISTRANTS_MANAGEMENT')?>
				</td>
				<td>
					<?php echo $this->lists['include_group_billing_in_registrants']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_INCLUDE_GROUP_BILLING_IN_REGISTRANTS_MANAGEMENT_EXPLAIN'); ?>
				</td>
			</tr>
			
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_INCLUDE_GROUP_MEMBERS_IN_CSV_EXPORT'); ?>
				</td>
				<td>
					<?php echo $this->lists['include_group_members_in_csv_export']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_INCLUDE_GROUP_MEMBERS_IN_CSV_EXPORT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_INCLUDE_GROUP_MEMBERS_IN_REGISTRANTS_MANAGEMENT')?>
				</td>
				<td>
					<?php echo $this->lists['include_group_members_in_registrants']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_INCLUDE_GROUP_MEMBERS_IN_REGISTRANTS_MANAGEMENT_EXPLAIN'); ?>
				</td>
			</tr>						
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_USER_GROUP_CAN_ADD_EVENTS'); ?>
				</td>
				<td>
					<input type="text" name="add_events_user_or_group_ids" class="inputbox" size="50" value="<?php echo $this->config->add_events_user_or_group_ids ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_USER_GROUP_ADD_EVENTS_EXPLAIN'); ?>
				</td>
			</tr>		
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_ACCESS_REGISTRANTS'); ?>
				</td>
				<td>
					<input type="text" name="registrant_access_user_ids" class="inputbox" size="50" value="<?php echo $this->config->registrant_access_user_ids ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_ACCESS_REGISTRANTS_EXPLAIN'); ?>
				</td>
			</tr>	
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_USER_GROUP_CAN_VIEW_REGISTRANT_LIST'); ?>
				</td>
				<td>
					<input type="text" name="view_registrant_list_user_or_group_ids" class="inputbox" size="50" value="<?php echo $this->config->view_registrant_list_user_or_group_ids ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_USER_GROUP_CAN_VIEW_REGISTRANT_LIST_EXPLAIN'); ?>
				</td>
			</tr>						
			<tr>				
				<td class="key">
					<?php echo JText::_('EB_ZOOM_LEVEL'); ?>
				</td>
				<td>						
					<?php echo JHTML::_('select.integerlist', 1, 14, 1, 'zoom_level', 'class="inputbox"', $this->config->zoom_level); ?>
				</td>
				<td>
					<?php echo JText::_('EB_ZOOM_LEVEL_EXPLAIN'); ?>
				</td>					
			</tr>
			<tr>				
				<td class="key">
					<?php echo JText::_('EB_MAP_WIDTH'); ?>
				</td>
				<td>						
					<input type="text" name="map_width" class="inputbox" value="<?php echo $this->config->map_width ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_MAP_WIDTH_EXPLAIN'); ?>
				</td>					
			</tr>
			<tr>				
				<td class="key">
					<?php echo JText::_('EB_MAP_HEIGHT'); ?>
				</td>
				<td>						
					<input type="text" name="map_height" class="inputbox" value="<?php echo $this->config->map_height ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_MAP_HEIGHT_EXPLAIN'); ?>
				</td>					
			</tr>
			<tr>			
				<td class="key">
					<?php echo JText::_('EB_ACTIVATE_RECURRING_EVENT'); ?>
				</td>
				<td>
					<?php echo $this->lists['activate_recurring_event']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_ACTIVATE_RECURRING_EVENT_EXPLAIN'); ?> 
				</td>
			</tr>			
			<tr>			
				<td class="key">
					<?php echo JText::_('EB_ACTIVATE_HTTPS'); ?>
				</td>
				<td>
					<?php echo $this->lists['use_https']; ?>
				</td>
				<td>
					<?php echo  JText::_('EB_ACTIVATE_HTTPS_EXPLAIN'); ?> 
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_HIDE_PAST_EVENTS'); ?>
				</td>
				<td>
					<?php echo $this->lists['hide_past_events']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_HIDE_PAST_EVENTS_EXPLAIN'); ?>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_FIX_PROCESS_BUTTON_NOT_WORKING'); ?>
				</td>
				<td>
					<?php echo $this->lists['fix_next_button']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_FIX_PROCESS_BUTTON_NOT_WORKING_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_FIX_BREADCRUMBS'); ?>
				</td>
				<td>
					<?php echo $this->lists['fix_breadcrumbs']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_FIX_BREADCRUMBS_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_FIX_TERM_AND_CONDITION_POPUP'); ?>
				</td>
				<td>
					<?php echo $this->lists['fix_term_and_condition_popup']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_FIX_TERM_AND_CONDITION_POPUP_EXPLAIN'); ?>
				</td>
			</tr>											
			<tr>
				<td class="key">
					<?php echo JText::_('EB_SHOW_TERM_AND_CONDITION') ?>
				</td>
				<td>
					<?php
						echo $this->lists['active_term'];
					?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_TERM_AND_CONDITION_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_TERM_AND_CONDITION_BY_EVENT') ; ?>
				</td>
				<td>
					<?php echo $this->lists['term_condition_by_event']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_TERM_AND_CONDITION_BY_EVENT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_DEFAULT_TERM_AND_CONDITION') ; ?>
				</td>
				<td>
					<?php echo $this->lists['article_id']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_ATTACHMENT_FILE_TYPES') ; ?>					
				</td>
				<td>
					<input type="text" name="attachment_file_types" class="inputbox" value="<?php echo strlen($this->config->attachment_file_types) ? $this->config->attachment_file_types : 'bmp|gif|jpg|png|swf|zip|doc|pdf|xls'; ?>" size="60" />
				</td>
				<td>
					<?php echo JText::_('EB_ATTACHMENT_FILE_TYPES_EXPLAIN'); ?>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_DATE_FORMAT') ; ?>					
				</td>
				<td>
					<input type="text" name="date_format" class="inputbox" value="<?php echo $this->config->date_format; ?>" size="20" />
				</td>
				<td>
					<?php echo JText::_('EB_DATE_FORMAT_EXPLAIN'); ?>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_EVENT_DATE_FORMAT') ; ?>					
				</td>
				<td>
					<input type="text" name="event_date_format" class="inputbox" value="<?php echo $this->config->event_date_format; ?>" size="40" />
				</td>
				<td>
					<?php echo JText::_('EB_EVENT_DATE_FORMAT_EXPLAIN'); ?>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_TIME_FORMAT') ; ?>					
				</td>
				<td>
					<input type="text" name="event_time_format" class="inputbox" value="<?php echo $this->config->event_time_format ? $this->config->event_time_format : '%I%P'; ?>" size="40" />
				</td>
				<td>
					<?php echo JText::_('EB_TIME_FORMAT_EXPLAIN'); ?>
				</td>
			</tr>	
						
			<tr>
				<td class="key">
					<?php echo JText::_('EB_CURRENCY_SYMBOL'); ?>
				</td>
				<td>
					<input type="text" name="currency_symbol" class="inputbox" value="<?php echo $this->config->currency_symbol; ?>" size="10" />
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_DECIMALS'); ?>
				</td>
				<td>
					<input type="text" name="decimals" class="inputbox" value="<?php echo isset($this->config->decimals) ? $this->config->decimals : 2; ?>" size="10" />
				</td>
				<td>
					<?php echo JText::_('EB_DECIMALS_EXPLAIN'); ?>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_DECIMAL_POINT'); ?>
				</td>
				<td>
					<input type="text" name="dec_point" class="inputbox" value="<?php echo isset($this->config->dec_point) ? $this->config->dec_point : '.'; ?>" size="10" />
				</td>
				<td>
					<?php echo JText::_('EB_DECIMAL_POINT_EXPLAIN'); ?>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_THOUNSANDS_SEP'); ?>
				</td>
				<td>
					<input type="text" name="thousands_sep" class="inputbox" value="<?php echo isset($this->config->thousands_sep) ? $this->config->thousands_sep : ','; ?>" size="10" />
				</td>
				<td>
					<?php echo JText::_('EB_THOUNSANDS_SEP_EXPLAIN'); ?>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_CURRENCY_POSITION'); ?>
				</td>
				<td>
					<?php echo $this->lists['currency_position']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
						
			<tr>
				<td class="key">
					<?php echo JText::_('EB_DEFAULT_COUNTRY'); ?>
				</td>
				<td>
					<?php echo $this->lists['country_list']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>				
		</table>		
		<?php
			echo $this->tabs->endPanel();
			echo $this->tabs->startPanel(JText::_('EB_MESSAGES'),'message-page');			
		?>
		<table class="admintable">				
			<tr>
				<td class="key" style="width: 18%;">
					<?php echo JText::_('EB_FROM_NAME'); ?> <br />					
				</td>
				<td>
					<input type="text" name="from_name" class="inputbox" value="<?php echo $this->config->from_name; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_FROM_NAME_EXPLAIN'); ?></strong>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_FROM_EMAIL'); ?> <br />					
				</td>
				<td>
					<input type="text" name="from_email" class="inputbox" value="<?php echo $this->config->from_email; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_FROM_EMAIL_EXPLAIN'); ?></strong>
				</td>
			</tr>	
			<tr>
				<td class="key">
					<?php echo JText::_('EB_NOTIFICATION_EMAILS'); ?> <br />					
				</td>
				<td>
					<input type="text" name="notification_emails" class="inputbox" value="<?php echo $this->config->notification_emails; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_NOTIFICATION_EMAILS_EXPLAIN'); ?></strong>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_ADMIN_EMAIL_SUBJECT'); ?>
				</td>
				<td>
					<input type="text" name="admin_email_subject" class="inputbox" value="<?php echo $this->config->admin_email_subject; ?>" size="80" />
				</td>
				<td width="35%">
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_ADMIN_EMAIL_BODY'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'admin_email_body',  $this->config->admin_email_body , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> :[REGISTRATION_DETAIL], [EVENT_TITLE], [FIRST_NAME], [LAST_NAME], [ORGANIZATION], [ADDRESS], [ADDRESS2], [CITY], [STATE], [CITY], [ZIP], [COUNTRY], [PHONE], [FAX], [EMAIL], [COMMENT], [AMOUNT]</strong>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_USER_EMAIL_SUBJECT'); ?>
				</td>
				<td>					
					<input type="text" name="user_email_subject" class="inputbox" value="<?php echo $this->config->user_email_subject; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_USER_EMAIL_BODY'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'user_email_body',  $this->config->user_email_body , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> :[REGISTRATION_DETAIL], [FIRST_NAME], [LAST_NAME], [ORGANIZATION], [ADDRESS], [ADDRESS2], [CITY], [STATE], [CITY], [ZIP], [COUNTRY], [PHONE], [FAX], [EMAIL], [COMMENT], [AMOUNT]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_USER_EMAIL_BODY_OFFLINE'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'user_email_body_offline',  $this->config->user_email_body_offline , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> :[REGISTRATION_DETAIL], [FIRST_NAME], [LAST_NAME], [ORGANIZATION], [ADDRESS], [ADDRESS2], [CITY], [STATE], [CITY], [ZIP], [COUNTRY], [PHONE], [FAX], [EMAIL], [COMMENT], [AMOUNT]</strong>
				</td>
			</tr>								
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REGISTRATION_FORM_MESSAGE'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'registration_form_message',  $this->config->registration_form_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_REGISTRATION_FORM_MESSAGE_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REGISTRATION_FORM_MESSAGE_GROUP'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'registration_form_message_group',  $this->config->registration_form_message_group , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_REGISTRATION_FORM_MESSAGE_GROUP_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_NUMBER_OF_MEMBERS_FORM_MESSAGE'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'number_members_form_message',  $this->config->number_members_form_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_NUMBER_OF_MEMBERS_FORM_MESSAGE_EXPLAIN'); ?></strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_MEMBER_INFORMATION_FORM_MESSAGE'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'member_information_form_message',  $this->config->member_information_form_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_MEMBER_INFORMATION_FORM_MESSAGE_EXPLAIN'); ?></strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_CONFIRMATION_MESSAGE'); ?>												
				</td>
				<td>
					<?php echo $editor->display( 'confirmation_message',  $this->config->confirmation_message , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_CONFIRMATION_MESSAGE_EXPLAIN'); ?>. <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE], [AMOUNT]</strong>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_THANK_YOU_MESSAGE'); ?>					
				</td>
				<td>			
					<?php echo $editor->display( 'thanks_message',  $this->config->thanks_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_THANK_YOU_MESSAGE_EXPLAIN'); ?></strong>
				</td>
			</tr>								
			<tr>
				<td class="key">
					<?php echo JText::_('EB_THANK_YOU_MESSAGE_OFFLINE'); ?>					
				</td>
				<td>			
					<?php echo $editor->display( 'thanks_message_offline',  $this->config->thanks_message_offline , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_THANK_YOU_MESSAGE_OFFLINE_EXPLAIN'); ?></strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_CANCEL_MESSAGE'); ?>					
				</td>
				<td>
					<?php echo $editor->display( 'cancel_message',  $this->config->cancel_message , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_CANCEL_MESSAGE_EXPLAIN') ; ?></strong>
				</td>
			</tr>					
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REGISTRATION_CANCEL_MESSAGE_FREE'); ?>					
				</td>
				<td>
					<?php echo $editor->display( 'registration_cancel_message_free',  $this->config->registration_cancel_message_free , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_REGISTRATION_CANCEL_MESSAGE_FREE_EXPLAIN'); ?></strong>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REGISTRATION_CANCEL_MESSAGE_PAID'); ?>					
				</td>
				<td>
					<?php echo $editor->display( 'registration_cancel_message_paid',  $this->config->registration_cancel_message_paid, '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_REGISTRATION_CANCEL_MESSAGE_PAID_EXPLAIN'); ?></strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_INVITATION_FORM_MESSAGE'); ?>					
				</td>
				<td>
					<?php echo $editor->display( 'invitation_form_message',  $this->config->invitation_form_message, '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_INVITATION_FORM_MESSAGE_EXPLAIN'); ?></strong>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_INVITATION_EMAIL_SUBJECT'); ?>
				</td>
				<td>					
					<input type="text" name="invitation_email_subject" class="inputbox" value="<?php echo $this->config->invitation_email_subject; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_INVITATION_EMAIL_BODY'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'invitation_email_body',  $this->config->invitation_email_body , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong>[SENDER_NAME],[NAME], [EVENT_TITLE], [INVITATION_NAME], [EVENT_DETAIL_LINK], [PERSONAL_MESSAGE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_INVITATION_COMPLETE_MESSAGE'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'invitation_complete',  $this->config->invitation_complete , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<?php echo JText::_('EB_INVITATION_COMPLETE_MESSAGE_EXPLAIN'); ?>
				</td>
			</tr>									
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REMINDER_EMAIL_SUBJECT'); ?>
				</td>
				<td>					
					<input type="text" name="reminder_email_subject" class="inputbox" value="<?php echo $this->config->reminder_email_subject; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_REMINDER_EMAIL_BODY'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'reminder_email_body',  $this->config->reminder_email_body , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAG'); ?> :[REGISTRATION_DETAIL], [FIRST_NAME], [LAST_NAME], [ORGANIZATION], [ADDRESS], [ADDRESS2], [CITY], [STATE], [CITY], [ZIP], [COUNTRY], [PHONE], [FAX], [EMAIL], [COMMENT], [AMOUNT]</strong>
				</td>
			</tr>
			<tr>
				<td  class="key">
					<?php echo JText::_('EB_CANCEL_NOTIFICATION_EMAIL_SUBJECT'); ?>
				</td>
				<td>					
					<input type="text" name="registration_cancel_email_subject" class="inputbox" value="<?php echo $this->config->registration_cancel_email_subject; ?>" size="50" />
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [EVENT_TITLE]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_CANCEL_NOTIFICATION_EMAIL_BODY'); ?>
				</td>
				<td>
					<?php echo $editor->display( 'registration_cancel_email_body',  $this->config->registration_cancel_email_body , '100%', '250', '75', '8' ) ;?>					
				</td>
				<td>
					<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> :[REGISTRATION_DETAIL], [FIRST_NAME], [LAST_NAME], [ORGANIZATION], [ADDRESS], [ADDRESS2], [CITY], [STATE], [CITY], [ZIP], [COUNTRY], [PHONE], [FAX], [EMAIL], [COMMENT], [AMOUNT]</strong>
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_FORM_MESSAGE'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'waitinglist_form_message',  $this->config->waitinglist_form_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_WAITINGLIST_FORM_MESSAGE_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE]</strong>
				</td>
			</tr>																
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_COMPLETE_MESSAGE'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'waitinglist_complete_message',  $this->config->waitinglist_complete_message , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_WAITINGLIST_COMPLETE_MESSAGE_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE], [FIRST_NAME], [LAST_NAME]</strong>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_CONFIRMATION_SUBJECT');  ?>
				</td>
				<td>
					<input type="text" name="watinglist_confirmation_subject" class="inputbox" size="70" value="<?php echo $this->config->watinglist_confirmation_subject ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_WAITINGLIST_CONFIRMATION_SUBJECT_EXPLAIN');  ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_CONFIRMATION_BODY'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'watinglist_confirmation_body',  $this->config->watinglist_confirmation_body , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_WAITINGLIST_COMPLETE_MESSAGE_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE], [FIRST_NAME], [LAST_NAME]</strong>
				</td>
			</tr>
			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_NOTIFICATION_SUBJECT');  ?>
				</td>
				<td>
					<input type="text" name="watinglist_notification_subject" class="inputbox" size="70" value="<?php echo $this->config->watinglist_notification_subject ; ?>" />
				</td>
				<td>
					<?php echo JText::_('EB_WAITINGLIST_NOTIFICATION_SUBJECT_EXPLAIN');  ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_WAITINGLIST_NOTIFICATION_BODY'); ?>														
				</td>
				<td>			
					<?php echo $editor->display( 'watinglist_notification_body',  $this->config->watinglist_notification_body , '100%', '250', '75', '8' ) ;?>							
				</td>
				<td>
					<strong><?php echo JText::_('EB_WAITINGLIST_NOTIFICATION_BODY_EXPLAIN'); ?> <?php echo JText::_('EB_AVAILABLE_TAGS'); ?>: [EVENT_TITLE], [FIRST_NAME], [LAST_NAME]</strong>
				</td>
			</tr>
									
		</table>
	<?php	
		echo $this->tabs->endPanel();		
		echo $this->tabs->startPanel(JText::_('EB_THEMES'),'theme-page');
	?>
		<table class="admintable" width="100%">
			<tr>
				<td class="key" style="width:18%;">
					<?php echo JText::_('EB_CALENDAR_THEME'); ?>
				</td>
				<td width="30%">
					<?php echo $this->lists['calendar_theme']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>			
			<tr>
				<td class="key">
					<?php echo JText::_('EB_SHOW_MULTIPLE_DAYS_EVENT_IN_CALENDAR'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_multiple_days_event_in_calendar']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="key">
					<?php echo JText::_('EB_SHOW_EVENT_TIME'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_event_time']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_EVENT_TIME_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_EMPTY_CATEGORIES'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_empty_cat']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>				
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_NUMBER_EVENTS'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_number_events']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_CATEGORIES_PER_PAGE'); ?>
				</td>
				<td>
					<input type="text" name="number_categories" class="inputbox" value="<?php echo $this->config->number_categories; ?>" size="10" />
				</td>
				<td>
					&nbsp;
				</td>
			</tr>													
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_EVENTS_PER_PAGE'); ?>
				</td>
				<td>
					<input type="text" name="number_events" class="inputbox" value="<?php echo $this->config->number_events; ?>" size="10" />
				</td>
				<td>
					&nbsp;
				</td>
			</tr>		
			<tr>
				<td class="key">
					<?php echo JText::_('EB_EVENT_ORDER_BY'); ?>
				</td>
				<td>
					<?php echo $this->lists['order_events'] ; ?>
				</td>
			</tr>	
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_EVENT_CAPACITY'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_capacity']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>				
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_NUMBER_REGISTERED_USERS'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_registered']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_AVAILABLE_PLACES'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_available_place']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_LIST_OF_REGISTRANTS'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_list_of_registrants']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_LOCATION_IN_CATEGORY_VIEW'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_location_in_category_view']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>			
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_LOCATION_IN_EMAIL'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_event_location_in_email']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_PROCESS_CONTENT_PLUGIN'); ?>
				</td>
				<td>
					<?php echo $this->lists['process_plugin']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>						
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_CATEGORY_DESCRIPTION_IN_CALENDAR_LAYOUT'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_cat_decription_in_calendar_layout']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_CATEGORY_DESCRIPTION_IN_TABLE_LAYOUT'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_cat_decription_in_table_layout']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_PRICE_IN_TABLE_LAYOUT'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_price_in_table_layout']; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_DISPLAY_MESSAGE_FOR_FULL_EVENT'); ?>														
				</td>
				<td>
					<?php echo $this->lists['display_message_for_full_event']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_DISPLAY_MESSAGE_FOR_FULL_EVENT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_PRICE_FOR_FREE_EVENT'); ?>														
				</td>
				<td>
					<?php echo $this->lists['show_price_for_free_event']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_PRICE_FOR_FREE_EVENT_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_DISCOUNTED_PRICE'); ?>														
				</td>
				<td>
					<?php echo $this->lists['show_discounted_price']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_DISCOUNTED_PRICE_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_EVENT_DATE'); ?>					
				</td>
				<td>
					<?php echo $this->lists['show_event_date']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_EVENT_DATE_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_FACEBOOK_LIKE_BUTTON'); ?>					
				</td>
				<td>
					<?php echo $this->lists['show_fb_like_button']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_FACEBOOKING_LIKE_BUTTON_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_SOCIAL_BOOKMARK'); ?>					
				</td>
				<td>
					<?php echo $this->lists['show_social_bookmark']; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_SOCIAL_BOOKMARK_EXPLAIN'); ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_INVITE_FRIEND'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_invite_friend'] ; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_INVITE_FRIEND_EXPLAIN') ; ?>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_ACTIVATE_WEEKLY_CALENDAR_VIEW'); ?>
				</td>
				<td>
					<?php echo $this->lists['activate_weekly_calendar_view'] ; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>					
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_ACTIVATE_DAILY_CALENDAR_VIEW'); ?>
				</td>
				<td>
					<?php echo $this->lists['activate_daily_calendar_view'] ; ?>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td width="30%" class="key">
					<?php echo JText::_('EB_SHOW_COUPON_CODE'); ?>
				</td>
				<td>
					<?php echo $this->lists['show_coupon_code_in_registrant_list'] ; ?>
				</td>
				<td>
					<?php echo JText::_('EB_SHOW_COUPON_CODE_EXPLAIN'); ?>
				</td>
			</tr>						
		</table>	
	<?php	
		echo $this->tabs->endPanel();			
		echo $this->tabs->startPanel(JText::_('EB_BILLING_FIELDS'),'payment-page');
	?>		
		<table class="admintable">
			<tr>
				<td colspan="3">
					<p><?php echo JText::_('EB_CHOOSE_BILLING_FIELDS'); ?></p>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key"><strong><?php echo JText::_('EB_FIELD'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_SHOW'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_REQUIRE'); ?></strong></td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_LAST_NAME'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_lastname'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_lastname'];  ?>
				</td>
			</tr>			
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ORGANIZATION'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_organization'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_organization'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_address'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_address'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS2'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_address2'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_address2'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_CITY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_city'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_city'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_STATE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_state'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_state'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ZIP'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_zip'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_zip'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COUNTRY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_country'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_country'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_PHONE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_phone'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_phone'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_FAX'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_fax'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_fax'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COMMENT'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['s_comment'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['r_comment'];  ?>
				</td>
			</tr>
		</table>
	<?php
		echo $this->tabs->endPanel();				
		echo $this->tabs->startPanel(JText::_('EB_GROUP_MEMBER_FIELDS'),'group-member-page');
	?>		
		<table class="admintable">
			<tr>
				<td colspan="3">
					<p><?php echo JText::_('EB_GROUP_MEMBER_FIELD_SETTING'); ?></p>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key"><strong><?php echo JText::_('EB_FIELD'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_SHOW'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_REQUIRE'); ?></strong></td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_LAST_NAME'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_lastname'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_lastname'];  ?>
				</td>
			</tr>			
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ORGANIZATION'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_organization'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_organization'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_address'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_address'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS2'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_address2'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_address2'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_CITY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_city'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_city'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_STATE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_state'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_state'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ZIP'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_zip'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_zip'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COUNTRY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_country'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_country'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_PHONE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_phone'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_phone'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_FAX'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_fax'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_fax'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_EMAIL'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_email'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_email'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COMMENT'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gs_comment'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['gr_comment'];  ?>
				</td>
			</tr>
		</table>
	<?php
		echo $this->tabs->endPanel();
		echo $this->tabs->startPanel(JText::_('EB_WAITINGLIST_FIELDS'),'waitinglist-page');
	?>		
		<table class="admintable">
			<tr>
				<td colspan="3">
					<p><?php echo JText::_('EB_WAITING_FIELD_SETTING'); ?></p>
				</td>
			</tr>
			<tr>
				<td width="30%" class="key"><strong><?php echo JText::_('EB_FIELD'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_SHOW'); ?></strong></td>
				<td class="key" style="text-align: center;"><strong><?php echo JText::_('EB_REQUIRE'); ?></strong></td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_LAST_NAME'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_lastname'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_lastname'];  ?>
				</td>
			</tr>			
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ORGANIZATION'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_organization'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_organization'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_address'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_address'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ADDRESS2'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_address2'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_address2'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_CITY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_city'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_city'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_STATE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_state'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_state'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_ZIP'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_zip'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_zip'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COUNTRY'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_country'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_country'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_PHONE'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_phone'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_phone'];  ?>
				</td>
			</tr>
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_FAX'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_fax'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_fax'];  ?>
				</td>
			</tr>			
			<tr>
				<td class="key" width="30%">
					<?php echo JText::_('EB_COMMENT'); ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['swt_comment'];  ?>
				</td>
				<td align="center">
					<?php echo  $this->lists['rwt_comment'];  ?>
				</td>
			</tr>
		</table>
	<?php
		echo $this->tabs->endPanel();	
		if ($this->config->cb_integration > 0) {
		    echo $this->tabs->startPanel(JText::_('EB_FIELD_MAPPING'), 'field-mapping-page');
		    ?>
    		<table class="admintable">
    			<tr>
    				<td colspan="2">
    					<p class="message"><strong><?php echo JText::_('EB_FIELD_MAPPING_EXPLAIN'); ?></strong></p>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_FIRST_NAME'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['m_firstname'] ;
    					?>					
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_LAST_NAME'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_lastname'] ?>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_ORGANIZATION'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_organization']; ?>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_ADDRESS'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_address'];?>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_ADDRESS2'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_address2'] ; ?>
    				</td>
    			</tr>				
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_CITY'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_city'] ; ?>
    				</td>
    			</tr>			
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_STATE'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_state']; ?>
    				</td>
    			</tr>			
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_ZIP'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_zip'] ; ?>
    				</td>
    			</tr>			
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_COUNTRY'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_country'] ; ?>
    				</td>
    			</tr>						
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_PHONE'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_phone'] ?>
    				</td>
    			</tr>									
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_FAX'); ?>
    				</td>
    				<td>
    					<?php echo $this->lists['m_fax'] ; ?>
    				</td>
    			</tr>
    		</table>
    	<?php	
		echo $this->tabs->endPanel();			       
		}				
        jimport('joomla.filesystem.file') ;
		if (JFile::exists(JPATH_ROOT.'/components/com_sh404sef/sh404sef.php')) {
		    echo $this->tabs->startPanel(JText::_('EB_SEF_SETTING'), 'sef-setting-page');
		    ?>
    		<table class="admintable">
    			<tr>
    				<td colspan="3">
    					<p class="message"><strong><?php echo JText::_('EB_SEF_SETTING_EXPLAIN'); ?></strong></p>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_INSERT_MENU_TITLE'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['insert_menu_title'] ;
    					?>					
    				</td>
    				<td>
    					<?php echo JText::_('EB_INSERT_MENU_TITLE_EXPLAIN'); ?>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_INSERT_EVENT_ID'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['insert_event_id'] ;
    					?>					
    				</td>
    				<td>
    					<?php echo JText::_('EB_INSERT_EVENT_ID_EXPLAIN'); ?>
    				</td>
    			</tr>       			
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_INSERT_EVENT_TITLE'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['insert_event_title'] ;
    					?>					
    				</td>
    				<td>
    					<?php echo JText::_('EB_INSERT_EVENT_TITLE_EXPLAIN'); ?>
    				</td>
    			</tr>    			
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_INSERT_CATEGORY_ID'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['insert_category_id'] ;
    					?>					
    				</td>
    				<td>
    					<?php echo JText::_('EB_INSERT_CATEGORY_ID_EXPLAIN'); ?>
    				</td>
    			</tr>
    			<tr>
    				<td width="30%" class="key">
    					<?php echo JText::_('EB_INSERT_CATEGORY'); ?>
    				</td>
    				<td>
    					<?php
    					    echo $this->lists['insert_category'] ;
    					?>					
    				</td>
    				<td>
    					<?php echo JText::_('EB_INSERT_CATEGORY_EXPLAIN'); ?>
    				</td>
    			</tr>
    		</table>
    	<?php	
		echo $this->tabs->endPanel();			       
		}			
		
		echo $this->tabs->endPane();
	?>	
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="task" value="" />	
</form>