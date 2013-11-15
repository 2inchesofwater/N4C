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


# Load helper from coomponent
if (! file_exists(JPATH_BASE.DS.'administrator'.DS.'components'.DS.'com_geocontent'.DS.'helpers'.DS.'geocontent.php')){
    return;
}
// Load helper
require_once(JPATH_BASE.DS.'administrator'.DS.'components'.DS.'com_geocontent'.DS.'helpers'.DS.'geocontent.php');
