<?php
/**
*
* @version      $Id: controller.php 66 2010-10-04 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2010 Alessandro Pasotti http://www.itopen.it
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml" style="height:100%">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title>Joomla! GeoContent Component</title>

    <script src="<?php echo GEOCONTENT_GOOGLE_MAPS_API ?>&amp;hl=<?php echo $this->gmap_lang; ?>"
      type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetpath . '/css/gmap.css'; ?>"></link>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetpath . '/css/geocontent.css'; ?>"></link>

    <script type="text/javascript">
    //<![CDATA[

        google.load("mootools", "1.2.3");
        google.load("maps", "2.s");

        // GeoContent item id
        var geocontentid = '<?php echo $this->id; ?>';
        // Make it global: the map object
        var map;
        // MBR
        var bounds;
        // Application status
        var application_status = 'nodata';
        // The geom feature list
        var feature_list = [];
        // Start feature
        var geodata = '<?php echo str_replace("\n", ' ', $this->item->geodata); ?>';
        // style
        var layer_style = {linergba : '#<?php echo $this->linergba; ?>', linewidth : <?php echo $this->linewidth; ?>, polyrgba : '#<?php echo $this->polyrgba; ?>', icon: '<?php echo JURI::root() . 'images/'.$this->point_icon_folder .'/' . $this->icon; ?>', iconsize : <?php echo $this->iconsize; ?>};
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
            map.setCenter(new google.maps.LatLng(<?php echo $this->gmap_latstart; ?>, <?php echo $this->gmap_lngstart; ?>), <?php echo $this->gmap_zoomstart; ?>);
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


            // Install click handler
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
                map.setCenter(new google.maps.LatLng(<?php echo $this->gmap_latstart; ?>, <?php echo $this->gmap_lngstart; ?>), <?php echo $this->gmap_zoomstart; ?>);
            }
            setStatus('editing');
        }


        function save_feature_list(){
            var parser = new GFormatWKT(editHandlerCb);
            bounds = new google.maps.LatLngBounds();
            var wkt = parser.write(feature_list);
            var options = {};
            options.method = 'post';
            options.url = '<?php echo $this->saveurl; ?>';
            options.onComplete = function(response) {
                // Item deleted
                if(!wkt && !document.geocontent_form.gpx) {
                    geocontentid = '';
                }
                // Get the geocontentid
                var m = response.match(/#(\d+)/);
                if(m){
                    geocontentid = m[1];
                }
                alert(response);
            };

            var myRequest = new Request(options).send(
                'geodata=' + wkt
                +'&minlat=' + bounds.getSouthWest().lat()
                +'&minlon=' + bounds.getSouthWest().lng()
                +'&maxlat=' + bounds.getNorthEast().lat()
                +'&maxlon=' + bounds.getNorthEast().lng()
                +'&layerid=<?php echo $this->layerid; ?>'
                +'&id=' + geocontentid
                +'&fe=1'
                +'&contentid=<?php echo $this->contentid; ?>'
                +'&content=<?php echo str_replace("\n", '\n', addcslashes($this->content, "'")); ?>'
                +'&tile=<?php echo addcslashes($this->title, "'"); ?>'
                +'&url=<?php echo addcslashes($this->url, "'") ; ?>'
                +'&contentname=<?php echo addcslashes($this->contentname, "'"); ?>'
                + '&<?php echo JUtility::getToken(); ?>=1'

            );
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
    <script src="<?php echo $this->assetpath . '/js/gmap_edit.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo $this->assetpath . '/js/gmap_wkt.js'; ?>" type="text/javascript"></script>

  </head>
  <body style="height:100%;margin:0">
    <div id="map_canvas" style="height:100%;width:<?php echo ($this->has_editing ? '75%;float:left' : '100%'); ?>"></div>

    <div id="map_sidebar" style="height:100%;width:25%;float:right">

        <div id="edit_controls" style="margin:0.25em;padding:0.25em;overflow:auto">
            <p class="gc_lbl" for="cg_save_btn"><?php  echo JText::_('COM_GEOCONTENT_EDIT');  ?></p>
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

            <button id="cg_save_btn" onclick="save_feature_list()"><?php echo JText::_('COM_GEOCONTENT_SAVE'); ?></button>

        </div>


        <hr />

        <div id="file_controls" style="margin:0.25em;padding:0.25em;overflow:auto">
            <p class="gc_lbl"><?php echo JText::_('COM_GEOCONTENT_LOAD_GPX_TRACK'); ?></p>
            <form method="post" action="<?php echo $this->saveurl; ?>" name="geocontent_form" enctype="multipart/form-data">
            <input type="hidden" name="format" value="raw" />
            <input type="hidden" name="fe" value="1" />
            <input type="hidden" name="contentid" value="<?php echo $this->contentid; ?>" />
            <input type="hidden" name="layerid" value="<?php echo $this->layerid; ?>" />
            <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
            <input type="hidden" name="cid[]" value="<?php echo $this->id; ?>" />
            <textarea style="display:none" name="content" id="content">
            <?php echo htmlentities($this->content); ?>
            </textarea>
            <input type="hidden" name="title" value="<?php echo addcslashes($this->title, '"'); ?>" />
            <input type="hidden" name="url" value="<?php echo addcslashes($this->url, '"'); ?>" />
            <input type="hidden" name="contentname" value="<?php echo addcslashes($this->contentname, '"'); ?>" />

            <?php echo JHTML::_( 'form.token' ); ?>
            <table>
                <tr><td><input size="10" type="file" name="gpx" id="gpx" /></td></tr>
                <tr><td><input type="submit" name="load" value="<?php echo JText::_('COM_GEOCONTENT_LOAD'); ?>" id="load" /></td></tr>
            </table>
            </form>
        </div>
    </div>
  </body>
</html>