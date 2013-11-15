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
    $param = null ;
    $timeFormat = $this->config->event_time_format ? $this->config->event_time_format : 'g:i a' ;
} else {
    $timeFormat = $this->config->event_time_format ? $this->config->event_time_format : '%I:%M %p' ;
    $param = 0 ;    
}	
?>
<script language="javascript">
	function cal_date_change(month,year,itemid){
		location.href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_category&layout=calendar&category_id=<?php echo $this->category->id; ?>&month=" + month + "&year=" + year + "&Itemid=" + itemid;
	}	
</script>
<form method="post" name="adminForm" id="adminForm" action="index.php">	
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
	
	if ($this->config->show_cat_decription_in_calendar_layout) {
	?>
		<div class="eb_cat">		
			<?php					       		    		      
				if($this->category->name != '') :
			        ?><h1 class="eb_title"><?php echo $this->category->name;?></h1><?php
			    endif;		
				if($this->category->description != '') :
					?><div class="eb_description"><?php echo $this->category->description;?></div><?php
				endif;
			?>
			<div class="clr"></div>
		</div>
	<?php	
	}
?> 
<div class="regpro_calendar" style="width: 98%">
<table class="regpro_calendarMonthHeader" border="0" width="100%">
	<tr>
		<td width="25%" align="right" valign="top">
			<a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_category&layout=calendar&category_id=<?php echo $this->category->id; ?>&month=<?php echo $previousMonth?>&year=<?php echo $previousYear;?>&Itemid=<?php echo $this->Itemid; ?>">
				<img alt="<?php echo JText::_("Previous Month")?>" src="components/com_eventbooking/assets/images/calendar_previous.png">
			</a>
		</td>
		<td align="center" valign="middle">
			<?php echo $this->search_month; ?>&nbsp;&nbsp;
			<?php echo $this->search_year; ?>
		</td>
		<td width="25%" align="left" valign="top">
			<a href="<?php echo JURI::root()?>index.php?option=com_eventbooking&task=view_category&layout=calendar&category_id=<?php echo $this->category->id; ?>&month=<?php echo $nextMonth ;?>&year=<?php echo $nextYear?>&Itemid=<?php echo $this->Itemid; ?>">
				<img alt="<?php echo JText::_("Next Month")?>" src="components/com_eventbooking/assets/images/calendar_next.png">
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
			<tr >
                <?php
                    for ($d=0;$d<7 && $dn<$datacount;$d++){
                	$currentDay = $this->data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
		                   <td onmouseout="this.className = 'regpro_calendarDay';" onmouseover="this.className = 'regpro_calenderday_highlight';" class="regpro_calendarDay">
		                        &nbsp;
		                    </td>
                    <?php
                    	break;
                		case "current":
               		?>
		                   <td onmouseout="this.className = 'regpro_calendarDay';" onmouseover="this.className = 'regpro_calenderday_highlight';" class="regpro_calendarDay">
		                    	<?php echo $currentDay['d']; 
		                    	foreach ($currentDay["events"] as $key=>$val){
		                    	?>		                    	
		                    		<div style="border:0;width:100%;">
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
<input type="hidden" name="category_id" value="<?php echo $this->category->id; ?>" />
<input type="hidden" name="view" value="category" />	
<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />
<input type="hidden" name="option" value="com_eventbooking" />
<input type="hidden" name="layout" value="calendar" />
</form>