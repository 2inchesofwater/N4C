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


class GeoContentModelLayers extends JModelList {


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
				'name', 'a.name',
				'ordering', 'a.ordering',
				'state', 'a.state', 'author', 'a.created_by'
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

		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_geocontent');
		$this->setState('params', $params);

		// List state information. Pass default ordering
		parent::populateState('name', 'asc');

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
				'a.id, a.name,' .
				'a.params,' .
				'a.ordering, a.published,' .
                'a.checked_out, a.checked_out_time,' .
                'u.username AS author,' .
                'a.created_by'
			)
		);
		$query->from('`#__geocontent_layer` AS a');

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.published = '.(int) $published);
		} else if ($published === '') {
			$query->where('(a.published IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('a.name LIKE '.$search);
			}
		}

        $query->join('LEFT', '#__users AS u ON a.created_by = u.id');

        // Join over the users for the checked out user.
        $query->select('uc.name AS editor');
        $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','jos_',$query));
		//die();
		return $query;
	}



    /**
    * Return number of orphan items deleted
    */
	function checkdb() {
        $db     =& JFactory::getDBO();
        $query = 'SELECT i.id AS geocontentid FROM #__geocontent_item AS i LEFT JOIN #__content AS c ON c.id = i.contentid WHERE c.id IS NULL AND i.contentid IS NOT NULL AND i.contentid > 0';
        $db->setQuery( $query );
		if (!$db->query()) {
			$this->setError( $db->getErrorMsg() );
			return false;
		}
		$ol = $db->loadObjectList();
		foreach($ol as $item){
            $query = 'DELETE FROM #__geocontent_item WHERE id = ' . $item->geocontentid;
            $db->setQuery( $query );
            if (!$db->query()) {
                $this->setError( $db->getErrorMsg() );
                return false;
            }
		}
		return count($ol);
	}

}
?>