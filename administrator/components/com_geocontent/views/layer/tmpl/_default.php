<?php
/**
*
* @version      $Id: controller.php 66 2008-06-12 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2011 Alessandro Pasotti http://www.itopen.it
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

		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', JText::_('\1\U') );
 		JToolBarHelper::customX( 'checkdb', 'refresh.png', 'checkdb.png', JText::_('\1\U') ,  false);
 		JToolBarHelper::customX( 'help', 'help.png', 'help_f2.png', JText::_('\1\U') ,  false);
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::preferences('com_geocontent', '500');


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
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Filter Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
				echo $this->lists['state'];
				?>
			</td>
		</tr>
		</table>

			<table class="adminlist">
			<thead>
				<tr>
					<th width="20">
						<?php echo JText::_( 'Edit items' ); ?>
					</th>
					<th width="20">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th width="40%" nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  JText::_('\1\U'), 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					<th width="5%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   JText::_('\1\U'), 'published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
					</th>
					<th width="8%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   JText::_('\1\U'), 'ordering', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
						<?php echo JHTML::_('grid.order',  $this->items ); ?>
					</th>
					<th width="15%">
						<?php echo JText::_('\1\U'); ?>
					</th>
					<th width="15%">
						<?php echo JText::_( 'Line style'); ?>
					</th>
					<th width="15%">
						<?php echo JText::_('\1\U'); ?>
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

				$link		= JRoute::_( 'index.php?option=com_geocontent&task=edit&cid[]='. $row->id );

				$published		= JHTML::_('grid.published', $row, $i );
				$row->checked_out = false;
				$checked		= JHTML::_('grid.checkedout',   $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td align="center">
						<span class="hasTip" title="<?php echo JText::_('\1\U') ; ?>"><?php
						$item_link = JRoute::_( 'index.php?option=com_geocontent&controller=item&layerid='. $row->id );
						echo JHTML::link($item_link, '<img src="'. JURI::root().'includes/js/ThemeOffice/mainmenu.png" alt="Items" />'); ?></span>
					</td>
					<td align="center">
						<?php echo $checked; ?>
					</td>
					<td>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit' );?>::<?php echo $row->name; ?>"><?php echo JHTML::link($link, $row->name ); ?></span>
					</td>
					<td align="center">
						<?php echo $published;?>
					</td>
					<td class="order">
						<span><?php echo $this->pagination->orderUpIcon( $i, true,'orderup', 'Move Up', $ordering ); ?></span>
						<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown', 'Move Down', $ordering ); ?></span>
						<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
					</td>
					<td align="center">
				<?php
                    $path = JURI::root() .DS.'images'.DS;
                    if ($row->icon != 'blank.png') {
                        $path.= $this->point_icon_folder.DS;
                    }
				?>
						<img src="<?php echo $path;?><?php echo $row->icon;?>" alt="Icon" height="16" />
					</td>
					<td align="center">
						<?php echo GeoContentHelper::LineStyleHTML($row->linergba, $row->linewidth, 'lsrgba-' . $k);?>
					</td>
					<td align="center">
						<?php echo GeoContentHelper::PolyStyleHTML($row->polyrgba, $row->linergba, $row->linewidth, 'psrgba-' . $k);?>
					</td>
					<td align="center">
						<a class="hasTip" title="KML::<?php echo JText::_( 'View this layer in Google Earth' );?>" href="<?php print GeoContentHelper::getKMLLink($row->id, null, false);?>"><img src="<?php echo $this->assetpath . '/images/geicon.png' ?>"/></a>
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

		<input type="hidden" name="controller" value="layer" />
		<input type="hidden" name="option" value="com_geocontent" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
