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

// Impedisce l'accesso diretto al file
defined('_JEXEC') or die();

jimport('joomla.application.component.controllerform');

class GeoContentControllerLayer extends JControllerForm {


    /**
     * Method override to check if you can edit an existing record.
     *
     * @param   array   $data   An array of input data.
     * @param   string  $key    The name of the key for the primary key.
     *
     * @return  boolean
     * @since   1.6
     */
    protected function allowEdit($data = array(), $key = 'id')
    {
        // Initialise variables.
        $recordId   = (int) isset($data[$key]) ? $data[$key] : 0;
        $user       = JFactory::getUser();
        $userId     = $user->get('id');

        // Check general edit permission first.
        if ($user->authorise('core.edit', 'com_geocontent.layer.'.$recordId)) {
            return true;
        }

        // Fallback on edit.own.
        // First test if the permission is available.
        if ($user->authorise('core.edit.own', 'com_geocontent.layer.'.$recordId)) {
            // Now test the owner is the user.
            $ownerId    = (int) isset($data['created_by']) ? $data['created_by'] : 0;
            if (empty($ownerId) && $recordId) {
                // Need to do a lookup from the model.
                $record     = $this->getModel()->getItem($recordId);

                if (empty($record)) {
                    return false;
                }

                $ownerId = $record->created_by;
            }

            // If the owner matches 'me' then do the test.
            if ($ownerId == $userId) {
                return true;
            }
        }

        // Since there is no asset tracking, revert to the component permissions.
        return parent::allowEdit($data, $key);
    }

}
