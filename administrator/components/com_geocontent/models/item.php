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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/geocontent.php';

/**
 * GeoContent Model
 */
class GeoContentModelItem extends JModelAdmin
{
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'item', $prefix = 'GeoContentTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{

        // Get the form.
		$form = $this->loadForm('com_geocontent.item', 'item', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}


	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_geocontent.edit.item.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
            // Prime some default values.
            if ($this->getState('item.layerid') == 0 && !$data->get('layerid')) {
                $app = JFactory::getApplication();
                $data->set('layerid', JRequest::getInt('layerid', $app->getUserState('com_geocontent.items.filter.layerid')));
            }
		}
		return $data;
	}


    /**
    * Validate some more points...
    */
    function validate($form, $data, $group = null){
        $errors = GeoContentHelper::validate($data);
        if($errors) {
            foreach ($errors as $message) {
                $this->setError(JText::_($message));
            }
            return false;
        }
        return parent::validate($form, $data, $group);
    }

}
?>