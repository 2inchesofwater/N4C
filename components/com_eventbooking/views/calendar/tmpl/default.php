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
?>
<script>
	function cal_date_change(month,year,itemid){
		location.href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_calendar&month=" + month + "&year=" + year + "&Itemid=" + itemid;
	}	
</script>
<?php
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
<?php
    if ($this->showCalendarMenu) {
    ?>
  		<div style="width: 100%;" class="topmenu_calendar">	
            <ul class="menu_calendar">
            	<li>
        			<?php 
                        $month = date('m',time());
                        $year = date('Y',time());
                    ?>
                    <a class="calendar_link active" href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&month=<?php echo $month;?>&year=<?php echo $year; ?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link active">
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
                            <a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&view=calendar&layout=daily&day=<?php echo $day;?>&Itemid=<?php echo $this->Itemid; ?>" class="calendar_link">
                                <?php echo JText::_('EB_DAILY_VIEW')?>
                            </a>
                        </li>
                    <?php    
                    }
                ?>                                
            </ul>
        </div>  
    <?php    
    }
?>
<div class="wraptable_calendar">
<div class="regpro_calendar" style="width: 100%">
<?php
	//Calculate next and previous month, year
	if ($this->month == 12) {
		$nextMonth = 1 ;
		$nextYear = $this->year + 1 ;
		$previousMonth = 11 ;
		$previousYear = $this->year ;
	} elseif ($this->month == 1) {
		$nextMonth = 2 ;
		$nextYear = $this->year ;
		$previousMonth = 12 ;
		$previousYear = $this->year - 1 ;
	} else {
		$nextMonth = $this->month + 1 ;
		$nextYear = $this->year ;
		$previousMonth = $this->month - 1 ;
		$previousYear = $this->year ;
	}
?>
<table class="regpro_calendarMonthHeader" border="0" width="100%">
	<tr>
		<td width="25%" align="right" valign="top">
			<a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_calendar&month=<?php echo $previousMonth ;?>&year=<?php echo $previousYear?>&Itemid=<?php echo $this->Itemid; ?>">
				<img alt="<?php echo JText::_("EB_PREVIOUS_MONTH")?>" src="components/com_eventbooking/assets/images/calendar_previous.png">
			</a>			
		</td>
		<td align="center" valign="middle">
			<?php echo $this->search_month; ?>&nbsp;&nbsp;
			<?php echo $this->search_year; ?>
		</td>
		<td width="25%" align="left" valign="top">
			<a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_calendar&month=<?php echo $nextMonth ;?>&year=<?php echo $nextYear ; ?>&Itemid=<?php echo $this->Itemid; ?>">
				<img alt="<?php echo JText::_("EB_NEXT_MONTH")?>" src="components/com_eventbooking/assets/images/calendar_next.png">
			</a>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" class="regpro_calendar_table" width="100%">
	<tr>
		<?php foreach ($this->data["daynames"] as $dayname) { ?>
             <td align="center" valign="top" class="regpro_calendarWeekDayHeader">
                 <?php 
                 echo $dayname;?>
             </td>
             <?php
         } ?>
	</tr>
	  <?php
            $datacount = count($this->data["dates"]);
            $dn=0;
            for ($w=0;$w<6 && $dn<$datacount;$w++){
            ?>
			<tr>
                <?php
                    for ($d=0;$d<7 && $dn < $datacount; $d++){
                	$currentDay = $this->data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
		                   <td onmouseout="this.className = 'regpro_calendarDay';" onmouseover="this.className = 'regpro_calenderday_highlight';" class="regpro_calendarDay">&nbsp;
		                        
		                    </td>
                    <?php
                    	break;
                		case "current":
               		?>
		                   <td onmouseout="this.className = 'regpro_calendarDay';" onmouseover="this.className = 'regpro_calenderday_highlight';" class="regpro_calendarDay">
		                    	<?php echo $currentDay['d']; 
		                    	foreach ($currentDay["events"] as $key=>$val){		   
		                    		$cssClass = 'eb_calendar_category_'.implode('_', EventBookingHelper::getCategoriesOfEvent($val->id));                 		
		                    	?>		                    	
		                    		<div style="border:0;width:100%;" class="<?php echo $cssClass ; ?>">		                    			
		                    			<a class="eb_event_link" href="<?php echo JText::_('index.php?option=com_eventbooking&task=view_event&event_id='.$val->id.'&Itemid='.$this->Itemid); ?>" title="<?php echo $val->title; ?>">
		                    				<img border="0" align="top" title="<?php echo JText::_("Event")?>" src="<?php echo JURI::root()?>components/com_eventbooking/assets/images/calendar_event.png">
		                    				<?php
		                    					if ($this->config->show_event_time) {
		                    						echo $val->title.' ('.JHTML::_('date', $val->event_date, $timeFormat, $param).')' ; 
		                    					} else {
		                    						echo $val->title ;
		                    					}	
		                    				?>		                    						                    				
		                    			</a>		                    		
		                    		</div>
		                   <?php }
		                    echo "</td>\n";
		                break;
		            }
		                	$dn++;
                }
                echo "</tr>\n";
            }
	?>	
</table>
</div>
</div>
</div>