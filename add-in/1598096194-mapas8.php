<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1598096194_mapa8", "fix1598096194_mapa8");
function fix1598096194_mapa8($atts, $content = null){
	ob_start();
	?>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
 	<!--script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script-->
 	
 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/leaflet.js"></script>
 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/Autolinker.min.js"></script>
 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/leaflet-svg-shape-markers.min.js"></script>
 	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>js/multi-style-layer.js"></script>
	
	<style type="text/css">
		#map {
			width: 100%;
			height: 80vh;

			border: 1px solid gray;
		}
	</style>
	<div id="map">carregando mapa...</div>
	<input id="lat" type="text" name="lat">
	<input id="lng" type="text" name="lng">
	<input id="zoom" type="text" name="zoom">



	<!-- DATA - INI -->
	<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa7/cordenadas-mapa-estados-brasileiro.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/PovosMonitorados_12.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/data/CoordenaesRegionaisdaFunai_11.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/data/DSEI_10.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/data/UnidadesdoIBAMA_9.js"></script>
	<script src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/data/Aeroportos_8.js"></script>
	

	<!--script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/eu-countries.js"></script-->
	<!-- DATA - END -->

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





		var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});


//==============================================================
	// // var map = L.map('map');
	// mymap.createPane('labels');
	// mymap.getPane('labels').style.zIndex = 650;
	// mymap.getPane('labels').style.pointerEvents = 'none';
	// var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
	//         attribution: '©OpenStreetMap, ©CartoDB'
	// })
	// positron.addTo(mymap);

	// var positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
	//         attribution: '©OpenStreetMap, ©CartoDB',
	//         pane: 'labels'
	// });
	// positronLabels.addTo(mymap);

	// var geojson = L.geoJson(GeoJsonData, geoJsonOptions).addTo(mymap);

	// geojson.eachLayer(function (layer) {
	//     layer.bindPopup(layer.feature.properties.name);
	// });
//==============================================================



    // var layer_Rodovias_7 = new L.geoJson(json_Rodovias_7, {
    //     attribution: '',
    //     interactive: false,
    //     dataVar: 'json_Rodovias_7',
    //     layerName: 'layer_Rodovias_7',
    //     pane: 'pane_Rodovias_7',
    //     onEachFeature: pop_Rodovias_7,
    //     style: style_Rodovias_7_0,
    // });


