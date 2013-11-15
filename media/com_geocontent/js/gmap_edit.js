/**
* Google map editing tool
* State machine
* - no_data
* - editing
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

function editHandlerCb(f){
    switch(f.WKT){
        case 'POLYGON':
            f.setStrokeStyle({color: getColor(layer_style['linergba']), weight: layer_style['linewidth'], opacity : getAlpha(layer_style['linergba'])});
            f.setFillStyle({color: getColor(layer_style['polyrgba']), opacity : getAlpha(layer_style['polyrgba'])})
            startDrawing(f, true);
        break;
        case 'POINT':
            var marker = new GMarker(f.getLatLng(), {icon: getIcon(), draggable: true});
            map.addOverlay(marker);
        break;
        case 'LINESTRING':
            f.setStrokeStyle({color: getColor(layer_style['linergba']), weight: layer_style['linewidth']});
            startDrawing(f, true);
        break;
    }
    setBounds(f);
}

function setBounds(f){
    switch(f.WKT){
        case 'POLYGON':
            bounds.extend(f.getBounds().getSouthWest());
            bounds.extend(f.getBounds().getNorthEast());
        break;
        case 'POINT':
            bounds.extend(f.getLatLng());
        break;
        case 'LINESTRING':
            bounds.extend(f.getBounds().getSouthWest());
            bounds.extend(f.getBounds().getNorthEast());
        break;
    }
}

function show(e){
     $(e).setStyle('display', '');
}

function hide(e){
    $(e).setStyle('display', 'none');
}


function setStatus(status){
    application_status = status;
}


function buttonSelect(buttonId) {
    $$('#edit_controls div').each(function(e){
        e.addClass('unselected');
        e.removeClass('selected');
    });
    $(buttonId).addClass('selected');
}

function stopEditing() {
    buttonSelect("hand_b");
}


function deleteShape(){
  buttonSelect("delete_b");
}


function getIcon() {
  var icon = new GIcon();
  icon.image = layer_style['icon'];
  icon.iconSize = new GSize(layer_style['iconsize'], layer_style['iconsize']);
  icon.iconAnchor = new GPoint(layer_style['iconsize'] / 2, layer_style['iconsize']);
  return icon;
}

function getColor(color){
    return color.substring(0,7);
}

function hex2num (s_hex) {
    eval("var n_num=0X" + s_hex);
    return n_num;
}

function getAlpha(color){
    if(color.length == 9){
        return hex2num(color.substring(7,9))/255;
    }
    return 1;
}

function startShape() {
  buttonSelect("shape_b");
  editing_feature = 'POLYGON';
  var polygon = new GPolygon([], getColor(layer_style['linergba']),  layer_style['linewidth'], getAlpha(layer_style['linergba']), getColor(layer_style['polyrgba']), getAlpha(layer_style['polyrgba']));
  startDrawing(polygon);
}

function startLine() {
  buttonSelect("line_b");
  editing_feature = 'LINESTRING';
  var line = new GPolyline([], getColor(layer_style['linergba']));
  startDrawing(line);
}

function checkDeleteVertex(poly, index){
    if(typeof index == "number" && poly.getVertexCount() > 4) {
        if(index == 0 || index == poly.getVertexCount() - 1){
            alert ('Cannot delete the first/last vertex of the polygon!');
        } else {
           poly.deleteVertex(index);
           //console.log('Delete vertex ' + index);
           //poly.redraw();
        }
    }
}

function startDrawing(poly, static) {
  map.addOverlay(poly);
  if(!static){
    poly.enableDrawing();
  }
  poly.enableEditing({onEvent: "mouseover"});
  poly.disableEditing({onEvent: "mouseout"});
  if(!static) {
    GEvent.addListener(poly, "endline", function() {
        buttonSelect("hand_b");
        GEvent.addListener(poly, "click", function(latlng, index) {
            if (typeof index == "number") {
                checkDeleteVertex(poly, index);
            } else {
                // do nothing
            }
        });
    });
  } else {
        GEvent.addListener(poly, "click", function(latlng, index) {
            if (typeof index == "number") {
                checkDeleteVertex(poly, index);
            } else {
                // do nothing
            }
        });
  }
}


function placeMarker() {
  buttonSelect("placemark_b");
  editing_feature = 'POINT';
  var listener = GEvent.addListener(map, "click", function(overlay, latlng) {
    if (latlng) {
      buttonSelect("hand_b");
      GEvent.removeListener(listener);
      var marker = new GMarker(latlng, {icon: getIcon(), draggable: true});
      map.addOverlay(marker);
    }
  });
}

function getBounds(features){
    var b = new google.maps.LatLngBounds();
    features.each(function(f){
        if(f.WKT == 'POINT'){
            b.extend(g.getLatLng());
        } else if(f.WKT == 'POLYGON' || f.WKT == 'LINESTRING'){
            b.extend(f.getBounds().getSouthWest());
            b.extend(f.getBounds().getNorthEast());
        }
    });

}