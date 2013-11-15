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


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');
jimport('joomla.form.helper');
//JFormHelper::loadFieldClass('imagelist');
JFormHelper::loadFieldClass('media');




// The class name must always be the same as the filename (in camel case)
class JFormFieldIconList extends JFormFieldMedia {

    //The field class must know its own type through the variable $type.
    public $type = 'iconlist';

    public function getInput() {
        $params = JComponentHelper::getParams( 'com_geocontent' );
        $icon_folder = $params->get('point_icon_folder');
        $this->element['directory'] = $icon_folder;
        // Add JURI;
        $this->element['onchange'] = "$('icon_preview').set('src', '".JURI::root()."' + $('jform_params_icon').value);";
        return parent::getInput();
    }

}


/*/ The class name must always be the same as the filename (in camel case)
class _JFormFieldIconList extends JFormFieldImageList {

	//The field class must know its own type through the variable $type.
	public $type = 'iconlist';

	public function getOptions() {
	    $params = JComponentHelper::getParams( 'com_geocontent' );
	    $icon_folder = $params->get('point_icon_folder');
        $this->element['directory'] = 'images' . DS . $icon_folder;
		$options = parent::getOptions();
        if (count($options) == 1){
            JFactory::getApplication()->enqueueMessage( JText::_( 'COM_GEOCONTENT_POINT_ICON_FORLDER_EMPTY' ), 'error' );
        }
        return $options;
	}

}
//*/

?>