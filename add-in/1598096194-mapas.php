<?php
//1598096194
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa1", "fix1598096194_mapa1");
function fix1598096194_mapa1($atts, $content = null){
	ob_start();
	?>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	<style type="text/css" media="screen">
		#mapid { 
			height: 600px; 
			width: 100%;
			border: 0px solid gray;
		}
	</style>
	<div id="mapid">xxx</div>

	<script type="text/javascript">
		jQuery(function($){
			
		});
		var mymap = L.map('mapid').setView([51.505, -0.09], 13);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    		maxZoom: 18,
    		id: 'mapbox/streets-v11',
    		tileSize: 512,
    		zoomOffset: -1,
    		accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(mymap);

		var marker = L.marker([51.5, -0.09]).addTo(mymap);
		var circle = L.circle([51.508, -0.11], {
		    color: 'red',
		    fillColor: '#f03',
		    fillOpacity: 0.5,
		    radius: 500
		}).addTo(mymap);

		//circulo
		var polygon = L.polygon([
		    [51.509, -0.08],
		    [51.503, -0.06],
		    [51.51, -0.047]
		]).addTo(mymap);
		//popup
		marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
		circle.bindPopup("I am a circle.");
		polygon.bindPopup("I am a polygon.");


		var popup = L.popup()
		    .setLatLng([51.5, -0.09])
		    .setContent("I am a standalone popup.")
		    .openOn(mymap);

		// function onMapClick(e) {
		//     alert("You clicked the map at " + e.latlng);
		// }
		// mymap.on('click', onMapClick);
		//map at LatLng(-8.282259, -35.975375)

		var popup = L.popup();
		function onMapClick(e) {
		    popup
		        .setLatLng(e.latlng)
		        .setContent("You clicked the map at " + e.latlng.toString())
		        .openOn(mymap);
		}
		mymap.on('click', onMapClick);

		
	</script>

	<?php
	return ob_get_clean();
}