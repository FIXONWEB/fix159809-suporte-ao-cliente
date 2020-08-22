<?php
/**
 * Plugin Name:     fix159809 licença de suporte ao cliente
 * Plugin URI:      https://fixonweb.com.br/plugin/fix159809
 * Description:     Fixonweb - Ref.: 159809 - licença de suporte ao cliente
 * Author:          FIXONWEB
 * Author URI:      https://fixonweb.com.br
 * Text Domain:     fix159809-suporte-ao-cliente
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Fix159809_Suporte_Ao_Cliente
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'plugin-update-checker.php';
$url_159809 	= 'https://github.com/fixonweb/fix159809-suporte-ao-cliente';
$slug_159809 	= 'fix159809-suporte-ao-cliente/fix159809-suporte-ao-cliente';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker($url_159809,__FILE__,$slug_159809);

function fix159809_load_modules($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
    $arrayItems = array();
    $skipByExclude = false;
    $handle = opendir($directory);
    if ($handle) {
        while (false !== ($file = readdir($handle))) {
        preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
        if($exclude){
            preg_match($exclude, $file, $skipByExclude);
        }
        if (!$skip && !$skipByExclude) {
            if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
                if($recursive) {
                    $arrayItems = array_merge($arrayItems, fix159809_load_modules($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                }
                if($listDirs){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            } else {
                if($listFiles){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            }
        }
    }
    closedir($handle);
    }
    return $arrayItems;
}


$path_modules = plugin_dir_path( __FILE__ )."add-in";
$dire = fix159809_load_modules($path_modules);
sort($dire);
foreach ($dire as $key => $value) {
	$extensao = substr($value, -4) ;
	if($extensao=='.php') require_once($value);;
}


function fix159809__file__(){
	return __FILE__;
}
function fix159809_plugin_file(){
	return plugin_dir_path( __FILE__ );
}

add_action('wp_enqueue_scripts', "fix159809_enqueue_scripts");
function fix159809_enqueue_scripts(){
    wp_enqueue_script( 'start-jquery', plugin_dir_url( __FILE__ ) . '/js/start-jquery.js', array( 'jquery' )  );
}
