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

define('GEOCONTENT_GOOGLE_MAPS_API', 'http://maps.googleapis.com/maps/api/js?v=3.6&sensor=false');

require_once(JPATH_ROOT.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

/**
 * GeoContent component helper.
 */
abstract class GeoContentHelper
{

    protected static $_map_num = 0;
    // No cache! protected static $_params_cache = array();

    protected static $_map_types = array(
        'olwidgetmap',
        'olmap',
        'gmap'
    );

    static $params = array(
        'map_latstart',
        'map_lngstart',
        'map_zoomstart',
        'point_icon_folder',
        'ol_url',
        'ol_osm_url',
        'map_width',
        'map_height',
        'toc_style',
        'toc_position',
        'toc_width',
        'start_with_layers',
        'active_layer',
        'layer_filter_list',
        'default_base_layer',
        'toc_kml',
        'kml_type',
        'replace_target',
        'show_mouse_position',
        'readmore',
        'highlight_items', //Plugin only
        'cloudmade_api',
        'cloudmade_id',
        'ol_custom_theme',
        'balloon_onmouseover',
        'automatic_zoom',
        'automatic_center'
    );


    /**
    * Allowed parameters for FE tag maps
    *   this list contains the parameters
    *   that can be used in tag maps
    *   and passed via GET requests
    */
    static $front_end_params= array(
        'map_latstart',
        'map_lngstart',
        'toc_style',
        'toc_position',
        'map_width',
        'map_height',
        'start_with_layers' ,
        'map_zoomstart',
        'toc_width',
        'toc_kml',
        'active_layer',
        'base_layers', // Not Goole only
        'default_base_layer',  // Not Goole only
        'replace_target',
        'layer_filter_list',
        'show_mouse_position',
        'map_type', // Plugin only
        'ol_custom_theme', // TODO: docs
        'cloudmade_id',
        'balloon_onmouseover'
    );

    /**
    * Allowed parameters for FE editor button
    */
    static $front_end_button_params= array(
        'map_latstart',
        'map_lngstart',
        'map_width',
        'map_height',
        'map_zoomstart',
        'default_base_layer',  // Not Goole only
        'show_mouse_position',
        'button_text',
        'layerid',
        'contentid'
    );


    function getAssetURL(){
        return JURI::root() . 'media/com_geocontent';
    }

	function PolyStyleHTML($polyrgba, $linergba, $linewidth, $id ) {
		return '<div id="'.$id.'" style="float:left;background-color:#' . substr($polyrgba, 0,6) . ';width:30px;height:20px;border:solid '.$linewidth.'px #' . substr($linergba, 0,6) .'">&nbsp;</div>';
	}

	function LineStyleHTML($rgba, $linewidth, $id) {
		return '<div id="'.$id.'"style="float:left;background-color:#' . substr($rgba, 0,6) . ';width:30px;height:'.$linewidth.'px;">&nbsp;</div>';
	}

	function RGBAHTML($rgba, $id) {
		return '<div id="'.$id.'" style="float:left;background-color:#' . substr($rgba, 0,6) . ';width:30px;height:20px;border:solid 1px black;">&nbsp;</div>';
	}

	/**
	* Get a list of visible layers (can filter by contentid)
	*/
	function getVisibleLayers($contentid = null, $layer_filter_list = null){

		// Parse filters
		if($layer_filter_list) {
			$filters = array();
			$layer_filter_list = explode(',' , $layer_filter_list);
			foreach($layer_filter_list as $layer_id) {
				$filter = (int)$layer_id;
				if($filter) {
					$filters[] = $filter;
				}
			}
			if(count($filters)) {
				$layer_filter_list = join(',' , $filters);
			}
		}

        $user   =& JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());

        $db =& JFactory::getDBO();
        // Create a new query object.
        $query = $db->getQuery(true);
        $query->select('DISTINCT l.id AS id, l.name AS name, l.params AS params');
        $query->from('#__geocontent_layer AS l');
        $query->order('ordering ASC');
        $query->where('l.published = 1 AND l.access IN ('.$groups.')');

        if($contentid){
            $query->select($content_id.' AS contentid');
            $query->join('INNER', '#__geocontent_item AS i ON i.layerid = l.id');
            $query->where('i.contentid = '.$contentid);
            $lang =& JFactory::getLanguage();
            $query->where('(i.language = ' . $db->quote($lang->getTag()) . ' OR i.language = \'*\')');
        } elseif($layer_filter_list) {
            $query->where('l.id IN ('.$layer_filter_list.')');
        }
        $db->setQuery($query);
        $list = $db->loadObjectList('id');
        foreach($list as $k => $v){
            $params = json_decode($list[$k]->params);
            foreach($params as $pk => $pv){
                $list[$k]->$pk = $pv;
            }
        }
        return $list;
    }

    /**
    * Just a wrapper to get the table fields for geocontent_item
    */
    function getTableFields($table){
        $db =& JFactory::getDBO();
        return $db->getTableFields($table);
    }

	/**
	* Get a list of active items for a given layerid and optional contentid
    *    to be used in FE !!
	*
	*/
	function getVisibleItems($layerid, $contentid = null, $user_id = null){
        $user	=& JFactory::getUser();
        $db =& JFactory::getDBO();
        $nullDate	= $db->getNullDate();
        $date =& JFactory::getDate();
        $now = $date->toMySQL();
        $groups = implode(',', $user->getAuthorisedViewLevels());


		// Create a new query object.
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('gci.*, a.id AS contentid, a.introtext, a.fulltext, u.username AS author, a.title AS title, a.catid as catid, b.alias AS catslug, b.id AS catid, CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug');
		$query->from('#__geocontent_item AS gci');
		$query->join('LEFT', '#__content AS a ON a.id = gci.contentid');
        $query->join('LEFT', '#__geocontent_layer AS l ON gci.layerid = l.id');
		$query->join('LEFT', '#__categories AS b ON b.id = a.catid OR a.catid IS NULL');
        $query->join('LEFT', '#__users AS u ON u.id = gci.created_by');


        if($contentid){
            $where = 'gci.contentid = ' . (int)$contentid . ' AND ';
        } else {
            $where = 'gci.layerid = ' . (int)$layerid . ' AND ';
        }
        $where .= "(a.id IS NULL OR a.id = 0 OR ("
        . ' a.state = 1'
        . ' AND (b.published = 1 OR b.published IS NULL)'
        . ' AND (a.access IN ('.$groups.') OR a.access IS NULL)'
        . ' AND (b.access IN ('.$groups.') OR b.access IS NULL)'
        . ' AND (l.access IN ('.$groups.'))'
        . ' AND (a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
        . ' AND (a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )))';

        // Check user also
        if($user_id){
            $where .= ' AND gci.created_by = ' . (int)$user_id;
        }

        $query->where($where);

        // Language
        $lang =& JFactory::getLanguage();
        $query->where('(gci.language = ' . $db->quote($lang->getTag()) . ' OR gci.language = "*")');


        $query->group('gci.id');

        $db->setQuery($query);
        #fb(str_replace('#__', 'jos_',$query->__toString()));

        return $db->loadObjectList('id');
	}

    /**
    * Full icon url
    */
    public static function getIconURL($icon){
        return JURI::root() . $icon;
    }

    /**
    * Returns the readmore text
    */
    function getReadMore(){
        $params = self::getComponentParamsArray();
        if($params['readmore']){
            return $params['readmore'];
        }
        return JText::_('COM_GEOCONTENT_READ_MORE');
    }

	/**
	* Build the KML link
	*/
	function getKMLLink($layerid = null, $contentid = null, $front_end = true){
	   if($contentid){
            $filter = '&amp;filter=' . $contentid;
	   } else {
            $filter = '';
	   }
	   $layerid = urlencode(($layerid));
        if($front_end){
            // ABP: hack: add ""&amp;view=item&amp;format=raw" to fake HEAD requests
            $link = JURI::base() . '?option=com_geocontent&amp;task=layers.kml&amp;typename='. $layerid . $filter;
        } else {
            $link = JURI::base() . '?option=com_geocontent&amp;controller=layer&amp;task=layers.kml&amp;typename=' . $layerid .  $filter;
        }
        if('kmz' == self::getParm('kml_type')){
            $link .= '&amp;request=kmz';
        }
        if(self::getParm('kml_no_cache')){
           $link .= '&amp;ts=' . time();
        }
        return $link;
	}

	/**
	* Get geo data from id
	*
	* @return array hash with layerid as key
	*/
	function getData($id){
		if(!$id){
			return null;
		}
        $db =& JFactory::getDBO();
        $db->setQuery('
            SELECT i.*, l.name AS layername
            FROM #__geocontent_item AS i '
		. ' INNER JOIN #__geocontent_layer AS l ON l.id=i.layerid'
        . " WHERE i.id = " . (int)$id
        );

        $result =& $db->loadObject();
        return $result;
	}

	/**
	* Get geo data from contentid item
	*
	* @return array hash with layerid as key
    *
    * @return array
    *
    * @TODO : language
	*/
	function getItemData($contentid){
        if(!$contentid){
            return array();
        }
        $db =& JFactory::getDBO();
        $db->setQuery('
            SELECT i.*, l.name AS layername
            FROM #__geocontent_item AS i '
		. ' INNER JOIN #__geocontent_layer AS l ON l.id=i.layerid'
        . " WHERE i.contentid = " . (int)$contentid
        );

        $result =& $db->loadObjectList('id');
        if(!count($result)){
            return array();
        }
        return $result;
	}

    /**
    * Get geo data from content item, layer must be published
    *
    * @return array
    *
    * @TODO : language
    *
    */
    function getEditableItemData($contentid){
        if(!$contentid){
            return array();
        }
        $db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());
        $accessible_layers = self::getEditorVisibleLayers($contentid);
        if(!$accessible_layers){
            return null;
        }

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('gci.*, l.name AS layername, u.username as author');
        $query->from('#__geocontent_item AS gci');
        $query->join('LEFT', '#__geocontent_layer AS l ON gci.layerid = l.id');
        $query->join('LEFT', '#__users AS u ON u.id = gci.created_by');

        $query->where("gci.contentid = " . (int)$contentid . " AND l.published = 1 AND l.access IN (" .$groups.')'
        . ' AND l.id IN (' . join(',', array_keys($accessible_layers)) . ')');

        $db->setQuery($query);

        $result =& $db->loadObjectList('id');
        if(!count($result)){
            return  array();
        }
        // Checks if can edit or can delete
        $user   = JFactory::getUser();
        $editable_items = array();
        foreach($result as $k => $i){
            $canDelete = GeoContentHelper::getActions($i->layerid)->get('core.delete') || ( GeoContentHelper::getActions($i->layerid)->get('geocontent.delete.own') && $i->created_by == $user->get('id'));
            $canEdit = GeoContentHelper::getActions($i->layerid)->get('core.edit') || ( GeoContentHelper::getActions($i->layerid)->get('geocontent.edit.own') && $i->created_by == $user->get('id'));
            if(!($canDelete || $canEdit)){
                continue;
            }
            $i->canDelete = $canDelete;
            $i->canEdit = $canEdit;
            $editable_items[$k] = $i;
        }

        return $editable_items;
    }


    /**
    * Get visible GeoContent items data from content id,
    * layer must be published and accessible
    * @TODO : language
    */
    function getVisibleItemData($contentid){
        if(!$contentid){
            return array();
        }
        $db =& JFactory::getDBO();
        $user   =& JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());

        $db->setQuery('
            SELECT i.*, l.name AS layername
            FROM #__geocontent_item AS i '
        . ' INNER JOIN #__geocontent_layer AS l ON l.id=i.layerid'
        . " WHERE i.contentid = " . (int)$contentid . " AND l.published = 1 AND l.access IN (" .$groups.')'
        );
        $result =& $db->loadObjectList('id');
        if(!count($result)){
            return array();
        }
        return $result;
    }

    /**
    * Get layer data from layer id
    */
    function getLayerData($layerid){
        $db =& JFactory::getDBO();

        $db->setQuery('
            SELECT *
            FROM #__geocontent_layer '
        . " WHERE id = " . (int)$layerid
        );
        $result =& $db->loadObject();
        $params = json_decode($result->params);
        foreach($params as $pk => $pv){
            $result->$pk = $pv;
        }
        return $result;

    }

	/**
	* Get component params, automatically selects source (site or admin) and override from GET
	*
	* @return JRegistry
	*/
	function getComponentParams(){
        // No cache!
        $_params_cache = JComponentHelper::getParams('com_geocontent');

        $app = JFactory::getApplication();
        if(!$app->isAdmin()){
            // From site FE part, do not user JRegistry::merge because toArray fails with nested arrays
            // $_params_cache->merge($app->getParams('com_geocontent'));
            foreach ($app->getParams('com_geocontent')->toArray() as $k => $v) {
                if (($v !== null) && ($v !== '')){
                    $_params_cache->set($k, $app->getParams('com_geocontent')->get($k));
                }
            }
        }


        // Overridable params: taken from front_end_params
        foreach(self::$front_end_params as $p){
            if($var = JRequest::getVar($p)) {
                $_params_cache->set($p, $var);
            }
        }
        // Defaults for js libraries
        if(!$_params_cache->get('ol_url')){
            if(!JDEBUG){
                $_params_cache->set('ol_url', JURI::root() . 'media/com_geocontent/js/openlayers/OpenLayers.js');
            } else {
                $_params_cache->set('ol_url', JURI::root() . 'media/com_geocontent/js/openlayers/OpenLayers_uncompressed.js');
            }
        }
        if(!$_params_cache->get('ol_osm_url')){
            $_params_cache->set('ol_osm_url', JURI::root() . 'media/com_geocontent/js/OpenStreetMap.js');
        }
        return $_params_cache;
	}

    /**
    * Get component params
    *
    * @return array
    */
    function getComponentParamsArray(){
        return self::getComponentParams()->toArray();
    }

   /**
    * Returns MBR and layers id list:
    *   center x
    *   center y
    *   min x
    *   min y
    *   max x
    *   max y
    *   active_layers (array)
    *
    * @return array
    */
    function getDataInfo($data, $automatic_center){
        // If Data: set new MBR to get zoom and center
        //          get layer and activates it
        //          TODO: highlight data ?
        // Data is array
        $data_maxlat = $data_maxlon = 0;
        $data_minlat = $data_minlon = 10000;
        $active_layers = array();
        if($data){
            foreach($data as $itemdata){
                $data_maxlat = max($data_maxlat, 1000 + $itemdata->maxlat);
                $data_maxlon = max($data_maxlon, 1000 + $itemdata->maxlon);
                $data_minlat = min($data_minlat, 1000 + $itemdata->minlat);
                $data_minlon = min($data_minlon, 1000 + $itemdata->minlon);
                $active_layers[$itemdata->layerid] = '';
            }
            $data_maxlat -= 1000;
            $data_maxlon -= 1000;
            $data_minlat -= 1000;
            $data_minlon -= 1000;
        }


        // Calculate center (override $map_latstart and $map_lngstart)
        if($data && ($automatic_center == 'yes')){
            $map_latstart = ($data_maxlat + $data_minlat) / 2;
            $map_lngstart = ($data_maxlon + $data_minlon) / 2;
        }


        // Make sure we have some values
        if(!$map_latstart) {
            $map_latstart = JComponentHelper::getParams('com_geocontent')->get('map_latstart', 45);
        }
        if(!$map_lngstart) {
            $map_lngstart = JComponentHelper::getParams('com_geocontent')->get('map_lngstart', 10);
        }

        unset($itemdata);
        $active_layers = array_keys($active_layers);

        return compact(array_keys(get_defined_vars()));
    }


    /**
    * Get map configuration (common to all maps)
    */
    static function getMapConfiguration($data = null, $params = null){

        // Map counter
        $map_num = ++self::$_map_num;

        // Adds a JS map catalog
        if($map_num === 1){
            $doc =& JFactory::getDocument();
            $doc->addScriptDeclaration('var gc_map_catalog = [];');
        }

        extract(self::getComponentParamsArray());
        // Override defaults
        if(is_array($params)){
            extract($params);
        }

        // Avoid undefined
        foreach(self::$params as $k){
            if(!isset($$k)){
                $$k = null;
            }
        }

        $assetpath          = self::getAssetURL();


        // Data info
        $data_highlight = array();
        if($data){
            extract(self::getDataInfo($data, $automatic_center));
            // Highlight data
            if (isset($highlight_items) && 'yes' === $highlight_items && $data){

                foreach($data as $k => $v){
                    if(!array_key_exists($v->layerid, $data_highlight)){
                        $data_highlight[$v->layerid] = array();
                    }
                    $data_highlight[$v->layerid][] = $v->id;
                }
            }
        }

        // Reset toc width and set toc  orientation
        if($toc_position == 'top' || $toc_position == 'bottom'){
            $toc_width = '100';
            $toc_orientation = 'horizontal';
        } else {
            $toc_orientation = 'vertical';
        }

        if($toc_style != 'none' && $toc_position == 'left'){
            $map_canvas_float = 'right';
            $toc_float= 'left';
            $map_canvas_width =  100 - $toc_width;
        } elseif($toc_style != 'none' && $toc_position == 'right'){
            $map_canvas_float= 'left';
            $toc_float= 'right';
            $map_canvas_width = 100 - $toc_width;
        } else {
            $map_canvas_float= 'none';
            $toc_float= 'none';
            $map_canvas_width = 100;
        }


        // Get layer list
        $layer_list = self::getVisibleLayers(null, $layer_filter_list);

        // Select can only show one layer at the time
        if ('select' == $toc_style && $start_with_layers == 'all') {
            $start_with_layers = 'none';
        }

        // Geodata
        $geodata = array();
        switch($start_with_layers){
            case 'all':
                foreach($layer_list as $l){
                    $geodata[$l->id] = urlencode(self::getLayerName($l->id));
                }
            break;
            case 'none':
            break;
            case 'one':
            case 'list':
                if($active_layer) {
                    // To array...
                    if(! is_array($active_layer)){
                        $active_layer = explode(',', $active_layer);
                    }
                    foreach ($active_layer as $_l){
                        $geodata[$_l] =  urlencode(self::getLayerName($_l));
                    }
                }
            break;
        }

        // Ensure $data layerid is shown
        if($data && $active_layers){
            foreach($active_layers as $l){
                if (! array_key_exists($l, $geodata)) {
                    $geodata[$l] =  urlencode(self::getLayerName($l));
                }
            }
        }

        foreach($layer_list as $l){
            $l->url = self::getKMLLink($l->id);
        }

        $kml_layers = json_encode($layer_list);
        $initial_layers = json_encode($geodata);
        $data_highlight = json_encode($data_highlight);

        // Base layers default because checkboxes has no multiple default and better to leave it blank
        if(empty($base_layers)){
            $base_layers = array('osm.mapnik', 'osm.osmarender', 'google.streets', 'google.physical', 'google.satellite', 'google.hybrid', 've.road', 've.shaded', 've.aerial', 've.hybrid');
        }

        // Adds cloudmade if set
        if($cloudmade_api && $cloudmade_id){
            $base_layers[] = 'cloudmade';
        }

        if($default_base_layer){
            $pos = array_search($default_base_layer, $base_layers);
            if($pos !== false){
                unset($base_layers[$pos]);
            }
            array_unshift($base_layers, $default_base_layer);
        }

        // Adds map id
        if($cloudmade_api && $cloudmade_id){
            $base_layers[array_search('cloudmade', $base_layers)] .= '.' .  $cloudmade_id;
        }


        $initial_base_layers = json_encode($base_layers);

        // Make sure some integer vars are set
        foreach(array('map_latstart', 'map_lngstart', 'map_zoomstart') as $v){
            if(!isset($$v)){
                $$v = 0;
            }
        }

        foreach(array('replace_target', 'balloon_onmouseover') as $v){
            if(!isset($$v)){
                $$v = 0;
            }
        }
        if(!$map_canvas_width){
            $map_canvas_width = 100;
        }
        if(!$map_width){
            $map_width = 100;
        }
        if(!$map_height){
            $map_height = 300;
        }

        return compact(array_keys(get_defined_vars()));
    }


    /**
    * get Editor button
    *
    * @param array $_params configuration
    */
    public static function getEditorButton($_params) {
        JHtml::_('behavior.modal');
        extract($_params);
        $link = 'index.php?option=com_geocontent&amp;task=editor&amp;view=editor&amp;fe=1&amp;tmpl=component';
        if(isset($layerid)){
            $link .= '&amp;layerid=' . $layerid;
        }
        if(isset($contentid)){
            $link .= '&amp;contentid=' . $contentid;
        }
        if(isset($map_latstart)){
            $link .= '&amp;map_latstart=' . $map_latstart;
        }
        if(isset($map_lngstart)){
            $link .= '&amp;map_lngstart=' . $map_lngstart;
        }
         // 600x400 (+72 +170)
        // TODO: params
        $frame_x = 672;
        $frame_y = 570;
        return <<<__BTN__
        <a rel="{handler: 'iframe', size: {x: $frame_x, y: $frame_y}}" href="$link" class="modal modal-button">$button_text</a>
__BTN__;

    }


	/**
	* get Map
	*
	* @param array $data records (can be more than one)
	* @param array $params configuration
	*/
	public static function getMap($data = null, $params = null){
        if(is_a($params, 'JRegistry')){
            $params = $params->toArray();
        }
        // Default map type is olwidget
        // Other:
        // * gmap
        // * olmap

        if(!($params && ($map_type = $params['map_type']) && in_array($map_type, self::$_map_types))) {
            $map_type = 'olwidgetmap';
        }
        return self::getMapByType($map_type, $data, $params);
    }


    /**
    * get Layer style
    *
    */
    private static function parseLayerStyle($params){
        $params = json_decode($params);
        $default_style = array(
            'fillColor' => '#' . substr($params->polyrgba, 0, 6), //    {String} Hex fill color.  Default is “#ee9900”.
            'fillOpacity' =>  base_convert(substr($params->polyrgba, 6), 16, 10)/255, //  {Number} Fill opacity (0-1).  Default is 0.4
            'strokeColor' => '#' . substr($params->linergba, 0, 6), //  {String} Hex stroke color.  Default is “#ee9900”.
            'strokeOpacity' => base_convert(substr($params->linergba, 6), 16, 10)/255, //    {Number} Stroke opacity (0-1).  Default is 1.
            'strokeWidth' => (int)$params->linewidth, //  {Number} Pixel stroke width.  Default is 1.
            'externalGraphic' => self::getIconURL($params->icon), //  {String} Url to an external graphic that will be used for rendering points.
            //'graphicOpacity' => , //   {Number} Opacity (0-1) for an external graphic.
            //'graphicXOffset' => , //   {Number} Pixel offset along the positive x axis for displacing an external graphic.
            //'graphicYOffset' => , //   {Number} Pixel offset along the positive y axis for displacing an external graphic.
            //'rotation' => , //     {Number} For point symbolizers, this is the rotation of a graphic in the clockwise direction about its center point (or any point off center as specified by graphicXOffset and graphicYOffset).
            //'graphicZIndex' => , //    {Number} The integer z-index value to use in rendering.
            //'graphicName' => , //  {String} Named graphic to use when rendering points.  Supported values include “circle” (default), “square”, “star”, “x”, “cross”, “triangle”.
            //'balloonStyle' => , //
            'graphicWidth' => (int)$params->iconsize, //     {Number} Pixel width for sizing an external graphic.
            'graphicHeight' => (int)$params->iconsize //    {Number} Pixel height for sizing an external graphic.
        );

        if($params->show_labels){
            $default_style = array_merge($default_style,
                array(
                    'label' => '${name}', //    {String} The text for an optional label.  For browsers that use the canvas renderer, this requires either fillText or mozDrawText to be available.
                    'labelAlign' => $params->label_align, //   {String} Label alignment.  This specifies the insertion point relative to the text.  It is a string composed of two characters.  The first character is for the horizontal alignment, the second for the vertical alignment.  Valid values for horizontal alignment: “l”=left, “c”=center, “r”=right.  Valid values for vertical alignment: “t”=top, “m”=middle, “b”=bottom.  Example values: “lt”, “cm”, “rb”.  The canvas renderer does not support vertical alignment, it will always use “b”.
                    'labelXOffset' => (int)$params->label_xoffset, //     {Number} Pixel offset along the positive x axis for displacing the label.
                    'labelYOffset' => (int)$params->label_yoffset, //     {Number} Pixel offset along the positive y axis for displacing the label.
                    'labelSelect' => ($params->label_select === '1'), //  {Boolean} If set to true, labels will be selectable using SelectFeature or similar controls.  Default is false.
                    'fontColor' => $params->label_font_color, //    {String} The font color for the label, to be provided like CSS.
                    'fontOpacity' => (int)$params->label_font_opacity/100, //  {Number} Opacity (0-1) for the label
                    'fontFamily' => $params->label_font_family, //   {String} The font family for the label, to be provided like in CSS.
                    'fontSize' => $params->label_font_size, //     {String} The font size for the label, to be provided like in CSS.
                    'fontWeight' => $params->label_font_weight //   {String} The font weight for the label, to be provided like in CSS.
                )
            );

        }

        $select_style = array(
            'fillColor' => '#' . substr($params->select_polyrgba, 0, 6), //    {String} Hex fill color.  Default is “#ee9900”.
            'fillOpacity' =>  base_convert(substr($params->select_polyrgba, 6), 16, 10)/255, //  {Number} Fill opacity (0-1).  Default is 0.4
            'strokeColor' => '#' . substr($params->select_linergba, 0, 6), //  {String} Hex stroke color.  Default is “#ee9900”.
            'strokeOpacity' => base_convert(substr($params->select_linergba, 6), 16, 10)/255, //    {Number} Stroke opacity (0-1).  Default is 1.
            'strokeWidth' => (int)$params->select_linewidth //  {Number} Pixel stroke width.  Default is 1.
        );

        $select_style = array_merge($default_style, $select_style);

        return array(
            'default' => $default_style,
            'select'  => $select_style
        );
    }


    /**
    * get Layer styles
    *
    */
    public static function &getLayerStyles(){
        $styles = array();
        foreach(self::getVisibleLayers() as $id => $data){
            $styles[$data->id] = self::parseLayerStyle($data->params);
        }
        return $styles;
    }


    /**
    * get Front-end Info Map
    *
    * @param array $data records (can be more than one)
    * @param array $params configuration
    */
    public static function getMapByType($map_class, $data = null, $params = null){

        extract(self::getMapConfiguration($data, $params));

        $custom_style_class = '';
        $ol_ls_color = 'blue';

        # Include mootools First!!!
        JHtml::_('behavior.framework', true);

        $map_class = 'GC' . ucfirst($map_class) . 'Class';

        $mbr = '';
        // Check if it's a single point
        if($data) {
            // Calculate zoom to MBR
            if(!isset($automatic_zoom) || 'yes' == $automatic_zoom){
                // Check if it's a point
                if($data_minlon == $data_maxlon && $data_maxlat == $data_minlat) {
                    // Change zoom level if set
                    if(isset($map_minzoom)){
                        $map_zoomstart = $map_minzoom;
                    }
                } else {
                    $mbr = "gcmap.zoomToExtent($data_minlon, $data_minlat, $data_maxlon, $data_maxlat);";
                }
            }
        }

        $doc =& JFactory::getDocument();

        $doc->setMetaData ('viewport', "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0");
        $doc->setMetaData ('apple-mobile-web-app-capable', "yes");

        #$doc->addScript('http://openlayers.org/api/OpenLayers.js');
        #$doc->addScript('http://openlayers.org/dev/OpenLayers.js');
        # dev needed for http://trac.osgeo.org/openlayers/ticket/2984
        if('GCGmapClass' != $map_class){
            $doc->addScript($ol_url);
            $doc->addScript($ol_osm_url);
            if(strpos(implode(',', $base_layers), 'google.') !== false){
                $doc->addScript(GEOCONTENT_GOOGLE_MAPS_API);
                $doc->addStyleSheet($assetpath .'/css/ol_google.css');
            }
            if(strpos(implode(',', $base_layers), 've.') !== false){
                $doc->addScript('http://dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.2');
            }
            $doc->addStyleSheet($assetpath .'/js/olwidget/css/olwidget.css');
            $doc->addScript($assetpath .'/js/olwidget/js/olwidget.js');
            // Adds cloudmade if set
            if($cloudmade_api && $cloudmade_id){
                $doc->addScript($assetpath .'/js/olwidget/js/cloudmade.js#' . $cloudmade_api);
            }
            if($ol_custom_theme){
                $ol_custom_theme = $assetpath.'/js/openlayers/' . $ol_custom_theme . '/';
                if(strpos($ol_custom_theme, 'grey') !== false){
                    $custom_style_class = ' grey';
                    $ol_ls_color = 'grey';
                }
            }

        } else {
            $doc->addScript(GEOCONTENT_GOOGLE_MAPS_API);

        }
        $doc->addStyleSheet($assetpath .'/css/ol_google.css');
        $doc->addStyleSheet($assetpath .'/css/geocontent.css');
        $doc->addScript($assetpath .'/js/gc_map_wrapper.js');

        $layer_styles = json_encode(self::getLayerStyles());

        $js =<<<__JS__
        // {gcrendered}

        function geocontent_init_$map_num(){
            var map_options = {
                name: 'GeoData_$map_num',
                defaultLat: $map_latstart,
                defaultLon: $map_lngstart,
                defaultZoom: $map_zoomstart,
                hideTextarea: true,
                mapDivStyle: {
                    width: '{$map_canvas_width}%',
                    height: '{$map_height}px'
                },
                layers: $initial_base_layers,
                styles: $layer_styles
            };

            var gcmap = new $map_class({
                map_num: $map_num,
                kml_layers: $kml_layers,
                initial_layers: $initial_layers,
                initial_base_layers: $initial_base_layers,
                replace_target: $replace_target,
                show_mouse_position: $show_mouse_position,
                highlight: $data_highlight,
                ol_custom_theme: '$ol_custom_theme',
                balloon_onmouseover: $balloon_onmouseover,
                layer_switcher_colors: {
                    //activeColor: 'dark$ol_ls_color',
                    //nonActiveColor: 'light$ol_ls_color',
                    roundedCornerColor: '$ol_ls_color'
                },
                map_options: map_options
            });
            gc_map_catalog.push(gcmap);

            // Adds events to toc_select
            if($('toc_select_' + $map_num)){
                $('toc_select_' + $map_num).addEvent('change', function(evt){
                    gcmap.hideAllLayers();
                    gcmap.toggleLayer(this.options[this.selectedIndex].value, true);
                });
            }

            // Adds events to toc_list
            if($('toc_list_' + $map_num)){
                $$('#toc_list_' + $map_num + ' li input').each(
                    function(elm){
                        elm.addEvent('click', function(evt){
                        gcmap.toggleLayer(evt.target.id.replace(/[^\d]+_[\d]+_/, ''), evt.target.checked);
                    });
                });
            }

            $mbr
        }


        // Doesn't work with Bing layers in FF, sorry.
        // window.addEvent('domready',);
        // Need to use onload... ...
        window.addEvent('load', geocontent_init_$map_num);

__JS__;


        $doc->addScriptDeclaration($js);
        $toc = self::getToc($layer_list, $toc_style, $toc_orientation, $toc_kml, $map_num);

        $maptoc = "
        <div id=\"map_toc_$map_num\" class=\"map_toc\" style=\"height:100%;width:{$toc_width}%;float:$toc_float\">
            <div id=\"toc_controls_$map_num\" class=\"toc_controls\">
                $toc
            </div>
        </div>";
        $html = "<div id=\"map_wrapper_$map_num\" class=\"map_wrapper$custom_style_class\" style=\"width:{$map_width}%;float:left\">";
        if($toc_position == 'top' || $toc_position == 'left'){
            $html .= $maptoc;
        }
        $html .= "<div id=\"map_canvas_$map_num\" class=\"map_canvas\" style=\"height:{$map_height}px;width:{$map_canvas_width}%;float:$map_canvas_float\"></div>";
        if($toc_position == 'bottom' || $toc_position == 'right'){
            $html .= $maptoc;
        }
        $html .= "</div>";

        return $html;

    }

    /**
    * Prepare TOC
    */
    function getToc(&$layer_list, $toc_style, $toc_orientation, $toc_kml, $map_num){
        // Prepare TOC
        if('select' == $toc_style) {
            $toc = "<select  id=\"toc_select_{$map_num}\" class=\"toc_select\"><option> -- </option>";
            foreach($layer_list as $l){
                $loadmessage = JText::_('COM_GEOCONTENT_LOAD_LAYER') . ' :' . $l->name;

                $toc .= "<option value=\"{$l->id}\" id=\"laycb_{$l->id}\">{$l->name}</option>\n";
            }
            $toc .= '</select>';
            return $toc;
        }
        // horizontal or vertical ?
        if('horizontal' == $toc_orientation){
            $ul_class = ' class="toc_list horizontal"';
        } else {
            $ul_class = ' class="toc_list vertical"';
        }
        $toc = '<ul id="toc_list_'.$map_num. '" ' . ($toc_style == 'none'  ? ' style="display:none"' : '' ) . $ul_class .'>';
        foreach($layer_list as $l){
            if($toc_kml){
                $kml_link = '<a class="kml_link" href="'.self::getKMLLink($l->id, null, true).'" title="' . JText::_('COM_GEOCONTENT_VIEW_THIS_LAYER_IN_GOOGLE_EARTH'). '"><img alt="' . JText::_('COM_GEOCONTENT_VIEW_THIS_LAYER_IN_GOOGLE_EARTH'). '" src="' . JURI::root() . '/media/com_geocontent/images/geicon.png' . '" /></a>';
            }

            $loadmessage = JText::_('COM_GEOCONTENT_LOAD_LAYER') . ' :' . $l->name;

            $toc .= "<li>$kml_link<input id=\"laycb_{$map_num}_{$l->id}\" type=\"checkbox\"/>&nbsp;{$l->name}<a href=\"#\" title=\"$loadmessage\"></a></li>\n";
        }
        $toc .= '</ul>';
        return $toc;
    }




    /**
    * Returns the name of the article the item points to (if any)
    */
    function getOriginalName($contentid){
		$query = 'SELECT title FROM #__content WHERE id = ' . (int) $contentid;
        $db     =& JFactory::getDBO();
        $db->setQuery($query);
		if (! $result = $db->loadResult()) {
			$this->setError( $db->getErrorMsg() );
			return false;
		}
		return $result;
    }


    function getParm($p){
        $params = &JComponentHelper::getParams( 'com_geocontent' );
        return $params->get($p);
    }

    function getLayerName($layerid){
        $db =& JFactory::getDBO();

        $db->setQuery('
            SELECT name
            FROM #__geocontent_layer'
        . " WHERE id = $layerid"
        );
        $result =& $db->loadResult();
        return $result;

    }


    function getLayerOptions(){
        $db =& JFactory::getDBO();

        $db->setQuery('
            SELECT name, id as value
            FROM #__geocontent_layer'
        . " ORDER BY name"
        );
        return $db->loadObjectList();

    }

    /**
    * Returns the item balloon's hyperlink URL
    *
    * if an article link is defined, the link to the
    * article is returned otherwise the url field value
    * is returned.
    */
    function getItemURL(&$item){
        if($item->contentid){
            return htmlentities(JURI::root() . ContentHelperRoute::getArticleRoute($item->contentid));
        }
        return $item->url;
    }

    /**
    * Returns the item balloon URL
    *
    */
    function getBalloonURL(&$item){
        $url = "index.php?option=com_geocontent&view=item&layout=balloon&format=raw&id={$item->id}";
        return htmlentities(JURI::root() . $url);
    }

    /**
    * Checks the article id is valid
    *
    */
    function checkContentId($id){
        $db =& JFactory::getDBO();

        $db->setQuery('
            SELECT id FROM #__content'
        . " WHERE id = $id"
        );
        $db->query();
        return $db->getNumRows();
    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @param   int     The layer ID.
     *
     * @return  JObject
     * @since   1.6
     */
    public static function getActions($layer_id = 0)
    {
        $user   = JFactory::getUser();
        $result = new JObject;

        if (empty($layer_id)) {
            $assetName = 'com_geocontent';
            $section = '';
            $action_list = JAccess::getActions('com_geocontent');
        }
        else  {
            $assetName = 'com_geocontent.layer.'.(int) $layer_id;
            $action_list = JAccess::getActions('com_geocontent', 'layer');
        }
        //vardie($d= JAccess::getActions('com_geocontent'));

        foreach($action_list as $action_item){
            $result->set($action_item->name, $user->authorise($action_item->name, $assetName));
        }

        return $result;
    }

    /**
    * Returns the list of layers where the user can add/edit items
    * if $add_only is true, returns only layers where the user can add items
    *
    */
    public static function getEditorVisibleLayers($contentid = null, $add_only = false){
        $results = array();
        $user =& JFactory::getUser();
        foreach(self::getVisibleLayers() as $layerid => $layerdata){
            $actions = self::getActions($layerid);
            if($actions->get('core.create')){
                $results[$layerid] = $layerdata;
            } elseif(!$add_only && $actions->get('core.edit')&& self::getVisibleItems($layerid, $contentid)) {
                $results[$layerid] = $layerdata;
            } elseif(!$add_only && $actions->get('core.edit.own')&& self::getVisibleItems($layerid, $contentid, $user->id)) {
                $results[$layerid] = $layerdata;
            }
        }
        return $results;
    }



    /**
     * Configure the Linkbar.
     *
     * @param   string  The name of the active view.
     * @since   1.6
     */
    public static function addSubmenu($vName = 'layers')
    {
        $document = JFactory::getDocument();
        JSubMenuHelper::addEntry(
            JText::_('COM_GEOCONTENT_SUBMENU_GEOCONTENT_LAYERS'),
            'index.php?option=com_geocontent&view=layers',
            $vName == 'layers'
        );
        JSubMenuHelper::addEntry(
            JText::_('COM_GEOCONTENT_SUBMENU_GEOCONTENT_ITEMS'),
            'index.php?option=com_geocontent&view=items',
            $vName == 'items'
        );
        if ($vName=='layers') {
            JToolBarHelper::title(
                JText::sprintf('COM_GEOCONTENT_LAYERS_ADMINISTRATION_TITLE', JText::_('com_geocontent')),
                'geocontent');
        }
    }

    /**
    * Applies the content tag filters to arbitrary text as per settings for current user group
    * @param text The string to filter
    * @return string The filtered string
    */
    public static function filterText($text)
    {


        $user       = JFactory::getUser();
        $userGroups = JAccess::getGroupsByUser($user->get('id'));

        $filters = GeoContentHelper::getParm('filters');


        $blackListTags          = array();
        $blackListAttributes    = array();

        $whiteListTags          = array();
        $whiteListAttributes    = array();

        $noHtml     = false;
        $whiteList  = false;
        $blackList  = false;
        $unfiltered = false;

        // Crazy trick for php bug in StdClass with numeric properties !!!
        $filters = json_decode(json_encode($filters));

        // Cycle through each of the user groups the user is in.
        // Remember they are include in the Public group as well.
        foreach ($userGroups AS $groupId)
        {
            // May have added a group by not saved the filters.
            if (!isset($filters->$groupId)) {
                continue;
            }

            // Each group the user is in could have different filtering properties.
            $filterData = $filters->$groupId;
            $filterType = strtoupper($filterData->filter_type);

            if ($filterType == 'NH') {
                // Maximum HTML filtering.
                $noHtml = true;
            }
            else if ($filterType == 'NONE') {
                // No HTML filtering.
                $unfiltered = true;
            }
            else {
                // Black or white list.
                // Preprocess the tags and attributes.
                $tags           = explode(',', $filterData->filter_tags);
                $attributes     = explode(',', $filterData->filter_attributes);
                $tempTags       = array();
                $tempAttributes = array();

                foreach ($tags AS $tag)
                {
                    $tag = trim($tag);

                    if ($tag) {
                        $tempTags[] = $tag;
                    }
                }

                foreach ($attributes AS $attribute)
                {
                    $attribute = trim($attribute);

                    if ($attribute) {
                        $tempAttributes[] = $attribute;
                    }
                }

                // Collect the black or white list tags and attributes.
                // Each list is cummulative.
                if ($filterType == 'BL') {
                    $blackList              = true;
                    $blackListTags          = array_merge($blackListTags, $tempTags);
                    $blackListAttributes    = array_merge($blackListAttributes, $tempAttributes);
                }
                else if ($filterType == 'WL') {
                    $whiteList              = true;
                    $whiteListTags          = array_merge($whiteListTags, $tempTags);
                    $whiteListAttributes    = array_merge($whiteListAttributes, $tempAttributes);
                }
            }
        }

        // Remove duplicates before processing (because the black list uses both sets of arrays).
        $blackListTags          = array_unique($blackListTags);
        $blackListAttributes    = array_unique($blackListAttributes);
        $whiteListTags          = array_unique($whiteListTags);
        $whiteListAttributes    = array_unique($whiteListAttributes);

        // Unfiltered assumes first priority.
        if ($unfiltered) {
            // Dont apply filtering.
        }
        else {
            // Black lists take second precedence.
            if ($blackList) {
                // Remove the white-listed attributes from the black-list.
                $filter = JFilterInput::getInstance(
                    array_diff($blackListTags, $whiteListTags),             // blacklisted tags
                    array_diff($blackListAttributes, $whiteListAttributes), // blacklisted attributes
                    1,                                                      // blacklist tags
                    1                                                       // blacklist attributes
                );
            }
            // White lists take third precedence.
            else if ($whiteList) {
                $filter = JFilterInput::getInstance($whiteListTags, $whiteListAttributes, 0, 0, 0);  // turn off xss auto clean
            }
            // No HTML takes last place.
            else {
                $filter = JFilterInput::getInstance();
            }

            $text = $filter->clean($text, 'html');
        }

        return $text;
    }

    /**
    * Return true on success, an error message if any
    *
    * Checks:
    *  - contentid or  URL
    *  - contentname
    *  - layerid is valid
    *  - contentid is valid
    */
    static function validate($data){
        extract($data);

        $canDo  = self::getActions($layerid);
        $errors = array();

        if(!($contentid || $url || $canDo->get('geocontent.unlinked'))) {
           $errors[] = JText::_("COM_GEOCONTENT_MISSING_LINK");
        }

        if(($url && !$canDo->get('geocontent.custom_url'))) {
            $errors[] = JText::_("COM_GEOCONTENT_CUSTOM_URL_NOT_ALLOWED");
        }

        if(!($contentid || $canDo->get('geocontent.unbound'))) {
            $errors[] = JText::_( 'COM_GEOCONTENT_UNBOUND_NOT_ALLOWED' );
        }

        // Check ID and creation of new items
        if((!array_key_exists('id', $data) || !$id) && !($canDo->get('core.create'))) {
            $errors[] = JText::_('COM_GEOCONTENT_ALERTNOTAUTH');
        }

        // Check ID and editing permissions
        if(array_key_exists('id', $data) && $id){
            // Retrieve item and check
            $item = self::getData($id);
            if(!$item){
                $errors[] = JText::_('COM_GEOCONTENT_ITEM_DOES_NOT_EXISTS');
            } else {
                // Checks if the layer has changed and if yes, check new layer for add
                if($data['layerid'] != $item->layerid && !$canDo->get('core.create')) {
                   $errors[] = JText::_('COM_GEOCONTENT_CANNOT_CHANGE_LAYER_ERROR');
                }
            }
            $user       = JFactory::getUser();
            if(!($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $user->get('id') == $item->created_by))) {
                $errors[] = JText::_('COM_GEOCONTENT_ALERTNOTAUTH');
            }
        }

        if(!($layerid && $contentname)) {
            $errors[] = JText::_( 'COM_GEOCONTENT_MISSING_REQUIRED' );
        }

        // Checks geodata
        if(array_key_exists('geodata', $data) && !$geodata && array_key_exists('gpx', $data) && !$gpx){
            $errors[] = JText::_( 'COM_GEOCONTENT_ERROR_EMPTY_GEODATA' );
        }

        // Check GPX
        if(array_key_exists('gpx', $data) && $gpx){
            require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'libs'. DS . 'gpx2wkt.php';
            $parser = new gpx2wkt(file_get_contents($gpx));
            $geodata = $parser->getWKT();
            if(!$geodata){
                $errors[] = JText::_( 'COM_GEOCONTENT_ERROR_INVALID_GPX' );
            }
        }

        if($contentid && !self::checkContentId($contentid)){
            $errors[] = JText::_( 'COM_GEOCONTENT_WRONG_CONTENTID');
        }
        if($layerid && !self::getLayerData($layerid)){
            $errors[] = JText::_( 'COM_GEOCONTENT_WRONG_LAYERID' );
        }
        return $errors;
    }

}