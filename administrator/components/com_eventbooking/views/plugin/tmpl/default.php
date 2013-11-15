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
	
JToolBarHelper::title(   JText::_( 'EB_PLUGIN' ).': <small><small>[edit]</small></small>' );
JToolBarHelper::save('save_plugin');	
JToolBarHelper::cancel('cancel_plugin');

JHTML::_('behavior.tooltip');
JHTML::_( 'behavior.modal' ) ;	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_plugin') {
			submitform( pressbutton );
			return;				
		} else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col" style="float:left; width:65%">
	<fieldset class="adminform">
		<legend><?php echo JText::_('EB_PLUGIN_DETAIL'); ?></legend>
			<table class="admintable">
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_NAME'); ?>
					</td>
					<td>
						<?php echo $this->item->name ; ?>
					</td>
				</tr>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_TITLE'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="title" id="title" size="40" maxlength="250" value="<?php echo $this->item->title;?>" />
					</td>
				</tr>					
				<tr>
					<td class="key">
						<?php echo JText::_('EB_AUTHOR'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="author" id="author" size="40" maxlength="250" value="<?php echo $this->item->author;?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_('Creation date'); ?>
					</td>
					<td>
						<?php echo $this->item->creation_date; ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_('Copyright') ; ?>
					</td>
					<td>
						<?php echo $this->item->copyright; ?>
					</td>
				</tr>	
				<tr>
					<td class="key">
						<?php echo JText::_('License'); ?>
					</td>
					<td>
						<?php echo $this->item->license; ?>
					</td>
				</tr>							
				<tr>
					<td class="key">
						<?php echo JText::_('Author email'); ?>
					</td>
					<td>
						<?php echo $this->item->author_email; ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_('Author URL'); ?>
					</td>
					<td>
						<?php echo $this->item->author_url; ?>
					</td>
				</tr>				
				<tr>
					<td class="key">
						<?php echo JText::_('Version'); ?>
					</td>
					<td>
						<?php echo $this->item->version; ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_('Description'); ?>
					</td>
					<td>
						<?php echo $this->item->description; ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_('Published'); ?>
					</td>
					<td>
						<?php					
							echo $this->lists['published'];					
						?>						
					</td>
				</tr>
		</table>
	</fieldset>				
</div>						
<div class="col" style="float:left; width:35%">
	<fieldset class="adminform">
		<legend><?php echo JText::_('Plugins Parameter'); ?></legend>
		<?php
			$output = $this->params->render('params') ;
			if ($output) :
				echo $output;
			else :
				echo "<div style=\"text-align: center; padding: 5px; \">".JText::_('There are no parametters')."</div>";
			endif;
		?>				
	</fieldset>				
</div>
		
<div class="clr"></div>	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />	
	<input type="hidden" name="task" value="" />
</form>