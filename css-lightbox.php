<?php

/**
* Plugin Name: CSS-Only Lightbox
* Description: Adds a shortcode and TinyMCE button for creating CSS-only lightboxes for images. Format is [css_lightbox id="uniqueID" height="400" width="400" title="A title" caption="A caption" alt="Some alt text" icon="true"]Image URL[/css_lightbox]
* Version: 0.0.1
* Author: Daniel Jones
* Text Domain: css-lightbox
**/

if ( ! defined( 'ABSPATH' ) )
    exit;

function css_lightbox_init() {
	wp_register_style( 'css-lightbox-styles', plugins_url( 'css-lightbox.css', __FILE__ ), array(), '0.0.1', 'screen' );
	add_shortcode( 'css_lightbox', 'css_lightbox' );

	/*
	 * Tinymce shortcode button taken from
	 * http://wordpress.stackexchange.com/questions/72394/how-to-add-a-shortcode-button-to-the-tinymce-editor
	*/
	//Abort early if the user will never see TinyMCE
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true' )
		return;
	//Add a callback to regiser our tinymce plugin   
	add_filter( "mce_external_plugins", "css_lightbox_register_tinymce_plugin" ); 
	// Add a callback to add our button to the TinyMCE toolbar
	add_filter('mce_buttons', 'css_lightbox_add_tinymce_button');
	// Add a callback to internationalize the plugin strings
	add_filter('mce_external_languages', 'css_lightbox_add_i18n');
}
add_action( 'init', 'css_lightbox_init' );

function css_lightbox( $atts, $content = 'null' ) {
	$atts = shortcode_atts( array(
		'id' => '',
		'height' => '',
		'width' => '',
		'alt' => '',
		'title' => '',
		'caption' => '',
		'icon' => 'true'
	), $atts );

	// Validate the URL
	if ( filter_var( $content, FILTER_VALIDATE_URL ) == false ) {
		$content = false;
	}
	// If the user hasn't given a valid URL or an ID, then we don't display the image
	if ( empty( $content ) || empty( $atts['id'] ) )
		return '<p>' . __( 'Sorry, there was an error displaying this image', 'css-lightbox' ) . '</p>';
	else {
		wp_enqueue_style( 'css-lightbox-styles' );
		ob_start(); ?>
			<a class="lightbox-link" href="#<?php echo $atts['id'] ?>">
				<?php
					if( $atts['icon'] !== 'false' ) {
						// We use a dashicon for the enlarge icon, and it's only enqueued for logged-in users by default
						wp_enqueue_style( 'dashicons' );
						echo '<p class="lightbox-enlarge"></p>';
					}
					$img_html = '<img class="lightbox-target" src="' . esc_url( $content ) . '"';
					/* 
					 * Not ideal, but need to use inline style instead of width and height HTML attributes
					 * in order to override common theme styles like "img { height: auto; }" which would nullify
					 * user-specified height for the image 
					 */
					if ( ! empty( $atts['width'] ) || ! empty( $atts['height'] ) )
						$img_html .= ' style="';
					if ( ! empty( $atts['width'] ) )
						$img_html .= 'width: ' . esc_attr( $atts['width'] ) . 'px;';
					if ( empty( $atts['height'] ) )
						$img_html .= '"';
					else
						$img_html .= ' height: ' . esc_attr( $atts['height'] ) . 'px"';

					$img_html .= ' alt="' . esc_attr( $atts['alt'] ) . '">';
					echo $img_html;
				?>
			</a>

			<div id="<?php echo $atts['id'] ?>" class="lightbox-overlay">
				<img class="lightbox-image" src="<?php echo esc_url( $content ) ?>" />
				<?php
					if ( ! empty( $atts['title'] ) || ! empty( $atts['caption'] ) ) {
						echo '<div class="lightbox-inner">';
						if ( ! empty( $atts['title'] ) )
							echo '<h3 class="lightbox-title">' . esc_html( $atts['title'] ) . '</h3>';
					
						if ( ! empty( $atts['caption'] ) )
							echo '<p class="lightbox-caption">' . esc_html( $atts['caption'] ) . '</p>';
						echo '</div>';
					}
				?>
				<a class="lightbox-close" href="#no-image">x</a>
			</div>
		<?php
		return ob_get_clean();
	}
}
// This callback registers our tinymce plugin
function css_lightbox_register_tinymce_plugin( $plugin_array ) {
	$plugin_array['css_lightbox_button'] = plugins_url( 'css-lightbox-tinymce.js', __FILE__ );
	return $plugin_array;
}

// This callback adds our tinymce button to the toolbar
function css_lightbox_add_tinymce_button($buttons) {
	//Add the button ID to the $button array
	$buttons[] = "css_lightbox_button";
	return $buttons;
}

// This callback adds internationalization to our tinymce plugin
function css_lightbox_add_i18n( $locales ) {
	$locales['css_lightbox_button'] = plugin_dir_path( __FILE__ ) . 'css-lightbox-tinymce-i18n.php';
	return $locales;
}