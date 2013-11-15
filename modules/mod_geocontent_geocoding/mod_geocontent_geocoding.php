<?php
/**
* @package      MOD_GEOCONTENT_GEOCODING
* @copyright    Copyright (C) 2010 Alessandro Pasotti http://www.itopen.it
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

/// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$list = GeoContentHelper::getVisibleLayers();

if (!count($list)) {
    //echo '<p>GeoContent Geocoding module not shown: no visible layers</p>';
	return;
}
// Add scripts to doc
$doc = & JFactory::getDocument();
$doc->addScript(GEOCONTENT_GOOGLE_MAPS_API);

$doc->addStyleDeclaration('#main ul#geocontent_geocoding_list {margin-left: 0;padding-left: 0; list-style-type: none;}');
$doc->addStyleDeclaration('#main #gc_geocoding_form input[type="checkbox"] {margin-right:5px;}');

// Get params
$gc_address = JRequest::getVar('gc_address');
$active_layer = explode(',', JRequest::getVar('active_layer'));


require(JModuleHelper::getLayoutPath('mod_geocontent_geocoding'));
