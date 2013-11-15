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

	JToolBarHelper::custom( 'layer', 'layer.png', 'layer_f2.png', 'Layer list', false );
    JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', JText::_('COM_GEOCONTENT_COPY') );
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_geocontent', '200');
?>
		<script type="text/javascript">
				function tableOrdering(order, dir, task) {
						var form = document.adminForm;

						form.filter_order.value = order;
						form.filter_order_Dir.value = dir;
						document.adminForm.submit(task);
				}
		</script>

		<form action="index.php?option=com_geocontent" method="post" name="adminForm">
		<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'COM_GEOCONTENT_FILTER' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'COM_GEOCONTENT_GO' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'COM_GEOCONTENT_FILTER_RESET' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
				//echo $this->lists['geotype'];
				echo $this->lists['layerid'];
				?>
			</td>
		</tr>
		</table>

			<table class="adminlist">
			<thead>
				<tr>
					<!--<th width="20">
						<?php echo JText::_( 'COM_GEOCONTENT_NUM' ); ?>
					</th>-->
					<th width="20">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th width="40%" nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  JText::_('COM_GEOCONTENT_GEOCONTENT_NAME'), 'contentname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					<th width="15%">
						<?php echo JHTML::_('grid.sort',   JText::_('COM_GEOCONTENT_LAYER'), 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					<?php /*
					<th width="15%">
						<?php echo JHTML::_('grid.sort',   'Geo Type', 'geotype', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					*/ ?>
					<th width="20">
						<?php echo JText::_( 'COM_GEOCONTENT_ARTICLE_ID' ); ?>
					</th>
					<th width="15%">
						KML
					</th>
					<th width="1%">
						<?php echo JHTML::_('grid.sort',   '#', 'id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="13">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php
			$k = 0;
			$ordering = ($this->lists['order'] == 'ordering');
			for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
				$row = &$this->items[$i];
				$row->checked_out = false;

				$link		= JRoute::_( 'index.php?option=com_geocontent&controller=item&task=edit&cid[]='. $row->id );

				$checked = JHTML::_('grid.checkedout',   $row, $i );

				?>
				<tr class="<?php echo "row$k"; ?>">
					<!--<td align="center">
						<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_EDIT_GEOCONTENT_ITEM' );?>::<?php echo $row->contentname ?  $row->contentname : $row->originalname; ?>"><?php echo JHTML::link($link, $this->pagination->getRowOffset($i) ); ?></span>
					</td>-->
					<td align="center">
						<?php echo $checked; ?>
					</td>
					<td>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_EDIT_GEOCONTENT_ITEM' );?>::<?php echo $row->contentname ?  $row->contentname : $row->originalname; ?>"><?php echo JHTML::link($link, $row->contentname ?  $row->contentname : $row->originalname); ?></span>
					</td>

					<td align="center">
						<?php echo $row->layername; ?>
					</td>
					<?php /*
					<td align="center">
						<?php echo $row->geotype;?>
					</td>
					*/ ?>
					<td align="center">
						<?php echo $row->contentid; ?>
					</td>
					<td align="center">
						<a class="hasTip" title="KML::<?php echo JText::_( 'COM_GEOCONTENT_VIEW_THIS_ITEM_IN_GOOGLE_EARTH' );?>" href="<?php echo GeoContentHelper::getKMLLink($row->layerid, $row->contentid, false);?>"><img src="<?php echo $this->assetpath . '/images/geicon.png' ?>"/></a>
					</td>
					<td align="center">
						<?php echo $row->id; ?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
			</table>

		<input type="hidden" name="controller" value="item" />
		<input type="hidden" name="option" value="com_geocontent" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
