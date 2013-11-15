<?php defined('_JEXEC') or die('Restricted access'); ?>
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

JHTML::_('behavior.modal') ;	
$headerText = JText::_('EB_REGISTRATION_GROUP_CONFIRMATION') ;
$headerText = str_replace('[EVENT_TITLE]', $this->event->title, $headerText) ;
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $param = null ;
?>
	<h1 class="eb_title"><?php echo $headerText ; ?></h1>
<?php            
} else {    
    $param = 0 ;
?>
	<div class="componentheading"><?php echo $headerText; ?></div>
<?php    
}
	if ($this->config->fix_next_button) {
	?>
		<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>">	
	<?php	 
	} else {
	?>
		<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php">
	<?php	
	}
	$msg = $this->config->confirmation_message ;			
	if (strlen($msg)) {
		$msg = str_replace('[EVENT_TITLE]', $this->event->title, $msg) ;
		$msg = str_replace('[EVENT_DATE]', JHTML::_('date', $this->event->event_date, $this->config->event_date_format, $param), $msg) ;
		$msg = str_replace('[AMOUNT]', $this->amount, $msg) ; 			
	?>								
		<div class="msg"><?php echo $msg ; ?></div>							 															
	<?php	
	}	
	?>		
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
			<td class="eb_row_heading">
				<h4><?php echo JText::_('EB_BILLING_INFORMATION') ; ?></h4>
			</td>
		</tr>	
		<tr>
			<td colspan="2">
				<table width="100%" class="os_table" cellspacing="3" cellpadding="3">
					<tr>			
					<td class="title_cell" width="30%">
						<?php echo  JText::_('EB_FIRST_NAME') ?>
					</td>
					<td class="field_cell">
						<?php echo $this->firstName; ?>
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
								<?php echo $this->city ; ?>
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
								<?php echo $this->fax ; ?>
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
				<tr>
					<td class="title_cell">
						<?php echo JText::_('Number registrants'); ?>
					</td>
					<td>
						<?php echo count($this->rowMembers);?>
					</td>
				</tr>				
				<?php								
					if ($this->totalAmount > 0) {				
						?>
							<tr>
								<td class="title_cell">
								<?php
								    if ($this->taxAmount > 0) {
								        echo JText::_('EB_BASE_PRICE');
								    } else {
								        echo JText::_('EB_TOTAL_AMOUNT');
								    }
								?>															            						            
						        </td>
								<td>
									<?php echo EventBookingHelper::formatCurrency($this->totalAmount, $this->config); ?>									
								</td>
							</tr>
							<?php
							if ($this->discount > 0 || $this->taxAmount > 0) {
							    if ($this->discount > 0) {
							    ?>
							  		<tr>
    									<td class="title_cell">
    										<?php echo JText::_('EB_DISCOUNT'); ?>
    									</td>
    									<td class="field_cell">
    										<?php					
    										    echo EventBookingHelper::formatCurrency($this->discount, $this->config) ;																																
    										?>				
    									</td>
    								</tr>  	
							    <?php							            
							    }
							    if ($this->taxAmount > 0) {
							    ?>
							    	<tr>
    									<td class="title_cell">
    										<?php echo JText::_('EB_TAX'); ?>
    									</td>
    									<td class="field_cell">
    										<?php					
    										    echo EventBookingHelper::formatCurrency($this->taxAmount, $this->config) ;																																
    										?>				
    									</td>
    								</tr>
							    <?php    
							    }
							?>									
								<tr>
									<td class="title_cell">
										<?php echo JText::_('EB_GRAND_TOTAL'); ?>
									</td>
									<td class="field_cell">
										<?php																					
										    echo EventBookingHelper::formatCurrency($this->amount + $this->taxAmount, $this->config) ;																
										?>				
									</td>
								</tr>	
							<?php	
							}							
							#Added support for deposit amount
            				if ($this->depositAmount > 0) {
            				?>
            					<tr>
            						<td class="title_cell">
            							<?php echo JText::_('EB_DEPOSIT_AMOUNT'); ?>
            						</td>
            						<td class="field_cell">
            							<?php							
            							    echo EventBookingHelper::formatCurrency($this->depositAmount, $this->config) ;														            													
            							?>				
            						</td>
            					</tr>
            				<?php
            					$amountDue = $this->totalAmount - $this->discount + $this->taxAmount - $this->depositAmount ;
            					if ($amountDue > 0) {
            					?>
            						<tr>
            							<td class="title_cell">
            								<?php echo JText::_('EB_AMOUNT_DUE'); ?>
            							</td>
            							<td class="field_cell">
            								<?php		
            								    echo EventBookingHelper::formatCurrency($amountDue, $this->config) ;																			            														
            								?>				
            							</td>
            						</tr>
            					<?php	
            					}			
            				}																	
							?>
							<tr>
								<td class="title_cell" valign="top">
									<?php echo JText::_('EB_PAYMENT_OPTION'); ?>							
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
									<?php echo $this->expMonth .'  /  '.$this->expYear ; ?>
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
							if ($method->getCardType()) {
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
							if ($method->getCardHolderName()) {
							?>
								<tr>
									<td class="title_cell">
										<?php echo JText::_('EB_CARD_HOLDER_NAME'); ?>
									</td>
									<td class="field_cell">
										<?php echo $this->cardHolderName ; ?>
									</td>
								</tr>
							<?php	
							}												
						}
					}																	
					if ($this->customFields) {
						echo $this->fields ;
					}			
					?>
				</table>
			</td>
		</tr>		
		<?php
			$rowMember = $this->rowMembers[0] ;
			if ($rowMember->first_name) {
			?>			
			<tr>
				<td class="eb_row_heading" colspan="2"><h4><?php echo JText::_('EB_MEMBERS_INFORMATION') ; ?></h4></td>
			</tr>
			<tr>
				<td class="eb_member_containers" colspan="2">
					<table width="100%" class="os_member_list">																		
						<?php			
							$jcField = new JCFields($this->event->id, false, 2) ;				
							for ($i = 0 , $n  = count($this->rowMembers); $i < $n; $i++) {								
								if ($i %2 == 0)
									echo "<tr>\n" ;
								$rowMember = $this->rowMembers[$i] ;
							?>
								<td>
									<table class="os_table" width="100%" cellspacing="3" cellpadding="3">
										<tr>
											<td colspan="2" class="eb_row_heading"><?php echo JText::sprintf('EB_MEMBER_INFORMATION', $i + 1) ; ?></td>
										</tr>
										<tr>
											<td class="title_cell">
												<?php echo JText::_('EB_FIRST_NAME'); ?>
											</td>
											<td>
												<?php echo $rowMember->first_name ; ?>
											</td>
										</tr>		
										<?php			
											if ($this->config->gs_lastname) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_LAST_NAME') ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->last_name ; ?>
													</td>
												</tr>
											<?php	
											}		
											if ($this->config->gs_organization) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_ORGANIZATION'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->organization ; ?>
													</td>
												</tr>
											<?php	
											}
											if ($this->config->gs_address) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_ADDRESS'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->address ; ?>
													</td>
												</tr>	
											<?php	
											}											
											if ($this->config->gs_address2) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_ADDRESS2'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->address2 ; ?>
													</td>
												</tr>	
											<?php	
											}			
											if ($this->config->gs_city) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_CITY'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->city ; ?>
													</td>
												</tr>		
											<?php	
											}			
											if ($this->config->gs_state) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_STATE'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->state ; ?>
													</td>
												</tr>
											<?php	
											}
											if ($this->config->gs_zip) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_ZIP'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->zip ; ?>
													</td>
												</tr>
											<?php	
											}
											
											if ($this->config->gs_country) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_COUNTRY'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->country ; ?>
													</td>
												</tr>	
											<?php	
											}			
											if ($this->config->gs_phone) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_PHONE'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->phone ; ?>
													</td>
												</tr>
											<?php
											}
											if ($this->config->gs_fax) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_FAX'); ?>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->fax ; ?>
													</td>
												</tr>
											<?php
											}	
											if ($this->config->gs_email) {
											?>
												<tr>			
													<td class="title_cell">
														<?php echo  JText::_('EB_EMAIL'); ?><span class="required">*</span>
													</td>
													<td class="field_cell">
														<?php echo $rowMember->email ; ?>
													</td>
												</tr>	
											<?php				
											}
											$jcField->renderGroupMemberConfirmation($rowMember->id);
											if ($this->config->gs_comment) {
											?>
												<tr>
													<td class="title_cell">
														<?php echo JText::_('EB_COMMENT') ; ?> 
													</td>
													<td>
														<?php echo $rowMember->comment ; ?>
													</td>
												</tr>
											<?php	
											}											
										?>																																					
									</table>
								</td>
							<?php	
								if (($i + 1) %2 == 0)
									echo "</tr>\n" ;	
							}				
	
							if ($i %2 != 0) {
								echo "<td>&nbsp;</td></tr>" ;
							}
						?>
					</table>
				</td>
			</tr>										
			<?php	
			}
		?>						
		<tr>
			<td>
				<table class="os_table" cellspacing="3" cellpadding="3">
					<?php					
						if ($this->config->s_comment) {
						?>
							<tr>			
								<td class="title_cell">
									<?php echo  JText::_('EB_COMMENT'); ?>
								</td>
								<td class="field_cell">
									<?php echo $this->comment ; ?>
								</td>
							</tr>	
						<?php	
						}
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
							$articleId  = $this->event->article_id ? $this->event->article_id : $this->config->article_id ;
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
									<?php echo JText::_('EB_ACCEPT'); ?>&nbsp;<a <?php echo $extra ; ?> title="<?php echo JText::_('EB_TERM_AND_CONDITION'); ?>" href="<?php echo JText::_($termLink); ?>"><strong><?php echo JText::_('EB_TERM_AND_CONDITION'); ?></strong></a>
								</td>
							</tr>
						<?php	
						}
					?>					
				</table>
			</td>
		</tr>											
		<tr>
			<td>
				<input type="button" class="button" name="btnBack" value="<?php echo  JText::_('EB_BACK') ;?>" onclick="billingPage();" />
				<input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_PROCESS_REGISTRATION') ;?>" onclick="checkData();" />				
			</td>
		</tr>										
	</table>						
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="event_id" value="<?php echo $this->event->id ; ?>" />	
	<input type="hidden" name="group_id" value="<?php echo $this->groupId; ?>" />
	<input type="hidden" name="total_amount" value="<?php echo $this->totalAmount; ?>" />
	<input type="hidden" name="discount_amount" value="<?php echo $this->discount ; ?>" />
	<input type="hidden" name="deposit_amount" value="<?php echo $this->depositAmount; ?>" />	
	<input type="hidden" name="tax_amount" value="<?php echo $this->taxAmount; ?>" />
	<input type="hidden" name="amount" value="<?php echo $this->amount ; ?>" />	
	<input type="hidden" name="task" value="process_group_registration" />
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="payment_method" value="<?php echo $this->paymentMethod ; ?>" />
	
	<!-- Hidden field for billing information -->
	<input type="hidden" name="username" value="<?php echo $this->username; ?>" />
	<input type="hidden" name="password" value="<?php echo $this->password; ?>" />	
	<input type="hidden" name="first_name" value="<?php echo $this->firstName ; ?>" />
	<input type="hidden" name="last_name" value="<?php echo $this->lastName ; ?>" />
	<input type="hidden" name="address" value="<?php echo $this->address ; ?>" />
	<input type="hidden" name="address2" value="<?php echo $this->address2 ; ?>" />
	<input type="hidden" name="city" value="<?php echo $this->city ; ?>" />
	<input type="hidden" name="state" value="<?php echo $this->state ; ?>" />
	<input type="hidden" name="zip" value="<?php echo $this->zip ; ?>" />
	<input type="hidden" name="country" value="<?php echo $this->country ; ?>" />
	<input type="hidden" name="phone" value="<?php echo $this->phone ; ?>" />
	<input type="hidden" name="fax" value="<?php echo $this->fax ; ?>" />
	<input type="hidden" name="email" value="<?php echo $this->email ; ?>" />
	<input type="hidden" name="x_card_num" value="<?php echo $this->x_card_num ; ?>" />
	<input type="hidden" name="x_card_code" value="<?php echo $this->x_card_code ; ?>" />	
	<input type="hidden" name="exp_month" value="<?php echo $this->expMonth ; ?>" />
	<input type="hidden" name="exp_year" value="<?php echo $this->expYear ; ?>" />
	<input type="hidden" name="card_holder_name" value="<?php echo $this->cardHolderName ; ?>" />
	<input type="hidden" name="organization" value="<?php echo $this->organization ; ?>" />
	<input type="hidden" name="comment" value="<?php echo $this->comment ; ?>" />
	<input type="hidden" name="card_type" value="<?php echo $this->cardType ; ?>" />
	<input type="hidden" name="coupon_code" value="<?php echo $this->couponCode; ?>" />	
	<input type="hidden" name="bank_id" value="<?php echo $this->bankId ; ?>" />	
	<input type="hidden" name="payment_type" value="<?php echo $this->paymentType ; ?>" />
		
	<!-- Hidden for custom fields -->
	<?php
		if ($this->customFields) {
			echo $this->hidden ;
		}
	?>						
	<script language="javascript">
		function billingPage() {
			var form = document.adminForm ;
			form.task.value = 'group_billing';
			form.submit();
		}
		/*Check term and condition**/		
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
	<?php echo JHTML::_( 'form.token' ); ?>
</form>