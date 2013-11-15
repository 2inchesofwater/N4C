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

if ($j15) {
?>
	<div class="componentheading"><?php echo JText::_('EB_CALENDAR') ; ?></div>
<?php    
} else {
?>
	<h1 class="eb_title"><?php echo JText::_('EB_CALENDAR') ; ?></h1>
<?php    
}	
?>
<div id="extcalendar">
<div style="width: 100%;" class="topmenu_calendar">
	<div class="left_calendar">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
                <td class="tableh1" colspan="3">
                    <table class="jcl_basetable">
                        <tr>
                            <td align="left" class="today">&nbsp;</td>
                            <td align="right" class="today">
                                <?php echo date('D. d M, Y',strtotime("$this->first_day_of_week")); ?> - <?php echo date('D. d M, Y',strtotime("+6 day", strtotime($this->first_day_of_week)));?>
                            </td>
                        </tr>
                    </table>
                </td>                
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
                        <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=weekly&date=<?php echo $date;?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link active">
                            <?php echo JText::_('EB_WEEKLY_VIEW')?>
                        </a>
                    </li>  	
                <?php   
                }
                if ($this->config->activate_daily_calendar_view) {
                ?>
                	<li>
                        <?php $day = date('Y-m-d',time())?>
                        <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=daily&day=<?php echo $day;?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link">
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
<table cellpadding="0" cellspacing="0" width="100%" border="0">
    
    <tr class="tablec">
        <td class="previousweek">
            <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=weekly&date=<?php echo date('Y-m-d',strtotime("-7 day", strtotime($this->first_day_of_week)));?>&Itemid=<?php echo $this->Itemid; ?>">
                <?php echo JText::_('EB_PREVIOUS_WEEK')?>
            </a>
        </td>
        <td class="currentweek currentweektoday">
            <?php echo JText::_('EB_WEEK')?> <?php echo date('W',strtotime("+6 day", strtotime($this->first_day_of_week)));?>
        </td>
        <td class="nextweek">
            <a class="shajaxLinkNextWeek extcalendar prefetch" href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=weekly&date=<?php echo date('Y-m-d',strtotime("+7 day", strtotime($this->first_day_of_week)));?>&Itemid=<?php echo $this->Itemid; ?>">
                <?php echo JText::_('EB_NEXT_WEEK')?>
            </a>
        </td>
    </tr>
	<?php 
		foreach ($this->events AS $key => $events) {
	?>
		<tr class="tableh2">
			<td class="tableh2" colspan="3">
				<?php echo date('l. d M, Y',strtotime("+$key day", strtotime($this->first_day_of_week)));?>
			</td>
		</tr>
		<tr class="tableb">
			
				<?php 
					if (!count($events)){
				?>		
					<td align="center" class="tableb" colspan="3">
						<br />
							<strong>
								<?php echo JText::_('EB_NO_EVENT_ON_THIS_DAY');?>
							</strong>
						<br />
                        <br />
					</td>
				<?php 
					}else{
				?>
					<td align="left" style="padding-left: 10px;" colspan="3">
						<br />
						 <?php 
						 	foreach ($events as $event) {
						 ?>
						 	<p>
						 		<a href="<?php echo JRoute::_('index.php?option=com_eventbooking&view=event&event_id='.$event->id.'&Itemid='.$this->Itemid); ?>"><?php echo $event->title?> ( <?php echo JHTML::_('date', $event->event_date, $timeFormat, $param); ?> )</a>
						 	</p>
						<?php 		
						 	}
						 ?>
						<br />
                        <br />
					</td>
				<?php 		
					}
				?>				
		</tr>
	<?php 	
		}
	?>
</table>
</div>
</div>

