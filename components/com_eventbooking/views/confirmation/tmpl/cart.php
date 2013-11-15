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

if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $param = null ;
?>
	<div class="componentheading"><?php echo JText::_('EB_CHECKOUT_CONFIRMATION') ; ?></div>
<?php    
} else {
    $param = 0 ;
?>
	<div class="componentheading"><?php echo JText::_('EB_CHECKOUT_CONFIRMATION') ; ?></div>
<?php    
}

JHTML::_('behavior.modal') ;	
$this->config->show_detail_in_popup = 1 ;
if ($this->config->show_detail_in_popup) {
	JHTML::_('behavior.modal');
	$popup = 'class="modal" rel="{handler: \'iframe\', size: {x: 800, y: 500}}"';	
} else {
	$popup = '';
}
$col = 2 ;
if ($this->config->fix_next_button) {
	$action = $this->url.'index.php?option=com_eventbooking&Itemid='.$this->Itemid ;
} else {
	$action = $this->url.'index.php' ;
}
if (strlen($this->config->confirmation_message)) {
	$msg = $this->config->confirmation_message ;
	$msg = str_replace('[EVENT_TITLE]', $this->eventTitle, $msg) ;
?>
	<p class="message"><?php echo $msg ; ?></p>			
<?php	 
}
?>
<form method="post" name="adminForm" id="adminForm" action="<?php echo $action; ?>">			
	<table width="100%" class="item_list">
		<tr>			
			<th class="sectiontableheader col_event">
				<?php echo JText::_('EB_EVENT'); ?>
			</th>
			<?php
				if ($this->config->show_event_date) {
				?>
					<th class="sectiontableheader col_event_date">
						<?php echo JText::_('EB_EVENT_DATE'); ?>
					</th>	
				<?php					
				}
			?>									
			<th class="sectiontableheader col_quantity">
				<?php echo JText::_('EB_QUANTITY'); ?>
			</th>						
			<th class="sectiontableheader col_price">
				<?php echo JText::_('EB_PRICE'); ?>
			</th>
			<th class="sectiontableheader col_price">
				<?php echo JText::_('EB_SUB_TOTAL'); ?>
			</th>					
		</tr>
		<?php
			$tabs = array('sectiontableentry1', 'sectiontableentry2') ;
			$total = 0 ;
			$k = 0 ;			
			for ($i = 0 , $n = count($this->items) ; $i < $n; $i++) {
				$item = $this->items[$i] ;
				$tab = $tabs[$k] ;
				$total += $item->quantity*$item->rate ;
				if ($this->config->show_detail_in_popup) {
	        		$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&tmpl=component&Itemid='.$this->Itemid);
	        	} else {
	        		$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&Itemid='.$this->Itemid);
	        	}
			?>
				<tr class="<?php echo $tab; ?>">									
					<td class="col_event">
						<a href="<?php echo $url; ?>" <?php echo $popup; ?>><?php echo $item->title; ?></a>								
					</td>
					<?php
						if ($this->config->show_event_date) {
						?>
							<td class="col_event_date">
								<?php
                                    if ($item->event_date == EB_TBC_DATE) {
                                        echo JText::_('EB_TBC');
                                    } else {
                                        echo JHTML::_('date', $item->event_date, $this->config->event_date_format, $param);  
                                    }
								?>								
							</td>
						<?php	
						}
					?>
					<td class="col_quantity">
						<?php echo $item->quantity ; ?>
					</td>																	
					<td class="col_price">
						<?php echo number_format($item->rate, 2); ?>
					</td>						
					<td class="col_price">
						<?php echo number_format($item->rate*$item->quantity, 2) ; ?>
					</td>
				</tr>
			<?php				
				$k = 1 - $k ;				
			}
			$tab = $tabs[$k] ;			
			if ($this->config->show_event_date) {
				$cols = 5 ;
			} else {
				$cols = 4 ;
			}			
			if ($this->discount > 0 || $this->taxAmount) {
			?>
				<tr class="<?php echo $tab; ?>">
					<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
						<span class="total_amount"><?php echo JText::_('EB_SUB_TOTAL'); ?></span>
					</td>
					<td style="text-align: right;">
						<?php echo EventBookingHelper::formatCurrency($total, $this->config); ?>																			
					</td>
				</tr>				
				<?php
                    if ($this->feeAmount != 0) {
                    ?> 
                    <tr class="<?php echo $tab; ?>">
						<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
							<span class="total_amount"><?php echo JText::_('EB_FEE_AMOUNT'); ?></span>
						</td>
						<td style="text-align: right;">							
							<?php echo EventBookingHelper::formatCurrency($this->feeAmount, $this->config) ; ?>													
						</td>
					</tr>	
                    <?php  
                    }
                    if ($this->discount > 0) {
                    ?>
                    	<tr class="<?php echo $tab; ?>">
        					<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
        						<span class="total_amount"><?php echo JText::_('EB_DISCOUNT'); ?></span>
        					</td>
        					<td style="text-align: right;">							
        						<?php echo EventBookingHelper::formatCurrency($this->discount, $this->config) ; ?>												
        					</td>
        				</tr>
                    <?php    
                    }
                    if ($this->taxAmount > 0) {
                    ?>
                    	<tr class="<?php echo $tab; ?>">
        					<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
        						<span class="total_amount"><?php echo JText::_('EB_TAX'); ?></span>
        					</td>
        					<td style="text-align: right;">							
        						<?php echo EventBookingHelper::formatCurrency($this->taxAmount, $this->config) ; ?>												
        					</td>
        				</tr>
                    <?php    
                    }
				?>							
				<tr class="<?php echo $tab; ?>">
					<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
						<span class="total_amount"><?php echo JText::_('EB_TOTAL'); ?></span>
					</td>
					<td style="text-align: right;">
						<?php echo EventBookingHelper::formatCurrency($this->amount + $this->taxAmount, $this->config) ; ?>																			
					</td>
				</tr>
				<?php	
				?>
			<?php	
			} else {			   			    
			    if ($this->feeAmount != 0) {
			    ?>					
					<tr class="<?php echo $tab; ?>">
						<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
							<span class="total_amount"><?php echo JText::_('EB_SUB_TOTAL'); ?></span>
						</td>
						<td style="text-align: right;">
							<?php echo EventBookingHelper::formatCurrency($total, $this->config) ; ?>																				
						</td>
					</tr>															
					<tr class="<?php echo $tab; ?>">
						<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
							<span class="total_amount"><?php echo JText::_('EB_TOTAL'); ?></span>
						</td>
						<td style="text-align: right;">
							<?php echo EventBookingHelper::formatCurrency($this->amount, $this->config) ; ?>																				
						</td>
					</tr>	
				<?php    
			    } else {
    			    ?>					
    					<tr class="<?php echo $tab; ?>">
    						<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
    							<span class="total_amount"><?php echo JText::_('EB_TOTAL'); ?></span>
    						</td>
    						<td style="text-align: right;">							
    							<?php echo EventBookingHelper::formatCurrency($total, $this->config) ; ?>    													
    						</td>
    					</tr>			
    				<?php
			    }			    				
			}											
			?>																
	</table>					
	<table width="100%" class="os_table" cellspacing="3" cellpadding="3">				
		<?php
			if ($this->username) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo JText::_('EB_USERNAME'); ?>
					</td>
					<td>
						<?php echo $this->username ; ?>
					</td>
				</tr>
			<?php	
				if ($this->password) {
				?>
					<tr>
						<td class="title_cell">
							<?php echo JText::_('EB_PASSWORD'); ?>
						</td>
						<td>
							<?php echo str_pad('', strlen($this->password), '*', STR_PAD_LEFT); ?>
						</td>
					</tr>
				<?php	
				}
			}
		?>
		<tr>			
			<td class="title_cell" width="30%">
				<?php echo  JText::_('EB_FIRST_NAME') ?>
			</td>
			<td class="field_cell">
				<?php echo $this->firstName ; ?>				 
			</td>
		</tr>
		<?php
			if ($this->config->s_lastname) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_LAST_NAME') ?>
					</td>
					<td class="field_cell">
						<?php echo $this->lastName ; ?>
					</td>
				</tr>
			<?php	
			}		
			if ($this->config->s_organization) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ORGANIZATION'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->organization ; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_address) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->address ; ?>
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->s_address2) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS2'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->address2 ; ?>
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->s_city) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_CITY'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->city ;  ?>
					</td>
				</tr>		
			<?php	
			}
			
			if ($this->config->s_state) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_STATE'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->state ; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_zip) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ZIP'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->zip ; ?>
					</td>
				</tr>
			<?php	
			}			
			if ($this->config->s_country) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COUNTRY'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->country ; ?>
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->s_phone) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_PHONE'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->phone ; ?>
					</td>
				</tr>
			<?php
			}
			if ($this->config->s_fax) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_FAX'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->fax; ?>
					</td>
				</tr>
			<?php
			}				
		 ?>																		
		<tr>			
			<td class="title_cell">
				<?php echo  JText::_('EB_EMAIL'); ?>
			</td>
			<td class="field_cell">
				<?php echo $this->email ; ?>
			</td>
		</tr>		
		<?php
			if ($this->customField)
				echo $this->fields ;		
			if ($this->amount > 0) {
			?>									
			<tr>
				<td class="title_cell" valign="top">
					<?php echo JText::_('EB_PAYMENT_OPTION') ; ?>
				</td>
				<td>
					<?php
						$method = os_payments::loadPaymentMethod($this->paymentMethod);
						if ($method)
							echo JText::_($method->title);
					?>
				</td>
			</tr>			
			<?php 				
				$method = $this->method ;							
				if ($method->getCreditCard()) {
				?>	
					<tr>
						<td class="title_cell"><?php echo  JText::_('AUTH_CARD_NUMBER'); ?>
						<td class="field_cell">
							<?php
								$len = strlen($this->x_card_num) ;
								$remaining =  substr($this->x_card_num, $len - 4 , 4) ;
								echo str_pad($remaining, $len, '*', STR_PAD_LEFT) ;
							?>												
						</td>
					</tr>
					<tr>
						<td class="title_cell">
							<?php echo JText::_('AUTH_CARD_EXPIRY_DATE'); ?>
						</td>
						<td class="field_cell">						
							<?php echo $this->expMonth .'/'.$this->expYear ; ?>
						</td>
					</tr>
					<tr>
						<td class="title_cell">
							<?php echo JText::_('AUTH_CVV_CODE'); ?>
						</td>
						<td class="field_cell">
							<?php echo $this->x_card_code ; ?>
						</td>
					</tr>
					<?php
						if ($method->getCardType()){
						?>
							<tr>
								<td class="title_cell">
									<?php echo JText::_('EB_CARD_TYPE'); ?>
								</td>
								<td class="field_cell">
									<?php echo $this->cardType ; ?>
								</td>
							</tr>
						<?php	
						}
					?>
				<?php				
				}						
				if ($method->getCardHolderName()) {
				?>
					<tr>
						<td class="title_cell">
							<?php echo JText::_('EB_CARD_HOLDER_NAME'); ?>
						</td>
						<td class="field_cell">
							<?php echo $this->cardHolderName;?>
						</td>
					</tr>
				<?php												
				}																	
		}
		?>				
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_COMMENT'); ?>
			</td>
			<td class="field_cell">
				<?php echo $this->comment; ?>
			</td>
		</tr>			
		<?php
			if ($this->showCaptcha) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo JText::_('EB_CAPTCHA'); ?><span class="required">*</span>
					</td>
					<td>
						<input type="text" class="inputbox" value="" size="8" name="security_code" />
						<img src="<?php echo JRoute::_('index.php?option=com_eventbooking&task=show_captcha_image'); ?>" title="<?php echo JText::_('EB_CAPTCHA_GUIDE'); ?>" align="middle" id="captcha_image" />
						<a href="javascript:reloadCaptcha();"><strong><?php echo JText::_('EB_RELOAD'); ?></strong></a>
						<?php
							if ($this->captchaInvalid) {
							?>
								<span class="error"><?php echo JText::_('EB_INVALID_CAPTCHA_ENTERED'); ?></span>
							<?php	
							}
						?>				
					</td>
				</tr>	
			<?php	
			}	
			if ($this->config->accept_term ==1) {
			    $articleId = $this->config->article_id ;
			    $db = & JFactory::getDbo() ;
				$sql = 'SELECT id, catid, sectionid FROM #__content WHERE id='.$articleId ;
				$db->setQuery($sql) ;
				$rowArticle = $db->loadObject() ;
				$catId = $rowArticle->catid ;
				$sectionId = $rowArticle->sectionid ;
				require_once JPATH_ROOT.'/components/com_content/helpers/route.php' ;				
				if ($this->config->fix_term_and_condition_popup) {
				    $termLink = ContentHelperRoute::getArticleRoute($articleId, $catId, $sectionId).'&format=html' ;
				    $extra = ' target="_blank" ';   
				} else {
				    $termLink = ContentHelperRoute::getArticleRoute($articleId, $catId, $sectionId).'&tmpl=component&format=html' ;
				    $extra = ' class="modal" ' ;
				}		
			?>
				<tr>
					<td colspan="2">
						<input type="checkbox" name="accept_term" value="1" class="inputbox" />
						<?php echo JText::_('EB_ACCEPT'); ?>&nbsp;<a href="<?php echo JRoute::_($termLink); ?>" <?php echo $extra; ?>><strong><?php echo JText::_('EB_TERM_AND_CONDITION'); ?></strong></a>
					</td>
				</tr>
			<?php	
			}
		?>						
		<tr>
			<td colspan="2" align="left">
				<input type="button" class="button" name="btnBack" value="<?php echo  JText::_('EB_BACK') ;?>" onclick="billingPage();" />
				<input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_PROCESS_REGISTRATION') ;?>" onclick="checkData()" />
			</td>
		</tr>										
	</table>		
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />	
	<input type="hidden" name="option" value="com_eventbooking" />		
	<input type="hidden" name="task" value="process_checkout" />		
	<script type="text/javascript">
		function billingPage() {			
			var form = document.adminForm ;
			form.task.value = 'checkout';
			form.submit();	
		}	
		function checkData() {
			var form = document.adminForm ;
			<?php
				if ($this->showCaptcha) {
				?>
					if (form.security_code.value == '') {
						alert("<?php echo JText::_("EB_ENTER_CAPTCHA"); ?>");
						form.security_code.focus() ;
						return ;	
					}
				<?php					
				}
				if ($this->config->accept_term == 1) {
				?>
					if (!form.accept_term.checked) {
						alert("<?php echo JText::_('EB_ACCEPT_TERMS') ; ?>");
						form.accept_term.focus();
						return ;
					}
				<?php	
				}
			?>
			//Prevent double click
			form.btnSubmit.disabled = true ;
			form.submit();
		}			
		function reloadCaptcha() {									
			document.getElementById('captcha_image').src = 'index.php?option=com_eventbooking&task=show_captcha_image&ran=' + Math.random();			
		}		
	</script>			
	<!-- Hidden information for basic member -->
	<input type="hidden" name="username" value="<?php echo $this->username; ?>" />
	<input type="hidden" name="password" value="<?php echo $this->password; ?>" />
	<input type="hidden" name="total_amount" value="<?php echo $this->totalAmount; ?>" />
	<input type="hidden" name="discount_amount" value="<?php echo $this->discount ; ?>" />
	<input type="hidden" name="amount" value="<?php echo $this->amount ; ?>" />
	<input type="hidden" name="deposit_amount" value="<?php echo $this->depositAmount; ?>" />
	<input type="hidden" name="first_name" value="<?php echo $this->firstName; ?>" />
	<input type="hidden" name="last_name" value="<?php echo $this->lastName; ?>" />
	<input type="hidden" name="organization" value="<?php echo $this->organization; ?>" />
	<input type="hidden" name="address" value="<?php echo $this->address; ?>" />
	<input type="hidden" name="address2" value="<?php echo $this->address2; ?>" />
	<input type="hidden" name="city" value="<?php echo $this->city; ?>" />
	<input type="hidden" name="state" value="<?php echo $this->state; ?>" />
	<input type="hidden" name="zip" value="<?php echo $this->zip; ?>" />
	<input type="hidden" name="country" value="<?php echo $this->country; ?>" />	
	<input type="hidden" name="phone" value="<?php echo $this->phone; ?>" />	
	<input type="hidden" name="fax" value="<?php echo $this->fax; ?>" />	
	<input type="hidden" name="email" value="<?php echo $this->email; ?>" />	
	<input type="hidden" name="comment" value="<?php echo $this->comment; ?>" />		
	<input type="hidden" name="payment_method" value="<?php echo $this->paymentMethod; ?>" />
	<input type="hidden" name="x_card_num" value="<?php echo $this->x_card_num; ?>" />				
	<input type="hidden" name="x_card_code" value="<?php echo $this->x_card_code; ?>" />				
	<input type="hidden" name="exp_month" value="<?php echo $this->expMonth; ?>" />
	<input type="hidden" name="exp_year" value="<?php echo $this->expYear; ?>" />
	<input type="hidden" name="card_holder_name" value="<?php echo $this->cardHolderName ; ?>" />
	<input type="hidden" name="card_type" value="<?php echo $this->cardType ; ?>" />
	<input type="hidden" name="coupon_code" value="<?php echo $this->couponCode; ?>" />
	<input type="hidden" name="bank_id" value="<?php echo $this->bankId ; ?>" />
	<input type="hidden" name="is_back" value="1" />
	<?php
		if ($this->customField)
			echo $this->hidden ;
	?>							
	<?php echo JHTML::_( 'form.token' ); ?>											
</form>