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


jimport('joomla.application.component.controlleradmin');

/**
 * Weblinks list controller class.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @since		1.6
 */
class GeoContentControllerLayers extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Layer', $prefix = 'GeoContentModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}


    /**
    * Search for orphan items
    */
    function checkdb() {
		$model = $this->getModel('Layers');

		$num = $model->checkdb();

        $msg = sprintf( JText::_('DB successfully checked: %d orphan items deleted'), $num);
		$this->setRedirect( 'index.php?option=com_geocontent&controller=layer', $msg );
    }


    function kml() {
        require_once JPATH_ADMINISTRATOR .  '/components/com_geocontent/libs/wkt2kml.php';
        $s = new LayerServer();
        $s->run();
    }

}

