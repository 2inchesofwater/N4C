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

$headerText = JText::_('EB_GROUP_REGISTRATION_BILLING') ;
?>
<section class="blockContainer page" id="registration">

<?php if ($this->config->fix_next_button) {
?>
	<form method="post" name="adminForm" id="adminForm" class="vertical" action="<?php echo $this->url; ?>index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>" autocomplete="off">	
<?php	 
} else {
?>
	<form method="post" name="adminForm" id="adminForm" class="vertical" action="<?php echo $this->url; ?>index.php" autocomplete="off">
<?php }	?>

	<h2 class="eb_title"><?php echo $headerText; ?></h2>	

<?php
$msg = $this->config->registration_form_message ;			
if (strlen($msg)) {
	$msg = str_replace('[EVENT_TITLE]', $this->event->title, $msg) ;
	$msg = str_replace('[EVENT_DATE]', JHTML::_('date', $this->event->event_date, $this->config->event_date_format, $param), $msg) ;
	$msg = str_replace('[AMOUNT]', EventBookingHelper::formatCurrency($this->event->individual_price, $this->config), $msg) ;			
?>								
	<div class="msg"><?php echo $msg ; ?></div>							 															
<?php } ?>		


	<?php if ($this->enableCoupon) { ?>
<div class="coupon">
		<label for="coupon"><?php echo  JText::_('EB_COUPON') ?><?php if ($this->errorCoupon) { ?><span class="invalid"><?php echo JText::_('EB_INVALID_COUPON'); ?></span><?php } ?></label>
        <input type="text" class="inputbox" name="coupon_code" value="<?php echo $this->couponCode; ?>" id="coupon" placeholder="<?php echo  JText::_('EB_COUPON') ?>" />
</div>
	<?php } ?>

	<?php if (!$this->userId && $this->config->user_registration) { ?>				
<div class="account">
		<label for="username">
			<?php echo  JText::_('EB_USERNAME') ?><?php if ($this->registrationErrorCode == 1 || $this->registrationErrorCode == 3) { ?><span class="invalid"><?php echo JText::_('EB_INVALID_USERNAME'); ?></span><?php } ?>
        </label>
        <input type="text" name="username" id="username" class="inputbox" value="<?php echo $this->username; ?>" placeholder="<?php echo  JText::_('EB_USERNAME') ?>" />

		<label for="password"><?php echo  JText::_('EB_PASSWORD') ?></label>
		<input type="password" name="password" id="password" class="inputbox" placeholder="<?php echo  JText::_('EB_PASSWORD') ?>" value="<?php echo $this->password; ?>" />

		<label for="password2"><?php echo  JText::_('EB_RETYPE_PASSWORD') ?></label>	
		<input type="password" name="password2" id="password2" class="inputbox" placeholder="<?php echo  JText::_('EB_RETYPE_PASSWORD') ?>" value="<?php echo $this->password ; ?>" />
</div>
	<?php } ?>

