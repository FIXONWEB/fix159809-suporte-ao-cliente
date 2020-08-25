<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa14", "fix1598096194_mapa14");
function fix1598096194_mapa14($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/Autolinker.min.js"></script>

 	<!-- DATA - INI -->
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>data/Estados_2.js"></script>
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
    		maxZoom: 20,
    		id: 'mapbox/streets-v11',
    		tileSize: 512,
    		zoomOffset: -1,
    		accessToken: 'pk.eyJ1IjoiZml4b253ZWIiLCJhIjoiY2tlNW80eGtpMHN0NDJ4cGVlZ2t3ZzJuNSJ9.sRQVAH2WX1fyxFlcHSJn4g'
		}).addTo(mymap);
		var popup = L.popup();

//=======================================================================================

		var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
		var baseMaps = {};


    mymap.createPane('pane_Estados_2');
    mymap.getPane('pane_Estados_2').style.zIndex = 402;
    mymap.getPane('pane_Estados_2').style['mix-blend-mode'] = 'normal';

    function pop_Estados_2(feature, layer) {
        var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['seq_estado'] !== null ? autolinker.link(feature.properties['seq_estado'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['cod_uf'] !== null ? autolinker.link(feature.properties['cod_uf'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_estado'] !== null ? autolinker.link(feature.properties['nom_estado'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_uf'] !== null ? autolinker.link(feature.properties['nom_uf'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['cod_regiao'] !== null ? autolinker.link(feature.properties['cod_regiao'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nome_regiao'] !== null ? autolinker.link(feature.properties['nome_regiao'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
        layer.bindPopup(popupContent, {maxHeight: 400});
    }


    function style_Estados_2_0() {
        return {
            pane: 'pane_Estados_2',
            opacity: 1,
            color: 'rgba(147,147,147,1.0)',
            dashArray: '',
            lineCap: 'butt',
            lineJoin: 'miter',
            weight: 2.0,
            fillOpacity: 0,
            interactive: false,
        }
    }
    var layer_Estados_2 = new L.geoJson(json_Estados_2, {
        attribution: '',
        interactive: false,
        dataVar: 'json_Estados_2',
        layerName: 'layer_Estados_2',
        pane: 'pane_Estados_2',
        onEachFeature: pop_Estados_2,
        style: style_Estados_2_0,
    });


		L.control.layers(baseMaps,{
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/Estados_2.png" /> Estados': layer_Estados_2,
		}).addTo(mymap);	
	</script>

	<?php
	return ob_get_clean();
}