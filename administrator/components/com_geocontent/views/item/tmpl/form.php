<?php defined('_JEXEC') or die('Restricted access');
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

?>

<?php
	$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
	$edit = count($cid) && $cid[0];
	JArrayHelper::toInteger($cid, array(0));

	$text = ( $edit ? JText::_( 'COM_GEOCONTENT_EDIT' ) : JText::_( 'COM_GEOCONTENT_NEW' ) );

	JToolBarHelper::title(  'GeoContent ' . JText::_( 'COM_GEOCONTENT_ITEM' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	JToolBarHelper::apply();
	if ($edit) {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	} else {
		JToolBarHelper::cancel();
	}
	JToolBarHelper::help( 'screen.items.edit' );
?>

<?php
JFilterOutput::objectHTMLSafe( $this->item, ENT_QUOTES );
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.contentid.value == "" && form.contentname.value == "" ) {
			alert( "<?php echo JText::_( 'COM_GEOCONTENT_SELECT_THE_LINKED_ARTICLE_OR_FILL_IN_THE_TITLE', true ); ?>" );
		} else if (form.layerid.value == ''){
			alert( "Select the layer for this item." );
        <?php /*
		} else if (form.geotype.value == ''){
			alert( "Choose item geometric type." );
        */ ?>
		} else if (form.geodata.value == '' && !form.gpx.value){
			alert( "Geometric data is empty." );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data" >
<div class="col width-70">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'COM_GEOCONTENT_DETAILS' ); ?></legend>
	<table class="admintable">

		<tr>
			<td width="110" class="key">
				<label for="name" class="hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_ITEM_NAME' ); ?>">
					<?php echo JText::_( 'COM_GEOCONTENT_LINK_TO_EXISTING_ARTICLE' ); ?>:
				</label>
			</td>
			<td>
				<div class="button2-left"><div class="blank"><a class="modal" rel="{handler: 'iframe', size: {x: 650, y: 375}}" href="index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;object=content" title="<?php echo JText::_('COM_GEOCONTENT_SELECT_AN_ARTICLE');?>"><?php echo JText::_('COM_GEOCONTENT_SELECT_ARTICLE'); ?></a>&nbsp;
				<input name="contentid" id="contentid" value="<?php echo $this->item->contentid; ?>"/></div>
			</td>
		</tr>
        <tr>
            <td width="110" class="key">
                <label for="title">
                    <?php echo JText::_( 'COM_GEOCONTENT_TITLE' ); ?>:
                </label>
            </td>
            <td>
                <input style="width:300px" length="100" class="inputbox" type="text" name="contentname" id="contentname" value="<?php echo $this->item->contentname; ?>" />
            </td>
        </tr>
        <tr>
            <td width="110" class="key">
                <label for="url">
                    <?php echo JText::_( 'COM_GEOCONTENT_URL' ); ?>:
                </label>
            </td>
            <td>
                <input style="width:300px" length="100" class="inputbox" type="text" name="url" id="url" value="<?php echo $this->item->url; ?>" />
            </td>
        </tr>
		<tr>
			<td width="110" class="key">
				<label for="layerid">
					<?php echo JText::_( 'COM_GEOCONTENT_LAYER' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['layerid']; ?>
			</td>
		</tr>
        <tr>
            <td width="110" class="key">
                <label for="content">
                    <?php echo JText::_( 'COM_GEOCONTENT_BALLOON_CONTENT' ); ?>:
                </label>
            </td>
            <td>
                <?php echo $this->editor->display( 'content',  $this->item->content, '100%;', '550', '75', '20', array('pagebreak', 'readmore') ) ; ?>
            </td>
        </tr>
	</table>
	</fieldset>
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'COM_GEOCONTENT_GEOMETRIC_INFORMATIONS' ); ?></legend>
	<table class="admintable">
		<?php if($this->gmap_button){ ?>
 		<tr>
			<td width="110" class="key">
				<label for="gmap_button">
					<?php echo JText::_( 'COM_GEOCONTENT_GOOGLE_MAP_EDITOR' ); ?>:
				</label>
			</td>
			<td>
			     <div class="button2-left">
			         <div class="blank">
                        <a class="modal" rel="{handler: 'iframe', size: {x: 800, y: 400}}" href="index.php?option=com_geocontent&amp;layerid=<?php echo $this->layerid; ?>&amp;controller=item&amp;tmpl=component&amp;task=gmap&amp;cid[]=<?php echo $this->item->id; ?>" title="<?php echo JText::_('COM_GEOCONTENT_OPEN_GOOGLE_MAP_EDITOR');?>"><?php echo JText::_('COM_GEOCONTENT_OPEN_GOOGLE_MAP_EDITOR'); ?></a>
                    </div>
                </div>
			</td>
		</tr>
		<?php } ?>
 		<tr>
			<td width="110" class="key">
				<label for="gpx">
					<?php echo JText::_( 'COM_GEOCONTENT_LOAD_GPX_TRACK' ); ?>:
				</label>
			</td>
			<td>
			     <input type="file" name="gpx" id="gpx" />
			</td>
		</tr>
		<?php /*
		<tr>
			<td width="110" class="key">
				<label for="iconsize">
					<?php echo JText::_( 'COM_GEOCONTENT_TYPE' ); ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['geotype']; ?>
			</td>
		</tr>
		*/ ?>
		<tr>
			<td width="110" class="key">
				<label for="geodata">
					<?php echo JText::_( 'COM_GEOCONTENT_GEO_DATA' ); ?>:
				</label>
			</td>
			<td>
				<textarea id="geodata" name="geodata" cols="100" rows="5"><?php echo $this->item->geodata; ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label>
					<?php echo JText::_( 'COM_GEOCONTENT_LATITUDE' ); ?>:
				</label>
			</td>
			<td>
				<?php echo JText::_( 'COM_GEOCONTENT_MIN' ); ?>:<input type="text" id="minlat" name="minlat" value="<?php echo $this->item->minlat; ?>" />
				<?php echo JText::_( 'COM_GEOCONTENT_MAX' ); ?>:<input type="text" id="maxlat" name="maxlat" value="<?php echo $this->item->maxlat; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label>
					<?php echo JText::_( 'COM_GEOCONTENT_LONGITUDE' ); ?>:
				</label>
			</td>
			<td>
				<?php echo JText::_( 'COM_GEOCONTENT_MIN' ); ?>:<input type="text" id="minlon" name="minlon" value="<?php echo $this->item->minlon; ?>" />
				<?php echo JText::_( 'COM_GEOCONTENT_MAX' ); ?>:<input type="text" id="maxlon" name="maxlon" value="<?php echo $this->item->maxlon; ?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="layout" value="form" />
	<input type="hidden" name="controller" value="item" />
	<input type="hidden" name="option" value="com_geocontent" />
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>