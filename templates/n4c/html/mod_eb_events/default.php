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
<div class="floating_panel related_panel events" id="<?php echo $module->title; ?>">
<h2><a href="<?php echo JRoute::_('index.php?option=com_eventbooking&view=category&layout=table'); ?>" title="See all <?php echo $module->title; ?>">
<?php echo $module->title; ?></a></h2>

<ul class="unstyled">
  <?php
				$tabs = array('sectiontableentry1' , 'sectiontableentry2');
				$k = 0 ;
				foreach ($rows as  $row) {
					$tab = $tabs[$k] ;
					$k = 1 - $k ; 
				?>
  <li class="component_list">
    <h3><a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$row->id.'&Itemid='.$itemId); ?>" class=""><?php echo $row->title ; ?></a></h3>
      <dl class="datetime">
      	<dd class="date"><?php echo date("D j F", strtotime($row->event_date)); ?></dd>
        <dt class="time"><?php echo date("g:ia", strtotime($row->event_date)); ?></dt>
      </dl>
      <p class="location"><?php echo $row->location_name ; ?></p>
      <div class="description"><?php echo $row->short_description; ?></div>
      <a class="readmore" href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$row->id.'&Itemid='.$itemId); ?>">More info + RSVP</a>
    </li>
  <?php
	}
  ?>
</ul>
<a class="seeall" href="<?php echo JRoute::_('index.php?option=com_eventbooking&view=category&layout=table'); ?>">See all Events</a>
</div>

<?php } else { ?>

    <div class="eb_empty accordion">
        <h2><a href="<?php echo JRoute::_('index.php?option=com_eventbooking'); ?>" title="See all <?php echo $module->title; ?>">
            <?php echo $module->title; ?>
        </a></h2>
        <?php echo JText::_('EB_NO_EVENTS') ?>
    </div>

<?php } ?>
