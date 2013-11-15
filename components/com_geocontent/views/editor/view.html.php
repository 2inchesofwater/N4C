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

/**
* This handles layer_list selection and balloon tasks ("default" and "balloon")
*/


defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.view');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'geocontent.php';


class GeoContentViewEditor extends JView {
    static $lang;

    function display($tpl = null) {

		$mainframe = JFactory::getApplication();

        # Include mootools First!!!
        JHtml::_('behavior.framework', true);

        // Get id from request
        $contentid  = JRequest::getInt('contentid');
        $id 		= JRequest::getInt('id');

        // Read data for item
        $itemdata	= GeoContentHelper::getEditableItemData($contentid); // 0 or n items from an article id
        $data		= GeoContentHelper::getData($id); // Single item from item id

        // Read from request, overwriting
        if($data){
            // If we are selecting the layer and a GeoContent item was selected for editing
            // we are going to show the "current" layer and ignore the query string one.
            if('layer_list' === $this->getLayout()){
                $layerid = $data->layerid;
            } else {
                $layerid    = JRequest::getInt('layerid');
                if(!$layerid){
                    $layerid = $data->layerid;
                }
            }
            $url        = JRequest::getVar('url', $data->url);
            $contentname= JRequest::getVar('contentname', $data->contentname);
            $content    = JRequest::getVar('content', $data->content, 'post', 'string', JREQUEST_ALLOWRAW);
            $geodata    = JRequest::getVar('geodata', $data->geodata);
        } else {
            $layerid    = JRequest::getInt('layerid');
            $url        = JRequest::getVar('url');
            $contentname= JRequest::getVar('contentname');
            $content    = JRequest::getVar('content', '', 'post', 'string', JREQUEST_ALLOWRAW);
            $geodata    = JRequest::getVar('geodata');
        }

		// Default contentname
        if(!$contentname && $contentid) {
			$contentname = GeoContentHelper::getOriginalName($contentid);
        }

		// Assign
		$params = GeoContentHelper::getComponentParamsArray();
		extract($params);
        $this->assign($params);
        // Last parameter is add_only flag :
		$this->assign('layers', GeoContentHelper::getEditorVisibleLayers($contentid, !$id));
		$this->assignRef('item', $data);
		$this->assign('id', $id);
		$this->assignRef('items', $itemdata);

		$assetpath          = GeoContentHelper::getAssetURL();

		// Add CSS
	    $doc		=& JFactory::getDocument();
		$doc->addStyleSheet($assetpath . '/css/geocontent.css');

        $this->assignRef('assetpath', $assetpath);
        $this->assign('layerid', $layerid);
        $editor     = & JFactory::getEditor();
        $this->assignRef('editor',      $editor);
        $this->assign('contentid', $contentid);

        // Assign balloon data
        $this->assign('content', $content);
        $this->assign('url', $url);
        $this->assign('contentname', $contentname);

        // No entities!
        // FE/BE
        $this->assign('saveurl', JURI::base() . '?option=com_geocontent&view=editor&task=save');
        $this->assign('deleteurl', JURI::base() . '?option=com_geocontent&view=editor&task=delete');
        $this->assign('map_lang', substr($doc->getLanguage(),0,2) );
        // Start X,Y and Zoomlevel
        $this->assign('map_latstart', $map_latstart ?  $map_latstart : 45);
        $this->assign('map_lngstart', $map_lngstart ?  $map_lngstart : 9);
        $this->assign('map_zoomstart', $map_zoomstart ?  $map_zoomstart : 7);
        $this->assign('has_editing', true);
        $this->assign('update_geodata', 'parent.document.adminForm.geodata');
        $this->assign('update_minlat', 'parent.document.adminForm.minlat');
        $this->assign('update_maxlat', 'parent.document.adminForm.maxlat');
        $this->assign('update_minlon', 'parent.document.adminForm.minlon');
        $this->assign('update_maxlon', 'parent.document.adminForm.maxlon');

        //////////////////////////////////
        // Validate input and show map editor


        if('olwidgetform' === $this->getLayout()) {
            // validate
            $errors = GeoContentHelper::validate(compact('contentid', 'layerid', 'url', 'contentname', 'content'));
            if($errors){
                foreach($errors as $error){
                    JFactory::getApplication()->enqueueMessage( $error, 'error' );
                }
            } else {
                // Load form field
                require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'models' . DS . 'fields' . DS . 'olmap.php';
                $doc->addScript($assetpath . '/js/iFrameFormRequest.js');
                $olmap_field = new JFormFieldOlmap();
                $olmap_field->setId('geodata');
                $olmap_field->setValue($geodata);
                $this->olmap_field = $olmap_field->getInput();
                $jscallback       = 'editorUpdateBounds';
                $error_msg = JText::_('COM_GEOCONTENT_ERROR_SAVING');
            }
        }
        //////////////////////////////////

		parent::display($tpl);

	}

}