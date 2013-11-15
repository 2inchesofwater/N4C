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

// No direct access.
defined('_JEXEC') or die;

// Include the HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'layer.cancel' || document.formvalidator.isValid(document.id('layer-form'))) {
			Joomla.submitform(task, document.getElementById('layer-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_geocontent&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="layer-form" class="form-validate">
	<div class="width-100">
       <?php if($this->canDo->get('core.admin') && !$this->isNew): ?>
        <fieldset class="adminform">
            <legend><?php echo JText::_('Admin'); ?></legend>
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('created_by'); ?>
                <?php echo $this->form->getInput('created_by'); ?></li>
            </ul>
        </fieldset>
        <?php endif; ?>
		<fieldset class="adminform">
		<legend><?php echo JText::_('General informations'); ?></legend>
		<ul class="adminformlist">
            <li><?php echo $this->form->getLabel('id'); ?>
            <?php echo $this->form->getInput('id'); ?></li>
            <li><?php echo $this->form->getLabel('asset_id'); ?>
            <?php echo $this->form->getInput('asset_id'); ?></li>
			<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>
            <li><?php echo $this->form->getLabel('access'); ?>
            <?php echo $this->form->getInput('access'); ?></li>
            <?php if ($this->canDo->get('core.admin')): ?>
                <li><span class="faux-label"><?php echo JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL'); ?></span>
                <div class="button2-left"><div class="blank">
                    <button type="button" onclick="document.location.href='#access-rules';">
                    <?php echo JText::_('JGLOBAL_PERMISSIONS_ANCHOR'); ?></button>
                </div></div>
                </li>
            <?php endif; ?>
			<li><?php echo $this->form->getLabel('published'); ?>
			<?php echo $this->form->getInput('published'); ?></li>
		</ul>
		</fieldset>
		<fieldset class="adminform">
		<legend><?php echo JText::_('COM_GEOCONTENT_COMMON_STYLE_FIELDSET'); ?></legend>

        <?php $params = $this->form->getFieldset('style');
        ?>

    		<ul class="adminformlist">
                <li><?php echo $params['jform_params_icon']->label; ?>
                <?php echo $params['jform_params_icon']->input; ?><img style="float:left;width:<?php echo $this->item->params['iconsize']; ?>px;height:<?php echo $this->item->params['iconsize']; ?>px;" id="icon_preview" src="<?php if ($this->item->params['icon']): ?><?php echo $this->icon_path . $this->item->params['icon'] ?><?php else: ?><?php echo $this->assetpath . '/js/moorainbow/images/blank.gif'?><?php endif; ?>" /></li>
                <li><?php echo $params['jform_params_iconsize']->label; ?>
                <?php echo $params['jform_params_iconsize']->input; ?></li>
                <li><?php echo  $params['jform_params_linergba']->label; ?>
                <?php echo $params['jform_params_linergba']->input; ?><img id="myRlinergba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" /><span style="float:left;margin: 5px 5px 5px 0;"><?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>:</span><?php echo $this->lists['linergbalpha']; ?><?php echo GeoContentHelper::LineStyleHTML($this->item->params['linergba'], $this->item->params['linewidth'], 'linestylergba');?></li>
                <li><?php echo $params['jform_params_linewidth']->label; ?>
                <?php echo $params['jform_params_linewidth']->input; ?></li>
                <li><?php echo $params['jform_params_polyrgba']->label; ?>
                <?php echo $params['jform_params_polyrgba']->input; ?><img id="myRpolyrgba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" /><span style="float:left;margin: 5px 5px 5px 0;"><?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>:</span><?php echo $this->lists['polyrgbalpha']; ?><?php echo GeoContentHelper::PolyStyleHTML($this->item->params['polyrgba'], $this->item->params['linergba'], $this->item->params['linewidth'], 'polystylergba');?></li>
            </ul>
        </fieldset>
        <fieldset class="adminform" id="fieldset_clustering">
        <legend><?php echo JText::_('COM_GEOCONTENT_SELECT_STYLE_CLUSTERING'); ?></legend>

            <ul class="adminformlist">

                <li><?php echo  $params['jform_params_cluster']->label; ?>
                <?php echo $params['jform_params_cluster']->input; ?></li>
            </ul>
        </fieldset>
        <fieldset class="adminform" id="fieldset_olstyle">
        <legend><?php echo JText::_('COM_GEOCONTENT_SELECT_STYLE_FIELDSET'); ?></legend>

            <ul class="adminformlist">

                <li><?php echo  $params['jform_params_select_linergba']->label; ?>
                <?php echo $params['jform_params_select_linergba']->input; ?><img id="myRselect_linergba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" /><span style="float:left;margin: 5px 5px 5px 0;"><?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>:</span><?php echo $this->lists['select_linergbalpha']; ?><?php echo GeoContentHelper::LineStyleHTML($this->item->params['select_linergba'], $this->item->params['select_linewidth'], 'select_linestylergba');?></li>
                <li><?php echo $params['jform_params_select_linewidth']->label; ?>
                <?php echo $params['jform_params_select_linewidth']->input; ?></li>
                <li><?php echo $params['jform_params_select_polyrgba']->label; ?>
                <?php echo $params['jform_params_select_polyrgba']->input; ?><img id="myRselect_polyrgba" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" /><span style="float:left;margin: 5px 5px 5px 0;"><?php echo JText::_( 'COM_GEOCONTENT_OPACITY' ); ?>:</span><?php echo $this->lists['select_polyrgbalpha']; ?><?php echo GeoContentHelper::PolyStyleHTML($this->item->params['select_polyrgba'], $this->item->params['select_linergba'], $this->item->params['select_linewidth'], 'select_polystylergba');?></li>

                <li><?php echo $params['jform_params_show_labels']->label; ?>
                <?php echo $params['jform_params_show_labels']->input; ?></li>
            </ul>
        </fieldset>
        <fieldset class="adminform" id="fieldset_labels">
        <legend><?php echo JText::_('COM_GEOCONTENT_LABELS_FIELDSET'); ?></legend>
            <div class="fltrt" style="border:dotted 1px gray; width: 300px"><span  id="label_preview"><?php echo JText::_('COM_GEOCONTENT_LABEL_PREVIEW'); ?></span></div>
            <div class="fltlft">
            <ul class="adminformlist">
                <?php foreach ($this->form->getFieldset('labels') as $field) : ?>
                    <li><?php echo $field->label; ?>
                    <?php echo $field->input; ?><?php if($field->id == 'jform_params_label_font_color'): ?><img id="myFontColor" src="<?php echo $this->assetpath ; ?>/js/moorainbow/images/rainbow.png" alt="[r]" width="16" height="16" /><?php endif; ?></li>
                <?php endforeach; ?>
            </ul>
            </div>
        </fieldset>
	</div>

    <div class="clr"></div>
    <?php if ($this->canDo->get('core.admin')): ?>
        <div  class="width-100 fltlft">

            <?php echo JHtml::_('sliders.start','permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

            <?php echo JHtml::_('sliders.panel',JText::_('COM_GEOCONTENT_FIELDSET_RULES'), 'access-rules'); ?>
                <fieldset class="panelform">
                    <?php echo $this->form->getLabel('rules'); ?>
                    <?php echo $this->form->getInput('rules'); ?>
                </fieldset>

            <?php echo JHtml::_('sliders.end'); ?>
        </div>
    <?php endif; ?>
    <div>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>

</form>
