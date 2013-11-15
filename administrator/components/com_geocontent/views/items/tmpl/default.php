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
$canOrder	= $user->authorise('core.edit.state', 'com_geocontent.item');
$saveOrder	= $listOrder=='ordering';

?>

<form action="<?php echo JRoute::_('index.php?option=com_geocontent&view=items'); ?>" method="post" name="adminForm">

	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_GEOCONTENT_SEARCH_IN_TITLE'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<select name="filter_layerid" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_GEOCONTENT_FILTER_LAYER');?></option>
				<?php echo JHtml::_('select.options', $this->layer_options, 'value', 'name', (int)$this->state->get('filter.layerid'));?>
			</select>

            <select name="filter_language" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
            </select>


        </div>


	</fieldset>



	<div class="clr"> </div>

			<table class="adminlist">
			<thead>
				<tr>
                    <th width="1%">
                        <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
                    </th>
					<th width="20%" nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  JText::_('COM_GEOCONTENT_NAME'), 'contentname', $listDirn, $listOrder ); ?>
					</th>
					<th width="20%" nowrap="nowrap" class="title">
						<?php echo JText::_('COM_GEOCONTENT_LAYER'); ?>
					</th>
                    <th width="10%" nowrap="nowrap" class="title">
                        <?php echo JHTML::_('grid.sort',  JText::_('COM_GEOCONTENT_ITEM_CREATOR'), 'author', $listDirn, $listOrder ); ?>
                    </th>
                    <th width="5%" nowrap="nowrap" class="title">
                        <?php echo JText::_('COM_GEOCONTENT_BOUND_ARTICLE'); ?>
                    </th>
                    <th width="40%" nowrap="nowrap" class="title">
                        <?php echo JText::_('COM_GEOCONTENT_URL'); ?>
                    </th>
                    <th width="1%" nowrap="nowrap" class="title">
                        <?php echo JText::_('COM_GEOCONTENT_PREVIEW'); ?>
                    </th>
                    <th width="5%">
                        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
                    </th>
                    <th width="1%" class="nowrap">
                        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
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
            $userId		= $user->get('id');
            $listOrder	= $this->escape($this->state->get('list.ordering'));
            $listDirn	= $this->escape($this->state->get('list.direction'));

            $saveOrder	= $listOrder=='ordering';
  			$ordering	= ($listOrder == 'ordering');
			foreach ($this->items as $i => $row) {
				$link		= JRoute::_( 'index.php?option=com_geocontent&task=item.edit&id='. $row->id );
                $canDo      = GeoContentHelper::getActions($row->layerid);
                $canChange	= $canOrder = $canDo->get('core.edit.state');
                $canCreate  = $canDo->get('core.create');
                $canEdit    = $canDo->get('core.edit');
                $canEditOwn = $canDo->get('core.edit.own') && $row->created_by == $userId;
                $canCheckin = $user->authorise('core.manage', 'com_checkin') || $row->checked_out == $userId || $row->checked_out == 0;

				?>
				<tr class="row<?php echo $i % 2; ?>">

                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                    </td>
                    <td>
                        <?php if ($row->checked_out) : ?>
                            <?php echo JHtml::_('jgrid.checkedout', $i, $row->editor, $row->checked_out_time, 'items.', $canCheckin); ?>
                        <?php endif; ?>

                        <?php if ($canEdit || $canEditOwn) : ?>
                        <span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_EDIT' );?>::<?php echo $row->contentname; ?>"><?php echo JHTML::link($link, $row->contentname ); ?></span>
                    <?php else : ?>
                        <?php echo $this->escape($row->contentname); ?>
                    <?php endif; ?>
					</td>
                    <td class="center">
    					<?php echo GeoContentHelper::getLayerName($row->layerid); ?>
					</td>
                    <td class="center">
                        <?php echo $this->escape($row->author); ?>
                    </td>
                    <td class="center">
                        <?php
                        if($row->contentid){
                            echo $this->escape($row->article_title);
                        } else {
                            echo '&mdash;';
                        }
                        ?>
                    </td>
                    <td class="center">
                        <?php if (GeoContentHelper::getItemURL($row)) : ?>
    					   <span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_LINK_PREVIEW' );?>"><a href="<?php echo GeoContentHelper::getItemURL($row); ?>" class="modal" rel="{handler: 'iframe', size: {x: 800, y: 400}}">
    					   <?php echo GeoContentHelper::getItemURL($row); ?></a>
    					   </span>
                        <?php else: ?>
                        <?php echo JText::_( 'COM_GEOCONTENT_LINK_EMTPTY' );?>
                        <?php endif; ?>
					</td>
                    <td class="center">
                           <span class="editlinktip hasTip" title="<?php echo JText::_( 'COM_GEOCONTENT_BALLOON_PREVIEW' );?>"><a href="<?php echo GeoContentHelper::getBalloonURL($row); ?>" class="modal" rel="{handler: 'iframe', size: {x: 800, y: 400}}">
                           <?php echo 'preview' ?></a>
                           </span>
                    </td>
                    <td class="center">
                        <?php if ($row->language=='*'):?>
                            <?php echo JText::alt('JALL','language'); ?>
                        <?php else:?>
                            <?php echo $row->language_title ? $this->escape($row->language_title) : JText::_('JUNDEFINED'); ?>
                        <?php endif;?>
                    </td>

                    <td class="center">
                        <?php echo (int) $row->id; ?>
                    </td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
			</table>

		<input type="hidden" name="task" value="item" />
		<input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
