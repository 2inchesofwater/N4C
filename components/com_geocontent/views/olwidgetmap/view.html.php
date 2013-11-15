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


defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.view');

/**
* OpenLayers map
*/
class GeoContentViewOlwidgetMap extends JView {

    function display($tpl = null) {

        # Load Helper

        $this->loadHelper('GeoContent');
        $params=  & GeoContentHelper::getComponentParams();

        $this->assign('params', $params);
        $this->assign('map_html', GeoContentHelper::getMapByType('olwidgetmap'));
        parent::display($tpl);
    }
}