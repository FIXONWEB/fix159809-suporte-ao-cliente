<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa7", "fix1598096194_mapa7");
function fix1598096194_mapa7($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	<style type="text/css">
		#map {
			width: 100%;
			height: 600px;

			border: 0px solid gray;
		}
	</style>
	<div id="map">carregando mapa...</div>
	<input id="lat" type="text" name="lat">
	<input id="lng" type="text" name="lng">
	<input id="zoom" type="text" name="zoom">



	
	
	<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa7/cordenadas-mapa-estados-brasileiro.js"></script>
	<script type="text/javascript">
		var mymap = L.map('map').setView([-11.005, -51.943], 4);
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    		maxZoom: 18,
    		id: 'mapbox/streets-v11',
    		tileSize: 512,
    		zoomOffset: -1,
    		accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(mymap);
		var popup = L.popup();
		function onMapClick(e) {
		        var lng = document.getElementById('lng');
		        lng.value = e.latlng.lng;

		        var lat = document.getElementById('lat');
		        lat.value = e.latlng.lat;

		        var zoom = document.getElementById('zoom');
		        zoom.value = mymap._zoom;
		}
		mymap.on('click', onMapClick);



		var info = L.control();
		info.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'info');
			this.update();
			return this._div;
		};
		info.update = function (props) {
			//this._div.innerHTML = '<h4>BRASIL</h4>';
			this._div.innerHTML = '<h4>BRASIL</h4>' +  (props ?
				'<b>' + props.nom_estado + '</b><br />' + props.nome_regiao + ' '
				: '');

			console.log(props);
		};

		info.addTo(mymap);

		var geojson;
		function resetHighlight(e) {
			geojson.resetStyle(e.target);
			info.update();
		}
		function zoomToFeature(e) {
			mymap.fitBounds(e.target.getBounds());
		}

		function onEachFeature(feature, layer) {
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: zoomToFeature
			});
		}


		function style(feature) {
			return {
				weight: 1,
				opacity: 1,
				color: 'black',
				dashArray: '3',
				// fillOpacity: 0.7,
				fillOpacity: 0,
				fillColor: getColor(feature.properties.density)
			};
		}
		function getColor(d) {
			return d > 1000 ? '#800026' :
					d > 500  ? '#BD0026' :
					d > 200  ? '#E31A1C' :
					d > 100  ? '#FC4E2A' :
					d > 50   ? '#FD8D3C' :
					d > 20   ? '#FEB24C' :
					d > 10   ? '#FED976' :
								'#FFEDA0';

			// return d > 1000 ? '' :
			// 		d > 500  ? '' :
			// 		d > 200  ? '#E31A1C' :
			// 		d > 100  ? '#FC4E2A' :
			// 		d > 50   ? '#FD8D3C' :
			// 		d > 20   ? '#FEB24C' :
			// 		d > 10   ? '#FED976' :
			// 					'';

		}
		function highlightFeature(e) {
			var layer = e.target;

			layer.setStyle({
				weight: 1,
				color: 'red',
				dashArray: '',
				fillOpacity: 0
			});

			if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
				layer.bringToFront();
			}

			info.update(layer.feature.properties);
		}

		geojson = L.geoJson(json_Estados_2, {
			style: style,
			onEachFeature: onEachFeature
		}).addTo(mymap);

	</script>

	<?php
	return ob_get_clean();
}