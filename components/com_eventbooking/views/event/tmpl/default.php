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
		
$item = $this->item ;	
$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&Itemid='.$this->Itemid);
$canRegister = EventBookingHelper::acceptRegistration($item->id) ;
$greyBox = JURI::base().'components/com_eventbooking/assets/js/greybox/';
JHTML::_('behavior.mootools');
JHTML::_('behavior.modal');	
$socialUrl = JURI::base().'index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&Itemid='.$this->Itemid ;
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $j15 = false ;
    $param = null ;
} else {
    $j15 = true ;
    $param = 0 ;	    
}
if ($this->config->use_https) {
    $ssl = true ;
} else {
    $ssl = false ;
}
?>
<script type="text/javascript">
    var GB_ROOT_DIR = "<?php echo $greyBox ; ?>";
</script>
<script type="text/javascript" src="<?php echo $greyBox; ?>/AJS.js"></script>
<script type="text/javascript" src="<?php echo $greyBox; ?>/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $greyBox; ?>/gb_scripts.js"></script>
<link href="<?php echo $greyBox; ?>/gb_styles.css" rel="stylesheet" type="text/css" />
<form method="post" name="adminForm" id="adminForm" action="index.php">
<div id="eb_docs">
	<div class="eb_row">
		<div class="eb_cat">			
			<h1 class="eb_title">																											
				<?php echo $item->title; ?>				
				<?php
					if ($this->config->show_fb_like_button) {
					?>
						<div id="fb_share_button">
							<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode($socialUrl);?>
							&amp;layout=standard
							&amp;show_faces=true
							&amp;width=150
							&amp;action=like
							&amp;font=arial
							&amp;colorscheme=light
							&amp;locale=en_GB"
							scrolling="no"
							frameborder="0"
							allowTransparency="true"
							style="border:none;
							overflow:hidden;
							width:360px;
							height:28px">
						</iframe>					
					</div>
					<?php	
					}
				?>							
			</h1>		
			<div class="eb_description">
				<?php echo $item->description ; ?>	
			</div>
		</div>	
		<div class="clr">
	</div>					
	<div id="eb_details" style="width: 100%;">
		<div id="detail_left">
			<h3>
				<?php echo JText::_('EB_EVENT_PROPERTIES'); ?>
			</h3>
			<table cellspacing="0">							
				<tbody>											
					<tr>				
						<td style="width: 30%;">
							<strong><?php echo JText::_('EB_EVENT_DATE') ?>:</strong>
						</td>
						<td>
							<?php
                               if ($item->event_date == EB_TBC_DATE) {
                                   echo JText::_('EB_TBC');
                               } else {
                                   echo JHTML::_('date', $item->event_date, $this->config->event_date_format, $param) ; 
                               }     
							?>							
						</td>
					</tr>
					<?php
						if ($item->event_end_date != $this->nullDate) {
						?>
							<tr>
								<td>
									<strong><?php echo JText::_('EB_EVENT_END_DATE'); ?>:</strong>
								</td>
								<td>
									<?php echo JHTML::_('date', $item->event_end_date, $this->config->event_date_format, $param) ; ?>
								</td>
							</div>
						<?php	
						}
						if ($this->config->show_capacity) {
						?>
							<tr>
								<td>
									<strong><?php echo JText::_('EB_CAPACITY'); ?></strong>
								</td>
								<td>
									<?php
										if ($item->event_capacity)
											echo $item->event_capacity ;
										else
											echo JText::_('EB_UNLIMITED') ;
									?>
								</td>
							</tr>	
						<?php	
						}
						if ($this->config->show_registered) {
						?>
							<tr>
								<td>
									<strong><?php echo JText::_('EB_REGISTERED'); ?></strong>
								</td>
								<td>
									<?php echo $item->total_registrants ; ?>
									<?php
									if ($this->config->show_list_of_registrants && ($item->total_registrants > 0) && EventBookingHelper::canViewRegistrantList()) {
										?>
											&nbsp;&nbsp;&nbsp;<a href="index.php?option=com_eventbooking&task=show_registrant_list&event_id=<?php echo $item->id ?>&tmpl=component" rel="gb_page_center[<?php echo VIEW_LIST_WIDTH; ?>, <?php echo VIEW_LIST_HEIGHT; ?>]" class="registrant_list_link"><span class="view_list"><?php echo JText::_("EB_VIEW_LIST"); ?></span></a>
										<?php											
										}
									?>
								</td>
							</tr>
						<?php	
						}					
						if ($this->config->show_available_place && $item->event_capacity) {
						?>
							<tr>
								<td>
									<strong><?php echo JText::_('EB_AVAILABLE_PLACE'); ?></strong>
								</td>
								<td>
									<?php echo $item->event_capacity - $item->total_registrants ; ?>									
								</td>
							</tr>
						<?php	
						}					
						if ($this->nullDate != $item->cut_off_date) {
						?>
						<tr>
							<td>
								<strong><?php echo JText::_('EB_CUT_OFF_DATE'); ?></strong>
							</td>
							<td>
								<?php echo JHTML::_('date', $item->cut_off_date, $this->config->date_format, $param) ; ?>
							</td>
						</tr>		
						<?php	
						}
						if (($item->individual_price > 0) || ($this->config->show_price_for_free_event)) {
							$showPrice = true ;	
						} else {
							$showPrice = false ;
						}
						
						if ($this->config->show_discounted_price && ($item->individual_price != $item->discounted_price)) {
						    if ($showPrice) {
    						?>
    							<tr>
    								<td>
    									<strong><?php echo JText::_('EB_ORIGINAL_PRICE'); ?></strong>
    								</td>
    								<td class="eb_price">
    									<?php
    										if ($item->individual_price > 0)
    										    echo EventBookingHelper::formatCurrency($item->individual_price, $this->config) ;    											
    										else 
    											echo '<span class="eb_free">'.JText::_('EB_FREE').'</span>' ;	
    								 	?>
    								</td>
    							</tr>
    							<tr>
    								<td>
    									<strong><?php echo JText::_('EB_DISCOUNTED_PRICE'); ?></strong>
    								</td>
    								<td class="eb_price">
    									<?php
    										if ($item->discounted_price > 0)
    										    echo EventBookingHelper::formatCurrency($item->discounted_price, $this->config) ;    											
    										else 
    											echo '<span class="eb_free">'.JText::_('EB_FREE').'</span>' ;	
    								 	?>
    								</td>
    							</tr>
    						<?php	
    						}	   
						} else {
						    if ($showPrice) {
    						?>
    							<tr>
    								<td>
    									<strong><?php echo JText::_('EB_INDIVIDUAL_PRICE'); ?></strong>
    								</td>
    								<td class="eb_price">
    									<?php
    										if ($item->individual_price > 0)
    										    echo EventBookingHelper::formatCurrency($item->individual_price, $this->config) ;    											
    										else 
    											echo '<span class="eb_free">'.JText::_('EB_FREE').'</span>' ;	
    								 	?>
    								</td>
    							</tr>
    						<?php	
    						}	    
						}															
						if ($this->config->event_custom_field) {
						 	foreach ($this->params as $param) {							 							 	
						 		if (strlen($param[4])) {
						 		?>
						 			<tr>
						 				<td>
											<strong><?php echo $param[3]; ?></strong>
										</td>		
										<td>
											<?php echo $param[4] ; ?>
										</td>
						 			</tr>
						 		<?php	
						 		}
						 	}	
						}
						if ($item->location_id) {
							$width = (int) $this->config->map_width ;
							if (!$width) {
								$width = 500 ;	
							}							
							$height = (int) $this->config->map_height ;
							if (!$height) {
								$height = 450 ;
							}	
						?>
							<tr>
								<td>
									<strong><?php echo JText::_('EB_LOCATION'); ?></strong>
								</td>
								<td>
									<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_map&location_id='.$item->location_id.'&tmpl=component&format=html'); ?>" rel="gb_page_center[<?php echo $width; ?>, <?php echo $height; ?>]" title="<?php echo $this->location->name ; ?>" class="location_link"><?php echo $this->location->name ; ?></a>
								</td>
							</tr>
						<?php	
						}
					?>												
			</tbody>
		</table>
		<?php			
			$activateWaitingList = $this->config->activate_waitinglist_feature ;
			if (($item->event_capacity > 0) && ($item->event_capacity <= $item->total_registrants) && $activateWaitingList && !$item->user_registered) {
	        	    $waitingList = true ;
	        	    $waitinglistUrl = JRoute::_('index.php?option=com_eventbooking&task=waitinglist_form&event_id='.$item->id.'&Itemid='.$this->Itemid);
        	} else {
        	    $waitingList = false ;
        	} 
			if (!$canRegister && $item->registration_type != 3 && $this->config->display_message_for_full_event && !$waitingList) {
			    if ($j15) {
    			    if (@$item->user_registered) {
    					$msg = JText::_('EB_YOU_REGISTERED_ALREADY');
    				} elseif ($item->registration_access > $this->aid) {
    					$msg = JText::_('EB_LOGIN_TO_REGISTER') ;
    				} else {
    					$msg = JText::_('EB_NO_LONGER_ACCEPT_REGISTRATION') ;
    				}    
			    } else {
    			    if (@$item->user_registered) {
    					$msg = JText::_('EB_YOU_REGISTERED_ALREADY');
    				} elseif (!in_array($item->registration_access, $this->viewLevels)) {
    					$msg = JText::_('EB_LOGIN_TO_REGISTER') ;
    				} else {
    					$msg = JText::_('EB_NO_LONGER_ACCEPT_REGISTRATION') ;
    				}
			    }				
			?>
				<div class="eb_notice_table" style="margin-top: 10px;"><?php echo $msg ; ?></div>
			<?php	
			}
		?>		
		</div>		
		<div id="detail_right">
			<?php
				if (count($this->rowGroupRates)) {
				?>
					<h3>
						<?php echo JText::_('EB_GROUP_RATE'); ?>
					</h3>
					<table>
						<tr>							
							<th class="sectiontableheader eb_number_registrant_column">
								<?php echo JText::_('EB_NUMBER_REGISTRANTS'); ?>
							</th>
							<th class="sectiontableheader eb_rate_column">
								<?php echo JText::_('EB_RATE_PERSON'); ?>(<?php echo $this->config->currency_symbol; ?>)	
							</th>
						</tr>
						<?php
							$i = 0 ;
							foreach ($this->rowGroupRates as $rowRate) {
							?>
							<tr>								
								<td class="eb_number_registrant_column">
									<?php echo $rowRate->registrant_number ; ?>
								</td>
								<td class="eb_rate_column">
									<?php echo number_format($rowRate->price, 2); ?>
								</td>
							</tr>	
							<?php	
							}
						?>						
					</table>	
				<?php	 
				}
			?>			
		</div>			
	</div>				
	<div class="clr"></div>				
			<?php				
			if ($this->showTaskBar) {
				?>
					<div class="eb_taskbar">
					    <ul>	
					    	<?php
					    		if ($canRegister || $waitingList) {
					    			if ($item->registration_type == 0 || $item->registration_type == 1) {
					    				if ($this->config->multiple_booking) {
					    					$url = JRoute::_('index.php?option=com_eventbooking&task=add_to_cart&id='.$item->id.'&Itemid='.$this->Itemid, false) ;
					    					$text = JText::_('EB_REGISTER');
					    				} else {
					    					$url = JRoute::_('index.php?option=com_eventbooking&task=individual_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl) ;
					    					$text = JText::_('EB_REGISTER_INDIVIDUAL') ;
					    				}
					    				if ($waitingList)
					    					$url = $waitinglistUrl ;
					    				?>
					    					<li>
					    						<a href="<?php echo $url ; ?>"><?php echo $text ; ?></a>
					    					</li>
					    				<?php	
					    				}					    
					    				//Disable group registration when multiple booking is enabled	
					    				if (($item->registration_type == 0 || $item->registration_type == 2) && !$this->config->multiple_booking) {
					    				?>
					    					<li>
					    						<a href="<?php echo $waitingList ? $waitinglistUrl : JRoute::_('index.php?option=com_eventbooking&task=group_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl) ; ?>"><?php echo JText::_('EB_REGISTER_GROUP'); ?></a>
					    					</li>	
					    				<?php	
					    				}
					    		}					    						    						    						    		
					    		if ($this->config->show_invite_friend) {
					    		?>
					    			<li>
									    <a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=invite_form&id='.$item->id.'&Itemid='.$this->Itemid.'&tmpl=component', false) ; ?>" class="modal" rel="{handler: 'iframe', size: {x: 800, y: 600}}"><?php echo JText::_('EB_INVITE_FRIEND'); ?></a>
									</li>	
					    		<?php	
					    		}
                                
    			                $registrantId = EventBookingHelper::canCancelRegistration($item->id) ; 
    				    		if ($registrantId !== false) {
    				    		?>
    				    			<li>
    				    				<a href="javascript:cancelRegistration(<?php echo $registrantId; ?>)"><?php echo JText::_('EB_CANCEL_REGISTRATION'); ?></a>
    				    			</li>
    				    		<?php    
    				    		}		

    				    		if ($tem->total_registrants && EventBookingHelper::canExportRegistrants()) {
    				    		?>
    				    			<li>
    				    				<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=csv_export&event_id='.$item->id.'&Itemid='.$this->Itemid); ?>"><?php echo JText::_('EB_EXPORT_REGISTRANTS'); ?></a>
    				    			</li>
    				    		<?php	
    				    		}
					    	?>						    							    		
					    </ul>
					    <div class="clr"></div>
					</div>	
				<?php	 
			}
		?>																													
	</div>
	<!-- Social sharing -->
		<?php
			if ($this->config->show_social_bookmark) {
			?>
				<div id="itp-social-buttons-box">
					<div id="eb_share_text"><?php echo JText::_('EB_SHARE_THIS_EVENT'); ?></div>
					<div id="eb_share_button">
						<?php
							$title = $item->title ;							
							$html = EventBookingHelper::getDeliciousButton( $title, $socialUrl );
			        		$html .= EventBookingHelper::getDiggButton( $title, $socialUrl );
					        $html .= EventBookingHelper::getFacebookButton( $title, $socialUrl );
					        $html .= EventBookingHelper::getGoogleButton( $title, $socialUrl );
					        $html .= EventBookingHelper::getStumbleuponButton( $title, $socialUrl );
					        $html .= EventBookingHelper::getTechnoratiButton( $title, $socialUrl );
					        $html .= EventBookingHelper::getTwitterButton( $title, $socialUrl );
					        echo $html ;
						?>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>		
				<div style="clear: both;">&nbsp;</div>
	<!-- End social sharing -->
			<?php	
			}
		?>			
	</div>		
	
	<script language="javascript">
    	function cancelRegistration(registrantId) {
    		var form = document.adminForm ;			
    		if (confirm("<?php echo JText::_('EB_CANCEL_REGISTRATION_CONFIRM'); ?>")) {
    			form.task.value = 'cancel_registration' ;
    			form.id.value = registrantId ;
    			form.submit() ;
    		}	
    	}
	</script>	
	
	
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="task" value="" />
			
</form>