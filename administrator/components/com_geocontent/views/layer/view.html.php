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


// Impedisce l'accesso diretto al file
defined('_JEXEC') or die( 'Restricted access' );

// Include la classe base JView
jimport('joomla.application.component.view');


/**
 */
class GeoContentViewLayer extends JView
{
	function display($tpl=null)
	{
        # Load Helper
        $this->loadHelper('GeoContent');

        # Include mootools First!!!
        JHtml::_('behavior.framework', true);

		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;

        // Add default params
        if(!$item->params){
            $params = $this->form->getGroup('params');
            foreach($params as $p){
                $item->params[$p->fieldname] = $p->value;
            }
        }
        $this->item = $item;

        $this->isNew  = ($this->item->id == 0);


		// Set the toolbar
		$this->addToolBar($this->item->id);

        // Permissions
        $this->canDo = GeoContentHelper::getActions();

        // GeoContent part
		// Get params
        $params =& JComponentHelper::getParams('com_geocontent');
        $this->assignRef('point_icon_folder', $params->get('point_icon_folder'));

		$assetpath 			= GeoContentHelper::getAssetURL();
        $this->assignRef('assetpath', $assetpath);

		$doc 				=& JFactory::getDocument();
		$doc->addHeadLink($assetpath.'/css/geocontent.css', 'stylesheet', 'rel', array('type' =>  'text/css'));
        for($i = 255; $i >= 0; $i-=2){
            $l[$i] = new StdClass();
            $l[$i]->value = dechex($i);
            $l[$i]->label = sprintf("%01.1f %%", 100 * $i / 255 );
        }
        $lists['linergbalpha'] = JHTML::_('select.genericlist' , $l, 'linergbalpha', array('onchange' => "update_alpha('line');"), 'value', 'label', $this->_getAlpha($item->params['linergba']), 'linergbalpha');
        $lists['polyrgbalpha'] = JHTML::_('select.genericlist' , $l, 'polyrgbalpha', array('onchange' => "update_alpha('poly')"), 'value', 'label', $this->_getAlpha($item->params['polyrgba']), 'polyrgbalpha');
        $lists['select_linergbalpha'] = JHTML::_('select.genericlist' , $l, 'select_linergbalpha', array('onchange' => "update_alpha('line', 'select_');"), 'value', 'label', $this->_getAlpha($item->params['select_linergba']), 'select_linergbalpha');
        $lists['select_polyrgbalpha'] = JHTML::_('select.genericlist' , $l, 'select_polyrgbalpha', array('onchange' => "update_alpha('poly', 'select_')"), 'value', 'label', $this->_getAlpha($item->params['select_polyrgba']), 'select_polyrgbalpha');

        for($i = 0; $i <= 10; $i++){
            $lw[$i] = new StdClass();
            $lw[$i]->value = $i;
            $lw[$i]->label = $i . ' pixel';
        }

        $this->assign('icon', $item->params['icon']);

        $lists['linewidth'] = JHTML::_('select.genericlist' , $lw, 'linewidth', array('onchange' => "set_lwidth()"), 'value', 'label', $item->params['linewidth'], 'linewidth');
        $this->assign('polyrgbaopacity', $this->_getAlphaFloat($item->params['polyrgba']));
        $this->assign('linergbaopacity', $this->_getAlphaFloat($item->params['linergba']));
        //vardie($this);
        $lists['select_linewidth'] = JHTML::_('select.genericlist' , $lw, 'select_linewidth', array('onchange' => "set_lwidth('select_')"), 'value', 'label', $item->params['select_linewidth'], 'select_linewidth');
        $this->assign('select_polyrgbaopacity', $this->_getAlphaFloat($item->params['select_polyrgba']));
        $this->assign('select_linergbaopacity', $this->_getAlphaFloat($item->params['select_linergba']));


        if($this->item->id) {
            $poly_start = array(
                hexdec(substr($this->item->params['polyrgba'], 0, 2)),
                hexdec(substr($this->item->params['polyrgba'], 2, 2)),
                hexdec(substr($this->item->params['polyrgba'], 4, 2))
            );
            $line_start = array(
                hexdec(substr($this->item->params['linergba'], 0, 2)),
                hexdec(substr($this->item->params['linergba'], 2, 2)),
                hexdec(substr($this->item->params['linergba'], 4, 2))
            );
            $label_start = array(
                hexdec(substr($this->item->params['label_font_color'], 1, 2)),
                hexdec(substr($this->item->params['label_font_color'], 3, 2)),
                hexdec(substr($this->item->params['label_font_color'], 5, 2))
            );
            $select_poly_start = array(
                hexdec(substr($this->item->params['select_polyrgba'], 0, 2)),
                hexdec(substr($this->item->params['select_polyrgba'], 2, 2)),
                hexdec(substr($this->item->params['select_polyrgba'], 4, 2))
            );
            $select_line_start = array(
                hexdec(substr($this->item->params['select_linergba'], 0, 2)),
                hexdec(substr($this->item->params['select_linergba'], 2, 2)),
                hexdec(substr($this->item->params['select_linergba'], 4, 2))
            );
        } else {
            $this->item->params['iconsize'] = 32;
            $poly_start = array(100 , 0, 0);
            $line_start = array(100 , 0, 0);
            $select_line_start = array(100 , 0, 0);
            $select_poly_start = array(100 , 0, 0);
            $label_start= array(100 , 0, 0);
        }

        $this->line_start = join(', ', $line_start);
        $this->poly_start = join(', ', $poly_start);
        $this->select_line_start = join(', ', $select_line_start);
        $this->select_poly_start = join(', ', $select_poly_start);
        $this->label_start= join(', ', $label_start);
        $icon_path = JURI::root();
        $this->assign('icon_path', $icon_path);
        $this->assign('lists', $lists);

        $js =<<<__JS__

    function dec2hex(dec){
        dec = parseInt(dec);
        dec.toString(16)
    }

    function hex2dec(hex){
            return parseInt(hex, 16);
    }

    // Parse a 2 digit hex and return a 0-1 float
    function getalpha (id) {
        if($(id).value){
            return (hex2dec($(id).value) / 255);
        }
        return 1;
    }

    function set_lwidth(prefix){
        var prefix = prefix || '';
        $(prefix + 'polystylergba').setStyle('border-width' , $(prefix + 'linewidth').value + 'px');
        $(prefix+ 'linestylergba').setStyle('height' , $(prefix + 'linewidth').value + 'px');
    }

    function update_alpha(ftype, prefix){
        var prefix = prefix || '';
        $(prefix + ftype + 'stylergba').setStyle('opacity', getalpha(ftype + 'rgbalpha'));
        $('jform_params_' + prefix + ftype + 'rgba').value = $('jform_params_' + prefix + ftype + 'rgba').value.substring(0,6) + $(prefix + ftype + 'rgbalpha').value;
    }

    function update_label_preview(){
        $('label_preview').setStyle('color', $('jform_params_label_font_color').value);
        $('label_preview').setStyle('font-family', $('jform_params_label_font_family').value);
        $('label_preview').setStyle('font-size', $('jform_params_label_font_size').value);
        $('label_preview').setStyle('font-weight', $('jform_params_label_font_weight').value);
        var opacity = parseFloat($('jform_params_label_font_opacity').value)/100;
        opacity = opacity.toString();
        $('label_preview').setStyle('opacity', opacity);
    }


    window.addEvent('load', function(){
        $('jform_params_show_labels').addEvent('change', function(evt){
            if(evt.target.value == '1') {
                $('fieldset_labels').slide('in');
            } else {
                $('fieldset_labels').slide('out');
            }
        });

        if($('jform_params_show_labels').value != '1') {
            $('fieldset_labels').slide('out');
        }

        var r = new MooRainbow('myRlinergba', {
            'startColor': [{$this->line_start}],
            id : 'mr1',
            imgPath: '{$this->assetpath}/js/moorainbow/images/',
            onChange : function(color) {
                    $('jform_params_linergba').value = color.hex.substring(1,7) + $('linergbalpha').value;
                    $('linestylergba').setStyle('background-color', '#' + color.hex.substring(1,7));
                    $('linestylergba').setStyle('opacity', getalpha('linergbalpha'));
                    $('polystylergba').setStyle('border-color', '#' + $('jform_params_linergba').value.substring(0,6));
            }
        });
        var r2 = new MooRainbow('myRpolyrgba', {
            'startColor': [{$this->poly_start}],
            id : 'mr2',
            imgPath: '{$this->assetpath}/js/moorainbow/images/',
            onChange : function(color) {
                    $('jform_params_polyrgba').value = color.hex.substring(1,7) + $('polyrgbalpha').value;
                    $('polystylergba').setStyle('border-color', '#' + $('jform_params_linergba').value.substring(0,6));
                    $('polystylergba').setStyle('background-color', '#' + color.hex.substring(1,7));
                    $('polystylergba').setStyle('opacity', getalpha('polyrgbalpha'));
            }
        });
        var r3 = new MooRainbow('myFontColor', {
            'startColor': [{$this->label_start}],
            id : 'mr3',
            imgPath: '{$this->assetpath}/js/moorainbow/images/',
            onChange : function(color) {
                    console.log(color);
                    $('jform_params_label_font_color').value = color.hex;
                    update_label_preview();
            }
        });

        var r4 = new MooRainbow('myRselect_linergba', {
            'startColor': [{$this->select_line_start}],
            id : 'mr4',
            imgPath: '{$this->assetpath}/js/moorainbow/images/',
            onChange : function(color) {
                    $('jform_params_select_linergba').value = color.hex.substring(1,7) + $('select_linergbalpha').value;
                    $('select_linestylergba').setStyle('background-color', '#' + color.hex.substring(1,7));
                    $('select_linestylergba').setStyle('opacity', getalpha('select_linergbalpha'));
                    $('select_polystylergba').setStyle('border-color', '#' + $('jform_params_select_linergba').value.substring(0,6));
            }
        });
        var r5 = new MooRainbow('myRselect_polyrgba', {
            'startColor': [{$this->select_poly_start}],
            id : 'mr5',
            imgPath: '{$this->assetpath}/js/moorainbow/images/',
            onChange : function(color) {
                    $('jform_params_select_polyrgba').value = color.hex.substring(1,7) + $('select_polyrgbalpha').value;
                    $('select_polystylergba').setStyle('border-color', '#' + $('jform_params_select_linergba').value.substring(0,6));
                    $('select_polystylergba').setStyle('background-color', '#' + color.hex.substring(1,7));
                    $('select_polystylergba').setStyle('opacity', getalpha('select_polyrgbalpha'));
            }
        });


        $('jform_params_label_font_family').addEvent('change', function(e){
            update_label_preview();
        });

        $('jform_params_label_font_weight').addEvent('change', function(e){
            update_label_preview();
        });

        $('jform_params_label_font_size').addEvent('change', function(e){
            update_label_preview();
        });

        $('jform_params_label_font_opacity').addEvent('change', function(e){
            update_label_preview();
        });

        // Load initial values
        $('polystylergba').setStyle('opacity', '{$this->polyrgbaopacity}');
        $('linestylergba').setStyle('opacity', '{$this->linergbaopacity}');
        $('select_polystylergba').setStyle('opacity', '{$this->select_polyrgbaopacity}');
        $('select_linestylergba').setStyle('opacity', '{$this->select_linergbaopacity}');
        if('{$this->icon}') {
            $('icon_preview').setStyle('background-image', '{$this->icon}');
        }

        //On change on the selects

        $('jform_params_linewidth').addEvent('change', function(e){
            $('linestylergba').setStyle('height', e.target.value + 'px');
            $('polystylergba').setStyle('border-width', e.target.value + 'px');
        });
        $('jform_params_select_linewidth').addEvent('change', function(e){
            $('select_linestylergba').setStyle('height', e.target.value + 'px');
            $('select_polystylergba').setStyle('border-width', e.target.value + 'px');
        });

        $('jform_params_icon').addEvent('change', function(){
            $('jform_params_icon').onchange();
        });

        $('jform_params_iconsize').addEvent('change', function(e){
            $('icon_preview').setStyle('width', e.target.value + 'px');
            $('icon_preview').setStyle('height', e.target.value + 'px');
        });

        update_label_preview();

    });

__JS__;

        $doc->addScriptDeclaration($js);
        $doc->addHeadLink($assetpath .'/js/moorainbow/mooRainbow.css', 'stylesheet', 'rel', array('type' =>  'text/css'));
        $doc->addScript($assetpath .'/js/moorainbow/mooRainbow.js');
        // End GeoContent part

		// Display the template
		parent::display($tpl);

    }


	/**
	 * Setting the toolbar
	 */
	protected function addToolBar($isNew)
	{

        JRequest::setVar('hidemainmenu', true);
        $user       = JFactory::getUser();
        $userId     = $user->get('id');
        $isNew      = ($this->item->id == 0);
        $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
        $canDo      = GeoContentHelper::getActions($this->item->id);

        JToolBarHelper::title(JText::_('COM_GEOCONTENT_LAYER_ADMINISTRATION_'.($checkedOut ? 'VIEW_ARTICLE' : ($isNew ? 'ADD' : 'EDIT'))), 'geocontent-layers');

        JToolBarHelper::save('layer.save', 'JTOOLBAR_SAVE');
        JToolBarHelper::apply('layer.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::cancel('layer.cancel','JTOOLBAR_CANCEL');
	}


    // Return HEX 2-digit alpha
	function _getAlpha($data){
        if(strlen($data) != 8){
            return 'FF';
        }
        return substr($data, 6);
	}

    // Return Float alpha 0-1 range
	function _getAlphaFloat($data){
        return hexdec($this->_getAlpha($data)) / 255;
	}

}