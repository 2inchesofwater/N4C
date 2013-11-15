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
    $j15 = false ;
    $param = null ;
    $timeFormat = $this->config->event_time_format ? $this->config->event_time_format : 'g:i a' ;    
} else {
    $j15 = true ;
    $param = 0 ;
    $timeFormat = $this->config->event_time_format ? $this->config->event_time_format : '%I:%M %p' ;
}
if (!$j15) {
?>
	<h1 class="eb_title"><?php echo JText::_('EB_CALENDAR') ; ?></h1>
<?php    
} else {
?>
	<div class="componentheading"><?php echo JText::_('EB_CALENDAR') ; ?></div>
<?php    
}
?>
<div id="extcalendar">
<div style="width: 100%;" class="topmenu_calendar">	
	<div class="left_calendar">
		<table>
			<tr>
				<td>
					<strong><?php echo JText::_('EB_CHOOSE_DATE'); ?>:</strong>
					<?php echo JHTML::_('calendar', JRequest::getVar('day', ''),'date', 'date', '%Y-%m-%d'); ?>
					<input type="button" class="button" value="<?php echo JText::_('Go'); ?>" onclick="gotoDate();" />
				</td>					
			</tr>
		</table>
	</div>
    <?php
    if ($this->showCalendarMenu) {
    ?>  		
        <ul class="menu_calendar">
        	<li>
    			<?php 
                    $month = date('m',time());
                    $year = date('Y',time());
                ?>
                <a class="calendar_link" href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&month=<?php echo $month;?>&year=<?php echo $year; ?>&Itemid=<?php echo $this->Itemid; ?>">
                    <?php echo JText::_('EB_MONTHLY_VIEW')?>
                </a>
            </li>
            <?php
                if ($this->config->activate_weekly_calendar_view) {
                ?> 
              		<li>
                        <?php $day = 0; $week_number = date('W',time()); $date = date('Y-m-d', strtotime($year."W".$week_number.$day));?>
                        <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=weekly&date=<?php echo $date;?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link">
                            <?php echo JText::_('EB_WEEKLY_VIEW')?>
                        </a>
                    </li>  	
                <?php   
                }
                if ($this->config->activate_daily_calendar_view) {
                ?>
                	<li>
                        <?php $day = date('Y-m-d',time())?>
                        <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=daily&day=<?php echo $day;?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link active">
                            <?php echo JText::_('EB_DAILY_VIEW')?>
                        </a>
                    </li>
                <?php    
                }
            ?>                                
        </ul>        
        <?php    
        }
    ?>
</div>
<div class="wraptable_calendar">
<table cellpadding="0" cellspacing="0" border="0" width="100%">	        
    <tr class="tablec">
        <td class="previousday">
            <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=daily&day=<?php echo date('Y-m-d',strtotime("-1 day", strtotime($this->day)));?>&Itemid=<?php echo $this->Itemid; ?>">
				<?php echo JText::_('EB_PREVIOUS_DAY')?>
			</a>
        </td>
        <td class="currentday currentdaytoday">
            <?php echo date('l, M d, Y ',strtotime($this->day));?>
        </td>
        <td class="nextday">
            <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=daily&day=<?php echo date('Y-m-d',strtotime("+1 day", strtotime($this->day)));?>&Itemid=<?php echo $this->Itemid; ?>">
				<?php echo JText::_('EB_NEXT_DAY')?>
			</a>
        </td>
    </tr>
    
    <tr>
    	<td colspan="3">
        	<?php 
			if (count($this->events)){
			?>	
			<table cellpadding="0" cellspacing="0" width="100%" border="0">
				<?php 
					foreach ($this->events AS $key => $event) {
				?>
					<tr>
						<td class="tableb">
                        	<div class="eventdesc">
								<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&view=event&event_id='.$event->id.'&Itemid='.$this->Itemid); ?>"><?php echo $event->title?> ( <?php echo JHTML::_('date', $event->event_date, $timeFormat, $param);?> )</a>
                            </div>
						</td>
					</tr>
				<?php }?>	
			</table>
			<?php } else {
			    echo '<span class="eb_no_events">'.JText::_('EB_NO_EVENTS')."</span>";
			}			
			?>
        </td>
    </tr>
    
</table>
</div>
</div>
<script language="javascript">
	function gotoDate() {
		date = document.getElementById('date');
		if (date.value) {
			var url = "index.php?option=com_eventbooking&view=calendar&layout=daily&day="+date.value+"&Itemid=<?php echo $this->Itemid; ?>" ;
			location.href = url ;
		} else {
			alert("<?php echo JText::_('EB_PLEASE_CHOOSE_DATE'); ?>");
		}
	}
</script>