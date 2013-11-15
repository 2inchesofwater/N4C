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

// Impedisce l'accesso diretto al file
defined('_JEXEC') or die('Restricted access');

// Include la classe base JController
jimport('joomla.application.component.controller');

//JLanguage::load(JPATH_COMPONENT_ADMINISTRATOR . DS . 'languages' . DS . );

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'geocontent.php';

class GeoContentController extends JController {

    function display() {
		if(JRequest::getVar('view') === 'editor'){
			return GeoContentController::editor();
		}
        parent::display();
    }

    function editor(){

        //self::$lang = JLanguageHelper::detectLanguage();
        $language = JFactory::getLanguage();
        $language->load('com_geocontent', JPATH_COMPONENT_ADMINISTRATOR);

        $app =& JFactory::getApplication();

		extract( GeoContentHelper::getComponentParamsArray());
		$contentid 	= JRequest::getInt('contentid');
		$layerid 	= JRequest::getInt('layerid');
		$id 		= JRequest::getInt('id');
        $task      	= JRequest::getWord('task');
        $layers     = GeoContentHelper::getEditorVisibleLayers($contentid);
        $layers_add = GeoContentHelper::getEditorVisibleLayers($contentid, true);
        $actions    = GeoContentHelper::getActions($layerid);

        // Check unbound
        // first checks for given layerid...
        $allow_unbound = $actions->get('geocontent.unbound');
        // Then search for at least one layer which allows geocontent.unbound, fallback if not found
        if(!$contentid){
            $_layers = $layers;
            foreach($_layers as $k => $l){
                $layer_actions = GeoContentHelper::getActions($l->id);
                if($layer_actions->get('geocontent.unbound')){
                    $allow_unbound = true;
                } else {
                    unset($layers[$k]);
                }
            }
        }


        if(!$contentid && !$allow_unbound){
            JFactory::getApplication()->enqueueMessage( JText::_( 'COM_GEOCONTENT_UNBOUND_NOT_ALLOWED' ), 'error' );
            $task = 'error';
        }

        // Check config conflict
        if(!$contentid && $allow_unbound && !$actions->get('geocontent.unlinked') && !$actions->get('geocontent.custom_url')){
            $conflict = true;
            $_layers = $layers;
            foreach($_layers as $k => $l){
                $layer_actions = GeoContentHelper::getActions($l->id);
                if($layer_actions->get('geocontent.unlinked') || $layer_actions->get('geocontent.custom_url')){
                    $conflict = false;
                } else {
                    unset($layers[$k]);
                }
            }
            if($conflict){
                JFactory::getApplication()->enqueueMessage( JText::_( 'COM_GEOCONTENT_CUSTOM_URL_UNLINKED_CONFLICT' ), 'error' );
                $task = 'error';
            }
        }

        // Check editable layers exists
        if(!$layers){
            JFactory::getApplication()->enqueueMessage( JText::_( 'COM_GEOCONTENT_NO_EDITABLE_LAYERS_ERROR' ), 'error' );
            $task = 'error';
        }



    	// Decide which view to show:
    	// * new item :  error
    	// * update item without layerid : layer select
    	// * update item with layerid : balloon
    	// * update item with layerid and gmap parameter set: form (map editor)
		// Set the view
		switch ($task) {
			case 'error':
				JRequest::setVar( 'layout'  , 'error');
			break;
			case 'balloon':
            	JRequest::setVar( 'layout'  , 'balloon');
			break;
            case 'form':
			case 'olwidgetform':
            	JRequest::setVar( 'layout'  , 'olwidgetform');
			break;
			case 'layer_list':
                $editable_layers = GeoContentHelper::getEditorVisibleLayers($contentid, !$id);
                if(count($editable_layers) === 1) {
                    $editable_layers_ids = array_keys($editable_layers);
                    JRequest::setVar( 'layerid'  , $editable_layers_ids[0]);
                    JRequest::setVar( 'layout'  , 'balloon');
                } else {
                    JRequest::setVar( 'layout'  , 'layer_list');
                }
			break;
			default:
				// New item
                $editable_layers = GeoContentHelper::getEditorVisibleLayers($contentid, !$id);
				if(!count(GeoContentHelper::getEditableItemData($contentid)))  {
				    if($layerid) {
                        JRequest::setVar( 'layout'  , 'balloon');
                    } // Checks if there is more than one layer to choose from
                    elseif(count($editable_layers) === 1) {
                        $editable_layers_ids = array_keys($editable_layers);
                        JRequest::setVar( 'layerid'  , $editable_layers_ids[0]);
                        JRequest::setVar( 'layout'  , 'balloon');
                    } else {
                        JRequest::setVar( 'layout'  , 'layer_list');
                    }
				} else {
					JRequest::setVar( 'layout'  , 'item_select');
				}
		}

        // Issue a warning when unbound
        if($task == 'editor' && (JRequest::getVar( 'layout' ) == 'layer_list') && !$contentid && GeoContentHelper::getParm('suppress_unbound_warning') != '1'){
            JFactory::getApplication()->enqueueMessage( JText::_( 'COM_GEOCONTENT_UNBOUND_WARNING_MESSAGE' ), 'warning' );
        }

        parent::display();

    }


    private static function _ajax_response($status = 'ok', $msg = ''){
        echo json_encode(array(
            'status' => $status,
            'msg'    => $msg
        ));
        exit;
    }

