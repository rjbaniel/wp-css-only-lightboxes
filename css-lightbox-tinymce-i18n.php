<?php

// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function css_lightbox_tinymce_plugin_translation() {
	$strings = array(
		'icon' => __( 'Show enlarge icon on image?', 'wp-css-only-lightboxes' ),
		'alt' => __( 'Alt text for the on-page image', 'wp-css-only-lightboxes' ),
		'height' => __( 'Height for the on-page image (in pixels, without adding px)', 'wp-css-only-lightboxes' ),
		'width' => __( 'Width for the on-page image (in pixels, without adding px)', 'wp-css-only-lightboxes' ),
		'caption' => __( 'Caption for the large image', 'wp-css-only-lightboxes' ),
		'title' => __( 'Title for the large image', 'wp-css-only-lightboxes' ),
		'id' => __( 'Unique ID for image (Required)', 'wp-css-only-lightboxes' )
	);

	$locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.css-lightbox", ' . json_encode( $strings ) . ");\n";

	return $translated;
}
$strings = css_lightbox_tinymce_plugin_translation();