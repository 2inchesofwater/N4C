<?php
/**
*
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

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('script','system/multiselect.js',false,true);


$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_geocontent.layer');
$saveOrder	= $listOrder=='ordering';

?>

<form action="<?php echo JRoute::_('index.php?option=com_geocontent&view=layers'); ?>" method="post" name="adminForm">

	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_GEOCONTENT_SEARCH_IN_TITLE'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
	</fieldset>
	<div class="clr"> </div>

			<table class="adminlist">
			<thead>
				<tr>
					<th width="20">
						<?php echo JText::_( 'COM_GEOCONTENT_EDIT_ITEMS' ); ?>
					</th>
					<th width="20">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th width="40%" nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  JText::_('COM_GEOCONTENT_NAME'), 'name', $listDirn, $listOrder ); ?>
					</th>
                    <th width="10%" nowrap="nowrap" class="title">
                        <?php echo JHTML::_('grid.sort',  JText::_('COM_GEOCONTENT_ITEM_CREATOR'), 'author', $listDirn, $listOrder ); ?>
                    </th>
					<th width="5%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   JText::_('JSTATUS'), 'published', $listDirn, $listOrder ); ?>
					</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'ordering', $listDirn, $listOrder); ?>
					<?php if ($canOrder && $saveOrder): ?>
						<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'layers.saveorder'); ?>
					<?php endif;?>
				</th>
					<th width="15%">
						<?php echo JText::_('COM_GEOCONTENT_POINT_ICON'); ?>
					</th>
					<th width="15%">
						<?php echo JText::_( 'COM_GEOCONTENT_LINE_STYLE'); ?>
					</th>
					<th width="15%">
						<?php echo JText::_('COM_GEOCONTENT_POLYGON_STYLE'); ?>
					</th>
					<th width="15%">
						KML
					</th>
					<th width="1%">
						<?php echo JHTML::_('grid.sort',   '#', 'id', $listDirn, $listOrder ); ?>
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

			JHtml::_('script','system/multiselect.js',false,true);

            $user		= JFactory::getUser();
            $userId		= (int)$user->get('id');
            $listOrder	= $this->escape($this->state->get('list.ordering'));
            $listDirn	= $this->escape($this->state->get('list.direction'));
            $canOrder	= $user->authorise('core.edit.state', 'com_geocontent.layer');
            $saveOrder	= $listOrder=='ordering';
  			$ordering	= ($listOrder == 'ordering');

            $canDo = GeoContentHelper::getActions();


			foreach ($this->items as $i => $row) {
                $canDoOnLayer = GeoContentHelper::getActions($row->id);

                $link		= JRoute::_( 'index.php?option=com_geocontent&task=layer.edit&id='. $row->id );
                $canChange  = $canDoOnLayer->get('core.edit.state');
                $canEdit    = $canDoOnLayer->get('core.edit');
                $canAdd     = $canDoOnLayer->get('core.create');
                $canEditOwn = $canDoOnLayer->get('core.edit.own') && $row->created_by == $userId;

                $canCheckin = $user->authorise('core.manage', 'com_checkin') || $row->checked_out == $userId || $row->checked_out == 0;
				$published  = JHtml::_('jgrid.published', $row->published, $i, 'layers.', $canChange);
                $params = json_decode($row->params);
				?>
				<tr class="row<?php echo $i % 2; ?>">

					<td align="center">
                        <?php if($canEdit || $canEditOwn): ?>
						<span class="hasTip" title="<?php echo JText::_('COM_GEOCONTENT_VIEW_EDIT_ITEMS_FOR_THIS_LAYER') ; ?>"><?php
						$item_link = JRoute::_( 'index.php?option=com_geocontent&view=items&filter_layerid='. $row->id );
						echo JHTML::link($item_link, '<img src="'. $this->assetpath . '/images/icon-24-edit.png" alt="Items" />'); ?></span>
                        <?php endif; ?>
					</td>
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                    </td>
					<td>
                        <?php if ($row->checked_out) : ?>
                            <?php echo JHtml::_('jgrid.checkedout', $i, $row->editor, $row->checked_out_time, 'layers.', $canCheckin); ?>
                        <?php endif; ?>
                        <?php if ($canEdit || ($canDo->get('core.edit.own') && $row->created_by == $userId )): ?>
					        <span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_EDIT' );?>::<?php echo $row->name; ?>"><?php echo JHTML::link($link, $row->name ); ?></span>
                        <?php else: ?>
                            <?php echo $this->escape($row->name); ?>
                        <?php endif; ?>
					</td>
                    <td class="center">
                        <?php echo $this->escape($row->author); ?>
                    </td>
					<td align="center">
						<?php echo $published;?>
					</td>

				<td class="order">
					<?php if ($canChange) : ?>
						<?php if ($saveOrder) :?>
							<?php if ($listDirn == 'asc') : ?>
								<span><?php echo $this->pagination->orderUpIcon($i, true, 'layers.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'layers.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							<?php elseif ($listDirn == 'desc') : ?>
								<span><?php echo $this->pagination->orderUpIcon($i, true, 'layers.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'layers.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							<?php endif; ?>
						<?php endif; ?>
						<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled;?> class="text-area-order" />
					<?php else : ?>
						<?php echo $row->ordering; ?>
					<?php endif; ?>
				</td>
    			<td align="center">
						<img src="<?php echo GeoContentHelper::getIconUrl($params->icon);?>" alt="Icon" height="16" />
					</td>
					<td align="center">
						<?php echo GeoContentHelper::LineStyleHTML($params->linergba, $params->linewidth, 'lsrgba-' . $k);?>
					</td>
					<td align="center">
						<?php echo GeoContentHelper::PolyStyleHTML($params->polyrgba, $params->linergba, $params->linewidth, 'psrgba-' . $k);?>
					</td>
					<td align="center">
						<a class="hasTip" title="KML::<?php echo JText::_( 'COM_GEOCONTENT_VIEW_THIS_LAYER_IN_GOOGLE_EARTH' );?>" href="<?php print GeoContentHelper::getKMLLink($row->id, null, false);?>"><img src="<?php echo $this->assetpath . '/images/geicon.png' ?>"/></a>
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
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
