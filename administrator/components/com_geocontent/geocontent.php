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


// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_geocontent')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}


// import joomla controller library
jimport('joomla.application.component.controller');


// Prende la classe dal FE
if(JRequest::getVar('fe')) {
    $path = JPATH_COMPONENT_SITE.DS.'controller.php';
    $controller = '';
    $config = array('base_path' => JPATH_COMPONENT_SITE.DS);
    $lang =& JFactory::getLanguage();
    $lang->load('com_geocontent', JPATH_COMPONENT_SITE);

    if(file_exists($path)) {
        require_once $path;
    } else {
        JError::raiseError(500, 'Controller not found : ' . $path);
    }

    // Crea un'instanza dell'oggetto Controller (layer o item)
    $classname = 'GeoContentController'.$controller;
    $controller = new $classname($config);

    //Esegue task (letto da $_REQUEST)
    $controller->execute(JRequest::getVar('task'));
    // Esegue un eventuale redirect
    $controller->redirect();

} else {
    // Normal flow
    // Get an instance of the controller prefixed by GeoContent
    $controller = JController::getInstance('GeoContent');
    // Perform the Request task
    $controller->execute(JRequest::getCmd('task'));
    // Redirect if set by the controller
    $controller->redirect();
}