<div class="personal">
	<div class="left half-width">
		<label for="first_name"><?php echo  JText::_('EB_FIRST_NAME') ?><span class="required">*</span></label>
        <input type="text" class="inputbox" name="first_name" id="first_name" placeholder="<?php echo  JText::_('EB_FIRST_NAME') ?>" value="<?php echo $this->firstName; ?>" required="required" />
	</div>

	<div class="left half-width-margin">
		<label for="last_name"><?php echo  JText::_('EB_LAST_NAME') ?><?php if ($this->config->r_lastname) echo '<span class="required">*</span>'; ?></label>
		<input type="text" class="inputbox" name="last_name" id="last_name" placeholder="<?php echo  JText::_('EB_LAST_NAME') ?>" value="<?php echo $this->lastName; ?>" <?php if ($this->config->r_lastname) echo "required='required'"; ?> />
    </div>

	<div class="left full-width">
		<?php if ($this->config->s_organization) { ?>
		<label for="organization"><?php echo  JText::_('EB_ORGANIZATION'); ?><?php if ($this->config->r_organization) echo '<span class="required">*</span>'; ?></label>
		<input type="text" class="inputbox" name="organization" id="organization" placeholder="<?php echo  JText::_('EB_ORGANIZATION'); ?>" value="<?php echo $this->organization; ?>" <?php if ($this->config->r_organization) echo "required='required'"; ?> />
		<?php } ?>
	</div>

	<div class="left full-width">
		<?php if ($this->config->s_address) { ?>
			<label for="address"><?php echo  JText::_('EB_ADDRESS'); ?><?php if ($this->config->r_address) echo '<span class="required">*</span>'; ?></label>
            <input type="text" class="inputbox" name="address" id="address" placeholder="<?php echo  JText::_('EB_ADDRESS'); ?>" value="<?php echo $this->address; ?>" <?php if ($this->config->r_address) echo "required='required'"; ?> />
		<?php } ?>
	</div>

	<div class="left full-width">   
        <?php if ($this->config->s_address2) { ?>
			<label for="address2"><?php echo  JText::_('EB_ADDRESS2'); ?><?php if ($this->config->r_address2) echo '<span class="required">*</span>'; ?></label>
            <input type="text" class="inputbox" name="address2" id="address2" placeholder="<?php echo  JText::_('EB_ADDRESS2'); ?>" value="<?php echo $this->address2; ?>" <?php if ($this->config->r_address2) echo "required='required'"; ?> />
		<?php } ?>
	</div>
    
	<div class="left half-width">
        <?php if ($this->config->s_city) { ?>
			<label for="city"><?php echo JText::_('EB_CITY'); ?><?php if ($this->config->r_city) echo '<span class="required">*</span>'; ?></label>
            <input type="text" class="inputbox" name="city" id="city" placeholder="<?php echo JText::_('EB_CITY'); ?>" value="<?php echo $this->city; ?>" <?php if ($this->config->r_city) echo "required='required'"; ?> />
		<?php } ?>
	</div>
    
    <?php if ($this->config->s_state) { ?>
		<div class="left quarter-width">
		<?php if ($this->config->display_state_dropdown) { ?>
				<label for="state"><?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->r_state) echo '<span class="required">*</span>'; ?></label>
                <?php echo $this->lists['state'] ; ?>
		<?php } else { ?>
				<label for="state"><?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->r_state) echo '<span class="required">*</span>'; ?></label>
                <input type="text" class="inputbox" name="state" id="state" placeholder="<?php echo  JText::_('EB_STATE'); ?>" value="<?php echo $this->state; ?>" <?php if ($this->config->r_state) echo "required='required'"; ?> />
		<?php }	?>
		</div>
    <?php } ?>
    
	<?php if ($this->config->s_zip) { ?>
    <div class="left quarter-width">
        <label for="zip"><?php echo  JText::_('EB_ZIP'); ?><?php if ($this->config->r_zip) echo '<span class="required">*</span>'; ?></label>
        <input type="text" class="inputbox" name="zip" id="zip" placeholder="<?php echo  JText::_('EB_ZIP'); ?>" value="<?php echo $this->zip; ?>" <?php if ($this->config->r_zip) echo "required='required'"; ?> />
    </div>
    <?php } ?>

	<div class="left full-width">
	<?php if ($this->config->s_country) { ?>
        <label><?php echo  JText::_('EB_COUNTRY'); ?><?php if ($this->config->r_country) echo '<span class="required">*</span>'; ?></label>
        <?php echo $this->lists['country_list']; ?>
    <?php } ?>
	</div>

	<div class="left full-width">
	<?php if ($this->config->s_phone) { ?>
        <label for="phone"><?php echo  JText::_('EB_PHONE'); ?><?php if ($this->config->r_phone) echo '<span class="required">*</span>'; ?></label>
        <input type="text" class="inputbox" name="phone" id="phone" placeholder="<?php echo  JText::_('EB_PHONE'); ?>" value="<?php echo $this->phone; ?>" <?php if ($this->config->r_phone) echo "required='required'"; ?> />
    <?php } ?>
	</div>

	<div class="left full-width">
	<?php if ($this->config->s_fax) { ?>
        <label for="fax"><?php echo  JText::_('EB_FAX'); ?><?php if ($this->config->r_fax) echo '<span class="required">*</span>'; ?></label>
        <input type="text" class="inputbox" name="fax" id="fax" placeholder="<?php echo  JText::_('EB_FAX'); ?>" value="<?php echo $this->fax; ?>" <?php if ($this->config->r_fax) echo "required='required'"; ?> />
    <?php } ?>																		
	</div>

	<div class="left full-width">
	<label><?php echo  JText::_('EB_EMAIL'); ?><span class="required">*</span><?php if ($this->registrationErrorCode == 2) { ?><span class="invalid"><?php echo JText::_('EB_EMAIL_USED'); ?></span><?php } ?></label>
    <input type="text" class="inputbox" name="email" id="email" placeholder="<?php echo  JText::_('EB_EMAIL'); ?>" value="<?php echo $this->email; ?>" required='required' />

	<?php if ($this->customField) { echo $this->fields ; }	?>
	</div>
</div>

