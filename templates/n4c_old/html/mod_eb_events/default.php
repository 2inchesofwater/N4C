<?php	
	defined('_JEXEC') or die ();	
	if (version_compare(JVERSION, '1.6.0', 'ge')) {
	    $format = null ;
	} else {
	    $format = 0 ;
	}
	if ($showLocation) {
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
	}
	if (count($rows)) {
	?>
<section class="blockContainer component_group" id="<?php echo $module->title; ?>">
<article>
<a href="#" title="See all <?php echo $module->title; ?>">
<h2><?php echo $module->title; ?></h2>
</a>
<ul class="">
  <?php
				$tabs = array('sectiontableentry1' , 'sectiontableentry2');
				$k = 0 ;
				foreach ($rows as  $row) {
					$tab = $tabs[$k] ;
					$k = 1 - $k ; 
				?>
  <li class="component_list">
    <h3><a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$row->id.'&Itemid='.$itemId); ?>" class="eb_event_link"><?php echo $row->title ; ?></a></h3>
    <div class="pin"> <img src="./images/pins/pin-yellow.png"/> </div>
    <div class="details">
      <p class="location"><?php echo $row->location_name ; ?></p>
      <?php echo $row->short_description; ?> </div>
    <div class="datetime"><p class="date"><?php echo date("D j F", strtotime($row->event_date)); ?></p><p class="time"><?php echo date("g:ia", strtotime($row->event_date)); ?></p> </div>
    <div class="readmore">
    <a class="button" href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$row->id.'&Itemid='.$itemId); ?>">More info + RSVP</a>
    </div>
    </li>
  <?php
	}
  ?>
</ul>
</article>
<a class="component_followOn" href="#">See all Events</a>
</section>
<?php	
	} else {
	?>
<div class="eb_empty"><?php echo JText::_('EB_NO_EVENTS') ?></div>
<?php	
	}
?>
