/**
* Google map class extensions, adds a WKT import/output filter
*
* requires mootools and gmap 2
*
* Parts adapted from:
* Copyright (c) 2006-2008 MetaCarta, Inc., published under the Clear BSD
* license.  See http://svn.openlayers.org/trunk/openlayers/license.txt for the
* full text of the license.
*
* @version      $Id: controller.php 66 2008-06-12 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2008 Alessandro Pasotti http://www.itopen.it
*/


var GFormatWKT = new Class( {

    initialize: function(createcb) {
        /**
        * Adds some human readable strings
        */
        GPolygon.prototype.WKT = 'POLYGON';
        GPolygon.prototype.CLASSNAME = 'GPolygon';

        GPolyline.prototype.WKT = 'LINESTRING';
        GPolyline.prototype.CLASSNAME = 'GPolyline';

        GMarker.prototype.WKT = 'POINT';
        GMarker.prototype.CLASSNAME = 'GMarker';

        this.regExes = {
        'typeStr': /^\s*(\w+)\s*\(\s*(.*)\s*\)\s*$/,
        'spaces': /\s+/,
        'parenComma': /\)\s*,\s*\(/,
        'doubleParenComma': /\)\s*\)\s*,\s*\(\s*\(/,  // can't use {2} here
        'trimParens': /^\s*\(?(.*?)\)?\s*$/
        };
        this.createcb = createcb;
    },

    /**
    * Method: read
    * Deserialize a WKT string and return an array of features or a sinle feature
    */
    read: function(wkt) {
        var features, type, str;
        var matches = this.regExes.typeStr.exec(wkt);
        if(matches) {
            type = matches[1].toLowerCase();
            str = matches[2];
            if(this.parse[type]) {
                features = this.parse[type].apply(this, [str]);
            }
        }
        return features;
    },

    /**
    * Method: write
    * Serialize a feature or array of features into a WKT string.
    */
    write: function(features) {
        var collection, geometry, type, data, isCollection;
        if(features.WKT == 'GEOMETRYCOLLECTION') {
            collection = features;
            isCollection = true;
        } else if (features.constructor.toString().indexOf("Array") != -1) {
                if(features.length > 1){
                    isCollection = true;
                } else {
                    isCollection = false;
                }
                collection = features;
        } else {
            collection = [features];
            isCollection = false;
        }
        var pieces = [];
        if(isCollection) {
            pieces.push('GEOMETRYCOLLECTION(');
        }
        for(var i=0; i<collection.length; ++i) {
            if(isCollection && i>0) {
                pieces.push(',');
            }
            geometry = collection[i];
            type = geometry.WKT.toLowerCase();
            if(!this.extract[type]) {
                //console.error('Missing type for ' +  type);
                return null;
            }

            data = this.extract[type].apply(this, [geometry]);
            pieces.push(type.toUpperCase() + '(' + data + ')');
        }
        if(isCollection) {
            pieces.push(')');
        }
        return pieces.join('');
    },

    /**
    * Object with properties corresponding to the geometry types
    * Property values are functions that do the actual data extraction.
    */
    extract: {
        /**
        * Return a space delimited string of point coordinates.
        */
        '_latlng': function(point) {
            var p = new GMarker(new GLatLng(point.lat(), point.lng()));
            setBounds(p);
            return point.lng() + ' ' + point.lat();
        },

        /**
        * Return a space delimited string of point coordinates.
        */
        'point': function(point) {
            point.WKT = 'POINT';
            setBounds(point);
            return point.getLatLng().lng() + ' ' + point.getLatLng().lat();
        },

        /**
        * Return a comma delimited string of point coordinates from a multipoint.
        */
        'multipoint': function(multipoint) {
            var array = [];
            var this2 = this;
            multipoint.each(function(p){
                array.push(this2.extract._latlng.apply(this2, [p]));
            });
            return array.join(',');
        },

        /**
        * Return a comma delimited string of point coordinates from a line.
        */
        'linestring': function(linestring) {
            var array = [];
            var this2 = this;
            for(var i=0; i<linestring.getVertexCount(); ++i) {
                array.push(this2.extract._latlng.apply(this, [linestring.getVertex(i)]));
            }
            return array.join(',');
        },

        /**
        * Return a comma delimited string of linestring strings from a multilinestring.
        */
        'multilinestring': function(multilinestring) {
            var array = [];
            var this2 = this;
            multilinestring.each(function(p){
                array.push('(' +
                            this2.extract.linestring.apply(this2, [p]) +
                            ')');
            });
            return array.join(',');
        },


        /**
        * Return a comma delimited string of linear ring arrays from a polygon.
        */
        'polygon': function(polygon) {
            var array = [];
            var this2 = this;
            if(polygon.constructor.toString().indexOf("Array") == -1){
                polygon = [polygon];
            }
            polygon.each(function(p){
                array.push('(' +
                            this2.extract.linestring.apply(this2, [p]) +
                            ')');
            });
            return array.join(',');
        },

        /**
        * Return an array of polygon arrays from a multipolygon.
        */
        'multipolygon': function(multipolygon) {
            var array = [];
            var this2 = this;
            multipolygon.each(function(p){
                array.push('(' +
                            this2.extract.polygon.apply(this2, [p]) +
                            ')');
            });
            return array.join(',');
        }

    },

    /**
    * Object with properties corresponding to the geometry types.
    * Property values are functions that do the actual parsing.
    */
    parse: {
        /**
        * Return point feature given a point WKT fragment.
        */
        '_latlng': function(str) {
            var coords = str.trim().split(this.regExes.spaces);
            return new GLatLng(coords[1],coords[0]);
        },

        'point': function(str) {
            var p =  new GMarker(this.parse._latlng.apply(this, [str]));
            if(typeof(this.createcb) == 'function'){
               this.createcb(p);
            }
            return p;
        },

        /**
        * Return a multipoint feature given a multipoint WKT fragment.
        */
        'multipoint': function(str) {
            var points = str.trim().split(',');
            var components = [];
            for(var i=0; i<points.length; ++i) {
                components.push(this.parse._latlng.apply(this, [points[i]]));
            }
            components.WKT = 'MULTIPOINT';
            return components;
        },

        /**
        * Return a linestring feature given a linestring WKT fragment.
        */
        '_latlngstring': function(str) {
            var points = str.trim().split(',');
            var components = [];
            for(var i=0; i<points.length; ++i) {
                components.push(this.parse._latlng.apply(this, [points[i]]));
            }
            return components;
        },

        /**
        * Return a linestring feature given a linestring WKT fragment.
        */
        'linestring': function(str) {
            var p = new GPolyline(this.parse._latlngstring.apply(this, [str]));
            if(typeof(this.createcb) == 'function'){
               this.createcb(p);
            }
            return p;
        },


        /**
        * Return a multilinestring feature given a multilinestring WKT fragment.
        */
        'multilinestring': function(str) {
            var line;
            var lines = str.trim().split(this.regExes.parenComma);
            var components = [];
            for(var i=0; i<lines.length; ++i) {
                line = lines[i].replace(this.regExes.trimParens, '$1');
                components.push(this.parse.linestring.apply(this, [line]));
            }
            components.WKT = 'MULTILINESTRING';
            return components;
        },

        /**
        * Return a polygon feature given a polygon WKT fragment.
        */
        'polygon': function(str) {
            var ring, linestring, linearring;
            var rings = str.trim().split(this.regExes.parenComma);
            var components = [];
            for(var i=0; i<rings.length; ++i) {
                ring = rings[i].replace(this.regExes.trimParens, '$1');
                linestring = this.parse._latlngstring.apply(this, [ring]);
                p = new GPolygon(linestring, '#000000',  2,  1,  '#000000',  0.5);
                if(typeof(this.createcb) == 'function'){
                    this.createcb(p);
                }
                components.push(p);
            }
            components.WKT = 'POLYGON';
            return components;
        },

        /**
        * Return a multipolygon feature given a multipolygon WKT fragment.
        */
        'multipolygon': function(str) {
            var polygon;
            var polygons = str.trim().split(this.regExes.doubleParenComma);
            var components = [];
            for(var i=0; i<polygons.length; ++i) {
                polygon = polygons[i].replace(this.regExes.trimParens, '$1');
                components.push(this.parse.polygon.apply(this, [polygon]));
            }
            components.WKT = 'MULTIPOLYGON';
            return components;
        },

        /**
        * Return an array of features given a geometrycollection WKT fragment.
        */
        'geometrycollection': function(str) {
            // separate components of the collection with |
            str = str.replace(/,\s*([A-Za-z])/g, '|$1');
            var wktArray = str.trim().split('|');
            var components = [];
            for(var i=0; i<wktArray.length; ++i) {
                components.push(GFormatWKT.prototype.read.apply(this,[wktArray[i]]));
            }
            components.WKT = 'GEOMETRYCOLLECTION';
            return components;
        }
    }
});


