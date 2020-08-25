<?php
//1598096194
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa5", "fix1598096194_mapa5");
function fix1598096194_mapa5($atts, $content = null){
	ob_start();
	?>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	<style type="text/css" media="screen">
		#map5id { 
			height: 80vh; 
			width: 100%;
			border: 1px solid gray;
		}
	</style>
	<div id="map5id">xxx</div>
	
	<script type="text/javascript">
			
		var map = L.map('map').setView([37.8, -96], 4);
		//-8.277564, -36.006114 eu
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		    maxZoom: 18,
		    id: 'mapbox/streets-v11',
		    tileSize: 512,
		    zoomOffset: -1,
		    accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(map);


		var popup = L.popup();
		function onMapClick(e) {
		    popup
		        .setLatLng(e.latlng)
		        .setContent("You clicked the map at " + e.latlng.toString())
		        .openOn(map);
		}
		map.on('click', onMapClick);


		// var geojsonFeature = {
		//     "type": "Feature",
		//     "properties": {
		//         "name": "Coors Field",
		//         "amenity": "Baseball Stadium",
		//         "popupContent": "This is where the Rockies play!"
		//     },
		//     "geometry": {
		//         "type": "Point",
		//         // "coordinates": [-8.276863, -36.006479]
		//         "coordinates": [-36.006479, -8.276863]
		//     }
		// };

		// L.geoJSON(geojsonFeature).addTo(map);





var states = [
	// {
	//     "type": "Feature",
	//     "properties": {"party": "Republican"},
	//     "geometry": {
	//         "type": "Polygon",
	//         "coordinates": [[
	//             [-104.05, 48.99],
	//             [-97.22,  48.98],
	//             [-96.58,  45.94],
	//             [-104.03, 45.94],
	//             [-104.05, 48.99]
	//         ]]
	//     }
	// }, 

	// {
	//     "type": "Feature",
	//     "properties": {"party": "Democrat"},
	//     "geometry": {
	//         "type": "Polygon",
	//         "coordinates": [[
	//             [-109.05, 41.00],
	//             [-102.06, 40.99],
	//             [-102.03, 36.99],
	//             [-109.04, 36.99],
	//             [-109.05, 41.00]
	//         ]]
	//     }
	// }, 
	{
	    "type": "Feature",
	    "properties": {"party": "Democrat"},
	    "geometry": {
	        "type": "Polygon",
	        "coordinates": [[
	            [-36.00948, -8.278354],
	            [-36.008788, -8.278396],
	            [-36.008933, -8.280105],
	            [-36.009254, -8.280052],
	            [-36.009651, -8.279166],
	            [-36.009544, -8.279113],
	            [-36.00948, -8.278354]
	        ]]
	    }
	}
];
 

/*
-8.278354, -36.00948
-8.278396, -36.008788
-8.280105, -36.008933
-8.280052, -36.009254
-8.278354, -36.00948
*/

L.geoJSON(states, {
    style: function(feature) {
        switch (feature.properties.party) {
            case 'Republican': return {color: "#ff0000"};
            case 'Democrat':   return {color: "#0000ff"};
        }
    }
}).addTo(map);


var geojsonMarkerOptions = {
    radius: 8,
    fillColor: "#ff7800",
    color: "#000",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.8
};
 
L.geoJSON(someGeojsonFeature, {
    pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, geojsonMarkerOptions);
    }
}).addTo(map);


	</script>

	<?php
	return ob_get_clean();
}