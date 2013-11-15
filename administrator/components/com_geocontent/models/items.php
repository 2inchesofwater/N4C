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
defined('_JEXEC') or die();

// Include la classe base JModel
jimport('joomla.application.component.modellist');


require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'geocontent.php';


class GeoContentModelItems extends JModelList {


	/**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings. Add the ordering filtering fields white list.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'contentid', 'a.contentid',
				'layerid', 'a.layerid',
				'contentname', 'a.contentname',
                'language', 'a.language', 'author', 'a.created_by', 'created_by'
			);
		}

		parent::__construct($config);
	}


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// Load the filter state.
		$layerid = $this->getUserStateFromRequest($this->context.'.filter.layerid', 'filter_layerid');
		$this->setState('filter.layerid', $layerid);

        $language = $this->getUserStateFromRequest($this->context.'.filter.language', 'filter_language', '');
        $this->setState('filter.language', $language);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_geocontent');
		$this->setState('params', $params);

        $filter_order = JRequest::getCmd('filter_order');
        $filter_order_Dir = JRequest::getCmd('filter_order_Dir');

        $this->setState('filter_order', $filter_order);
        $this->setState('filter_order_Dir', $filter_order_Dir);


		// List state information. Pass default ordering
		parent::populateState('a.contentname', 'asc');
	}


	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}



	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.contentname, a.created_by, ' .
				'a.layerid, a.contentid,' .
                'a.checked_out, a.checked_out_time,' .
				'a.url, u.username AS author, a.language, c.catid AS catid, c.title AS article_title'
			)
		);
		$query->from('#__geocontent_item AS a');
        $query->join('LEFT', '#__users AS u ON a.created_by = u.id');
        $query->join('LEFT', '#__content AS c ON a.contentid = c.id');

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('a.contentname LIKE '.$search);
			}
		}

        // Join over the language
        $query->select('l.title AS language_title');
        $query->join('LEFT', '`#__languages` AS l ON l.lang_code = a.language');

        // Filter by layerid in title
        $layerid = $this->getState('filter.layerid');
        if (!empty($layerid)) {
            $query->where('a.layerid = '.(int) $layerid);
        }


        // Join over the users for the checked out user.
        $query->select('uc.name AS editor');
        $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');


        // Filter on the language.
        if ($language = $this->getState('filter.language')) {
            $query->where('a.language = '.$db->quote($language));
        }

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		return $query;
	}

}
