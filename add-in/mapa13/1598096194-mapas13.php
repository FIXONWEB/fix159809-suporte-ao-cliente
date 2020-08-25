<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa13", "fix1598096194_mapa13");
function fix1598096194_mapa13($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/Autolinker.min.js"></script>

 	<!-- DATA - INI -->
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>data/TerrasIndgenas_3.js"></script>
	<!-- DATA - END -->

	<style type="text/css">
		#map {
			width: 100%;
			height: 80vh;
			border: 0px solid gray;
		}
	</style>
	<div id="map">MAPA</div>
	
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

//=======================================================================================

		var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
		var baseMaps = {};

	    mymap.createPane('pane_TerrasIndgenas_3');
	    mymap.getPane('pane_TerrasIndgenas_3').style.zIndex = 403;
	    mymap.getPane('pane_TerrasIndgenas_3').style['mix-blend-mode'] = 'normal';

	    function pop_TerrasIndgenas_3(feature, layer) {
	        var popupContent = '<table>\
	                    <tr>\
	                        <th scope="row">Códico</th>\
	                        <td>' + (feature.properties['Códico'] !== null ? autolinker.link(feature.properties['Códico'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">Terra Indígena</th>\
	                        <td>' + (feature.properties['Terra Indígena'] !== null ? autolinker.link(feature.properties['Terra Indígena'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">Situação de Isolados</th>\
	                        <td>' + (feature.properties['Situação de Isolados'] !== null ? autolinker.link(feature.properties['Situação de Isolados'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">Decreto de Homologação</th>\
	                        <td>' + (feature.properties['Decreto de Homologação'] !== null ? autolinker.link(feature.properties['Decreto de Homologação'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">Link do Decreto</th>\
	                        <td>' + (feature.properties['Link do Decreto'] !== null ? autolinker.link(feature.properties['Link do Decreto'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">Hectares</th>\
	                        <td>' + (feature.properties['Hectares'] !== null ? autolinker.link(feature.properties['Hectares'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">CR Responsável</th>\
	                        <td>' + (feature.properties['CR Responsável'] !== null ? autolinker.link(feature.properties['CR Responsável'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                    <tr>\
	                        <th scope="row">DSEI Responsável</th>\
	                        <td>' + (feature.properties['DSEI Responsável'] !== null ? autolinker.link(feature.properties['DSEI Responsável'].toLocaleString()) : '') + '</td>\
	                    </tr>\
	                </table>';
	        layer.bindPopup(popupContent, {maxHeight: 400});
	    }

	    function style_TerrasIndgenas_3_0() {
	        return {
	            pane: 'pane_TerrasIndgenas_3',
	            opacity: 1,
	            color: 'rgba(35,106,53,0.6)',
	            dashArray: '',
	            lineCap: 'butt',
	            lineJoin: 'miter',
	            weight: 3.0,
	            fill: true,
	            fillOpacity: 1,
	            fillColor: 'rgba(31,197,78,0.8)',
	            interactive: true,
	        }
	    }
	    var layer_TerrasIndgenas_3 = new L.geoJson(json_TerrasIndgenas_3, {
	        attribution: '',
	        interactive: true,
	        dataVar: 'json_TerrasIndgenas_3',
	        layerName: 'layer_TerrasIndgenas_3',
	        pane: 'pane_TerrasIndgenas_3',
	        onEachFeature: pop_TerrasIndgenas_3,
	        style: style_TerrasIndgenas_3_0,
	    });


		L.control.layers(baseMaps,{
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/TerrasIndgenas_3.png" /> Terras Indígenas': layer_TerrasIndgenas_3,
		}).addTo(mymap);	
	</script>

	<?php
	return ob_get_clean();
}