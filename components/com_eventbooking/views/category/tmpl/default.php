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

/**
 * This field was written base on the category layout of docman extension 
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */


//Load greybox lib
$greyBox = JURI::base().'components/com_eventbooking/assets/js/greybox/';
?>
	<script type="text/javascript">
    	var GB_ROOT_DIR = "<?php echo $greyBox ; ?>";
	</script>
	<script type="text/javascript" src="<?php echo $greyBox; ?>/AJS.js"></script>
	<script type="text/javascript" src="<?php echo $greyBox; ?>/AJS_fx.js"></script>
	<script type="text/javascript" src="<?php echo $greyBox; ?>/gb_scripts.js"></script>
	<link href="<?php echo $greyBox; ?>/gb_styles.css" rel="stylesheet" type="text/css" />
<?php
$width = (int) $this->config->map_width ;
if (!$width) {
	$width = 500 ;	
}							
$height = (int) $this->config->map_height ;
if (!$height) {
	$height = 450 ;
}		       	    		        
	
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $param = null ;
    $j15 = false ;
} else {
    $param = 0 ;
    $j15 = true ;
} 
if ($this->config->use_https) {
    $ssl = true ;
} else {
    $ssl = false ;
}
?>
<form method="post" name="adminForm" id="adminForm" action="index.php">	
	<div class="eb_cat">		
		<?php					       		    		      
			if($this->category->name != '') :
		        ?><h1 class="eb_title"><?php echo $this->category->name;?></h1><?php
		    endif;		
			if($this->category->description != '') :
				?><div class="eb_description"><?php echo $this->category->description;?></div><?php
			endif;
		?>
		<div class="clr"></div>
	</div>
	<!-- Events List -->
	<?php if(count($this->items)) { ?>
	    <div id="eb_docs">
	    <h2 class="eb_title"><?php echo JText::_('EB_EVENTS'); ?></h2>	    	    	   
	    <?php
	        $activateWaitingList = $this->config->activate_waitinglist_feature ;
	        for ($i = 0 , $n = count($this->items) ;  $i < $n ; $i++) {
	        	$item = $this->items[$i] ;
	        	$canRegister = EventBookingHelper::acceptRegistration($item->id) ;	        			        	        	
	        	$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&Itemid='.$this->Itemid);
	        	if (($item->event_capacity > 0) && ($item->event_capacity <= $item->total_registrants) && $activateWaitingList && !$item->user_registered) {
	        	    $waitingList = true ;
	        	    $waitinglistUrl = JRoute::_('index.php?option=com_eventbooking&task=waitinglist_form&event_id='.$item->id.'&Itemid='.$this->Itemid);
	        	} else {
	        	    $waitingList = false ;
	        	}	        	
	        ?>
	        	<div class="eb_row">
					<h3 class="eb_title">																										
						<a href="<?php echo $url; ?>" title="<?php echo $item->title; ?>">
						<?php echo $item->title; ?>
					</a>
					<div class="clr"></div>
					</h3>				
				<?php
				
				//output document description
				if (!$item->short_description)
					$item->short_description = $item->description ;
				if (true) :
					?>					
					<dl class="eb_props">
						<div class="eb_prop">
							<dt>
								<?php echo JText::_('EB_EVENT_DATE'); ?>:
							</dt>
							<dd>
								<?php
                                    if ($item->event_date == EB_TBC_DATE) {
                                        echo JText::_('EB_TBC');        
                                    } else {
                                        echo JHTML::_('date', $item->event_date, $this->config->event_date_format, $param) ;         
                                    }                                       
								?>								
							</dd>
						</div>						
						<?php	
	       				 	if ($item->event_end_date != $this->nullDate) {
							?>
								<div class="eb_prop">
									<dt>
										<?php echo JText::_('EB_EVENT_END_DATE'); ?>:
									</dt>
									<dd>
										<?php echo JHTML::_('date', $item->event_end_date, $this->config->event_date_format, $param) ; ?>
									</dd>
								</div>
							<?php	
							}						
							if ($item->cut_off_date != $this->nullDate) {
							?>
								<div class="eb_prop">
									<dt>
										<?php echo JText::_('EB_CUT_OFF_DATE'); ?>:
									</dt>
									<dd>
										<?php echo JHTML::_('date', $item->cut_off_date, $this->config->date_format,$param) ; ?>
									</dd>
								</div>
							<?php	
							}
							if ($this->config->show_capacity) {
							?>
								<div class="eb_prop">
									<dt>
										<?php echo JText::_('EB_CAPACTIY'); ?>:
									</dt>
									<dd>
										<?php
											if ($item->event_capacity)
												echo $item->event_capacity ;
											else
												echo JText::_('EB_UNLIMITED') ;
										?>										
									</dd>
								</div>	
							<?php	
							}
							if ($this->config->show_registered) {
							?>
								<div class="eb_prop">
									<dt>
										<?php echo JText::_('EB_REGISTERED'); ?>:
									</dt>
									<dd>
										<?php echo (int) $item->total_registrants ; ?>
										<?php
											if ($this->config->show_list_of_registrants && ($item->total_registrants > 0) && EventBookingHelper::canViewRegistrantList()) {
											?>
												&nbsp;&nbsp;&nbsp;<a href="index.php?option=com_eventbooking&task=show_registrant_list&event_id=<?php echo $item->id ?>&tmpl=component" rel="gb_page_center[<?php echo VIEW_LIST_WIDTH; ?>, <?php echo VIEW_LIST_HEIGHT; ?>]" class="registrant_list_link"><span class="view_list"><?php echo JText::_("EB_VIEW_LIST"); ?></span></a>
											<?php	
											}
										?>
									</dd>
								</div>
							<?php	
							}
							if ($this->config->show_available_place && $item->event_capacity) {
							?>
								<div class="eb_prop">
									<dt>
										<?php echo JText::_('EB_AVAILABLE_PLACE'); ?>:
									</dt>
									<dd>
										<?php echo $item->event_capacity - $item->total_registrants ; ?>
									</dd>
								</div>
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
    								<div class="eb_prop">
    									<dt>
    										<?php echo JText::_('EB_ORIGINAL_PRICE'); ?>:
    									</dt>
    									<dd class="eb_price">
    										<?php
    											if ($item->individual_price > 0) {
    											    echo EventBookingHelper::formatCurrency($item->individual_price, $this->config);    												
    											}  else {
    												echo '<span class="eb_price">'.JText::_('EB_FREE').'</span>' ;		
    											}
    										?>
    									</dd>
    								</div>
    								<div class="eb_prop">
    									<dt>
    										<?php echo JText::_('EB_DISCOUNTED_PRICE'); ?>:
    									</dt>
    									<dd class="eb_price">
    										<?php
    											if ($item->discounted_price > 0) {
    											    echo EventBookingHelper::formatCurrency($item->discounted_price, $this->config);    												
    											}  else {
    												echo '<span class="eb_price">'.JText::_('EB_FREE').'</span>' ;		
    											}
    										?>
    									</dd>
    								</div>
    							<?php	
    							}	    
							} else {
							    if ($showPrice) {
    							?>
    								<div class="eb_prop">
    									<dt>
    										<?php echo JText::_('EB_INDIVIDUAL_PRICE'); ?>:
    									</dt>
    									<dd class="eb_price">
    										<?php
    											if ($item->individual_price > 0) {
    											    echo EventBookingHelper::formatCurrency($item->individual_price, $this->config);    												
    											}  else {
    												echo '<span class="eb_price">'.JText::_('EB_FREE').'</span>' ;		
    											}
    										?>
    									</dd>
    								</div>
    							<?php	
    							}	        
							}												
	        				if ($item->location_id && $this->config->show_location_in_category_view) {								
							?>
								<div class="eb_prop">
									<dt>
										<strong><?php echo JText::_('EB_LOCATION'); ?>:</strong>
									</dt>
									<dd>
										<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_map&location_id='.$item->location_id.'&tmpl=component&format=html'); ?>" rel="gb_page_center[<?php echo $width; ?>, <?php echo $height; ?>]" title="<?php echo $item->location_name ; ?>" class="location_link"><?php echo $item->location_name ; ?></a>
									</dd>
								</div>								
							<?php	
							}	
							?>																																				
					</dl>										
					<div class="eb_description" style="text-align: justify;">
						<?php echo $item->short_description ; ?>
						<?php
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
								<p class="eb_notice"><?php echo $msg ; ?></p>
							<?php	
							}
						?>						
					</div>
					<?php				
					endif;
				?>
				<div class="clr"></div>								
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
					    			if ($waitingList) {
					    			    $url = $waitinglistUrl ;
					    			}
				    			?>
					    			<li>
							    		<a href="<?php echo $url ; ?>"><?php echo $text; ?></a>
							    	</li>	
				    			<?php	
				    			}				    		
				    			if (($item->registration_type == 0 || $item->registration_type == 2) && !$this->config->multiple_booking) {
				    			    if ($waitingList) 
				    			        $url = $waitinglistUrl ;
				    			    else 
				    			        $url = JRoute::_('index.php?option=com_eventbooking&task=group_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl) ;    
					    		?>
					    			<li>				    		
							    		<a href="<?php echo $url ; ?>"><?php echo JText::_('EB_REGISTER_GROUP'); ?></a>
							    	</li>	
					    		<?php	
					    		}						    	
				    		}
				    		$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&Itemid='.$this->Itemid, false);				    						    		
				    		//Add link to enable cancel registration
				    		$registrantId = EventBookingHelper::canCancelRegistration($item->id) ; 
				    		if ($registrantId !== false) {
				    		?>
				    			<li>
				    				<a href="javascript:cancelRegistration(<?php echo $registrantId; ?>)"><?php echo JText::_('EB_CANCEL_REGISTRATION'); ?></a>
				    			</li>
				    		<?php    
				    		}			
				    		if ($item->total_registrants && EventBookingHelper::canExportRegistrants()) {
				    		?>
    		    				   <li>
    		    				    	<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=csv_export&event_id='.$item->id.'&Itemid='.$this->Itemid); ?>"><?php echo JText::_('EB_EXPORT_REGISTRANTS'); ?></a>
    		    				   </li>
    		    			<?php	
    		    			}	    						    	
				    	?>				    													    
						<li>
							<a href="<?php echo $url; ?>">
								<?php echo JText::_('EB_DETAILS'); ?>
							</a>
						</li>   						 					
				    </ul>
				    <div class="clr"></div>
				</div>				
				</div>
	        <?php	
	        }
	    ?>	    
	    </div>	    
    	<?php
    		if ($this->pagination->total > $this->pagination->limit) {
    		?>
    			<div align="center" class="pagination">
    				<?php echo $this->pagination->getListFooter(); ?>
    			</div>
    		<?php	
    		}
    	?>	    		   
	<?php } else { ?>
	    <br />
	    <div id="eb_docs">
	        <i><?php echo JText::_('EB_NO_EVENTS'); ?></i>
	    </div>
	<?php } ?>
	<input type="hidden" name="category_id" value="<?php echo $this->category->id; ?>" />
	<input type="hidden" name="view" value="category" />	
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="task" value="" />	
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
</form>