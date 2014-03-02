<?php

$lumi_classes_path = dirname(__FILE__) . '/classes/';

define( 'LUMI_CSS_VER', 5 );


/**
 * Classes autoloading
 */
$files = array();
$global = glob( $lumi_classes_path . '*.global.php' );
$specific = ( is_admin() ) ? glob( $lumi_classes_path . '*.admin.php' ) : glob( $lumi_classes_path . '*.frontend.php' );
if( !empty( $global ) ) {
	$files = array_merge( $files, $global );
}
if( !empty( $specific ) ) {
	$files = array_merge( $files, $specific );
}
foreach( $files as $file ) {
	include_once $file;
}

/**
 * Template class autoloader
 * @var string $name
 * @return \Lumiart\Template\ContactFrontend | \Lumiart\Template\Layout | \Lumiart\Template\Options | \Lumiart\Template\Portfolio
 */
function lumi_load_template( $name ) {
	global $lumi_classes_path;
	include_once $lumi_classes_path . $name . '.template.php';
	return call_user_func( '\Lumiart\Template\return_' . $name );
}

/**
 * Dashboard activity plugin
 */
if( is_admin() ) {
	include_once 'admin-dashboard-activity/admin-dashboard-activity.php';
}




/**
 * Disable imagemagick for savana
 * TODO: Finally change hosting for gods sake
 */
add_filter( 'wp_image_editors', 'change_graphic_lib' );
function change_graphic_lib($array) {
	return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

