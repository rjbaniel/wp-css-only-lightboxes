=== Plugin Name ===
Contributors: Daniel Jones
Tags: lightbox, css, css lightbox
Requires at least: 3.0.1
Tested up to: 4.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

Adds a shortcode and TinyMCE button for creating CSS-only lightboxes for images.

== Description ==

This is the long description.  No limit, and you can use Markdown (as well as in the following sections).

For backwards compatibility, if this section is missing, the full length of the short description will be used, and
Markdown parsed.

A few notes about the sections above:

*   "Contributors" is a comma separated list of wordpress.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= How do I add a lightbox? =

1. Copy and paste the complete URL for the image you want to make a lightbox for into the Wordpress editor
1. Select the URL with your cursor
1. Click the "Lightbox" button in the TinyMCE toolbar
1. Enter the values you're prompted for. The only one that's required is a unique ID for the image

OR

1. Copy and paste the complete URL for the image you want to make a lightbox for into the Wordpress editor
1. Add the opening shortcode, [css_lightbox ...] before the beginning of the URL and add the options you want
1. Attributes you can use with the shortcode are:
* "id" (unique identifier for the image, required)
* "height" (in pixels, without including px)
* "width" (in pixels, without including px)
* "title" (a title for image, displayed when it's enlarged)
* "caption" (a caption for the image, displayed when it's enlarged)
* "alt" (alt text for the on-page image), "icon" ('true' or 'false' - whether or not to include a small magnifying glass icon in the top-left of the on-page image, to indicate that it can be enlarged)
1. An example using all of the available options: [css_lightbox id="uniqueID" height="400" width="400" title="A title" caption="A caption" alt="Some alt text" icon="true"]Image URL[/css_lightbox]

= What features are coming? =
* The option to use other units for the image dimension, including %, em, rem, vw, and vh
* Send me suggestions in the support forum!

== Changelog ==

= 1.0 =
First version:
* Adds shortcode
* Adds TinyMCE plugin and button to make the shortcode easier to use