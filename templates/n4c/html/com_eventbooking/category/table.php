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

<section class="blockContainer component_group" id="intro_<?php echo $this->category->name;?>">
  <?php if($this->category->description != '') { ?>
      <h2 class="eb_title"><?php echo $this->category->name;?></h2>
      <div class="eb_description"><?php echo $this->category->description;?></div>
      </section>
      <section class="blockContainer component_group" id="<?php echo $this->category->name;?>">
  <?php } else { ?>
    <h2 class="eb_title"><?php echo $this->category->name;?></h2>
  <?php } ?>

    <ul>
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
      <li class="component_list">
        <h3><a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id); ?>" class="eb_event_link"><?php echo $item->title ; ?></a></h3>
        <div class="pin"> <img src="./images/pins/pin-yellow.png"/> </div>
        <div class="details">
          <p class="location"><?php echo $item->location_name ; ?></p>
          <?php echo $item->short_description; ?> </div>
        <div class="datetime">
          <p class="date"><?php echo date("D j F", strtotime($item->event_date)); ?></p>
          <p class="time"><?php echo date("g:ia", strtotime($item->event_date)); ?></p>
        </div>
        <div class="readmore"> <a class="button" href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$item->id); ?>">More info + RSVP</a> </div>
      </li>
      <?php } } ?>

    </ul>

    <?php if ($this->pagination->total > $this->pagination->limit) { ?>
    <div align="center" class="pagination"><?php echo $this->pagination->getListFooter(); ?></div>
    <?php } ?>
  </section>
  <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
  <input type="hidden" name="option" value="com_eventbooking" />
  <input type="hidden" name="view" value="category" />
  <input type="hidden" name="layout" value="table" />
  <input type="hidden" name="category_id" value="<?php echo $this->category->id; ?>" />
  </form>
