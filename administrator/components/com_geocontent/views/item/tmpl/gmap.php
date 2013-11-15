<?php
/**
*
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

*/?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml" style="height:100%">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title>Joomla! GeoContent Component</title>

    <script src="http://www.google.com/jsapi?key=<?php echo $this->google_api_key; ?>&amp;hl=<?php echo $this->map_lang; ?>"
      type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetpath . '/css/gmap.css'; ?>"></link>


    <script type="text/javascript">
    //<![CDATA[

        //google.load("mootools", "1.2.3");
        google.load("maps", "2.s");

        // Make it global: the map object
        var map;
        // MBR
        var bounds ;
        // The geom feature list
        var feature_list = [];
        // Start feature
        var geodata = '<?php echo str_replace("\n", ' ', $this->item->geodata); ?>';
        //try loading from opener
        try {
            var geodata = parent.$('jform_geodata').value;
        } catch(e){}
        if (!geodata){
            geodata = '<?php echo str_replace("\n", ' ', $this->item->geodata); ?>';
        }
        // Application status
        var application_status = 'nodata';
        // style
        var layer_style = {linergba : '#<?php echo $this->layer->linergba; ?>', linewidth : <?php echo $this->layer->linewidth; ?>, polyrgba : '#<?php echo $this->layer->polyrgba; ?>', icon: '<?php echo $path = JURI::root() . 'images/'.$this->point_icon_folder .'/' . $this->layer->icon; ?>', iconsize : <?php echo $this->layer->iconsize; ?>};
        // Editing status: feature type
        var editing_feature = '';


        function OnLoad() {
            // Features MBR
            bounds = new google.maps.LatLngBounds();
           // Map setup
            GPolygon.prototype.WKT = 'POLYGON';
            GPolygon.prototype.CLASSNAME = 'GPolygon';

            GPolyline.prototype.WKT = 'LINESTRING';
            GPolyline.prototype.CLASSNAME = 'GPolyline';

            GMarker.prototype.WKT = 'POINT';
            GMarker.prototype.CLASSNAME = 'GMarker';
            map = new google.maps.Map2(document.getElementById("map_canvas"));
            map.setCenter(new google.maps.LatLng(<?php echo $this->map_latstart; ?>, <?php echo $this->map_lngstart; ?>), <?php echo $this->map_zoomstart; ?>);
            map.addMapType(G_PHYSICAL_MAP);
            map.removeMapType(G_HYBRID_MAP);
            map.addControl(new GMapTypeControl());
            if(map.getSize().width > 400) {
                map.addControl(new google.maps.OverviewMapControl());
                map.addControl(new google.maps.LargeMapControl());
            } else {
                map.addControl(new google.maps.SmallMapControl());
            }
            map.enableScrollWheelZoom();
            buttonSelect("hand_b");
            // Get startup parameters

            // Install delete handler
            google.maps.Event.addListener(map, "click", function(ol) {
                    if(ol && $('delete_b').hasClass('selected')){
                        try {
                            if(ol.WKT != 'POINT'){
                                ol.disableEditing();
                            }
                            map.removeOverlay(ol);
                            GEvent.clearInstanceListeners(ol);
                            buttonSelect("hand_b");
                        } catch(e) {}
                    }
            });

            // Install list handler
            google.maps.Event.addListener(map, "addoverlay", function(ol) {
                //console.log('addoverlay event fired');
                if(typeof ol.WKT !== 'undefined'){
                    if(application_status == 'nodata' || editing_feature == ol.WKT){
                        feature_list.push(ol);
                        //console.log('added ' + ol.WKT);
                    }
                }
            });


            // Install delete handler
            google.maps.Event.addListener(map, "removeoverlay", function(ol) {
                if(typeof ol.WKT !== 'undefined'){
                    feature_list.erase(ol);
                    //console.log('removed ' + ol.WKT);
                }
            });

            // Load WKT data
            if(geodata){
                var parser = new GFormatWKT(editHandlerCb);
                parser.read(geodata);
                map.setZoom(map.getBoundsZoomLevel(bounds));
                map.setCenter(bounds.getCenter());
            } else {
                map.setCenter(new google.maps.LatLng(<?php echo $this->map_latstart; ?>, <?php echo $this->map_lngstart; ?>), <?php echo $this->map_zoomstart; ?>);
            }
            setStatus('editing');
        }

        function save_feature_list(){
            var parser = new GFormatWKT(editHandlerCb);
            bounds = new google.maps.LatLngBounds();
            var wkt = parser.write(feature_list);
            try {
                parent.<?php echo $this->jscallback ?>(wkt, bounds.getSouthWest().lat(), bounds.getSouthWest().lng(), bounds.getNorthEast().lat(),bounds.getNorthEast().lng());
                parent.SqueezeBox.close();
            } catch(e) {
                alert('<?php echo JText::_('COM_GEOCONTENT_ERROR_SAVING') ?>.\n' + wkt + '\n' + e.message);
            }
        }

        function quit(){
            if(window.opener){
                window.close(this);
            }
        }

        // Set onload cb
        google.setOnLoadCallback(OnLoad);

    //]]>
	</script>

    <script src="<?php echo $this->assetpath . '/js/gmap_edit.js'; ?>"      type="text/javascript"></script>
    <script src="<?php echo $this->assetpath . '/js/gmap_wkt.js'; ?>"      type="text/javascript"></script>

  </head>
  <body style="height:100%;margin:0">
    <div id="map_canvas" style="height:100%;width:<?php echo ($this->has_editing ? '75%;float:left' : '100%'); ?>"></div>
    <?php if($this->has_editing){ ?>
    <div id="map_sidebar" style="height:100%;width:25%;float:right">

        <div id="edit_controls" style="margin:0.25em;padding:0.25em;overflow:auto">
            <h2><?php  echo JText::_('COM_GEOCONTENT_EDIT');  ?></h2>
            <table>
                <tr>
                    <td><div id="hand_b"        onclick="stopEditing()"/></td>
                    <td><div id="placemark_b"   onclick="placeMarker()"/></td>
                    <td><div id="line_b"        onclick="startLine()"/></td>
                    <td><div id="shape_b"       onclick="startShape()"/></td>
                    <td><div id="delete_b"      onclick="deleteShape()"/></td>
                </tr>
            </table>

            <input type="hidden" id="featuredetails" rows="2"/>
            <p><?php echo JText::_('COM_GEOCONTENT_GMAP_EDIT_MSG'); ?>
            </p>
            <table id ="featuretable">
                <tbody id="featuretbody"></tbody>
            </table>
        </div>

        <div id="file_controls" style="margin:0.25em;padding:0.25em;overflow:auto">
            <h2><?php echo JText::_('COM_GEOCONTENT_FILE'); ?></h2>
            <table>
                <tr><td><button onclick="save_feature_list()"><?php echo JText::_('COM_GEOCONTENT_SAVE'); ?></button></td></tr>
                <?php /*
                <tr><td><button onclick="quit()"><?php echo JText::_('COM_GEOCONTENT_CANCEL'); ?></button></td></tr>
                */ ?>
            </table>
        </div>


    </div>
    <?php } // end has editing ?>
  </body>
</html>