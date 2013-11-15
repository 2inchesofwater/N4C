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
class GeoContentTableItem extends JTable
{

	function __construct( &$_db )
	{
		parent::__construct( '#__geocontent_item', 'id', $_db );
		$now =& JFactory::getDate();
		$this->set( 'date', $now->toMySQL() );
    }

	/**
	 * Overriden JTable::store and user id.
     * Overriden JTable::save to handle GPX
	 *
	 * @param	boolean	True to update fields even if they are null.
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	public function store($updateNulls = false)
	{
		$user	= JFactory::getUser();
        // Process GPX if given
        $gpx = null;
        if(@$_FILES['jform']['tmp_name']['gpx']){
            $gpx = $_FILES['jform']['tmp_name']['gpx'];
        } elseif(@$_FILES['gpx']['tmp_name']){
            $gpx = $_FILES['gpx']['tmp_name'];
        }
        if($gpx){
            require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'libs'. DS . 'gpx2wkt.php';
            $parser = new gpx2wkt(file_get_contents($gpx));
            $this->geodata = $parser->getWKT();
            list($this->minlat, $this->minlon, $this->maxlat, $this->maxlon) = $parser->getMBR();
        }
		if ($this->id) {
			// Existing item
		} else {
     		$this->created_by = $user->get('id');
            // Alias is not a field ... but seems harmless
            $this->created_by_alias = $user->get('alias');
		}
        // Set language to All
        if(!$this->language){
            $this->language = '*';
        }
        // TODO: simplify
		return parent::store($updateNulls);
	}


}

?>