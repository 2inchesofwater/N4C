/**
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
*
*/

// Google API v2 to v3...
G_HYBRID_MAP = google.maps.MapTypeId.HYBRID;
G_SATELLITE_MAP = google.maps.MapTypeId.SATELLITE;
G_PHYSICAL_MAP = google.maps.MapTypeId.TERRAIN;
G_STREETS_MAP = google.maps.MapTypeId.ROADMAP;
G_STREET_MAP = google.maps.MapTypeId.ROADMAP;


/**
* Base class
*/
var GCBaseMapClass = new Class({
    olmap: null,
    Implements: [ Options ],
    options: {
        kml_layers: [],
        map_num: 0,
        initial_layers: [],
        initial_base_layers: [],
        map_options: {},
        show_mouse_position: false,
        replace_target: true
    },

    initialize: function( options )
    {
        this.setOptions( options );
        // Set up map
        this.setUpMap();
        // Initial layers to load
        this.loadInitialLayers();
    },

    loadInitialLayers: function(){
        for (typename in this.options.initial_layers){
            this.createLayer(typename);
            this.setTOCControls(typename, true);
        };

    }.protect(),


    getLayerByTypename: function (typename){
        return this.options.kml_layers[typename];
    },

    setTOCControls: function(typename, state){
        try{
            $('laycb_' + this.options.map_num + '_' + typename).checked = state;
        } catch(e){}
        try{
            $('toc_select_' + this.options.map_num).value = typename;
        } catch(e){}
    }
});

/**
* Olwidget wrapper
*/
var GCOlwidgetmapClass = new Class({
    Extends: GCBaseMapClass,

    initialize: function( options )
    {
        options.data_projection = new OpenLayers.Projection("EPSG:4326");
        // setting restrictedExtent so that we can use the
        // VirtualEarth-layers, see e.g.
        // http://dev.openlayers.org/apidocs/files/OpenLayers/Layer/VirtualEarth-js.html
        var maxExtent = new OpenLayers.Bounds(-20037508, -20037508, 20037508, 20037508);
        var restrictedExtent = maxExtent.clone();
        var maxResolution = 156543.0339;
        options.map_options.restrictedExtent = restrictedExtent;
        options.map_options.maxResolution = maxResolution;
        options.map_options.maxExtent = maxExtent;
        options.map_options.mapOptions = {
            controls: ['Navigation', 'PanZoom', 'Attribution']
        };
        // Set custom theme
        if (options.ol_custom_theme){
            OpenLayers.ImgPath = options.ol_custom_theme;
        }
        this.parent(options);
    },

    setUpMap: function(){
        this.gcmap = new olwidget.Map('map_canvas_' + this.options.map_num, [], this.options.map_options);
        this.gcmap.addControl(new OpenLayers.Control.LayerSwitcher(this.options.layer_switcher_colors));
        this.gcmap.events.on({
            zoomend: this.gcmap.zoomEnd,
            scope: this.gcmap
        });
        if(this.options.show_mouse_position){
            this.gcmap.addControl(new OpenLayers.Control.MousePosition());
        }
    }.protect(),

    // Adds kml layers
    createLayer: function(typename){
        var l = this.getLayerByTypename(typename);
        if(l){
            if(! l.ol){
                l.ol = new OpenLayers.Layer.Vector(l.name, {
                    strategies: parseInt(l.cluster) ? [new OpenLayers.Strategy.Cluster({threshold: 2}), new OpenLayers.Strategy.Fixed()] : [new OpenLayers.Strategy.Fixed()],
                    protocol: new OpenLayers.Protocol.HTTP({
                        url: l.url.replace(/&amp;/g,'&').replace(/request=kmz/, 'request=kml'),
                        format: new OpenLayers.Format.KML({
                            extractStyles: !this.options.map_options.styles[l.id],
                            extractAttributes: true,
                            maxDepth: 2
                        })
                    }),
                    projection: this.options.data_projection,
                    styleMap: this.options.map_options.styles[l.id] ? new OpenLayers.StyleMap(this.options.map_options.styles[l.id]): null
                });
                l.ol.events.on({
                    'loadend' : function(e){
                        // Select highlighted features
                        if(this.options.highlight[typename]){
                            for (var i = 0; i < this.options.highlight[typename].length; i++) {
                                var f = l.ol.getFeatureBy('fid', this.options.highlight[typename][i]);
                                if(f){
                                    this.gcmap.selectControl.select(f);
                                }
                            }
                        }
                    },
                    'visibilitychanged': function(elm){
                        //this.setTOCControls(l.id, elm.object.getVisibility());
                    },
                    // Clustering management: copy attributes
                    'beforefeatureadded': function(elm){
                        if(elm.feature.cluster){
                            var name = [];
                            var description = [];
                            elm.feature.cluster.each(function(feature){
                                name.push(feature.attributes.name);
                                description.push(feature.attributes.description);
                                feature.attributes.html = '<h1>' + feature.attributes.name + '</h1>' + feature.attributes.description;
                            });
                            elm.feature.attributes.name = name.join(', ');
                            elm.feature.attributes.description = description.join(', ');
                        }
                        elm.feature.attributes.html = '<h1>' + elm.feature.attributes.name + '</h1>' + elm.feature.attributes.description;
                        if(!this.options.replace_target){
                            elm.feature.attributes.html = elm.feature.attributes.html.replace(/class="gc_readmore"/, 'class="gc_readmore" target="_blank"');
                        }
                        try {
                            elm.feature.fid = elm.feature.attributes.id.value;
                        } catch(e){
                            //console.log('Error setting FID');
                        }
                    },
                    scope: this
                });

                this.gcmap.addLayers([l.ol]);
                this.gcmap.vectorLayers.push(l.ol);
                // Controls
                this.gcmap.removeControl(this.gcmap.selectControl);
                delete this.gcmap.selectControl;
                this.gcmap.selectControl = new OpenLayers.Control.SelectFeature(
                    this.gcmap.vectorLayers, {hover: this.options.balloon_onmouseover});
                this.gcmap.selectControl.events.on({
                    featurehighlighted: function(evt){
                        // Checks if it comes from a user click
                        if(evt.object.handlers.feature.evt){
                            this.featureHighlighted(evt);
                        }
                    },
                    featureunhighlighted: this.gcmap.featureUnhighlighted,
                    scope: this.gcmap
                });
                // Allow dragging when over features.
                this.gcmap.selectControl.handlers.feature.stopDown = false;
                this.gcmap.addControl(this.gcmap.selectControl);
                this.gcmap.selectControl.activate();
            }
        }
    },

    // Popups
    onPopupClose: function(evt) {
        // 'this' is the popup.
        this.that.gcmap.selectControl.unselect(this.feature);
    },

    hideAllLayers: function(){
        for(l in this.options.kml_layers){
            if(this.options.kml_layers[l].ol){
                this.options.kml_layers[l].ol.setVisibility(false);
            }
        };
    },

    toggleLayer: function(typename, state){
        var l = this.getLayerByTypename(typename);
        if(l){
            if(!l.ol){
                this.createLayer(l.id);
            }
            if(typeof state == 'undefined') {
                state = !l.ol.getVisibility();
            }
            l.ol.setVisibility(state);
            this.setTOCControls(l.id, state);
        }
    },

    zoomToExtent: function(min_lng, min_lat, max_lng, max_lat){
        var bounds = new OpenLayers.Bounds(min_lng, min_lat, max_lng, max_lat);
        this.gcmap.zoomToExtent(bounds.transform(this.options.data_projection, this.gcmap.projection));
    },

    setCenterZoom: function(lng, lat, zoom){
        if(typeof zoom == 'undefined'){
            zoom = this.options.map_options.defaultZoom;
        }
        this.gcmap.setCenter(new OpenLayers.LonLat(lng, lat).transform(
            this.options.data_projection,
            this.gcmap.getProjectionObject()
        ), zoom);
    }
});

