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
JFormHelper::loadFieldClass('list');



require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/geocontent.php';


class JFormFieldLayersList extends JFormFieldList{

    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     * @since   11.1
     */
    protected function getOptions()
    {
        // Initialize variables.
        $options = array();

        $layers = GeoContentHelper::getEditorVisibleLayers();
        foreach ($layers as $value => $option) {

            // Create a new option object based on the <option /> element.
            $tmp = JHtml::_('select.option', (string) $value, JText::alt(trim((string) $option->name), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text', ((string) @$option->disabled=='true'));

            // Set some option attributes.
            $tmp->class = (string) @$option->class;

            // Set some JavaScript option attributes.
            $tmp->onclick = (string) @$option->onclick;

            // Add the option object to the result set.
            $options[] = $tmp;
        }

        reset($options);

        return $options;
    }
}