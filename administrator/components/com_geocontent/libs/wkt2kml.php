<?php
/**
* Mapserver wrapper to KML/KMZ data
*
* Returns KML or KMZ representation of common OGC requests
*
* <pre>
* accepted parameters (case insensitive):
* - request     = string - request type (OGC WFS like), can be kml (default), kmz, icon
* - map         = string - path to mapfile
* - typename    = string - (can be a csv list) - layer id(s)
* - filter      = string - filter encoding
* - bbox        = string - (csv) - bounding box csv
* - encoding    = string - data and mapfile encoding, defaults to ISO-8859-1
*
*
* </pre>
*
* @author  Alessandro Pasotti
* @copyright 2007 ItOpen.it - All rights reserved
* @package KMLMAPSERVER

This file is part of KMLMAPSERVER.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/


/** Fix a GE bug for filled polygons, render as linestrings */
define('TREAT_POLY_AS_LINE', false);

/** Enable cache */
define('ENABLE_CACHE', false);

define('JMS_SUCCESS', true);
if(!defined('MS_ON')){
    define('MS_ON', true);
}

require_once dirname(__FILE__) . '/jmapobject.class.php';

/**
* Main server class
*/

class LayerServer {

    /** map file path */
    var $map;

    /** request */
    var $request;

    /** map instance */
    var $map_object;

    /** layer name(s) passed on the request */
    var $typename;

    /** array of requested layer objects (hash with layer name as key) */
    var $layers;

    /** filters */
    var $filter;

    /** bounding box */
    var $bbox;

    /** error messages */
    var $errors;

    /** send zipped data */
    var $_zipped = false;

    /** internal XML buffer */
    var $_xml;

    /** debug flag  */
    var $_debug = false;

    /** end point */
    var $endpoint;

    /** custom style counter */
    var $style_counter = 0;


    /**
    * Mapfile and data encoding encoding
    * XMl output must be UTF-8, attributes and METADATA based strings
    * must be converted to UTF-8, encoding defaults to ISO-8859-1, if
    * your encoding is different, you can set it through CGI style parameters
    */
    var $encoding;

    /**
    * Send networklink
    * wether folder should contain networklinks instead of real geometries
    * it is automatically set when all layers are requested
    */
    var $_networklink;


    /**
    * Initialize
    *
    */
    function LayerServer(){
        $this->errors = array();
        // Load request parameters
        $this->get_request();

        $this->style_counter = 0;

        // Load map
        if(!$this->has_error()) {
             $this->load_map();
        }
    }

    /**
    * Run the server and sends data
    * @return string or void
    */
    function run(){
        // Check cache
        if(ENABLE_CACHE){
            $cache_file = $this->get_cache_file_name();
            if(file_exists($cache_file)){
                // Check if is not expired
                if(filectime($cache_file) + KML_CACHE < (time())) {
                    error_log('removing cache ' . $cache_file);
                    //error_log('ctime : ' . filectime($cache_file) . ' , ' . time() . ' lm ' .  $layer->getMetadata('KML_CACHE'));
                    @unlink($cache_file);
                } else {
                    $this->send_header();
                    error_log('sending cache ' . $cache_file);
                    readfile($cache_file);
                    exit;
                }
            }
        }

        // If no layer are requested, send all as networklinks
        if(!$this->typename){
            $this->_networklink = true;
            $this->typename = $this->get_layer_list();
        } else {
            $this->_networklink = false;
        }

        $this->_xml = new SimpleXMLElement('<kml xmlns="http://earth.google.com/kml/2.0"><Document ></Document></kml>');
        // Set endpoint
        //die($_SERVER['REQUEST_URI']);
        $this->endpoint = (array_key_exists('HTTPS', $_SERVER) ? 'https' : 'http') . '://'.$_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] ? ':'.$_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'];


