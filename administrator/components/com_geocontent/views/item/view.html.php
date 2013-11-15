
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
class GeoContentViewItem extends JView
{
	function display($tpl=null)
	{
        # Load Helper
        $this->loadHelper('GeoContent');

        # Include mootools First!!! (need to be here!)
        JHtml::_('behavior.framework', true);
        JHtml::_('behavior.formvalidation');

		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');

        // Fill defaults
        if(!$item->id) {
            $item->layerid = $form->getValue('layerid');
        }

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;

        $this->isNew  = ($this->item->id == 0);

		// Set the toolbar
		$this->addToolBar();

		$doc 				=& JFactory::getDocument();
		$assetpath 			= GeoContentHelper::getAssetURL();
        $this->assetpath = $assetpath;
		$doc->addHeadLink($assetpath.'/css/geocontent.css', 'stylesheet', 'rel', array('type' =>  'text/css'));

        // Actions
        $this->actions = GeoContentHelper::getActions($this->item->get($item->layerid));

		// Get params
        $params =& JComponentHelper::getParams('com_geocontent');
        $this->point_icon_folder = $params->get('point_icon_folder');

        switch($this->getLayout()) {
            case 'gmap':
                // Get gmapkey
                $google_api_key = $params->get('google_api_key');
                if($google_api_key){
                    $this->google_api_key   = $google_api_key;
                    $this->map_lang        = substr($doc->getLanguage(),0,2);
                    // Start X,Y and Zoomlevel
                    $this->map_latstart     = $params->get('map_latstart') ?  $params->get('map_latstart') : 45;
                    $this->map_lngstart     = $params->get('map_lngstart') ?  $params->get('map_lngstart') : 9;
                    $this->map_zoomstart    = $params->get('map_zoomstart') ?  $params->get('map_zoomstart') : 7;
                    $this->has_editing      = true;
                    $this->jscallback       = 'editorUpdateBounds';

                } else {
                    JError::raiseError(500, 'google_api_key is undefined, please set a Google API key in the GeoContent Options window.');
                    return false;
                }
                // Assign layer info
                // Needed for styles
                if($layerid = JRequest::getInt('layerid')){
                    $this->layer = GeoContentHelper::getLayerData($layerid);
                } else {
                    JError::raiseError(500, 'layerid parameter is missing from the URL call, please file a bug on GeoContent bug tracking system.');
                    return false;
                }
            break;
            case 'olmap':
                // Load form field
                require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'models' . DS . 'fields' . DS . 'olmap.php';
                $olmap_field = new JFormFieldOlmap();
                $olmap_field->setId('geodata');
                $this->olmap_field = $olmap_field->getInput();
                $jscallback       = 'editorUpdateBounds';

                $error_msg = JText::_('COM_GEOCONTENT_ERROR_SAVING');

                $init_map =<<<__JS__

                // Calls parent
                function updateBounds(minlat, minlon, maxlat, maxlon) {
                    parent.updateBounds(minlat, minlon, maxlat, maxlon);
                }

                function save_feature_list(){
                    try {
                        var edit_layer = olmap.getLayersByClass('olwidget.EditableLayer')[0];
                        if(edit_layer.features.length){
                            var extent = edit_layer.getDataExtent().transform(olmap.projection, olmap.displayProjection);
                        } else {
                            var extent = {
                                top: 0,
                                bottom: 0,
                                left: 0,
                                right: 0
                            };
                        }
                        parent.$jscallback($('geodata').value, extent.bottom, extent.left, extent.top, extent.right);
                        parent.SqueezeBox.close();
                    } catch(e) {
                        alert('$error_msg' + '\\n' + '\\n' + e.message);
                    }
                }
                window.addEvent('domready', function(){
                    $('geodata').value =  parent.$('jform_geodata') ? parent.$('jform_geodata').value : '';
                });
__JS__;
                $doc->addScriptDeclaration($init_map);
            break;
            default:
                JText::script('COM_GEOCONTENT_FORM_ERROR_UNACCEPTABLE');
                JText::script('COM_GEOCONTENT_ERROR_EMPTY_GEODATA');
            break;
        }
		// Display the template
		parent::display($tpl);

    }

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{

		JRequest::setVar('hidemainmenu', true);
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
        $isNew      = ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);


		$canDo		= GeoContentHelper::getActions($this->item->layerid);
		JToolBarHelper::title(JText::_('COM_GEOCONTENT_ITEM_ADMINISTRATION_' . ($isNew ? 'ADD' : 'EDIT')), 'geocontent-items');


		// Built the actions for new and existing records.

		// For new records, check the create permission.
		if ($isNew && $canDo->get('core.create')) {
			JToolBarHelper::apply('item.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('item.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('item.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			JToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
            // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
            if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
                JToolBarHelper::apply('item.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::save('item.save', 'JTOOLBAR_SAVE');

                // We can save this record, but check the create permission to see if we can return to make a new one.
                if ($canDo->get('core.create')) {
                    JToolBarHelper::custom('item.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
                }
            }

			// If checked out, we can still save
			if ($canDo->get('core.create')) {
				JToolBarHelper::custom('item.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			}

			JToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help(null, false, 'http://www.itopen.it/geocontent_docs/');

	}

}

