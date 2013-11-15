<?php
/**
*
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


/**
 */
class GeoContentViewItems extends JView
{

	protected $items;
	protected $pagination;
	protected $state;

	function display($tpl=null)
	{
        # Load Helper
        $this->loadHelper('GeoContent');

        // Load the submenu.
        GeoContentHelper::addSubmenu(JRequest::getCmd('view', 'items'));

		// Get data from the model
        $state = $this->get('State');
		$this->state		= $state;
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

        $this->sortDirection = $state->get('filter_order_Dir');
        $this->sortColumn = $state->get('filter_order');

		// Get params
        $params =& JComponentHelper::getParams('com_geocontent');

		$assetpath 			= GeoContentHelper::getAssetURL();
        $this->assetpath    = $assetpath;

		$doc 				=& JFactory::getDocument();
		$doc->addHeadLink($assetpath.'/css/geocontent.css', 'stylesheet', 'rel', array('type' =>  'text/css'));
		$this->layer_options=  GeoContentHelper::getLayerOptions();

		// Set the toolbar
		$this->addToolBar();

		parent::display($tpl);
	}


	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{

        require_once JPATH_COMPONENT.'/helpers/geocontent.php';


        $canDo  = GeoContentHelper::getActions($this->state->get('filter.layerid'));


        JToolBarHelper::title(JText::_('COM_GEOCONTENT_ITEMS_ADMINISTRATION_TITLE'), 'geocontent-items');

        if ($canDo->get('core.create')){
            JToolBarHelper::addNew('item.add');
        }

        if ($canDo->get('core.edit') || $canDo->get('core.edit.own')){
            JToolBarHelper::editList('item.edit');
        }

        if ($canDo->get('core.delete') || $canDo->get('geocontent.delete.own')){
            JToolBarHelper::deleteList('', 'items.delete');
        }

 		JToolBarHelper::help(null, false, 'http://www.itopen.it/geocontent_docs/');
		JToolBarHelper::preferences('com_geocontent', '500');

	}
}
