<?php

// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function css_lightbox_tinymce_plugin_translation() {
	$strings = array(
		'icon' => __( 'Show enlarge icon on image?', 'css-lightbox' ),
		'alt' => __( 'Alt text for the on-page image', 'css-lightbox' ),
		'height' => __( 'Height for the on-page image (in pixels, without adding px)', 'css-lightbox' ),
		'width' => __( 'Width for the on-page image (in pixels, without adding px)', 'css-lightbox' ),
		'caption' => __( 'Caption for the large image', 'css-lightbox' ),
		'title' => __( 'Title for the large image', 'css-lightbox' ),
		'id' => __( 'Unique ID for image (Required)', 'css-lightbox' )
	);

	$locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.css-lightbox", ' . json_encode( $strings ) . ");\n";

	return $translated;
}
$strings = css_lightbox_tinymce_plugin_translation();