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
    <script type="text/javascript">
        function gc_delete_item(id){
            if(confirm('<?php echo JText::_('COM_GEOCONTENT_DELETE_CONFIRM'); ?>')){
                var options = {};
                options.method = 'post';
                options.url = '<?php echo $this->deleteurl; ?>';
                options.onRequest = function(){
                    new Fx.Tween('gci_' + id,{
                        duration:300
                    }).start('background-color', '#fb6c6c');
                };
                options.onComplete = function(response) {
                    response = JSON.decode(response);
                    alert(response.msg);
                    if(response.status == 'ok'){
                        new Fx.Slide('gci_' + id,{
                            duration:300,
                            onComplete: function() {
                                $('gci_' + id).dispose();
                            }
                        }).slideOut();
                    }
                };

                var myRequest = new Request(options).send(
                    'id=' + id
                    +'&fe=1'
                    + '&<?php echo JUtility::getToken(); ?>=1'

                );
            }
        }

        window.addEvent('domready', function(){
            $$('.cg_delete').addEvent('click', function(evt){
                evt.preventDefault();
                gc_delete_item(evt.target.value);
            });
        });

    </script>
		<form name="layer_form" method="post">

        <?php
        // Get the list of items
            foreach($this->items as $i) {
                $i->layer_data = GeoContentHelper::getLayerData($i->layerid);
            }
        ?>

        <?php if(count($this->items)) : ?>
            <h1><?php echo JText::_('COM_GEOCONTENT_CHOOSE_ITEM_TO_EDIT_OR_ADD'); ?></h1>
            <p><?php echo JText::_('COM_GEOCONTENT_ITEM_SELECT_OR_ADD'); ?></p>
            <p>
                <button type="submit" name="id" value=""><?php echo JText::_('COM_GEOCONTENT_NEW_ITEM'); ?></button>
            </p>
         <?php else: ?>
              <h1><?php echo JText::_('COM_GEOCONTENT_CHOOSE_ITEM_TO_EDIT'); ?></h1>
              <p><?php echo JText::_('COM_GEOCONTENT_ITEM_SELECT'); ?></p>
        <?php endif; ?>

		<table class="adminlist" >
			<thead>
				<tr>
					<th>&nbsp;</th>
                    <th>&nbsp;</th>
					<th>#ID</th>
                    <th><?php echo JText::_('JAUTHOR'); ?></th>
					<th><?php echo JText::_('COM_GEOCONTENT_TITLE'); ?></th>
					<th><?php echo JText::_('COM_GEOCONTENT_LAYER'); ?></th>
					<th colspan="3"><?php echo JText::_('COM_GEOCONTENT_STYLE'); ?></th>
				</tr>
			</thead>
			<tbody>
		<?php
			$even = true;
			foreach($this->items as $i) {
                $canDelete = $i->canDelete;
                $canEdit = $i->canEdit;
                $l = $i->layer_data;
				?>
				<tr id="gci_<?php echo $i->id ?>">
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php if($canEdit): ?><button type="submit" name="id" value="<?php echo $i->id ?>"><?php echo JText::_('COM_GEOCONTENT_EDIT'); ?></button><?php else: ?>&nbsp;<?php endif; ?></td>
                    <td class="row<?php echo $even ? 0 : 1; ?>"><?php if($canDelete) : ?><button type="submit" class="cg_delete" name="delete" value="<?php echo $i->id; ?>"><?php echo JText::_('COM_GEOCONTENT_DELETE'); ?></button><?php else: ?>&nbsp;<?php endif; ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $i->id ?></td>
                    <td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $i->author ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $i->contentname ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo $l->name ?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><img src="<?php echo GeoContentHelper::getIconURL($l->icon);?>" alt="Icon" height="16" /></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo GeoContentHelper::LineStyleHTML($l->linergba, $l->linewidth, 'lsrgba-' . $i->id);?></td>
					<td class="row<?php echo $even ? 0 : 1; ?>"><?php echo GeoContentHelper::PolyStyleHTML($l->polyrgba, $l->linergba, $l->linewidth, 'polystylergba-' . $i->id);?></td>
				</tr>
				<?php
				$even = ! $even;
			}
		?></tbody>
		</table>
            <input type="hidden" name="task" value="layer_list" />
            <input type="hidden" name="contentid" value="<?php echo $this->contentid; ?>" />
            <input type="hidden" name="layerid" value="<?php echo $this->layerid; ?>" />
            <input type="hidden" name="map_lngstart" value="<?php echo $this->map_lngstart; ?>" />
            <input type="hidden" name="map_latstart" value="<?php echo $this->map_latstart; ?>" />
		</form>
