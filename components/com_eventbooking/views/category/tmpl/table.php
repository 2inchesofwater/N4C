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

if ($this->config->show_location_in_category_view) {
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
}
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $j15 = false ;
    $param = null ;
} else {
    $j15 = true ;
    $param = 0 ;
}	
if ($this->config->show_cat_decription_in_calendar_layout) {
?>
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
<?php	
} else {
?>
	<div class="componentheading"><?php echo JText::_('EB_EVENT_LIST') ; ?></div>
	<p class="eb_message">
		<?php echo JText::_('EB_EVENT_GUIDE') ; ?>
	</p>
<?php	
}
$col = 3 ;	
$activateWaitingList = $this->config->activate_waitinglist_feature ;
if ($this->config->use_https)
    $ssl = true ;
else 
    $ssl = false ;    
?> 
<form method="post" name="adminForm" id="adminForm" action="index.php">
	<table width="100%" class="doc_list">
		<tr>
			<th class="sectiontableheader no_col">
				<?php echo JText::_('EB_NO') ; ?>	
			</th>
			<th class="sectiontableheader">
				<?php echo JText::_('EB_EVENT_TITLE'); ?>
			</th>							
			<th class="sectiontableheader date_col">
				<?php echo JText::_('EB_EVENT_DATE'); ?>
			</th>
			<?php
				if ($this->config->show_location_in_category_view) {
					$col++ ; 
				?>
					<th class="sectiontableheader location_col">
						<?php echo JText::_('EB_LOCATION'); ?>
					</th>
				<?php	
				}
				if ($this->config->show_price_in_table_layout) {
				?>
					<th class="sectiontableheader table_price_col">
						<?php echo JText::_('EB_INDIVIDUAL_PRICE'); ?>
					</th>
				<?php    
				    $col++;
				}
				if ($this->config->show_capacity) {
					$col++ ;
				?>
					<th class="sectiontableheader capacity_col">
						<?php echo JText::_('EB_CAPACITY'); ?>
					</th>	
				<?php	
				}
				if ($this->config->show_registered) {
					$col++ ;
				?>
					<th class="sectiontableheader registered_col">
						<?php echo JText::_('EB_REGISTERED'); ?>
					</th>	
				<?php	
				}
			?>										
		</tr>
		<?php
			$tabs = array('sectiontableentry1', 'sectiontableentry1');
			$total = 0 ;
			$k = 0 ;			
			for ($i = 0 , $n = count($this->items) ; $i < $n; $i++) {
				$item = $this->items[$i] ;
				$canRegister = EventBookingHelper::acceptRegistration($item->id) ;
				$tab = $tabs[$k] ;		
			    if (($item->event_capacity > 0) && ($item->event_capacity <= $item->total_registrants) && $activateWaitingList && !$item->user_registered) {
	        	    $waitingList = true ;
	        	    $waitinglistUrl = JRoute::_('index.php?option=com_eventbooking&task=waitinglist_form&event_id='.$item->id.'&Itemid='.$this->Itemid);
	        	} else {
	        	    $waitingList = false ;
	        	}				
	        	$k = 1 - $k ;
			?>
				<tr class="<?php echo $tab; ?>">
					<td>
						<?php echo $i + 1 ; ?>
					</td>					
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id) ?>" class="eb_event_link"><?php echo $item->title ; ?></a>
					</td>					
					<td>	
						<?php
                            if ($item->event_date == EB_TBC_DATE) {
                                echo JText::_('EB_TBC');
                            } else {
                                echo JHTML::_('date', $item->event_date, $this->config->event_date_format, $param);
                            }
						?>										
					</td>			
					<?php
						if ($this->config->show_location_in_category_view) {
						?>
							<td>
								<?php
									if ($item->location_id) {
									?>
										<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_map&location_id='.$item->location_id.'&tmpl=component&format=html'); ?>" rel="gb_page_center[<?php echo $width; ?>, <?php echo $height; ?>]" title="<?php echo $item->location_name ; ?>" class="location_link"><?php echo $item->location_name ; ?></a>
									<?php	
									} else {
									?>
										&nbsp;	
									<?php	
									}	
								?>								
							</td>
						<?php	
						}
			            if ($this->config->show_price_in_table_layout) {
						    if ($this->config->show_discounted_price)
						        $price = $item->discounted_price ;
						    else 
						        $price = $item->individual_price ;   						     
						?>
							<td>
								<?php echo EventBookingHelper::formatCurrency($price, $this->config); ?>
							</td>
						<?php    
						}
						if ($this->config->show_capacity) {
						?>
							<td style="text-align: center;">
								<?php
									if ($item->event_capacity)
										echo $item->event_capacity ;
									else
										echo JText::_('EB_UNLIMITED') ;	
								?>
							</td>
						<?php	
						}
						if ($this->config->show_registered) {
						?>
							<td style="text-align: center;">
								<?php
									echo $item->total_registrants ;
								?>
							</td>
						<?php	
						}
					?>																											
				</tr>
				<?php
					if ($waitingList || $canRegister || ($item->registration_type != 3 && $this->config->display_message_for_full_event)) {
					?>					
						<tr class="<?php echo $tab; ?>">					
							<td colspan="<?php echo $col; ?>">
								<?php
									if ($canRegister || $waitingList) {
									?>
										<div class="eb_taskbar" style="float: right;">
										    <ul>	
										    	<?php
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
										    		?>
										    			<li>
												    		<a href="<?php echo $waitingList ? $waitinglistUrl : JRoute::_('index.php?option=com_eventbooking&task=group_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl) ; ?>"><?php echo JText::_('EB_REGISTER_GROUP'); ?></a>
												    	</li>	
										    		<?php	
										    		}								    		
										    	?>								    									   						 			
										    </ul>
										    <div class="clr"></div>
										</div>		
									<?php	
									} elseif($item->registration_type != 3 && $this->config->display_message_for_full_event && !$waitingList) {
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
										<div class="eb_notice_table">
											<?php echo $msg ; ?>
										</div>
									<?php
									}
								?>													
							</td>
						</tr>																				
					<?php	
					}					
				$k = 1 - $k ;		
			}				
			if ($this->pagination->total > $this->pagination->limit) {
			?>	
				<tr>
					<td colspan="<?php echo $col ; ?>"><div align="center" class="pagination"><?php echo $this->pagination->getListFooter(); ?></div></td>
				</tr>				
			<?php		
			}
		?>		
	</table>		
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />	
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="view" value="category" />
	<input type="hidden" name="layout" value="table" />	
	<input type="hidden" name="category_id" value="<?php echo $this->category->id; ?>" />	
</form>