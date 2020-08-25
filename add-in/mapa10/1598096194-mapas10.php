<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa10", "fix1598096194_mapa10");
function fix1598096194_mapa10($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/Autolinker.min.js"></script>

 	<!-- DATA - INI -->
 	<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) ?>data/cordenadas-mapa-estados-brasileiro.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>data/Hidrovias_6.js"></script>
	<!-- DATA - END -->

	<style type="text/css">
		#map {
			width: 800px;
			height: 600px;

			border: 1px solid gray;
		}
	</style>
	<div id="map">MAPA</div>
	<input id="lat" type="text" name="lat">
	<input id="lng" type="text" name="lng">
	<input id="zoom" type="text" name="zoom">



	
	
	
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

		}
		function highlightFeature(e) {
			var layer = e.target;

			layer.setStyle({
				weight: 3,
				color: 'blue',
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








		var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
		var baseMaps = {};

    
	    function pop_Hidrovias_6(feature, layer) {
	        var popupContent = '<table>\
                <tr>\
                    <th scope="row">id</th>\
                    <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                </tr>\
                <tr>\
                    <th scope="row">Nome da Hidrovia</th>\
                    <td>' + (feature.properties['Nome da Hidrovia'] !== null ? autolinker.link(feature.properties['Nome da Hidrovia'].toLocaleString()) : '') + '</td>\
                </tr>\
                <tr>\
                    <th scope="row">Nome do Rio</th>\
                    <td>' + (feature.properties['Nome do Rio'] !== null ? autolinker.link(feature.properties['Nome do Rio'].toLocaleString()) : '') + '</td>\
                </tr>\
                <tr>\
                    <th scope="row">Tipo</th>\
                    <td>' + (feature.properties['Tipo'] !== null ? autolinker.link(feature.properties['Tipo'].toLocaleString()) : '') + '</td>\
                </tr>\
                <tr>\
                    <th scope="row">Classificação</th>\
                    <td>' + (feature.properties['Classificação'] !== null ? autolinker.link(feature.properties['Classificação'].toLocaleString()) : '') + '</td>\
                </tr>\
            </table>';
	        layer.bindPopup(popupContent, {maxHeight: 400});
	    }
	    var layer_Hidrovias_6 = new L.geoJson(json_Hidrovias_6, {
	        attribution: '',
	        interactive: true,
	        dataVar: 'json_Hidrovias_6',
	        layerName: 'layer_Hidrovias_6',
	        pane: 'pane_Hidrovias_6',
	        onEachFeature: pop_Hidrovias_6,
	        style: style_Hidrovias_6_0,
	    });

	    function style_Hidrovias_6_0(feature) {
	        switch(String(feature.properties['Classificação'])) {
	            case 'Navegável':
	                return {
	                    pane: 'pane_Hidrovias_6',
	                    opacity: 1,
	                    color: 'rgba(82,87,238,1.0)',
	                    dashArray: '',
	                    lineCap: 'square',
	                    lineJoin: 'bevel',
	                    weight: 2.0,
	                    fillOpacity: 0,
	                    interactive: true,
	                }
	                break;
	            case 'Navegação sazonal':
	                return {
	                    pane: 'pane_Hidrovias_6',
	                    opacity: 1,
	                    color: 'rgba(82,87,238,1.0)',
	                    dashArray: '1,5',
	                    lineCap: 'square',
	                    lineJoin: 'bevel',
	                    weight: 2.0,
	                    fillOpacity: 0,
	                    interactive: true,
	                }
	                break;
	            case 'Navegação inexpressiva':
	                return {
	                    pane: 'pane_Hidrovias_6',
	                    opacity: 1,
	                    color: 'rgba(82,87,238,1.0)',
	                    dashArray: '',
	                    lineCap: 'square',
	                    lineJoin: 'bevel',
	                    weight: 1.0,
	                    fillOpacity: 0,
	                    interactive: true,
	                }
	                break;
	        }
	    }

	    mymap.createPane('pane_Hidrovias_6');
	    mymap.getPane('pane_Hidrovias_6').style.zIndex = 406;
	    mymap.getPane('pane_Hidrovias_6').style['mix-blend-mode'] = 'normal';


		L.control.layers(baseMaps,{

			'Hidrovias<br />\
			<table>\
				<tr>\
					<td style="text-align: center;">\
						<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/Hidrovias_6_Navegável0.png" />\
					</td>\
					<td>Navegável</td>\
				</tr>\
				<tr>\
					<td style="text-align: center;">\
						<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/Hidrovias_6_Navegaçãosazonal1.png" />\
					</td>\
					<td>\
						Navegação sazonal\
					</td>\
				</tr>\
				<tr>\
					<td style="text-align: center;">\
						<img src="<?php echo plugin_dir_url( __FILE__ ) ?>legend/Hidrovias_6_Navegaçãoinexpressiva2.png" />\
					</td>\
					<td>Navegação inexpressiva</td>\
				</tr>\
			</table>': layer_Hidrovias_6,
		}).addTo(mymap);	
	</script>

	<?php
	return ob_get_clean();
}