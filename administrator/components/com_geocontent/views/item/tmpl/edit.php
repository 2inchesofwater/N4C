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
JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">

    function updateBounds(minlat, minlon, maxlat, maxlon){
        $('jform_minlat').set('value', minlat);
        $('jform_maxlat').set('value', maxlat);
        $('jform_minlon').set('value', minlon);
        $('jform_maxlon').set('value', maxlon);
    }


    // Callback from Map editors
    function editorUpdateBounds(wkt, minlat, minlon, maxlat, maxlon){
        if(wkt.match(/SRID=\d+;/)){
            wkt = wkt.replace(/SRID=\d+;/, '');
        }
        $('jform_geodata').set('value', wkt);
        updateBounds(minlat, minlon, maxlat, maxlon);
        edit_layer.readWKT();
    }

    Joomla.submitbutton = function(task)
    {
        var form = document.adminForm;
        if (task == 'item.cancel') {
            Joomla.submitform(task);
            return true;
        }
        if (task == '')
        {
            return false;
        }
        else
        {
            var isValid=true;
            var action = task.split('.');
            if (action[1] != 'cancel' && action[1] != 'close')
            {
                var forms = $$('form.form-validate');
                for (var i=0;i<forms.length;i++)
                {
                    if (!document.formvalidator.isValid(forms[i]))
                    {
                        isValid = false;
                        break;
                    }
                }
            }

            // ABP: Custom
            if(!($('jform_geodata').value || $('jform_gpx').value)) {
                alert(Joomla.JText._('COM_GEOCONTENT_ERROR_EMPTY_GEODATA','Please add at least one geometry: point, line or polygon or load a GPX file'));
                return false;
            }

            if (isValid)
            {
                Joomla.submitform(task);
                return true;
            }
            else
            {
                alert(Joomla.JText._('COM_GEOCONTENT_FORM_ERROR_UNACCEPTABLE','Some values are unacceptable'));
                return false;
            }
        }
    }

	jSelectArticle_jform_url = function(id, title, category ){
        $('jform_contentname').set('value', title);
        $('jform_contentid').set('value', id);
        //$('jform_url').set('disabled', 'disabled');
        //$('jform_url').classList.add('readonly');
        SqueezeBox.close();
	}

    jSelectArticle_jform_url_clear = function(){
        $('jform_contentname').set('value', '');
        $('jform_contentid').set('value', '');
        //$('jform_url').set('disabled', '');
        //$('jform_url').classList.remove('readonly');

    }

</script>
<form action="<?php echo JRoute::_('index.php?option=com_geocontent&layout=edit&view=item&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-100">

        <?php if($this->actions->get('core.admin') && !$this->isNew): ?>
        <fieldset class="adminform">
            <legend><?php echo JText::_('Admin'); ?></legend>
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('created_by'); ?>
                <?php echo $this->form->getInput('created_by'); ?></li>
            </ul>
        </fieldset>
        <?php endif; ?>

		<fieldset class="adminform">
		<legend><?php echo JText::_('Balloon'); ?></legend>
		<ul class="adminformlist">
		    <li><span class="fltlft"><?php echo $this->form->getLabel('contentid'); ?>
			<?php echo $this->form->getInput('contentid'); ?>&nbsp;</span>
		        <div class="button2-left">
                    <div class="blank">
                        <a rel="{handler: 'iframe', size: {x: 800, y: 450}}" href="index.php?option=com_content&amp;view=articles&amp;layout=modal&amp;tmpl=component&amp;function=jSelectArticle_jform_url" title="Select or Change article" class="modal"><?php echo JText::_('COM_GEOCONTENT_CHANGE_ARTICLE_BUTTON'); ?></a>
                    </div>
                </div>
		        <div class="button2-left">
                    <div class="blank">
                        <a href="javascript:void(0);" onclick="jSelectArticle_jform_url_clear()"><?php echo JText::_('JCLEAR'); ?></a>
                    </div>
                </div>
            </li>
            <li><?php echo $this->form->getLabel('language'); ?>
            <?php echo $this->form->getInput('language'); ?></li>
			<li><?php echo $this->form->getLabel('contentname'); ?>
			<?php echo $this->form->getInput('contentname'); ?></li>
			<li><?php echo $this->form->getLabel('url'); ?>
			<?php echo $this->form->getInput('url'); ?></li>
			<li><?php echo $this->form->getLabel('content'); ?>
			<div style="clear:both;"><?php echo $this->form->getInput('content'); ?></div></li>
		</ul>
		</fieldset>

		<fieldset class="adminform">
		<legend><?php echo JText::_('Geodata'); ?></legend>
    		<ul class="adminformlist">
                <li><?php echo $this->form->getLabel('layerid'); ?>
                <?php echo $this->form->getInput('layerid'); ?></li>
                <li><?php echo $this->form->getLabel('gpx'); ?>
                <?php echo $this->form->getInput('gpx'); ?></li>
                <li><?php echo $this->form->getLabel('minlat'); ?>
                <?php echo $this->form->getInput('minlat'); ?></li>
                <li><?php echo $this->form->getLabel('maxlat'); ?>
                <?php echo $this->form->getInput('maxlat'); ?></li>
                <li><?php echo $this->form->getLabel('minlon'); ?>
                <?php echo $this->form->getInput('minlon'); ?></li>
                <li><?php echo $this->form->getLabel('maxlon'); ?>
                <?php echo $this->form->getInput('maxlon'); ?></li>
                <li><?php echo $this->form->getLabel('geodata'); ?>
                <?php echo $this->form->getInput('geodata'); ?></li>
                <li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
            </ul>
        </fieldset>

        <input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
    <script type="text/javascript">
        // Used by Gmap only, atm
        $('jform_layerid').addEvent('change', function(evt){
            $$('a.modal.map_editor').each(function(elm){
                var uri = elm.href.toURI();
                var qs = uri.get('query').parseQueryString();
                qs.layerid = evt.target.value;
                uri.setData(qs);
                elm.set('href', uri.toString());
            });
        });
    </script>
</form>