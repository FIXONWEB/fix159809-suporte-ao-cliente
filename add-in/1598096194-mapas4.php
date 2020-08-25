<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa4", "fix1598096194_mapa4");
function fix1598096194_mapa4($atts, $content = null){
	ob_start();
	?>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	<style type="text/css" media="screen">
		#map4id { 
			height: 300px; 
			width: 600px;
			border: 1px solid gray;
		}
	</style>
	<div id="map4id">carregando mapa...</div>

	<script type="text/javascript">
		jQuery(function($){
			
		});

		var map = L.map('map4id').fitWorld();
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		    maxZoom: 18,
		    id: 'mapbox/streets-v11',
		    tileSize: 512,
		    zoomOffset: -1,
		    accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(map);

		map.locate({setView: true, maxZoom: 16});

		var greenIcon = L.icon({
		    iconUrl: 'http://u1598090346.pro.fixonweb.com.br/wp-content/uploads/2020/08/leaf-green.png',
		    shadowUrl: 'http://u1598090346.pro.fixonweb.com.br/wp-content/uploads/2020/08/leaf-shadow.png',

		    iconSize:     [38, 95], // size of the icon
		    shadowSize:   [50, 64], // size of the shadow
		    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
		    shadowAnchor: [4, 62],  // the same for the shadow
		    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
		});
		L.marker([-8.277521, -36.006093], {icon: greenIcon}).addTo(map);

		var popup = L.popup();
		function onMapClick(e) {
		    popup
		        .setLatLng(e.latlng)
		        .setContent("You clicked the map at " + e.latlng.toString())
		        .openOn(map);
		}
		map.on('click', onMapClick);

	</script>

	<?php
	return ob_get_clean();
}