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

?>
		<h1><?php echo JText::_('COM_GEOCONTENT_CHOOSE_LAYER'); ?></h1>
		<p><?php if($this->layerid) {
          echo JText::_('COM_GEOCONTENT_LAYER_SELECT_EDIT');
        } else {
          echo JText::_('COM_GEOCONTENT_LAYER_SELECT');
        }?></p>
		<form name="layer_form" method="post">
		<table class="adminlist" id="gc_layer_table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>#ID</th>
					<th><?php echo JText::_('COM_GEOCONTENT_NAME'); ?></th>
					<th colspan="3"><?php echo JText::_('COM_GEOCONTENT_STYLE'); ?></th>
				</tr>
			</thead>
			<tbody>

		<?php if($this->layerid) { ?>
		<tfoot>
			<tr><td colspan="6"><span class="current-layer">&nbsp;&nbsp;&nbsp;&nbsp;</span> : <?php echo JText::_('COM_GEOCONTENT_CURRENT'); ?></td></tr>
		</tfoot>

		<?php } ?>
		<?php

			foreach($this->layers as $l) {
				$even = true;
				?>
				<tr <?php if($this->layerid && $l->id == $this->layerid) { ?>class="current-layer"<?php }?>>
					<td class="row<?php echo $even ? 0 : 1; ?>"><button type="submit" name="layerid" value="<?php echo $l->id ?>"><?php echo JText::_('COM_GEOCONTENT_SELECT'); ?></button></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $l->id ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $l->name ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><img src="<?php echo GeoContentHelper::getIconURL($l->icon);?>" alt="Icon" height="16" /></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo GeoContentHelper::LineStyleHTML($l->linergba, $l->linewidth, 'lsrgba-' . $l->id);?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo GeoContentHelper::PolyStyleHTML($l->polyrgba, $l->linergba, $l->linewidth, 'polystylergba-' . $l->id);?></td>
				</tr>
				<?php
				$even = ! $even;
			}
		?>
		</tbody>
		</table>
            <input type="hidden" name="task" value="balloon" />
            <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
            <input type="hidden" name="contentid" value="<?php echo $this->contentid; ?>" />
            <input type="hidden" name="map_lngstart" value="<?php echo $this->map_lngstart; ?>" />
            <input type="hidden" name="map_latstart" value="<?php echo $this->map_latstart; ?>" />
		</form>
