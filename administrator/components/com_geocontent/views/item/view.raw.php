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


// Impedisce l'accesso diretto al file
defined('_JEXEC') or die( 'Restricted access' );

// Include la classe base JView
jimport('joomla.application.component.view');


/**
 */
class GeoContentViewItem extends JView
{
    function display($tpl=null){
        # Load Helper
        $this->loadHelper('GeoContent');

        // Get params
        $params =& JComponentHelper::getParams('com_geocontent');
        $this->point_icon_folder = $params->get('point_icon_folder');
        $assetpath          = GeoContentHelper::getAssetURL();
        $this->assetpath = $assetpath;

        switch($this->getLayout()) {
            case 'gmap':
                // Get gmapkey
                $google_api_key = $params->get('google_api_key');
                if($google_api_key){
                    $this->google_api_key   = $google_api_key;
                    $this->map_lang         = substr($doc->getLanguage(),0,2);
                    // Start X,Y and Zoomlevel
                    $this->map_latstart     = $params->get('map_latstart') ?  $params->get('map_latstart') : 45;
                    $this->map_lngstart     = $params->get('map_lngstart') ?  $params->get('map_lngstart') : 9;
                    $this->map_zoomstart    = $params->get('map_zoomstart') ?  $params->get('map_zoomstart') : 7;
                    $this->has_editing      = true;
                    $this->jscallback       = 'editorUpdateBounds';

                } else {
                    JError::raiseError(500, 'google_api_key is undefined, please set a Google API key in the GeoContent Options window.');
                    return false;
                }
                // Assign layer info
                // Needed for styles
                if($layerid = JRequest::getInt('layerid')){
                    $this->layer = GeoContentHelper::getLayerData($layerid);
                } else {
                    JError::raiseError(500, 'layerid parameter is missing from the URL call, please file a bug on GeoContent bug tracking system.');
                    return false;
                }
            break;
            case 'olmap':
                $this->ol_url           = $params->get('ol_url');
                $this->ol_osm_url       = $params->get('ol_osm_url');
                $this->map_latstart     = $params->get('map_latstart');
                $this->map_lngstart     = $params->get('map_lngstart');
                $this->map_zoomstart    = $params->get('map_zoomstart');
                $this->jscallback       = 'editorUpdateBounds';
                $this->has_editing      = true;
                // Assign layer info
                // Needed for styles ? Not yet implemented styles
                /*
                if($layerid = JRequest::getInt('layerid')){
                    $this->layer = GeoContentHelper::getLayerData($layerid);
                } else {
                    JError::raiseError(500, 'layerid parameter is missing from the URL call, please file a bug on GeoContent bug tracking system.');
                    return false;
                }
                */
            break;

        }
        // Display the template
        parent::display($tpl);

    }
}