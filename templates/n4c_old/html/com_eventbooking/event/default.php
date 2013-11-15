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

<section class="blockContainer component_event" id="component_event">
<form method="post" name="adminForm" id="adminForm" action="index.php">
<h2><?php echo $item->title; ?></h2>
<?php
   if ($item->event_date == EB_TBC_DATE) {
	   echo JText::_('EB_TBC');
   } else { ?>
	  <div class='datetime'><p class='date'><?php echo date("D j F", strtotime($item->event_date)); ?></p><p class="time"><?php echo date("g:ia", strtotime($item->event_date)); ?></p>
		  <?php if ($item->event_end_date > $item->event_date ) { ?>
		  	<h4><?php echo JText::_('EB_EVENT_END_DATE'); ?></h4>
			<?php if ($item->event_end_date != $item->event_date) { ?>
            <p class='date'><?php echo date("D j F", strtotime($item->event_end_date)); ?></p>
				<?php if (date("g:ia", strtotime($item->event_end_date)) != date("g:ia", strtotime($item->event_date))) { ?>
                    <p class="time"><?php echo date("g:ia", strtotime($item->event_end_date)); ?></p>
          <?php } } } ?>
      </div>
<?php }  ?>

<div class="details">
<p class="location"><?php echo $this->location->name ; ?></p>
<?php echo $item->description ; ?>	
</div>

<div class="extraDetails">
<ul>
	<?php if ($item->individual_price > 0) { ?>
        <li><p class="slug"><?php echo JText::_('EB_INDIVIDUAL_PRICE'); ?></p>
        <p class="price value"><?php echo EventBookingHelper::formatCurrency($item->individual_price, $this->config) ; ?></p></li>
    <?php } ?>
    <?php if ($this->config->show_discounted_price && ($item->individual_price != $item->discounted_price)) { ?>
         <li><p class="slug"><?php echo JText::_('EB_ORIGINAL_PRICE'); ?></p>
         <p class="price value"><?php EventBookingHelper::formatCurrency($item->individual_price, $this->config) ; ?></p></li>
    <?php } ?>
    <?php if ($item->discounted_price > 0) { ?>
        <li><p class="slug"><?php echo JText::_('EB_DISCOUNTED_PRICE'); ?></p>
        <p class="price value"><?php echo EventBookingHelper::formatCurrency($item->discounted_price, $this->config) ; ?></p></li>
    <?php } ?>
    
	<?php if ($item->event_capacity > 0) { ?>
	<li><p class="slug"><?php echo JText::_('EB_CAPACITY'); ?></p>
	<p class="value"><?php if ($item->event_capacity)
				echo $item->event_capacity ;
			else
				echo JText::_('EB_UNLIMITED') ;
		?></p></li>
		<?php if ($item->event_capacity - $item->total_registrants) { ?>
            <li><p class="slug"><?php echo JText::_('EB_AVAILABLE_PLACE'); ?></p>
            <p class="value"><?php echo $item->event_capacity - $item->total_registrants ; ?></p></li>
        <?php } ?>
     <?php } ?> <!-- end if capacity -->  
	 <?php if (date("D j F", strtotime($item->cut_off_date)) > date("D j F", strtotime($item->event_date))) { ?>
         <li><p class="slug"><?php echo JText::_('EB_CUT_OFF_DATE'); ?></p>
         <p class="value"><?php echo date("D j F", strtotime($item->cut_off_date)); ?></p></li>
     <?php } ?>
     
     <?php if ($this->config->event_custom_field) {
		foreach ($this->params as $param) {							 							 	
			if (strlen($param[4])) { ?>
            	<li><p class="slug"><?php echo $param[3]; ?></p>
                <p class="value"><?php echo $param[4] ; ?></p></li>
	<?php } } } ?>
</ul>
</div>
<?php if (date("D j F", strtotime($item->cut_off_date)) > date("D j F")) { ?>

<?php
	if ($canRegister || $waitingList) {
		if ($item->registration_type == 0 || $item->registration_type == 1) { ?>
				<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=individual_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl); ?>" class="button primary left"><?php echo JText::_('EB_REGISTER_INDIVIDUAL'); ?></a>
                <?php if ($this->config->multiple_booking) { ?>
                <a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=add_to_cart&id='.$item->id.'&Itemid='.$this->Itemid, false); ?>"><?php echo JText::_('EB_REGISTER'); ?></a>
                <?php } ?>
			<?php	
			}					    
			//Disable group registration when multiple booking is enabled	
			if (($item->registration_type == 0 || $item->registration_type == 2) && !$this->config->multiple_booking) { ?>
					<a href="<?php echo $waitingList ? $waitinglistUrl : JRoute::_('index.php?option=com_eventbooking&task=group_registration&event_id='.$item->id.'&Itemid='.$this->Itemid, false, $ssl) ; ?>" class="button secondary right"><?php echo JText::_('EB_REGISTER_GROUP'); ?></a>
			<?php	
			}
	}
	if ($this->config->show_invite_friend) { ?>
		<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=invite_form&id='.$item->id.'&Itemid='.$this->Itemid.'&tmpl=component', false) ; ?>" class="button secondary right"><?php echo JText::_('EB_INVITE_FRIEND'); ?></a>
<?php } }?>
	
	
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="task" value="" />
			
</form>
</section>