/**
* Plain old OpenLayers wrapper
*/
var GCOlmapClass = new Class({
    Extends : GCOlwidgetmapClass,

    initialize: function( options )
    {
        options.map_options.layers = null;
        this.parent(options);
    },

    setUpMap: function(){
        this.gcmap = new OpenLayers.Map('map_canvas_' + this.options.map_num, this.options.map_options );

        var layers = [];
        for (var i = 0; i < this.options.initial_base_layers.length; i++) {
            var parts = this.options.initial_base_layers[i].split(".");
            layers.push(olwidget[parts[0]].map(parts[1]));
        }
        this.gcmap.addLayers(layers);

        // TODO controls configurations
        this.gcmap.addControl(new OpenLayers.Control.LayerSwitcher(this.options.layer_switcher_colors));

        // Google.v3 uses EPSG:900913 as projection, so we have to
        // transform our coordinates
        this.setCenterZoom(this.options.map_options.defaultLon, this.options.map_options.defaultLat, this.options.map_options.defaultZoom);
        // Show Coordinates
        if(this.options.show_mouse_position){
            this.gcmap.addControl(new OpenLayers.Control.MousePosition({displayProjection: this.options.data_projection}));
        }

    },

    onFeatureSelect: function(evt) {
        var feature = evt.feature;
        if(!this.options.replace_target){
            feature.attributes.description = feature.attributes.description.replace(/class="gc_readmore"/, 'class="gc_readmore" target="_blank"');
        }
        this.popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                feature.geometry.getBounds().getCenterLonLat(),
                                new OpenLayers.Size(100,100),
                                feature.data.description,
                                null, true, this.onPopupClose);
        this.popup.that = this; // Store self into that
        feature.popup = this.popup;
        this.popup.feature = feature;
        this.gcmap.addPopup(this.popup);
    },

    onFeatureUnselect: function (evt) {
        var feature = evt.feature;
        if (feature.popup) {
            this.popup.feature = null;
            this.gcmap.removePopup(feature.popup);
            feature.popup.destroy();
            feature.popup = null;
        }
    },

    // Adds kml layers
    createLayer: function(typename){
        var l = this.getLayerByTypename(typename);
        if(l){
            if(! l.ol){
                l.ol = new OpenLayers.Layer.Vector(l.name, {
                    strategies: [new OpenLayers.Strategy.Fixed()],
                    protocol: new OpenLayers.Protocol.HTTP({
                        url: l.url.replace(/&amp;/g,'&').replace(/request=kmz/, 'request=kml'),
                        format: new OpenLayers.Format.KML({
                            extractStyles: !this.options.map_options.styles[l.id],
                            extractAttributes: true,
                            maxDepth: 2
                        })
                    }),
                    styleMap: this.options.map_options.styles[l.id] ? new OpenLayers.StyleMap(this.options.map_options.styles[l.id]): null
                });
                l.ol.events.on({
                    'featureselected': this.onFeatureSelect,
                    'featureunselected': this.onFeatureUnselect,
                    'visibilitychanged' : function(elm){
                        //this.setTOCControls(l.id, elm.object.getVisibility());
                    },
                    scope: this
                });
                this.gcmap.addLayers([l.ol]);
                // Add selectControl
                if(!this.gcmap.selectControl){
                    this.gcmap.selectControl = new OpenLayers.Control.SelectFeature([l.ol], {hover: this.options.balloon_onmouseover});
                } else {
                    var layers = this.gcmap.selectControl.layers;
                    layers.push(l.ol)
                    this.gcmap.removeControl(this.gcmap.selectControl);
                    delete this.gcmap.selectControl;
                    this.gcmap.selectControl = new OpenLayers.Control.SelectFeature(layers, {hover: this.options.balloon_onmouseover});
                }
                this.gcmap.addControl(this.gcmap.selectControl);
                this.gcmap.selectControl.activate();
            }
        }
    }

});

