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
	
$edit = JRequest::getVar('edit', false);	
$text = $edit ? JText::_('EB_EDIT') : JText::_('EB_NEW');	
JToolBarHelper::title(   JText::_( 'Location' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::save('save_location');	
JToolBarHelper::cancel('cancel_location');	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_location') {
			submitform( pressbutton );
			return;				
		} else {
			//Should validate the information here
			if (form.name.value == "") {
				alert("<?php echo JText::_('EN_ENTER_LOCATION'); ?>");
				form.name.focus();
				return ;
			}					
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col width-95" style="float:left">			
	<table class="admintable" width="100%">		
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_NAME'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->item->name;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>			
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_ADDRESS'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="address" id="address" size="70" maxlength="250" value="<?php echo $this->item->address;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_CITY'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="city" id="city" size="30" maxlength="250" value="<?php echo $this->item->city;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_STATE'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="state" id="state" size="30" maxlength="250" value="<?php echo $this->item->state;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_ZIP'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="zip" id="zip" size="20" maxlength="250" value="<?php echo $this->item->zip;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_COUNTRY'); ?>
			</td>
			<td>
				<?php echo $this->lists['country'] ; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_LATITUDE'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="lat" id="lat" size="20" maxlength="250" value="<?php echo $this->item->lat;?>" />
			</td>
			<td>
				<?php echo JText::_('EB_LATITUDE_EXPLAIN'); ?>				
			</td>
		</tr>
		<tr>
			<td class="key"> 
				<?php echo JText::_('EB_LONGITUDE'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="long" id="long" size="20" maxlength="250" value="<?php echo $this->item->long;?>" />
			</td>
			<td>
				<?php echo JText::_('EB_LONGITUDE_EXPLAIN'); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_('EB_PUBLISHED') ; ?>
			</td>
			<td>
				<?php echo $this->lists['published']; ?>
			</td>	
		</tr>
	</table>			
</div>		
<div class="clr"></div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />	
	<?php echo JHTML::_( 'form.token' ); ?>		
</form>