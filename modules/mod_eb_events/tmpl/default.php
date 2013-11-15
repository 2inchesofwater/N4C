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
		<table class="TEST eb_event_list" width="100%">
			<?php
				$tabs = array('sectiontableentry1' , 'sectiontableentry2');
				$k = 0 ;
				foreach ($rows as  $row) {
					$tab = $tabs[$k] ;
					$k = 1 - $k ; 
				?>	
					<tr class="<?php echo $tab; ?>">
						<td class="eb_event">
							<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_event&event_id='.$row->id.'&Itemid='.$itemId); ?>" class="eb_event_link"><?php echo $row->title ; ?></a>
							<br />
							<span class="event_date"><?php echo JHTML::_('date', $row->event_date, $config->event_date_format, $format); ?></span>
							<?php
								if ($showCategory) {
								?>
									<br />		
									<span><?php echo JText::_('EB_CATEGORY'); ?>:&nbsp;&nbsp;<?php echo $row->categories ; ?></span>	
								<?php	
								}
								if ($showLocation && strlen($row->location_name)) {
								?>
									<br />		
									<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&task=view_map&location_id='.$row->location_id); ?>&tmpl=component&format=html" rel="gb_page_center[500,450]" title="<?php echo $row->location_name ; ?>" class="location_link"><?php echo $row->location_name ; ?></a>
								<?php	 
								}
							?>											
						</td>
					</tr>
				<?php
				}
			?>
		</table>
	<?php	
	} else {
	?>
		<div class="eb_empty"><?php echo JText::_('EB_NO_EVENTS') ?></div>
	<?php	
	}
?>