/**
* Google Wrapper
*/
var GCGmapClass = new Class({
    Extends : GCBaseMapClass,

    initialize: function( options )
    {
        this.parent(options);
    },

    setUpMap: function(){
        var latlng = new google.maps.LatLng(this.options.map_options.defaultLat, this.options.map_options.defaultLon);
        var mapTypeIds = [];
        this.options.initial_base_layers.each(function(bl){
            if(bl.match(/^google\./)){
                mapTypeIds.push(eval(bl.replace('google.', 'G_').toUpperCase() + '_MAP'));
            }
        });
        if(!mapTypeIds.length){
            mapTypeIds = [G_STREET_MAP, G_SATELLITE_MAP, G_PHYSICAL_MAP, G_HYBRID_MAP];
        }
        var mapTypeId = mapTypeIds[0];
        var myOptions = {
            zoom: this.options.map_options.defaultZoom,
            center: latlng,
            mapTypeId: mapTypeId,
            mapTypeControlOptions: {mapTypeIds: mapTypeIds}
        };
        this.gcmap = new google.maps.Map(document.getElementById('map_canvas_' + this.options.map_num), myOptions);
        // Prevents _blank
        if(this.options.replace_target){
            if(!window.MooTools){
                alert('You have choosen to replace target _blank for Google maps balloon links, this function requires MooTools library: please install and activate MooTools.');
            } else {
                document.id('map_canvas_' + this.options.map_num).addEvent('click:relay(a)', function(event, target){
                    event.preventDefault();
                    window.document.location.href = target.get('href');
                });
            };
        };
    },

    loadInitialLayers: function(){
        for (typename in this.options.initial_layers){
            this.createLayer(typename);
            this.setTOCControls(typename, true);
        };
    }.protect(),

    createLayer: function(typename){
        var l = this.getLayerByTypename(typename);
        if(l){
            if(! l.ol){
                l.ol = new  google.maps.KmlLayer(l.url.replace(/&amp;/g, '&'), {'preserveViewport' : true, 'map' : this.gcmap});
            }
        }
    },

    hideAllLayers: function(){
        for(l in this.options.kml_layers){
            if(this.options.kml_layers[l].ol){
                this.options.kml_layers[l].ol.setMap(null);
            }
        }
    },

    toggleLayer: function(typename, state){
        var l = this.getLayerByTypename(typename);
        if(l){
            if(!l.ol){
                this.createLayer(l.id);
            }
            if(typeof state == 'undefined') {
                state = !l.ol.getMap();
            }
            if(state){
                l.ol.setMap(this.gcmap);
            } else {
                l.ol.setMap(null);
            }
            this.setTOCControls(l.id, state);
        }
    },

    setCenterZoom: function(lng, lat, zoom){
        this.gcmap.setCenter(new google.maps.LatLng(lat, lng));
        this.gcmap.setZoom(zoom);
    },

    zoomToExtent: function(min_lng, min_lat, max_lng, max_lat) {
        this.gcmap.fitBounds(new google.maps.LatLngBounds(new google.maps.LatLng(min_lat, min_lng), new google.maps.LatLng(max_lat, max_lng)));
    }

});
