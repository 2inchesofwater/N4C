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
			
JHTML::_('behavior.modal');
$popup = 'class="modal" rel="{handler: \'iframe\', size: {x: 800, y: 500}}"';
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $param  = null ;
?>
	<div class="componentheading"><?php echo JText::_('EB_CHECKOUT'); ?></div>
<?php    
} else {
    $param = 0 ;
?>
	<div class="componentheading"><?php echo JText::_('EB_CHECKOUT'); ?></div>
<?php    
}		

if ($this->config->fix_next_button) {
?>
	<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>" autocomplete="off">	
<?php	 
} else {
?>
	<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php" autocomplete="off">
<?php	
}
$msg = $this->config->registration_form_message ;					
if (strlen($msg)) {					
	$msg = str_replace('[EVENT_TITLE]', $this->eventTitle, $msg) ;
	$msg = str_replace('[AMOUNT]', EventBookingHelper::formatCurrency($this->amount, $this->config), $msg) ;
?>								
	<div class="msg"><?php echo $msg ; ?></div>							 															
<?php	
}			
?>			
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
			<th class="sectiontableheader col_price">
				<?php echo JText::_('EB_PRICE'); ?>
			</th>					
			<th class="sectiontableheader col_quantity">
				<?php echo JText::_('EB_QUANTITY'); ?>
			</th>
			<th class="sectiontableheader col_subtotal">
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
	        	$url = JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id.'&tmpl=component&Itemid='.$this->Itemid);	        	
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
					<td class="col_price">
						<?php echo number_format($item->rate, 2); ?>
					</td>
					<td class="col_quantity">
						<?php echo $item->quantity ; ?>
					</td>	
					<td class="col_price">
						<?php echo number_format($item->rate*$item->quantity, 2); ?>
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
			
			if ($this->discount > 0 || $this->taxAmount > 0) {
			?>
				<tr class="<?php echo $tab; ?>">
					<td colspan="<?php echo $cols - 1 ; ?>" style="text-align: right;">
						<span class="total_amount">
						    <?php echo JText::_('EB_SUB_TOTAL'); ?>			    
						</span>
					</td>
					<td style="text-align: right;">				
						<?php echo EventBookingHelper::formatCurrency($total, $this->config) ?>														
					</td>
				</tr>
				<?php
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
			$k = 1 - $k ;
			$tab = $tabs[$k] ;				
			?>		
			<tr class="<?php echo $tab; ?>">				
				<td colspan="<?php echo $cols ; ?>" style="text-align: right;">										
					<input type="button" class="button" value="<?php echo JText::_('EB_MODIFY_CART'); ?>" onclick="updateCart();" />																									
				</td>								
			</tr>			
	</table>				
	<table width="100%" class="os_table" cellspacing="3" cellpadding="3">
		<?php
			if ($this->enableCoupon) {
			?>
				<tr class="coupon_row">			
					<td class="title_cell" width="30%">
						<?php echo  JText::_('EB_COUPON') ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="coupon_code" value="<?php echo $this->couponCode; ?>" size="18" />						
						<?php
							if ($this->errorCoupon) {
							?>
								<span class="invalid"><?php echo JText::_('EB_INVALID_COUPON'); ?></span>
							<?php	
							}
						?>
					</td>
				</tr>	
			<?php	
			}
			if (!$this->userId && $this->config->user_registration) {
			?>				
				<tr>
					<td colspan="2">					
						<ul>
							<li>
								<?php echo JText::_('EB_HAVE_AN_ACCOUNT_ALREADY'); ?>								
							</li>
							<li>
								<?php echo JText::_('EB_WANT_TO_REGISTER'); ?>
							</li>
							<li>
								<?php echo JText::_('EB_DONT_WANT_TO_REGISTER'); ?>
							</li>
						</ul>														
					</td>
				</tr>				
				<tr>			
					<td class="title_cell" width="30%">
						<?php echo  JText::_('EB_USERNAME') ?>
					</td>
					<td class="field_cell">
						<input type="text" name="username" class="inputbox" value="<?php echo $this->username; ?>" size="15" />
						<?php
							if ($this->registrationErrorCode == 1 || $this->registrationErrorCode == 3) {
							?>
								<span class="invalid"><?php echo JText::_('EB_INVALID_USERNAME'); ?></span>
							<?php	
							}
						?>						
					</td>
				</tr>
				<tr>			
					<td class="title_cell" width="30%">
						<?php echo  JText::_('EB_PASSWORD') ?>
					</td>
					<td class="field_cell">
						<input type="password" name="password" class="inputbox" value="<?php echo $this->password; ?>" size="15" />
					</td>
				</tr>					
				<tr>			
					<td class="title_cell" width="30%">
						<?php echo  JText::_('EB_RETYPE_PASSWORD') ?>
					</td>
					<td class="field_cell">
						<input type="password" name="password2" class="inputbox" value="<?php echo $this->password ; ?>" size="15" />
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			<?php	
			}
			?>												
			<tr>			
				<td class="title_cell" width="30%">
					<?php echo  JText::_('EB_FIRST_NAME') ?><span class="required">*</span>
				</td>
				<td class="field_cell">
					<input type="text" class="inputbox" name="first_name" value="<?php echo $this->firstName; ?>" size="25" />
				</td>
			</tr>	
			<?php		
			if ($this->config->s_lastname) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_LAST_NAME') ?><?php if ($this->config->r_lastname) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="last_name" value="<?php echo $this->lastName; ?>" size="25" />
					</td>
				</tr>
			<?php	
			}		
			if ($this->config->s_organization) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ORGANIZATION'); ?><?php if ($this->config->r_organization) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="organization" value="<?php echo $this->organization; ?>" size="30" />
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_address) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS'); ?><?php if ($this->config->r_address) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="address" value="<?php echo $this->address; ?>" size="50" />
					</td>
				</tr>	
			<?php	
			}
			
			if ($this->config->s_address2) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS2'); ?><?php if ($this->config->r_address2) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="address2" value="<?php echo $this->address2; ?>" size="50" />
					</td>
				</tr>	
			<?php	
			}
			
			if ($this->config->s_city) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_CITY'); ?><?php if ($this->config->r_city) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="city" value="<?php echo $this->city; ?>" size="15" />
					</td>
				</tr>		
			<?php	
			}
			if ($this->config->s_country) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COUNTRY'); ?><?php if ($this->config->r_country) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<?php echo $this->lists['country_list']; ?>
					</td>
				</tr>	
			<?php	
			}					
			if ($this->config->s_state) {
				if ($this->config->display_state_dropdown) {
				?>
					<tr>			
						<td class="title_cell">
							<?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->r_state) echo '<span class="required">*</span>'; ?>
						</td>
						<td class="field_cell">
							<?php echo $this->lists['state'] ; ?>
						</td>
					</tr>		
				<?php	
				} else {
				?>
					<tr>			
						<td class="title_cell">
							<?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->r_state) echo '<span class="required">*</span>'; ?>
						</td>
						<td class="field_cell">
							<input type="text" class="inputbox" name="state" value="<?php echo $this->state; ?>" size="15" />
						</td>
					</tr>	
				<?php	
				}			
			}			
			if ($this->config->s_zip) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ZIP'); ?><?php if ($this->config->r_zip) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="zip" value="<?php echo $this->zip; ?>" size="15" />
					</td>
				</tr>
			<?php	
			}								
			if ($this->config->s_phone) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_PHONE'); ?><?php if ($this->config->r_phone) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="phone" value="<?php echo $this->phone; ?>" size="15" />
					</td>
				</tr>
			<?php
			}
			if ($this->config->s_fax) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_FAX'); ?><?php if ($this->config->r_fax) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="fax" value="<?php echo $this->fax; ?>" size="15" />
					</td>
				</tr>
			<?php
			}				
		 ?>																		
		<tr>			
			<td class="title_cell">
				<?php echo  JText::_('EB_EMAIL'); ?><span class="required">*</span>
			</td>
			<td class="field_cell">
				<input type="text" class="inputbox" name="email" value="<?php echo $this->email; ?>" size="40" />
				<?php
					if ($this->registrationErrorCode == 2) {
					?>
						<span class="invalid"><?php echo JText::_('EB_EMAIL_USED'); ?></span>
					<?php	
					}
				?>
			</td>
		</tr>				
		<?php				
			if ($this->customField) 
				echo $this->fields ;				
			if (($this->amount > 0) || ($this->numberFeeFields > 0)) {			    
				if (count($this->methods) > 1) {
				?>
					<tr>
						<td class="title_cell" valign="top">
							<?php echo JText::_('EB_PAYMENT_OPTION'); ?>
							<span class="required">*</span>
						</td>
						<td>
							<?php
								$method = null ;
								for ($i = 0 , $n = count($this->methods); $i < $n; $i++) {
									$paymentMethod = $this->methods[$i];
									if ($paymentMethod->getName() == $this->paymentMethod) {
										$checked = ' checked="checked" ';
										$method = $paymentMethod ;
									}										
									else 
										$checked = '';	
								?>
									<input onclick="changePaymentMethod();" type="radio" name="payment_method" value="<?php echo $paymentMethod->getName(); ?>" <?php echo $checked; ?> /><?php echo JText::_($paymentMethod->getTitle()); ?> <br />
								<?php		
								}	
							?>
						</td>
					</tr>				
				<?php					
				} else {
					$method = $this->methods[0] ;
				?>
				<tr>
					<td class="title_cell" valign="top">
						<?php echo JText::_('EB_PAYMENT_OPTION'); ?>						
					</td>
					<td>
						<?php echo JText::_($method->getTitle()); ?>
					</td>
				</tr>
				<?php	
				}																			
				if ($method->getCreditCard()) {
					$style = '' ;	
				} else {
					$style = 'style = "display:none"';
				}			
				?>			
				<tr id="tr_card_number" <?php echo $style; ?>>
					<td class="title_cell"><?php echo  JText::_('AUTH_CARD_NUMBER'); ?><span class="required">*</span></td>
					<td class="field_cell">
						<input type="text" name="x_card_num" class="inputbox" onkeyup="checkNumber(this)" value="<?php echo $this->x_card_num; ?>" size="20" />
					</td>
				</tr>
				<tr id="tr_exp_date" <?php echo $style; ?>>
					<td class="title_cell">
						<?php echo JText::_('AUTH_CARD_EXPIRY_DATE'); ?><span class="required">*</span>
					</td>
					<td class="field_cell">					
						<?php echo $this->lists['exp_month'] .'  /  '.$this->lists['exp_year'] ; ?>
					</td>
				</tr>
				<tr id="tr_cvv_code" <?php echo $style; ?>>
					<td class="title_cell">
						<?php echo JText::_('AUTH_CVV_CODE'); ?><span class="required">*</span>
					</td>
					<td class="field_cell">
						<input type="text" name="x_card_code" class="inputbox" onKeyUp="checkNumber(this)" value="<?php echo $this->x_card_code; ?>" size="20" />
					</td>
				</tr>
				<?php
					if ($method->getCardType()) {
						$style = '' ;
					} else {
						$style = ' style = "display:none;" ' ;										
					}
				?>
					<tr id="tr_card_type" <?php echo $style; ?>>
						<td class="title_cell">
							<?php echo JText::_('EB_CARD_TYPE'); ?><span class="required">*</span>
						</td>
						<td class="field_cell">
							<?php echo $this->lists['card_type'] ; ?>
						</td>
					</tr>					
				<?php
					if ($method->getCardHolderName()) {
						$style = '' ;
					} else {
						$style = ' style = "display:none;" ' ;										
					}
				?>
					<tr id="tr_card_holder_name" <?php echo $style; ?>>
						<td class="title_cell">
							<?php echo JText::_('EB_CARD_HOLDER_NAME'); ?><span class="required">*</span>
						</td>
						<td class="field_cell">
							<input type="text" name="card_holder_name" class="inputbox"  value="<?php echo $this->cardHolderName; ?>" size="40" />
						</td>
					</tr>
				<?php
					if ($method->getName() == 'os_ideal') {
						$style = '' ;
					} else {
						$style = ' style = "display:none;" ' ;
					}					
				?>
					<tr id="tr_bank_list" <?php echo $style; ?>>
						<td class="title_cell">
							<?php echo JText::_('EB_BANK_LIST'); ?><span class="required">*</span>
						</td>
						<td class="field_cell">
							<?php echo $this->lists['bank_id'] ; ?>
						</td>
					</tr>
				<?php		
			}			
			if ($this->config->s_comment) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COMMENT'); ?><?php if ($this->config->r_comment) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<textarea rows="7" cols="50" name="comment" class="inputbox"><?php echo $this->comment;?></textarea>
					</td>
				</tr>	
			<?php	
			}						
			?>									
		<tr>
			<td colspan="2" align="left">
				<input type="button" class="button" name="btnBack" value="<?php echo  JText::_('EB_BACK') ;?>" onclick="window.history.go(-1);">
				<input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_CHECKOUT_CONFIRMATION') ;?>" onclick="checkData();">				
			</td>
		</tr>										
	</table>					
	<?php
		if (count($this->methods) == 1) {
		?>
			<input type="hidden" name="payment_method" value="<?php echo $this->methods[0]->getName(); ?>" />
		<?php	
		}		
	?>
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="event_id" value="0" />
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="task" value="checkout_confirmation" />			
	<script language="javascript">
		<?php
			echo os_payments::writeJavascriptObjects(); 
			if ($this->config->display_state_dropdown) {
				echo $this->countryIdsString ;
				echo $this->countryNamesString ;
				echo $this->stateString ;
			} 		
		?>
		function checkData() {
			var form = document.adminForm ;
			<?php
				if (!$this->userId && $this->config->user_registration) {
				?>
					if (form.password.value != '') {
						if (form.username.value == '') {
							alert("<?php echo JText::_("EB_USERNAME_REQUIRED"); ?>");
							form.username.focus();
							return ;
						}
						if (form.password.value != form.password2.value) {
							alert("<?php echo JText::_("EB_CONFIRMATION_PASSWORD_NOT_MATCH"); ?>");
							form.password.focus();
							return ;
						}
					}	
				<?php	
				}
			?>			
			if (form.first_name.value == '') {
				alert("<?php echo JText::_('EB_REQUIRE_FIRST_NAME'); ?>");
				form.first_name.focus();
				return ;
			}						
			<?php
				if ($this->config->s_lastname && $this->config->r_lastname) {
				?>
					if (form.last_name.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_LAST_NAME'); ?>");
						form.last_name.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->s_organization && $this->config->r_organization) {
				?>
					if (form.organization.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ORGANIZATION'); ?>");
						form.organization.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->s_address && $this->config->r_address) {
				?>
					if (form.address.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ADDRESS'); ?>");
						form.address.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->s_city && $this->config->r_city) {
				?>
					if (form.city.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_CITY'); ?>");
						form.city.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->s_country && $this->config->r_country) {
				?>
					if (form.country.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_COUNTRY'); ?>");
						form.country.focus();
						return;	
					}				
				<?php		
				}
				if ($this->config->s_state && $this->config->r_state) {
					if ($this->config->display_state_dropdown) {
					?>
						if ((form.state.options.length > 1) && (form.state.value == '')) {
							alert("<?php echo JText::_('EB_REQUIRE_STATE'); ?>");
							form.state.focus();
							return;
						}
					<?php	
					} else {
					?>
						if (form.state.value =="") {
							alert("<?php echo JText::_('EB_REQUIRE_STATE'); ?>");
							form.state.focus();
							return;	
						}
					<?php	
					}							
				}								
				if ($this->config->s_zip && $this->config->r_zip) {
				?>
					if (form.zip.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_ZIP'); ?>");
						form.zip.focus();
						return;
					}						
				<?php		
				}				
				if ($this->config->s_phone && $this->config->r_phone) {
				?>
					if (form.phone.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_PHONE'); ?>");
						form.phone.focus();
						return;
					}						
				<?php		
				}																										
			?>				
			if (form.email.value == '') {
				alert("<?php echo JText::_('EB_REQUIRE_EMAIL'); ?>");
				form.email.focus();
				return;
			}							
			var emailFilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
			var ret = emailFilter.test(form.email.value);
			if (!ret) {
				alert("<?php echo  JText::_('EB_VALID_EMAIL'); ?>");
				form.email.focus();
				return;
			}					
			//Custom field validation
			<?php				
				if ($this->customField) {
					echo $this->validations ;
				}
			?>																						
			var paymentMethod = "";
			<?php
			if ($this->amount > 0 ) {				
				if (count($this->methods) > 1) {
				?>
					var paymentValid = false;
					for (var i = 0 ; i < form.payment_method.length; i++) {
						if (form.payment_method[i].checked == true) {
							paymentValid = true;
							paymentMethod = form.payment_method[i].value;
							break;
						}
					}
					
					if (!paymentValid) {
						alert("<?php echo JText::_('EB_REQUIRE_PAYMENT_OPTION'); ?>");
						return;
					}		
				<?php	
				} else {
				?>
					paymentMethod = "<?php echo $this->methods[0]->getName(); ?>";
				<?php	
				}				
				?>
				method = methods.Find(paymentMethod);				
				//Check payment method page
				if (method.getCreditCard()) {
					if (form.x_card_num.value == "") {
						alert("<?php echo  JText::_('EB_ENTER_CARD_NUMBER'); ?>");
						form.x_card_num.focus();
						return;					
					}					
					if (form.x_card_code.value == "") {
						alert("<?php echo JText::_('EB_ENTER_CARD_CODE'); ?>");
						form.x_card_code.focus();
						return ;
					}
				}
				if (method.getCardHolderName()) {
					if (form.card_holder_name.value == '') {
						alert("<?php echo JText::_('EB_ENTER_CARD_HOLDER_NAME') ; ?>");
						form.card_holde_name.focus();
						return ;
					}
				}										
			<?php																						
			}								
			if ($this->config->s_comment && $this->config->r_comment) {
				?>
					if (form.comment.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_COMMENT'); ?>");
						form.comment.focus();
						return;
					}						
				<?php	
				}									 						
			?>													
			form.submit();
		}		
		function checkNumber(txtName)
		{			
			var num = txtName.value			
			if(isNaN(num))			
			{			
				alert("<?php echo JText::_('EB_ONLY_NUMBER'); ?>");			
				txtName.value = "";			
				txtName.focus();			
			}			
		}		
		function updateCart(){
			location.href = 'index.php?option=com_eventbooking&task=view_cart&Itemid=' + <?php echo $this->Itemid; ?> ;	
		}									
	</script>	
	<?php echo JHTML::_( 'form.token' ); ?>
</form>