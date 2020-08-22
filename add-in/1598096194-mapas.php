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
		#mapid { height: 180px; }
	</style>
	<div id="mapid"></div>

	<script type="text/javascript">
		var mymap = L.map('mapid').setView([51.505, -0.09], 13);
	</script>

	<?php
	return ob_get_clean();
}