// Tests
/*

function getObjectClass(obj)
{
    if (obj && obj.constructor && obj.constructor.toString)
    {
        var arr = obj.constructor.toString().match(
            /function\s*(\w+)/);

        if (arr && arr.length == 2)
        {
            return arr[1];
        }
    }
    return undefined;
}

function wkt_log(o){
    var c = getObjectClass(o);
    if(c == 'Array'){
        o.each(function(o2){
            wkt_log(o2);
        });
    } else {
        console.log(o.CLASSNAME + ' -> ' + o.WKT);
        console.log(o);
    }
}

function Test(t) {
    var f = new GFormatWKT();
    var o = f.read(t);
    console.log('WKT: ' + t);
    //wkt_log(o);
    var t2 = f.write(o);
    if(t2.trim() != t.trim()){
        console.warn(t);
        console.warn(t2);
    }
}


Test('POINT(6 10)');
Test('LINESTRING(3 4,10 50,20 25)');
Test('POLYGON((1 1,5 1,5 5,1 5,1 1),(2 2,3 2,3 3,2 3,2 2))');
Test('MULTIPOINT(3.5 5.6,4.8 10.5)');
Test('MULTILINESTRING((3 4,10 50,20 25),(-5 -8,-10 -8,-15 -4))');
Test('MULTIPOLYGON(((1 1,5 1,5 5,1 5,1 1),(2 2,3 2,3 3,2 3,2 2)),((3 3,6 2,6 4,3 3)))');
Test('GEOMETRYCOLLECTION(POINT(4 6),LINESTRING(4 6,7 10))');
//*/