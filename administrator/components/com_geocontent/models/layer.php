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

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * GeoContent Model
 */
class GeoContentModelLayer extends JModelAdmin
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
	public function getTable($type = 'Layer', $prefix = 'GeoContentTable', $config = array())
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
		$form = $this->loadForm('com_geocontent.layer', 'layer', array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_geocontent.edit.geocontent.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}


	/**
	 * Set ordering and clean "name"
	 *
	 * @since	1.6
	 */
	protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');

		$table->name		= htmlspecialchars_decode($table->name, ENT_QUOTES);

        // Set ordering to the last item if not set
        if (empty($table->ordering)) {
            $db = JFactory::getDbo();
            $db->setQuery('SELECT MAX(ordering) FROM #__geocontent_layer');
            $max = $db->loadResult();

            $table->ordering = $max+1;
        }
	}

    /**
     * @param   object  A form object.
     * @param   mixed   The data expected for the form.
     * @throws  Exception if there is an error loading the form.
     * @since   1.6
     */
    protected function preprocessForm(JForm $form, $data, $groups = '')
    {
        // Set the access control rules field component value.
        $form->setFieldAttribute('rules', 'section', 'layer');
        // Trigger the default form events.
        parent::preprocessForm($form, $data);
    }


    /**
     * Method to test whether a record can be deleted.
     *
     * @param   object   $record  A record object.
     *
     * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
     * @since   11.1
     */
    protected function canDelete($record)
    {
        $user = JFactory::getUser();
        $canDo = GeoContentHelper::getActions($record->id);
        $canDelete = $canDo->get('core.delete') || ($canDo->get('geocontent.delete.own') && $user->get('id') == $record->created_by);
        if(!$canDelete){
            return false;
        }
        // Check if empty
        $db = JFactory::getDbo();
        $db->setQuery('SELECT COUNT(id) FROM #__geocontent_item WHERE layerid = ' . (int)$record->id);
        $items_count = $db->loadResult();
        if($items_count){
            $app = JFactory::getApplication();
            $app->enqueueMessage(JText::_('COM_GEOCONTENT_CANNOT_DELETE_HAS_CHILDREN'), 'error');
            return false;
        }
        return $canDelete;
    }


}

