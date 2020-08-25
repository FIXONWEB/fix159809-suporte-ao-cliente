<?php
//1598096194
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa2", "fix1598096194_mapa2");
function fix1598096194_mapa2($atts, $content = null){
	ob_start();
	?>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	<style type="text/css" media="screen">
		#map2id { 
			height: 300px; 
			width: 600px;
			border: 1px solid gray;
		}
	</style>
	<div id="map2id">xxx</div>

	<script type="text/javascript">
		jQuery(function($){
			
		});
		//var mymap = L.map('mapid').setView([51.505, -0.09], 13);
		var map = L.map('map2id').fitWorld();
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		    maxZoom: 18,
		    id: 'mapbox/streets-v11',
		    tileSize: 512,
		    zoomOffset: -1,
		    accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(map);

		map.locate({setView: true, maxZoom: 16});

		function onLocationFound(e) {
    		var radius = e.accuracy;
    		L.marker(e.latlng).addTo(map)
        	.bindPopup("You are within " + radius + " meters from this point").openPopup();
    		L.circle(e.latlng, radius).addTo(map);
		}
		map.on('locationfound', onLocationFound);

		function onLocationError(e) {
    		alert(e.message);
		}
		map.on('locationerror', onLocationError);

	</script>

	<?php
	return ob_get_clean();
}