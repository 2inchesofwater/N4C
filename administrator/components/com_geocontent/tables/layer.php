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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 */
class GeoContentTableLayer extends JTable
{

	function __construct( &$_db )
	{
		parent::__construct( '#__geocontent_layer', 'id', $_db );

		$now =& JFactory::getDate();
		$this->set( 'date', $now->toMySQL() );
	}


    /**
     * Overriden JTable::store and user id.
     *
     * @param   boolean True to update fields even if they are null.
     *
     * @return  boolean True on success.
     * @since   1.6
     */
    public function store($updateNulls = false)
    {
        $user   = JFactory::getUser();
        if ($this->id && $this->created_by) {
            // Existing item
        } else {
            $this->created_by = $user->get('id');
            // Alias is not a field ... but seems harmless
            $this->created_by_alias = $user->get('alias');
        }
        return parent::store($updateNulls);
    }


    /**
     * Overloaded bind function
     *
     * @param       array           named array
     * @return      null|string     null is operation was satisfactory, otherwise returns an error
     * @see JTable:bind
     * @since 1.5
     */
    public function bind($array, $ignore = '')
    {

        // Bind the permission rules.
        if (isset($array['rules']) && is_array($array['rules'])) {
            $rules = new JRules($array['rules']);
            $this->setRules($rules);
        }

        // Bind the params
        if (isset($array['params']) && is_array($array['params'])) {
            $registry = new JRegistry;
            $registry->loadArray($array['params']);
            $array['params'] = (string)$registry;
        }
        return parent::bind($array, $ignore);
    }

    /**
     * Method to compute the default name of the asset.
     * The default name is in the form `table_name.id`
     * where id is the value of the primary key of the table.
     *
     * @return  string
     * @since   1.6
     */
    protected function _getAssetName()
    {
        $k = $this->_tbl_key;
        return 'com_geocontent.layer.'.(int) $this->$k;
    }

    /**
     * Method to return the title to use for the asset table.
     *
     * @return  string
     * @since   1.6
     */
    protected function _getAssetTitle()
    {
        return 'GeoContent Layer: ' . $this->name;
    }

    /**
     * Get the parent asset id for the record
     *
     * @return  int
     * @since   1.6
     */
    protected function _getAssetParentId()
    {
        $asset = JTable::getInstance('Asset');
        $asset->loadByName('com_geocontent');
        return $asset->id;
    }


}
?>
