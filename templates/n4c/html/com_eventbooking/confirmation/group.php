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
?>

<section class="blockContainer page" id="registration">

	<?php if ($this->config->fix_next_button) { ?>
		<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>">	
	<?php } else { ?>
		<form method="post" name="adminForm" id="adminForm" action="<?php echo $this->url; ?>index.php">
	<?php } ?>
    
    	<h2 class="eb_title"><?php echo $headingText ; ?></h2>	

<?php if ($this->config->confirmation_message) {
		$msg = $this->config->confirmation_message ;
		$msg = str_replace('[EVENT_TITLE]', $this->event->title, $msg) ;
		$msg = str_replace('[EVENT_DATE]', JHTML::_('date', $this->event->event_date, $this->config->event_date_format, $param), $msg) ; ?>
		<p class="info"><?php echo $msg;?></p>
	<?php } ?>	
    
		<?php if ($this->username) { echo $this->username ;  } ?>
		<?php if ($this->password) { echo str_pad('', strlen($this->password), '*', STR_PAD_LEFT); } ?>
		<?php echo $this->firstName ; ?>
		<?php if ($this->config->s_lastname) {  echo $this->lastName ; } ?>
		<?php if ($this->config->s_organization) {  echo $this->organization ; } ?>
		<?php if ($this->config->s_address) { echo $this->address ; } ?>
		<?php if ($this->config->s_address2) { echo $this->address2 ; } ?>
		<?php if ($this->config->s_city) { echo $this->city ; } ?>
		<?php if ($this->config->s_state) { echo $this->state; } ?>
		<?php if ($this->config->s_zip) { echo $this->zip ; } ?>
		<?php if ($this->config->s_country) { echo $this->country ; } ?>
		<?php if ($this->config->s_phone) { echo $this->phone ; } ?>
		<?php if ($this->config->s_fax) { echo $this->fax; } ?>
		<?php echo $this->email ; ?>
		<?php if ($this->customField) { echo $this->fields ; }?>
        <?php echo JText::_('Number registrants'); echo count($this->rowMembers);?>


<?php if ($this->amount > 0) {
			//add a <p> tag here
		if ($this->taxAmount > 0) { 
			echo JText::_('EB_BASE_PRICE');
		 } else {
			echo JText::_('EB_TOTAL_AMOUNT');
		}

		if ($this->feeAmount > 0) {
			echo JText::sprintf('EB_TOTAL_AMOUNT_INCLUDE_FEE', EventBookingHelper::formatCurrency($this->totalAmount, $this->config), EventBookingHelper::formatCurrency($this->feeAmount, $this->config));
		} else {								    				      
		   echo EventBookingHelper::formatCurrency($this->totalAmount, $this->config) ;    							
		} //close </p> here
			
		 if ($this->discount > 0) {
			echo JText::_('EB_DISCOUNT'); 
			echo EventBookingHelper::formatCurrency($this->discount, $this->config) ; 
		} 
		
		if ($this->taxAmount > 0) {
			echo JText::_('EB_TAX');
			echo EventBookingHelper::formatCurrency($this->taxAmount, $this->config) ;
		} 
		 
		echo JText::_('EB_GRAND_TOTAL'); echo EventBookingHelper::formatCurrency($this->amount + $this->taxAmount, $this->config) ;      

		if ($this->depositAmount > 0) {
			echo JText::_('EB_DEPOSIT_AMOUNT');
			echo EventBookingHelper::formatCurrency($this->depositAmount, $this->config) ;
			
			$amountDue = $this->totalAmount - $this->discount - $this->depositAmount + $this->taxAmount ;
			if ($amountDue > 0) {  
				echo JText::_('EB_AMOUNT_DUE'); 
				echo EventBookingHelper::formatCurrency($amountDue, $this->config) ;
			} 		
		}
		
		echo JText::_('EB_PAYMENT_OPTION') ; 
		$method = os_payments::loadPaymentMethod($this->paymentMethod);
		if ($method) { echo JText::_($method->title); }
			
		if ($method->getCardHolderName()) {
			echo JText::_('EB_CARD_HOLDER_NAME');
			echo $this->cardHolderName;
		}
				
		$method = $this->method ;							
		if ($method->getCreditCard()) { 
			echo  JText::_('AUTH_CARD_NUMBER');
			$len = strlen($this->x_card_num) ;
			$remaining =  substr($this->x_card_num, $len - 4 , 4) ;
			echo str_pad($remaining, $len, '*', STR_PAD_LEFT) ;
			
			echo JText::_('AUTH_CARD_EXPIRY_DATE');
			echo $this->expMonth .'/'.$this->expYear ; 
			
			echo JText::_('AUTH_CVV_CODE');
			echo $this->x_card_code ;
			
			if ($method->getCardType()){
				echo JText::_('EB_CARD_TYPE');
				echo $this->cardType ;
			}
		}
 } ?>


				
<?php if ($this->config->s_comment) { echo  JText::_('EB_COMMENT'); echo $this->comment; }; ?>

	<?php if ($this->showCaptcha) {
        echo JText::_('EB_CAPTCHA'); ?><span class="required">*</span>
            <input type="text" class="inputbox" value="" size="8" name="security_code" />
        <img src="<?php echo JRoute::_('index.php?option=com_eventbooking&task=show_captcha_image'); ?>" title="<?php echo JText::_('EB_CAPTCHA_GUIDE'); ?>" align="middle" id="captcha_image" />
        <a href="javascript:reloadCaptcha();"><strong><?php echo JText::_('EB_RELOAD'); ?></strong></a>
        <?php  if ($this->captchaInvalid) { ?>
          <span class="error"><?php echo JText::_('EB_INVALID_CAPTCHA_ENTERED'); ?></span>
        <?php }
    } ?>

	<?php	
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
        <input type="checkbox" name="accept_term" value="1" class="inputbox" />
        <?php echo JText::_('EB_ACCEPT'); ?>&nbsp;<a <?php echo $extra ; ?> title="<?php echo JText::_('EB_TERM_AND_CONDITION'); ?>" href="<?php echo JRoute::_($termLink); ?>"><strong><?php echo JText::_('EB_TERM_AND_CONDITION'); ?></strong></a>
	<?php } ?>							



    <input type="button" class="button" name="btnBack" value="<?php echo  JText::_('EB_BACK') ;?>" onclick="billingPage();" />
    <input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_PROCESS_REGISTRATION') ;?>" onclick="checkData()" />


					
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
</section>