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
jimport('joomla.application.component.helper');
JFormHelper::loadFieldClass('textarea');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'geocontent.php';

// The class name must always be the same as the filename (in camel case)
class JFormFieldOlmap extends JFormFieldTextarea {

    //The field class must know its own type through the variable $type.
    public $type = 'olmap';

    public function setId($id){
        $this->id = $id;
        $this->name = $id;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getInput() {
        extract(GeoContentHelper::getComponentParamsArray());
        $assetpath          = GeoContentHelper::getAssetURL();
        $doc =& JFactory::getDocument();

        # Include mootools First!!!
        JHtml::_('behavior.framework', true);

        $doc->addScript(GEOCONTENT_GOOGLE_MAPS_API);
        $doc->addScript('http://dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.1');
        $doc->addScript($ol_url);
        $doc->addScript($ol_osm_url);
        $doc->addStyleDeclaration('.olmap_container img {margin:0; padding:0;}');
        $doc->addStyleDeclaration('.olControlLayerSwitcher input {float: none; margin: 6px 5px 0 0;}');
        $doc->addStyleSheet($assetpath .'/css/ol_google.css');
        $doc->addStyleDeclaration('div.olMap div.olControlMousePosition {left: 50px; top: 0px; bottom: inherit; right: inherit;}');
        $doc->addScript($assetpath .'/js/olwidget/js/olwidget.js');
        //<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        //<meta name="apple-mobile-web-app-capable" content="yes">

        $olwidget = <<<__JS__
        <script type='text/javascript'>

            // Google API v2 to v3...
            G_HYBRID_MAP = google.maps.MapTypeId.HYBRID;
            G_SATELLITE_MAP = google.maps.MapTypeId.SATELLITE;
            G_PHYSICAL_MAP = google.maps.MapTypeId.PHYSICAL;
            G_STREET_MAP = google.maps.MapTypeId.STREET;

            // No SRID wanted!  Monkeypatching...
            olwidget.featureToEWKT = function(feature, proj) {
                if(olwidget.isCollectionEmpty(feature)){
                    return '';
                }
                // No collection
                if(feature.length == 1){
                    feature = feature[0];
                }
                return this.wktFormat.write(feature);
            };

            var edit_layer;
            var olmap;

            window.addEvent('domready', function(){
                olmap = new olwidget.EditableMap('$this->id', {
                    name: 'GeoData',
                    geometry: ['point', 'linestring', 'polygon'],
                    isCollection: true,
                    defaultLat: $map_latstart,
                    defaultLon: $map_lngstart,
                    defaultZoom: $map_zoomstart,
                    hideTextarea: true,
                    layers : ['osm.mapnik', 'osm.osmarender', 'google.streets', 'google.physical', 'google.satellite', 'google.hybrid', 've.road', 've.shaded', 've.aerial', 've.hybrid']
                    // TODO: styles
                });
                olmap.addControl(new OpenLayers.Control.MousePosition());
                edit_layer = olmap.getLayersByClass('olwidget.EditableLayer')[0]
                edit_layer.events.on({
                    "featuremodified": function(evt){
                        var extent = edit_layer.getDataExtent().transform(olmap.projection, olmap.displayProjection);
                        updateBounds(extent.bottom, extent.left, extent.top, extent.right);
                    },
                    "featureadded": function(evt){
                        var extent = edit_layer.getDataExtent().transform(olmap.projection, olmap.displayProjection);
                        updateBounds(extent.bottom, extent.left, extent.top, extent.right);
                    },
                    scope: edit_layer
                });
                $('$this->id').addEvent('change', function(evt){
                    edit_layer.redraw();
                });
            });

            // addAddressToMap() is called when the geocoder returns an
            // answer.  It adds a marker to the map with an open info window
            // showing the nicely formatted version of the address and the country code.
            function addAddressToMap(response, status_code) {
                if (!response || status_code != 'OK') {
                    alert("Address not found.");
                } else {
                    var place = response[0].formatted_address;
                    var lng = response[0].geometry.location.lng();
                    var lat = response[0].geometry.location.lat();
                    var active_layer = [];
                    $$('input[name="active_layer"]').each(function(e){
                        if(e.checked){
                            active_layer.push(e.value);
                        }
                    });
                    var address_point = new OpenLayers.LonLat(lng, lat).transform(new OpenLayers.Projection('EPSG:4326'), olmap.projection);
                    olmap.setCenter(address_point, $map_zoomstart);
                    if(document.getElementById('gc_addpoint').checked) {
                        var f = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(address_point.lon, address_point.lat));
                        var edit_layer = olmap.getLayersByClass('olwidget.EditableLayer')[0];
                        var sw = olmap.getControlsByClass('olwidget.EditableLayerSwitcher')[0];
                        sw.setEditing(edit_layer);
                        edit_layer.addFeatures([f]);
                    }
                }
            }

            // showLocation() is called when you click on the Search button
            // in the form.  It geocodes the address entered into the form
            // and adds a marker to the map at that location.
            function gcGeoCoding (){
                address = document.getElementById('gc_address').value;
                if(!address){
                    return false;
                }
                geocoder = new google.maps.Geocoder();
                var address = document.getElementById('gc_address').value;
                geocoder.geocode({address: address}, addAddressToMap);
                return false;
            }

        </script>
__JS__;
        $doc->addStyleSheet($assetpath .'/js/olwidget/css/olwidget.css');

        // GeoCoding
        $gc_input = <<<__HTML__
        <label for="gc_address">Zoom to address:</label> <input type="text" name="gc_address" id="gc_address" value="" />
        <input type="button" name="gc_submit" id="gc_submit" value="Search" onclick="return gcGeoCoding()" />&nbsp;<input id="gc_addpoint" type="checkbox" /><label for="gc_addpoint"> add the address location to the map</label><br />
__HTML__;
        // code that returns HTML that will be shown as the form field
        return "<div style=\"clear: both;width:100%;\">$gc_input</div><div  style=\"clear: left;\" class=\"fltlft olmap_container\">" . parent::getInput() . "</div>\n" . $olwidget;
    }
}

?>