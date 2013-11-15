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
defined('_JEXEC') or die( 'Restricted access' );

// Include la classe base JView
jimport('joomla.application.component.view');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'geocontent.php';


/**
 */
class GeoContentViewLayers extends JView
{

	protected $items;
	protected $pagination;
	protected $state;

	function display($tpl = null) {

        # Load Helper
        $this->loadHelper('GeoContent');

        // Get data from the model
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Get params
        $params = & JComponentHelper::getParams('com_geocontent');
        $this->assignRef('point_icon_folder', $params->get('point_icon_folder'));

        $assetpath = GeoContentHelper::getAssetURL();
        $this->assignRef('assetpath', $assetpath);

        $doc = & JFactory::getDocument();
        $doc->addHeadLink($assetpath . '/css/geocontent.css', 'stylesheet', 'rel', array('type' => 'text/css'));

        // Set the toolbar
        $this->addToolBar();
        parent::display($tpl);

        // Load the submenu.
        GeoContentHelper::addSubmenu(JRequest::getCmd('view', 'layers'));
    }


	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
        require_once JPATH_COMPONENT.'/helpers/geocontent.php';

        $canDo  = GeoContentHelper::getActions();
        $user       = JFactory::getUser();

		JToolBarHelper::title(JText::_('COM_GEOCONTENT_ADMINISTRATION'), 'geocontent' );


        if ($canDo->get('core.edit') || $canDo->get('core.edit.own')){
            JToolBarHelper::editList('layer.edit');
        }

        if ($canDo->get('core.create')){
            JToolBarHelper::addNew('layer.add');
        }

        if ($canDo->get('core.edit.state')){
            JToolBarHelper::publishList('layers.publish');
            JToolBarHelper::unpublishList('layers.unpublish');
        }

        if ($canDo->get('core.delete') || $canDo->get('geocontent.delete.own')){
            JToolBarHelper::deleteList('', 'layers.delete');
        }


        if ($canDo->get('core.admin')){
            JToolBarHelper::divider();
            JToolBarHelper::customX( 'layers.checkdb', 'refresh.png', 'checkdb.png', JText::_('COM_GEOCONTENT_CHECK_DB') ,  false);
	        JToolBarHelper::preferences('com_geocontent', '500');
        }

        JToolBarHelper::divider();
        JToolBarHelper::help(null, false, 'http://www.itopen.it/geocontent_docs/');


	}

}