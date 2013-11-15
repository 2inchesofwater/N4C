<?php
/**
*
* @version      $Id: controller.php 66 2008-06-12 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2008 Alessandro Pasotti http://www.itopen.it
* @license      GNU/AGPL

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
defined('_JEXEC') or die('Restricted access'); ?>

<?php
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$edit= JRequest::getVar( 'edit', false );
	JArrayHelper::toInteger($cid, array(0));

	$text = ( $edit ? JText::_( 'COM_GEOCONTENT_EDIT' ) : JText::_( 'COM_GEOCONTENT_NEW' ) );

	JToolBarHelper::title(  JText::_( 'COM_GEOCONTENT_LAYER' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	JToolBarHelper::apply();
	if ($edit) {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	} else {
		JToolBarHelper::cancel();
	}
	JToolBarHelper::help( 'screen.layers.edit' );
?>

<?php
JFilterOutput::objectHTMLSafe( $this->layer, ENT_QUOTES );
?>

<script type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.name.value == "") {
			alert( "<?php echo JText::_( 'COM_GEOCONTENT_LAYER_MUST_HAVE_A_NAME', true ); ?>" );
		} else if( isNaN( parseInt( form.iconsize.value ) ) ) {
			alert( "<?php echo JText::_( 'COM_GEOCONTENT_ICON_SIZE_MUST_BE___0_', true ); ?>" );
		} else if (form.icon.value == ""){
			alert( "layer must have an icon." );
		} else if (form.linergba.value == ''){
			alert( "layer line must have a color." );
		} else if (form.polyrgba.value == ''){
			alert( "layer polygon must have a color." );
		} else if (form.linewidth.value == ''){
			alert( "layer line must have a width." );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm">
<div class="col width-70">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'COM_GEOCONTENT_DETAILS' ); ?></legend>
	<table class="admintable">

		<tr>
			<td width="110" class="key">
				<label for="name" class="hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_LAYER_NAME__WILL_BE_VISIBLE_IN_THE_TABLE_OF_CONTENT_' ); ?>">
					<?php echo JText::_( 'COM_GEOCONTENT_NAME' ); ?>:
				</label>
			</td>
			<td  width="500" colspan="2">
				<input class="inputbox" type="text" name="name" id="name" size="32" value="<?php echo $this->layer->name; ?>" />
			</td>
		</tr>
		<tr>
			<td width="120" class="key">
				<?php echo JText::_( 'COM_GEOCONTENT_ENABLED' ); ?>:
			</td>
			<td colspan="2">
				<?php echo JHTML::_( 'select.booleanlist',  'enabled', 'class="inputbox"', $this->layer->published ); ?>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="icon">
					<?php echo JText::_( 'COM_GEOCONTENT_ICON_FOR_POINTS' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<?php
					$path = JURI::base().'..' .DS.'images'.DS;
					if ($this->layer->icon != 'blank.png') {
						$path.= $this->point_icon_folder.DS;
					}
				?>
				<?php echo JHTML::_( 'list.images',  'icon', $this->layer->icon , null, DS.'images'.DS.$this->point_icon_folder.DS); ?>&nbsp;<img src="<?php echo $path . $this->layer->icon;?>" name="imagelib" width="" height="" border="2" alt="<?php echo JText::_( 'COM_GEOCONTENT_PREVIEW' ); ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="iconsize">
					<?php echo JText::_( 'COM_GEOCONTENT_ICON_SIZE__KML_ONLY__NO_EFFECT_ON_BROWSER_MAP_' ); ?>:
				</label>
			</td>
			<td colspan="2">
				<?php echo JHTML::_( 'select.integerlist', 10, 40, 2, 'iconsize', null,  $this->layer->iconsize); ?>&nbsp;pixel
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="linergba">
					<?php echo JText::_( 'COM_GEOCONTENT_LINE_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="linergba" id="linergba" size="8" value="<?php echo $this->layer->linergba; ?>" /><img id="myRlinergba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" />&nbsp;<?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>&nbsp;<?php echo $this->lists['linergbalpha']; ?>

			</td>
			<td>
			     <?php echo GeoContentHelper::LineStyleHTML($this->layer->linergba, $this->layer->linewidth, 'linestylergba');?>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="linewidth">
					<?php echo JText::_( 'COM_GEOCONTENT_LINE_WIDTH' ); ?>:
				</label>
			</td>
			<td colspan="2">
			     <?php echo $this->lists['linewidth']; ?>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="polyrgba">
					<?php echo JText::_( 'COM_GEOCONTENT_POLY_COLOR' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="polyrgba" id="polyrgba" size="8" value="<?php echo $this->layer->polyrgba; ?>" /><img id="myRpolyrgba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" />&nbsp;<?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>&nbsp;<?php echo $this->lists['polyrgbalpha']; ?>

			</td>
			<td>
			     <?php echo GeoContentHelper::PolyStyleHTML($this->layer->polyrgba, $this->layer->linergba, $this->layer->linewidth, 'polystylergba');?>
			</td>
		</tr>

	</table>
	</fieldset>
<script type="text/javascript">
    $('polystylergba').setStyle('opacity', <?php echo $this->polyrgbaopacity; ?>);
    $('linestylergba').setStyle('opacity', <?php echo $this->linergbaopacity; ?>);
</script>
</div>
<div class="clr"></div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="layout" value="form" />
	<input type="hidden" name="option" value="com_geocontent" />
	<input type="hidden" name="id" value="<?php echo $this->layer->id; ?>" />
	<input type="hidden" name="cid[]" value="<?php echo $this->layer->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>