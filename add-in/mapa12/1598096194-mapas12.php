<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa12", "fix1598096194_mapa12");
function fix1598096194_mapa12($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/Autolinker.min.js"></script>

 	<!-- DATA - INI -->
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>data/RotuloTerrasIndgenas_4.js"></script>
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

	    mymap.createPane('pane_RotuloTerrasIndgenas_4');
	    mymap.getPane('pane_RotuloTerrasIndgenas_4').style.zIndex = 404;
	    mymap.getPane('pane_RotuloTerrasIndgenas_4').style['mix-blend-mode'] = 'normal';

	    function pop_RotuloTerrasIndgenas_4(feature, layer) {
	        var popupContent = '<table>\
                <tr>\
                    <td colspan="2">' + (feature.properties['_uid_'] !== null ? autolinker.link(feature.properties['_uid_'].toLocaleString()) : '') + '</td>\
                </tr>\
                <tr>\
                    <td colspan="2">' + (feature.properties['nom_terra_indigena'] !== null ? autolinker.link(feature.properties['nom_terra_indigena'].toLocaleString()) : '') + '</td>\
                </tr>\
            </table>';
	        layer.bindPopup(popupContent, {maxHeight: 400});
	    }

	    function style_RotuloTerrasIndgenas_4_0() {
	        return {
	            pane: 'pane_RotuloTerrasIndgenas_4',
	            stroke: false,
	            fillOpacity: 0,
	            interactive: false,
	        }
	    }

	    var layer_RotuloTerrasIndgenas_4 = new L.geoJson(json_RotuloTerrasIndgenas_4, {
	        attribution: '',
	        interactive: false,
	        dataVar: 'json_RotuloTerrasIndgenas_4',
	        layerName: 'layer_RotuloTerrasIndgenas_4',
	        pane: 'pane_RotuloTerrasIndgenas_4',
	        onEachFeature: pop_RotuloTerrasIndgenas_4,
	        style: style_RotuloTerrasIndgenas_4_0,
	    });

		L.control.layers(baseMaps,{
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/RotuloTerrasIndgenas_4.png" /> Rotulo Terras Indígenas': layer_RotuloTerrasIndgenas_4,
		}).addTo(mymap);	
	</script>

	<?php
	return ob_get_clean();
}