	/**
	* Save a content item
    *
    * AJAX call
	*/
    function save(){

        $mainframe =& JFactory::getApplication();
		JRequest::checkToken() or die( 'Invalid Token' );

		extract(GeoContentHelper::getComponentParamsArray());

		// Get data
		$id 		= JRequest::getInt('id');
		$layerid 	= JRequest::getInt('layerid');
		$contentid 	= JRequest::getInt('contentid');
        $content 	= JRequest::getVar('content', '', 'post', 'string', JREQUEST_ALLOWRAW);
        $url 		= JRequest::getVar('url');
        $contentname= JRequest::getVar('contentname');
		$geodata 	= JRequest::getVar('geodata');
        $minlat     = JRequest::getVar('minlat');
        $minlon     = JRequest::getVar('minlon');
        $maxlat     = JRequest::getVar('maxlat');
        $maxlon     = JRequest::getVar('maxlon');
		$gpx		= $_FILES['gpx']['tmp_name'];

        $isNew      = !$id;

        // Create data array
        $data = array(
            'id' => $id,
            'layerid' => $layerid,
            'contentid' => $contentid,
            'content' => GeoContentHelper::filterText($content),
            'contentname' => $contentname,
            'geodata' => $geodata,
            'minlat' => $minlat,
            'minlon' => $minlon,
            'maxlat' => $maxlat,
            'maxlon' => $maxlon,
            'gpx' => $gpx,
            'url' => $url
        );

        // Validation
        // To be used in BE too:
        // Check access
        $errors = GeoContentHelper::validate($data);



        if($errors){
            GeoContentController::_ajax_response('error', join(',', $errors));
        }


		// To be used in BE too: add path, probably added by JApplication for FE but not in BE
 		JModel::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'models');
 		$model = $this->getModel('item', 'GeoContentModel');
        $table = $model->getTable();
     	if($table->save($data)) {
                // Send mail to admins
                if($isNew && GeoContentHelper::getParm('warn_admins')){

                    $user = JFactory::getUser();

                    // Messaging for new items
                    JModel::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_messages/models', 'MessagesModel');
                    JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_messages/tables');

                    $db = JFactory::getDbo();
                    $db->setQuery('SELECT id FROM #__users WHERE sendEmail = 1');
                    $users = (array) $db->loadResultArray();

                    $default_language = JComponentHelper::getParams('com_languages')->get('administrator');
                    $debug = JFactory::getConfig()->get('debug_lang');

                    foreach ($users as $user_id)
                    {
                        if ($user_id != $user->id) {
                            // Load language for messaging
                            $receiver = JUser::getInstance($user_id);
                            $lang = JLanguage::getInstance($receiver->getParam('admin_language', $default_language), $debug);
                            $lang->load('com_content');
                            $lang->load('com_geocontent', JPATH_COMPONENT_SITE);
                            $message = array(
                                'user_id_from'  => $user->id ? $user->id : $user_id, // Fake: unknown user
                                'user_id_to'    => $user_id,
                                'subject'       => $lang->_('COM_GEOCONTENT_NEW_ITEM'),
                                'message'       => sprintf($lang->_('COM_GEOCONTENT_ON_NEW_CONTENT'), $user->get('name') ? $user->get('name') : 'Anonymous user', $contentname, $table->id)
                            );
                            $model_message = JModel::getInstance('Message', 'MessagesModel');
                            $model_message->save($message);
                        }
                    }
                }
                GeoContentController::_ajax_response('ok', JText::sprintf("COM_GEOCONTENT_ITEM_SAVED_AS", $table->id));
			} else {
				GeoContentController::_ajax_response('error', JText::_("COM_GEOCONTENT_ERROR_SAVING_ITEM"));
			}
    }

    /**
    * Delete a content item
    *
    * AJAX call
    */
    function delete(){
        $id         = JRequest::getInt('id');
        JRequest::checkToken() or die( 'Invalid Token' );
        $mainframe =& JFactory::getApplication();
        // Check data
        if(!$id){
            GeoContentController::_ajax_response('error', JText::_("COM_GEOCONTENT_ITEM_DOES_NOT_EXISTS"));
        }

        // Check access
        $user =& JFactory::getUser();
        $item = GeoContentHelper::getData($id);
        $actions = GeoContentHelper::getActions($item->layerid);
        if(!$item){
            GeoContentController::_ajax_response('error', JText::_('COM_GEOCONTENT_ITEM_DOES_NOT_EXISTS'));
        }
        if(!($actions->get('core.delete') || ($actions->get('geocontent.delete.own') && $user->get('id') == $item->created_by))) {
            GeoContentController::_ajax_response('error', JText::_('COM_GEOCONTENT_ALERTNOTAUTH'));
        }

        // To be used in BE too: add path, probably added by JApplication for FE but not in BE
        JModel::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'models');
        $model = $this->getModel('item', 'GeoContentModel');
        $table = $model->getTable();
        // Delete item
        if($table->delete($id)){
            GeoContentController::_ajax_response('ok', JText::_("COM_GEOCONTENT_ITEM_DELETED"));
        } else {
            GeoContentController::_ajax_response('error', JText::_("COM_GEOCONTENT_ERROR_DELETING_ITEM"));
        }
    }


}
?>