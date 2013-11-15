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

// import Joomla controller library
jimport('joomla.application.component.controller');


/**
 * General Controller of the component
 */
class GeoContentController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false)
	{
        // set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'layers'));

        $this->setDocument();

		// call parent behavior
		parent::display($cachable);
	}

    function gmap() {
		JRequest::setVar('view', 'item');
    	JRequest::setVar('layout', 'gmap');
        parent::display();
    }

    function olmap() {
		JRequest::setVar('view', 'item');
    	JRequest::setVar('layout', 'olmap');
        parent::display();
    }


    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_GEOCONTENT_ADMINISTRATION'));

        $document->addStyleDeclaration('.icon-48-geocontent {background-image: url(../media/com_geocontent/images/geocontent-48x48.png);}');
        $document->addStyleDeclaration('.icon-48-geocontent-layers {background-image: url(../media/com_geocontent/images/geocontent-48x48.png);}');
        $document->addStyleDeclaration('.icon-48-geocontent-items {background-image: url(../media/com_geocontent/images/geocontent-items-48x48.png);}');
    }

}

?>