//==============================================================
    mymap.createPane('pane_Aeroportos_8');
    mymap.getPane('pane_Aeroportos_8').style.zIndex = 408;
    mymap.getPane('pane_Aeroportos_8').style['mix-blend-mode'] = 'normal';

    function pop_Aeroportos_8(feature, layer) {
        var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Código</th>\
                        <td>' + (feature.properties['Código'] !== null ? autolinker.link(feature.properties['Código'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nome</th>\
                        <td>' + (feature.properties['Nome'] !== null ? autolinker.link(feature.properties['Nome'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Uso</th>\
                        <td>' + (feature.properties['Uso'] !== null ? autolinker.link(feature.properties['Uso'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Pavimento</th>\
                        <td>' + (feature.properties['Pavimento'] !== null ? autolinker.link(feature.properties['Pavimento'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
        layer.bindPopup(popupContent, {maxHeight: 400});
    }    

    function style_Aeroportos_8_0() {
        return {
            pane: 'pane_Aeroportos_8',
            rotationAngle: 0.0,
            rotationOrigin: 'center center',
            icon: L.icon({
                iconUrl: '<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/markers/transport_airport.svg',
                iconSize: [11.399999999999999, 11.399999999999999]
            }),
            interactive: true,
        }
    }
    function style_Aeroportos_8_1() {
        return {
            pane: 'pane_Aeroportos_8',
            rotationAngle: 0.0,
            rotationOrigin: 'center center',
            icon: L.icon({
                iconUrl: '<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/markers/transport_airport.svg',
                iconSize: [11.399999999999999, 11.399999999999999]
            }),
            interactive: true,
        }
    }


    var layer_Aeroportos_8 = new L.geoJson.multiStyle(json_Aeroportos_8, {
        attribution: '',
        interactive: true,
        dataVar: 'json_Aeroportos_8',
        layerName: 'layer_Aeroportos_8',
        pane: 'pane_Aeroportos_8',
        onEachFeature: pop_Aeroportos_8,
        pointToLayers: [function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.marker(latlng, style_Aeroportos_8_0(feature));
        },function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.marker(latlng, style_Aeroportos_8_1(feature));
        },
	]});

//==============================================================




    mymap.createPane('pane_UnidadesdoIBAMA_9');
    mymap.getPane('pane_UnidadesdoIBAMA_9').style.zIndex = 409;
    mymap.getPane('pane_UnidadesdoIBAMA_9').style['mix-blend-mode'] = 'normal';

    function style_UnidadesdoIBAMA_9_0() {
        return {
            pane: 'pane_UnidadesdoIBAMA_9',
            shape: 'square',
            radius: 4.0,
            opacity: 1,
            color: 'rgba(90,74,19,1.0)',
            dashArray: '',
            lineCap: 'butt',
            lineJoin: 'miter',
            weight: 1,
            fill: true,
            fillOpacity: 1,
            fillColor: 'rgba(216,179,45,1.0)',
            interactive: true,
        }
    }

    function pop_UnidadesdoIBAMA_9(feature, layer) {
        var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">nom_unidade_ibama</th>\
                        <td>' + (feature.properties['nom_unidade_ibama'] !== null ? autolinker.link(feature.properties['nom_unidade_ibama'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
        layer.bindPopup(popupContent, {maxHeight: 400});
    }

    var layer_UnidadesdoIBAMA_9 = new L.geoJson(json_UnidadesdoIBAMA_9, {
        attribution: '',
        interactive: true,
        dataVar: 'json_UnidadesdoIBAMA_9',
        layerName: 'layer_UnidadesdoIBAMA_9',
        pane: 'pane_UnidadesdoIBAMA_9',
        onEachFeature: pop_UnidadesdoIBAMA_9,
        pointToLayer: function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.shapeMarker(latlng, style_UnidadesdoIBAMA_9_0(feature));
        },
    });




//==============================================================
    mymap.createPane('pane_DSEI_10');
    mymap.getPane('pane_DSEI_10').style.zIndex = 410;
    mymap.getPane('pane_DSEI_10').style['mix-blend-mode'] = 'normal';

    function style_DSEI_10_0() {
        return {
            pane: 'pane_DSEI_10',
            shape: 'diamond',
            radius: 6.0,
            opacity: 1,
            color: 'rgba(34,103,51,1.0)',
            dashArray: '',
            lineCap: 'butt',
            lineJoin: 'miter',
            weight: 2.0,
            fill: true,
            fillOpacity: 1,
            fillColor: 'rgba(44,132,66,1.0)',
            interactive: true,
        }
    }
    function pop_DSEI_10(feature, layer) {
        var popupContent = '<table>\
                    <tr>\
                        <th scope="row">Código</th>\
                        <td>' + (feature.properties['Código'] !== null ? autolinker.link(feature.properties['Código'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">DSEI</th>\
                        <td>' + (feature.properties['DSEI'] !== null ? autolinker.link(feature.properties['DSEI'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Município</th>\
                        <td>' + (feature.properties['Município'] !== null ? autolinker.link(feature.properties['Município'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">E-mail</th>\
                        <td>' + (feature.properties['E-mail'] !== null ? autolinker.link(feature.properties['E-mail'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Telefone</th>\
                        <td>' + (feature.properties['Telefone'] !== null ? autolinker.link(feature.properties['Telefone'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
        layer.bindPopup(popupContent, {maxHeight: 400});
    }
    var layer_DSEI_10 = new L.geoJson(json_DSEI_10, {
        attribution: '',
        interactive: true,
        dataVar: 'json_DSEI_10',
        layerName: 'layer_DSEI_10',
        pane: 'pane_DSEI_10',
        onEachFeature: pop_DSEI_10,
        pointToLayer: function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.shapeMarker(latlng, style_DSEI_10_0(feature));
        },
    });


//==============================================================


    function style_CoordenaesRegionaisdaFunai_11_0() {
        return {
            pane: 'pane_CoordenaesRegionaisdaFunai_11',
            shape: 'triangle',
            radius: 6.0,
            opacity: 1,
            color: 'rgba(50,87,128,1.0)',
            dashArray: '',
            lineCap: 'butt',
            lineJoin: 'miter',
            weight: 2.0,
            fill: true,
            fillOpacity: 1,
            fillColor: 'rgba(82,151,207,1.0)',
            interactive: true,
        }
    }

    function pop_CoordenaesRegionaisdaFunai_11(feature, layer) {
        var popupContent = '<table>\
            <tr>\
                <th scope="row">Código</th>\
                <td>' + (feature.properties['Código'] !== null ? autolinker.link(feature.properties['Código'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <th scope="row">Sigla</th>\
                <td>' + (feature.properties['Sigla'] !== null ? autolinker.link(feature.properties['Sigla'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <th scope="row">CR Funai</th>\
                <td>' + (feature.properties['CR Funai'] !== null ? autolinker.link(feature.properties['CR Funai'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <th scope="row">Município</th>\
                <td>' + (feature.properties['Município'] !== null ? autolinker.link(feature.properties['Município'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <th scope="row">E-mail</th>\
                <td>' + (feature.properties['E-mail'] !== null ? autolinker.link(feature.properties['E-mail'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <th scope="row">Telefone</th>\
                <td>' + (feature.properties['Telefone'] !== null ? autolinker.link(feature.properties['Telefone'].toLocaleString()) : '') + '</td>\
            </tr>\
        </table>';
        // var popupContent = '---x---';
        layer.bindPopup(popupContent, {maxHeight: 400});
    }

    var layer_CoordenaesRegionaisdaFunai_11 = new L.geoJson(json_CoordenaesRegionaisdaFunai_11, {
        attribution: '',
        interactive: true,
        dataVar: 'json_CoordenaesRegionaisdaFunai_11',
        layerName: 'layer_CoordenaesRegionaisdaFunai_11',
        pane: 'pane_CoordenaesRegionaisdaFunai_11',
        onEachFeature: pop_CoordenaesRegionaisdaFunai_11,
        pointToLayer: function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.shapeMarker(latlng, style_CoordenaesRegionaisdaFunai_11_0(feature));
        },
    });

    mymap.createPane('pane_CoordenaesRegionaisdaFunai_11');
    mymap.getPane('pane_CoordenaesRegionaisdaFunai_11').style.zIndex = 411;
    mymap.getPane('pane_CoordenaesRegionaisdaFunai_11').style['mix-blend-mode'] = 'normal';

//==============================================================
		

	    function style_PovosMonitorados_12_0(feature) {
	        switch(String(feature.properties['Situação'])) {
	            case 'Isolados':
	                return {
	                    pane: 'pane_PovosMonitorados_12',
	                    radius: 4.0,
	                    opacity: 1,
	                    color: 'rgba(91,27,26,1.0)',
	                    dashArray: '',
	                    lineCap: 'butt',
	                    lineJoin: 'miter',
	                    weight: 1,
	                    fill: true,
	                    fillOpacity: 1,
	                    fillColor: 'rgba(194,55,55,1.0)',
	                    interactive: true,
	                }
	                break;
	            case 'Recente Contato':
	                return {
	                    pane: 'pane_PovosMonitorados_12',
	                    radius: 4.0,
	                    opacity: 1,
	                    color: 'rgba(91,27,26,1.0)',
	                    dashArray: '',
	                    lineCap: 'butt',
	                    lineJoin: 'miter',
	                    weight: 1,
	                    fill: true,
	                    fillOpacity: 1,
	                    fillColor: 'rgba(238,139,67,1.0)',
	                    interactive: true,
	                }
	                break;
	        }
	    }



	    function pop_PovosMonitorados_12(feature, layer) {
	        var popupContent = '<table>\
	            <tr>\
	                <th scope="row">Registro Nº</th>\
	                <td>' + (feature.properties['Registro Nº'] !== null ? autolinker.link(feature.properties['Registro Nº'].toLocaleString()) : '') + '</td>\
	            </tr>\
	            <tr>\
	                <th scope="row">Nome</th>\
	                <td>' + (feature.properties['Nome'] !== null ? autolinker.link(feature.properties['Nome'].toLocaleString()) : '') + '</td>\
	            </tr>\
	            <tr>\
	                <th scope="row">Situação</th>\
	                <td>' + (feature.properties['Situação'] !== null ? autolinker.link(feature.properties['Situação'].toLocaleString()) : '') + '</td>\
	            </tr>\
	            <tr>\
	                <th scope="row">Etnia</th>\
	                <td>' + (feature.properties['Etnia'] !== null ? autolinker.link(feature.properties['Etnia'].toLocaleString()) : '') + '</td>\
	            </tr>\
	            <tr>\
	                <th scope="row">Língua</th>\
	                <td>' + (feature.properties['Língua'] !== null ? autolinker.link(feature.properties['Língua'].toLocaleString()) : '') + '</td>\
	            </tr>\
	        </table>';
	        layer.bindPopup(popupContent, {maxHeight: 400});
	    }

		mymap.createPane('pane_PovosMonitorados_12');



	    var layer_PovosMonitorados_12 = new L.geoJson(json_PovosMonitorados_12, {
	        attribution: '',
	        interactive: true,
	        dataVar: 'json_PovosMonitorados_12',
	        layerName: 'layer_PovosMonitorados_12',
	        pane: 'pane_PovosMonitorados_12',
	        onEachFeature: pop_PovosMonitorados_12,
	        pointToLayer: function (feature, latlng) {
	            var context = {
	                feature: feature,
	                variables: {}
	            };
	            return L.circleMarker(latlng, style_PovosMonitorados_12_0(feature));
	        },
	    });


		var baseMaps = {};

		L.control.layers(baseMaps,{
			// mnu: layer_PovosMonitorados_12,
			'Povos Monitorados<br />\
			<table>\
				<tr>\
					<td style="text-align: center;">\
						<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/PovosMonitorados_12_Isolados0.png" />\
					</td>\
					<td>Isolados</td>\
				</tr>\
				<tr>\
					<td style="text-align: center;"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/PovosMonitorados_12_RecenteContato1.png" /></td>\
					<td>Recente Contato</td>\
				</tr>\
			</table>': layer_PovosMonitorados_12,
			
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/CoordenaesRegionaisdaFunai_11.png" /> Coordenações Regionais da Funai': layer_CoordenaesRegionaisdaFunai_11,
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/DSEI_10.png" /> DSEI': layer_DSEI_10,
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/UnidadesdoIBAMA_9.png" /> Unidades do IBAMA': layer_UnidadesdoIBAMA_9,
			'<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/Aeroportos_8.png" /> Aeroportos': layer_Aeroportos_8,
			// 'Rodovias<br />\
			// 	<table>\
			// 		<tr>\
			// 			<td style="text-align: center;">\
			// 				<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/Rodovias_7_NãoPavimentada0.png" />\
			// 			</td>\
			// 			<td>Não Pavimentada</td>\
			// 		</tr>\
			// 		<tr>\
			// 			<td style="text-align: center;">\
			// 				<img src="<?php echo plugin_dir_url( __FILE__ ) ?>mapa8/legend/Rodovias_7_Pavimentada1.png" />\
			// 			</td>\
			// 			<td>Pavimentada</td>\
			// 		</tr>\
			// 	</table>': layer_Rodovias_7,
			// 'Hidrovias<br /><table><tr><td style="text-align: center;"><img src="legend/Hidrovias_6_Navegável0.png" /></td><td>Navegável</td></tr><tr><td style="text-align: center;"><img src="legend/Hidrovias_6_Navegaçãosazonal1.png" /></td><td>Navegação sazonal</td></tr><tr><td style="text-align: center;"><img src="legend/Hidrovias_6_Navegaçãoinexpressiva2.png" /></td><td>Navegação inexpressiva</td></tr></table>': layer_Hidrovias_6,
			// '<img src="legend/RioSemDadodeNavegabilidade_5.png" /> Rio Sem Dado de Navegabilidade': layer_RioSemDadodeNavegabilidade_5,
			// '<img src="legend/RotuloTerrasIndgenas_4.png" /> Rotulo Terras Indígenas': layer_RotuloTerrasIndgenas_4,
			// '<img src="legend/TerrasIndgenas_3.png" /> Terras Indígenas': layer_TerrasIndgenas_3,
			// '<img src="legend/Estados_2.png" /> Estados': layer_Estados_2,
			// '<img src="legend/America_1.png" /> America': layer_America_1,
			// "ESRI Standard": layer_ESRIStandard_0,
		}).addTo(mymap);	

	</script>

	<?php
	return ob_get_clean();
}