<?php if (($this->amount > 0) || $this->numberFeeFields) {	?>
	<div class="payment">    
	
	<?php if ($this->depositPayment) { ?>			    	
    	<label><?php echo JText::_('EB_PAYMENT_TYPE') ; ?></label>
        <?php echo $this->lists['payment_type'] ; ?>
	<?php }	?>
    
    <?php if (count($this->methods) > 1) { ?>
		<label for="payment_method"><?php echo JText::_('EB_PAYMENT_OPTION'); ?><span class="required">*</span></label>
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
        <?php }	?>
	<?php } else { ?>
		<?php $method = $this->methods[0] ; ?>
			<label class="visible"><?php echo JText::_('EB_PAYMENT_OPTION'); ?></label>
			<?php echo JText::_($method->getTitle()); ?>
	<?php }	?>
        
    <?php    																	
		if ($method->getCreditCard()) {
			$style = '' ;	
		} else {
			$style = 'style = "display:none"';
		} ?>			
		<label for="card_holder_name"><?php echo JText::_('EB_CARD_HOLDER_NAME'); ?><span class="required">*</span></label>
        <input type="text" name="card_holder_name" id="card_holder_name" class="inputbox" placeholder="<?php echo JText::_('EB_CARD_HOLDER_NAME'); ?>" value="<?php echo $this->cardHolderName; ?>" required='required' />

		<label for="x_card_num"><?php echo  JText::_('AUTH_CARD_NUMBER'); ?><span class="required">*</span></label>
		<input type="text" name="x_card_num" id="x_card_num" class="inputbox" placeholder="<?php echo  JText::_('AUTH_CARD_NUMBER'); ?>" onkeyup="checkNumber(this)" value="<?php echo $this->x_card_num; ?>" required='required' />

		<div class="left half-width">
		<label class="visible"><?php echo JText::_('AUTH_CARD_EXPIRY_DATE'); ?><span class="required">*</span></label>
		<?php echo $this->lists['exp_month'] .'  /  '.$this->lists['exp_year'] ; ?>
		</div>
        
        <div class="left half-width">
		<label for="x_card_code"><?php echo JText::_('AUTH_CVV_CODE'); ?><span class="required">*</span></label>
		<input type="text" name="x_card_code" id="x_card_code" class="inputbox" placeholder="<?php echo JText::_('AUTH_CVV_CODE'); ?>" onKeyUp="checkNumber(this)" value="<?php echo $this->x_card_code; ?>" required="required" />
        </div>

	<?php
        if ($method->getCardType()) {
            $style = '' ;
        } else {
            $style = ' style = "display:none;" ' ;										
        } ?>
		<label class="visible"><?php echo JText::_('EB_CARD_TYPE'); ?><span class="required">*</span></label>
		<?php echo $this->lists['card_type'] ; ?>


	<?php
        if ($method->getName() == 'os_ideal') {
            $style = '' ;
        } else {
            $style = ' style = "display:none;" ' ;
        } ?>
		<label class="visible"><?php echo JText::_('EB_BANK_LIST'); ?><span class="required">*</span></label>
        <?php echo $this->lists['bank_id'] ; ?>
<?php } ?>
</div>		
        	
<div class="comment">
<?php if ($this->config->s_comment) { ?>
		<label for="comment"><?php echo  JText::_('EB_COMMENT'); ?><?php if ($this->config->r_comment) echo '<span class="required">*</span>'; ?></label>
		<textarea rows="7" cols="50" name="comment" id="comment" class="inputbox"><?php echo $this->comment;?></textarea>
<?php }	?>									
</div>

<div class="action">
			<input type="button" class="button right secondary" name="btnBack" value="<?php echo  JText::_('EB_BACK') ;?>" onclick="window.history.go(-1);">
			<input type="button" class="button left primary" name="btnSubmit" value="<?php echo  JText::_('EB_REGISTRATION_CONFIRMATION') ;?>" onclick="checkData();">				
</div>




	<?php
		if (count($this->methods) == 1) {
		?>
			<input type="hidden" name="payment_method" value="<?php echo $this->methods[0]->getName(); ?>" />
		<?php	
		}		
	?>
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="event_id" value="<?php echo $this->event->id ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="group_id" value="<?php echo $this->groupId; ?>" />	
	<input type="hidden" name="task" value="group_confirmation" />			
	<script language="javascript">
		<?php
			os_payments::writeJavascriptObjects();
			if ($this->config->display_state_dropdown) {
				echo $this->countryIdsString ;
				echo $this->countryNamesString ;
				echo $this->stateString ;
			}
		?>
		function checkData() {
			var form = document.adminForm ;
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
	</script>
	<?php echo JHTML::_( 'form.token' ); ?>	
</form>
</section>