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

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/geocontent.php';


class GeoContentControllerItem extends JControllerForm {


    /**
     * Method override to check if you can add a new record.
     *
     * @param   array   $data   An array of input data.
     * @return  boolean
     * @since   1.6
     */
    protected function allowAdd($data = array())
    {
        // Initialise variables.
        $user       = JFactory::getUser();
        $layerid = JArrayHelper::getValue($data, 'layerid', JRequest::getInt('filter_layerid'), 'int');
        $allow      = null;

        $canDo = GeoContentHelper::getActions($layerid);

        $allow  = $canDo->get('core.create');

        if ($allow === null) {
            // In the absense of better information, revert to the component permissions.
            return parent::allowAdd($data);
        } else {
            return $allow;
        }
    }

    /**
     * Method to check if you can edit an existing record.
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
        $layerid = (int) isset($data['layerid']) ? $data['layerid'] : 0;
        $old_layerid = $layerid;

        if (!$recordId) {
            return parent::allowEdit($data, $key);
        } else {
            $old_layerid = $this->getModel()->getItem($recordId)->layerid;
            if(!$layerid){
                $layerid = $old_layerid;
            }
        }

        $canDo = GeoContentHelper::getActions($layerid);

        return $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->getModel()->getItem($recordId)->created_by == JFactory::getUser()->get('id'));
    }

}