        // Process request
        if(!$this->has_error()) {
             $this->process_request();
        }
        if($this->has_error()){
            $this->add_errors();
        }
        //die($this->get_kml());
        return $this->send_stream($this->get_kml());
     }

    /**
    * Set debug flag
    * @param boolean $value
    */
    function set_debug($value){
        $this->_debug = $value;
    }

    /**
    * Get all request parameters
    */
    function get_request(){
        $this->map          = $this->load_parm('map');
        $this->bbox         = $this->load_parm('bbox');
        $this->filter       = $this->load_parm('filter');
        $this->typename     = stripslashes($this->load_parm('typename'));
        $this->encoding     = $this->load_parm('encoding', 'UTF-8');
        $this->request      = $this->load_parm('request', 'kml');

        if($this->request == 'kmz') {
            $this->_zipped = true;
        }
   }


    /**
    * Process request
    */
    function process_request(){
        // Get layer(s)
        $layers = explode(',', $this->typename);
        if($this->_networklink){
            foreach($layers as $layer_id){
                $this->add_networklink($layer_id);
            }
        } else {
            foreach($layers as $layer_id){
                $this->process_layer_request($layer_id);
            }
        }
    }

    /**
    * Add a networklink
    */
    function add_networklink(&$layer_id){
        $nl =& $this->_xml->Document->addChild('NetworkLink');

        $layer = @$this->map_object->getLayerById($layer_id);
        $nl->addChild('name', $this->get_layer_description($layer));
        $nl->addChild('visibility', 0);
        $link =& $nl->addChild('Link');
        $link->addChild('href', $this->endpoint . '?option=com_geocontent&amp;controller=layer&amp;task=kml&amp;map=' . $this->map . '&amp;typename=' . $layer_id . '&amp;request=' . ($this->_zipped ? 'kmz' : 'kml'). '&amp;encoding=' . $this->encoding);
    }


    /**
    * Process a single layer
    * @return boolean false on error
    */
    function process_layer_request(&$layer_id){

        $layer = $this->map_object->getLayerById($layer_id);
        $layer_name = $layer->name;

        if(!$layer){
            $this->set_error('Layer not found ' . $layer_name, $layer_name);
            return false;
        }

        // Add to layer list
        $this->layers[$layer_name] =&  $layer;

        // Get custom template if any
        $description_template = $layer->getMetadata('DESCRIPTION_TEMPLATE');
        $balloon_template     = $layer->getMetadata('BALLOON_TEMPLATE');
        $name_template        = $layer->getMetadata('NAME_TEMPLATE');

        // Set on
        $layer->set( 'status', MS_ON );

        // Set kml title from layer description (default to layer name)
        $layer_desc = $this->get_layer_description($layer);

        // Get results
        if(JMS_SUCCESS == $layer->open()){
            // Search which column to use to identify the feature
            $namecol = $layer->getMetadata('RESULT_FIELDS');
            if(!$namecol){
                $cols = array_values($layer->getItems());
                $namecol = $cols[0];
            }
            // Add classes
            $folder =& $this->_xml->Document->addChild('Folder');
            $class_list = $this->parse_classes($layer, $folder, $namecol, $title_field, $description_template, $name_template, $balloon_template);

            //die(print_r($class_list, true));
            $this->addCData($folder, 'description', $layer_desc);
            $this->addCData($folder, 'name', $layer_desc);
            //$folder->addChild('name', $layer_desc);

            $status = $layer->whichShapes($this->map_object->extent);
            while ($shape = $layer->nextShape()) {
                $this->process_shape($layer, $shape, $class_list, $folder, $namecol );
            }
            $layer->close();
        } else {
            $this->set_error('Layer cannot be opened: ' . $layer_name, $layer_name);
            return false;
        }
        return true;
    }


    /**
    * Process the shape
    */
    function process_shape(&$layer, &$shape, &$class_list, &$folder, &$namecol){
        // Assign style
        $style_id = array_pop(array_keys($class_list));
        // Add the feature
        if(array_key_exists('folder', $class_list[$style_id])) {
            $feature_folder =& $class_list[$style_id]['folder'];
        } else {
            //die('missing folder for ' . $style_id);
            $feature_folder =& $folder;
        }
        if(!is_object($feature_folder)){
            $folder_name = $feature_folder;
            $feature_folder =& $folder ->addChild('Folder');
            $feature_folder->addChild('name', $folder_name);
        }
        // Add style class
        $style_url =& $this->add_style($layer, $feature_folder, $style_id, $class_list[$style_id], $namecol, $shape->values);

        $wkt = $shape->toWkt();
        if(stripos($wkt, 'GEOMETRYCOLLECTION') === false){
            $wkt = "GEOMETRYCOLLECTION($wkt)";
        }
        // Split
        preg_match('/GEOMETRYCOLLECTION\((.*)\)/', $wkt, $wktar);
        $wkts = $wktar[1];
        // Separate components
        $wkts = preg_replace('/,\s*([A-Za-z])/', '|\1', $wkts);

        // Array of metadata
        $metadata = array(
            'KML_ADD_POINT' => $layer->getMetadata('KML_ADD_POINT')
        );
        //print_r(preg_split('/\|/', $wkts)); die();
        foreach(preg_split('/\|/', $wkts) as $wkt){
            $placemark =& $this->add_feature($feature_folder, $wkt, $shape->values[$namecol],  $shape->values, $class_list[$style_id]['description_template'], $class_list[$style_id]['name_template'], $class_list[$style_id], $metadata);
            if($shape->extended_data){
                $this->addExtendedData($placemark, $shape->extended_data, $shape->values);
            }
            //print "process_shape style_url : $style_url \n";
            $placemark->addChild('styleUrl', '#'. $style_url);
        }

    }

    /**
    * Add CDATA section
    */
    function addCData(&$parentnode, $nodename, $cdata_text)
    {
        $node = $parentnode->addChild($nodename); //Added a nodename to create inside the function
        $node = dom_import_simplexml($node);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
    }


    /**
    * Add the feature to the result set
    * @return reference to placemark object
    */
    function &add_feature(&$folder, &$wkt, $featurename, $attributes, $description_template, $name_template, $style_data, $metadata){
        $pm = $folder->addChild('Placemark');
        //$pm->addChild('name', str_replace('&', '&amp;', iconv($this->encoding, 'utf-8', $featurename)));
        //$pm->addChild('description', $this->get_feature_description($featurename, $attributes, $description_template));
        $this->addCData($pm, 'name', $this->get_feature_name($featurename, $attributes, $name_template));
        $this->addCData($pm, 'description', $this->get_feature_description($featurename, $attributes, $description_template));
        // Now parse the wkt
        if(strpos($wkt, 'MULTILINESTRING') !== false){
            $this->add_multilinestring($wkt, $pm, $featurename, $metadata['KML_ADD_POINT'] ? $style_data['icon'] : null);
        } elseif(strpos($wkt, 'LINESTRING') !== false){
            $this->add_linestring($wkt, $pm, $featurename, $metadata['KML_ADD_POINT'] ? $style_data['icon'] : null);
        } elseif(strpos($wkt, 'POINT') !== false){
            $this->add_point($wkt, $pm,  $featurename);
        } elseif(strpos($wkt, 'MULTIPOLYGON') !== false){
            if(TREAT_POLY_AS_LINE){
                $ml = $pm->addChild('MultiGeometry');
                foreach(preg_split('/\),\s*\(/', $wkt) as $line){
                    $this->add_multilinestring($line, $ml, $featurename, $metadata['KML_ADD_POINT'] ? $style_data['icon'] : null);
                }
            } else {
                $this->add_multipolygon($wkt, $pm,  $featurename);
            }
        } elseif(strpos($wkt, 'POLYGON') !== false){
            if(TREAT_POLY_AS_LINE){
                $this->add_multilinestring($wkt, $pm, $featurename, $metadata['KML_ADD_POINT'] ? $style_data['icon'] : null);
            } else {
                $this->add_polygon($wkt, $pm,  $featurename);
            }
        } else {
            // Error?
        }
        return $pm;
    }


    /**
    * Add extended_data
    */
    function addExtendedData(&$element, &$extended_data, &$values){
        $ed =& $element->addChild('ExtendedData');
        foreach($extended_data as $k){
            if(array_key_exists($k, $values)){
                $data = $ed->addChild('Data');
                $data['name'] = $k;
                $this->addCData($data, 'value', $values[$k]);
            }
        }
    }

    /**
    * Add a linestring
    * $add_points = adds start and end points
    */
    function add_linestring(&$wkt, &$element, $featurename, $add_points){
        preg_match('/(-?\d+\.\d+[^\(\)]*-?\d+\.\d+)/', $wkt, $data);
        $data = preg_replace('|,\s*|', '#', $data[1]);
        $data = preg_replace('|\s+|', ',', $data);
        $data = str_replace('#', ' ', $data);
        //print_r($data);
        if($add_points){
             //print_r($data);
             preg_match('/^(-?\d+\.\d+,-?\d+\.\d+).*?(-?\d+\.\d+,-?\d+\.\d+)$/', $data, $points);
             //print_r($points); die();
             if(count($points) == 3){
                $mg = $element->addChild('MultiGeometry');
                $ls = $mg->addChild('LineString');
                $pt1 = $mg->addChild('Point');
                $pt1->addChild('coordinates', $points[1]);
                $pt2 = $mg->addChild('Point');
                $pt2->addChild('coordinates', $points[2]);
             } else {
                $ls = $element->addChild('LineString');
             }
        } else {
            $ls = $element->addChild('LineString');
        }
        $ls->addChild('coordinates', $data);
    }

    /**
    * Add a multilinestring
    */
    function add_multilinestring(&$wkt, &$element, $featurename, $add_points = null){
        $ml = $element->addChild('MultiGeometry');
        foreach(preg_split('/\),\s*\(/', $wkt) as $line){
            $this->add_linestring($line, $ml, $featurename, $add_points );
        }
    }


    /**
    * Add a point
    */
    function add_point(&$wkt, &$element, $featurename){
        $pt = $element->addChild('Point');
        // 21-03-2012 Changed from + to * after comma digit
        preg_match('/(-?\d+\.?\d*\s+-?\d+\.?\d*)/', $wkt, $data);
        $data = str_replace(' ', ',', $data[1]);
        $pt->addChild('coordinates', $data);
    }


    /**
    * Add a polygon
    */
    function add_polygon(&$wkt, &$element, $featurename){
        $ml = $element->addChild('Polygon');
        foreach(preg_split('/\),\s*\(/', $wkt) as $line){
            preg_match('/(-?\d+[^\(\)]*-?\d)/', $wkt, $data);
            $data = preg_replace('/,\s*/', '#', $data[1]);
            $data = preg_replace('/\s+/', ',', $data);
            // Add 1 meter height
            $data = str_replace('#', ',1 ', $data) . ',1';
            $ml->addChild('tessellate', 1);
            //$element->addChild('altitudeMode', 'relativeToGround');
            $element->addChild('altitudeMode', 'clampToGround');
            $ob = $ml->addChild('outerBoundaryIs');
            $ls = $ob->addChild('LinearRing');
            $ls->addChild('coordinates', $data);
        }
    }


    /**
    * Add a multipolygon
    * FIXME: untested, should take holes into account
    */
    function add_multipolygon(&$wkt, &$element, $featurename){
        $ml = $element->addChild('MultiGeometry');
        foreach(preg_split('/\), \(/', $wkt) as $line){
           $this->add_polygon($line, $ml, $featurename );
        }
    }


    /**
    * Get the feature description
    */
    function get_feature_description($featurename, $attributes, $description_template){
        // Compute hyperlink
        if($description_template){
            // Hack for missing link
            if(@$attributes['link']){
                $description = $description_template;
            } else {
                $description = '%content%';
            }
            foreach($attributes as $k => $val){
                $description = str_ireplace("%$k%", iconv($this->encoding, 'utf-8', $val), $description);
            }
        } else {
            $description = iconv($this->encoding, 'utf-8', $featurename);
        }
        return $description;
    }

    /**
    * Get the feature featurename
    */
    function get_feature_name($featurename, $attributes, $name_template){
        // Compute hyperlink
        if($name_template){
            $_featurename = $name_template;
            foreach($attributes as $k => $val){
                if (strpos($_featurename, "%$k%") !== false && ! $val) {
                    return iconv($this->encoding, 'utf-8', $featurename);
                }
                $_featurename = str_ireplace("%$k%", iconv($this->encoding, 'utf-8', $val), $_featurename);
            }
        } else {
            $_featurename = iconv($this->encoding, 'utf-8', $featurename);
        }
        return $_featurename;
    }


    /**
    * Parse classes
    * @return array hash of 'style_id' => style_data)
    * @todo remove description_template from class (it's layer dependent)
    */
    function parse_classes(&$layer, &$folder,  &$namecol, &$title_field, &$description_template, &$name_template, &$balloon_template ){
        $style_ar = array();
        $numclasses = $layer->numclasses;
        for($i = 0; $i < $numclasses; $i++){
            $class = $layer->getClass($i);
            // Get styles
            for($j = 0; $j < $class->numstyles; $j++){
                $style = $class->getStyle($j);

            }
            if(property_exists($class, 'label')){
               $label = $class->label;
               $style['label_color']        = $label->color;
               $style['label_size']         = $label->size;
            } else {
               $style['label_color']        = null;
               $style['label_size']         = null;
            }
            $style['expression']        = $class->getExpression();
            // Set description_template if any
            $style['description_template'] = $description_template;
            // Set description_template if any
            $style['name_template'] = $name_template;
            // Set balloon_template_template if any
            $style['balloon_template'] = $balloon_template;
            // Create style element
            $style_id = preg_replace('/[^A-Za-z0-9]/', '', $layer->name . $class->name);
            //$this->add_style($layer, $folder, $style_id, $style, $namecol, $title_field );
            // create folder if more than one class
            if($numclasses > 1){
                $style['folder'] =& $class->name;
                //$folder->addChild('Folder');
                //$style['folder']->addChild('name', $class->name);
            }
            $style_ar[$style_id] = $style;
        }
        return $style_ar;
    }

    /**
    * Return a CSV list of all layer names in the mapfile
    * FIXME: filter out ANNOTATIONS and other "strange" layers
    */
    function get_layer_list(){
        $layer_list = array();
        for($i = 0; $i < $this->map_object->numlayers; $i++){
            $layer =& $this->map_object->getLayerById($i);
            $kml_skip = $layer->getMetadata('KML_SKIP');
            if(strtolower($kml_skip) !== 'true'){
                $layer_list[] = $layer->id;
            }
        }
        return join(',', $layer_list);
    }


    /**
    * Add the style
    * @return the style URL
    */
    function add_style(&$layer, &$folder, $style_id, &$style_data){
        // Calculare style URL
        /*
        if($style_data['description_template']){
            $this->style_counter++;
            $style_id .= '_'.$this->style_counter;
            $balloon_template = $this->get_feature_description($attributes[$namecol], $attributes, $style_data['description_template']);
        }
        */
        //print "add_style($style_id) \n";
        // Check if the style already exists
        $expr = '//*[@id=\''.$style_id.'\']';
        if($folder->xpath($expr)) {
            return $style_id;
        }
        $new_style =& $this->_xml->Document->addChild('Style');
        $new_style['id'] = $style_id;
        $this->add_style_point($new_style, $style_data, true);
        $this->add_style_polygon($new_style, $style_data);
        $this->add_style_line($new_style, $style_data);
        // Add the balloon style if description_template is set
        if($style_data['balloon_template']){
            $this->add_balloon_style($new_style, $style_data['balloon_template']);
        }
        return $style_id;
    }

    /**
    * Add style for lines
    */
    function add_style_line(&$new_style, &$style_data){
        if($style_data['color']){
            $st =& $new_style->addChild('LineStyle');
            $st->addChild('color', strtoupper($style_data['color']));
            if($style_data['width']) {
                $st->addChild('width', $style_data['width']);
            }
        }
    }

    /**
    * Add style for points
    */
    function add_style_point(&$new_style, &$style_data, $skip_balloon = false){
        if($style_data['icon']){
            $st =& $new_style->addChild('IconStyle');
            if($style_data['width'] && $style_data['icon_width'] != 32){
                $st->addChild('scale', $style_data['icon_width'] / 32);
            }
            $icon =& $st->addChild('Icon');
            $icon->addChild('href', htmlentities($style_data['icon']));
        }
        //*/
        // Label size and color
        if($style_data['label_size'] || $style_data['label_color']){
            $ls =& $new_style->addChild('LabelStyle');
            if($style_data['label_size'] != -1 && $style_data['label_size'] != 32){
                 $ls->addChild('scale', $style_data['label_size'] / 32);
            }
            if($style_data['label_color']){
                $ls->addChild('color',  strtoupper($style_data['label_color']));
            }
        }
    }

    /**
    * Add style for polygons
    */
    function add_style_polygon(&$new_style, &$style_data){
        // Get also outline styles
/*        $st =& $new_style->addChild('LineStyle');
        if($style_data['outlinecolor']){
            $st->addChild('color', strtoupper($style_data['outlinecolor']));
            if($width) {
                $st->addChild('width', $width);
            }
        }*/
        $st2 =& $new_style->addChild('PolyStyle');
        //die(print_r($backgroundcolor, true));
        if($style_data['backgroundcolor']){
            $st2->addChild('color', strtoupper($style_data['backgroundcolor']));
            $st2->addChild('fill', 1);
        } else {
            $st2->addChild('fill', 0);
        }
        $st2->addChild('outline', 1);
    }

    /**
    * Add a WMS raster link
    */
    function add_wms_link(&$folder, &$layer, &$link){
        // Build up the KML response document.
        $icon =& $folder->addChild('Icon');
        $icon->addChild('href', $link . 'layers=' . $layer->name);
        //$icon->addChild('viewBoundScale', 1.5);
        $icon->addChild('viewRefreshMode', 'onStop');
        $llbox =& $folder->addChild('LatLonBox');
        $ext = $this->map_object->extent;
        $llbox->north = $ext->maxy;
        $llbox->south = $ext->miny;
        $llbox->east  = $ext->maxx;
        $llbox->west  = $ext->minx;
     }


    /**
    * Get the layer description
    */
    function get_layer_description(&$layer){
        $description = $layer->getMetadata('DESCRIPTION');
        if(!$description){
            $description = $layer->getMetadata('OWS_TITLE');
        }
        if(!$description){
            $description = $layer->getMetadata('WFS_TITLE');
        }
        if(!$description){
            $description = $layer->getMetadata('WMS_TITLE');
        }
        if(!$description){
            $description = $layer->name;
        }
        return $description;
    }



    /**
    * Add style for balloon
    * @param string style XML id
    * @param string column name for title
    */
    function add_balloon_style(&$style, $balloon_template){
        $balloon =& $style->addChild('BalloonStyle');
        $balloon->addChild('text', htmlentities($balloon_template));
    }


    /**
    * Get a request parameter
    * @param string $name
    * @param string $default parameter optional
    * @return string the parameter value or empty string if null
    */
    function load_parm($name, $default = ''){
        if(!isset($_REQUEST[$name])) return $default;
        $value = $_REQUEST[$name];
        if(get_magic_quotes_gpc() != 1) $value = addslashes($value);
        //$value = escapeshellcmd($value);
        return $value;
    }

    /**
    * Set error message
    * @param string $message
    * @param string $layer name
    */
    function set_error($message, $layer = 'Error'){
        $this->errors[$layer][] = $message;
    }


    /**
    * Load the map and create the map instance
    */
    function load_map(){
        $this->map_object = new JMapObject($this->filter);
    }

    /**
    * Test if has errors
    * @return boolean
    */
    function has_error(){
        return count($this->errors) > 0;
    }

    /**
    * Add error messages to folders TAGS
    */
    function add_errors(){
        foreach($this->errors as $layer => $errors){
            $folder =& $this->_xml->Document->addChild('Folder');
            $folder->addChild('name', $layer);
            $folder->addChild('description', '<p>' . join("</p>\n<p>", $errors) . "</p>");
        }
        return $errorxml;
    }

    /**
    * Fetch XML and format it
    */
    function get_kml(){
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $domnode = dom_import_simplexml($this->_xml);
        $domnode = $doc->importNode($domnode, true);
        $domnode = $doc->appendChild($domnode);
        // Suppress wierd not-utf-8 errors
        return @$doc->saveXML();
    }

    /**
    * Send header
    */
    function send_header(){
        header('Content-type: application/vnd.google-earth.km'.($this->_zipped ? 'z' : 'l').'+XML');
        header('Content-disposition: inline; filename=doc'.($this->_zipped ? '.kmz' : '.kml'));
    }

    /**
    * Calculate cache file name
    */
    function get_cache_file_name(){
        return  'cache/'. md5($_SERVER['QUERY_STRING']) . ($this->_zipped ? '.kmz' : '.kml');
    }


    /**
    * Send stream
    */
    function send_stream($data){

        $app = JFactory::getApplication();

        // Apply Uri to index.php if SEF is off
        if ($app->getCfg('sef')=='0') {
            $regex  = '#href="index.php\?([^"]*)#m';
            $data = preg_replace($regex, 'href="' . JURI::root() . 'index.php?\1' , $data);
        } else {
            // Now triggers system plugins
            JResponse::setBody($data);
            JPluginHelper::importPlugin('system');
            $dispatcher =& JDispatcher::getInstance();
            $dispatcher->trigger( 'onAfterRender' );
            $data = JResponse::getBody();

            // Adds base
            $base   = JURI::base(true).'/';
            $regex  = '#href="' . $base . '#m';
            $data = preg_replace($regex, 'href="' . JURI::root() , $data);
        }

        // Fix embedded images
        $regex  = '#src="'.JURI::base(true).'/([^"]*)#m';
        $data = preg_replace($regex, 'src="' . JURI::base() . '\1' , $data);


        $this->send_header();
        // Compress data
        if($this->_zipped){
            include("zip.class.php");
            $ziper = new zipfile();
            $ziper->addFile($data, 'doc.kml');
            $data = $ziper->file();
        }
        // Create cache if needed
        if(ENABLE_CACHE && count($this->layers) == 1 && $this->layers[$this->typename]->getMetadata('KML_CACHE')) {
            error_log( 'creating cache ' . $this->get_cache_file_name() );
            file_put_contents($this->get_cache_file_name(), $data);
        }
        print $data;
        exit();
    }
}