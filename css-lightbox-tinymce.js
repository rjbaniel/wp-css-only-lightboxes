jQuery(document).ready(function() {
	tinymce.create('tinymce.plugins.csslightbox', {
		init: function(editor, url) {
			editor.addCommand('css_lightbox_insert_shortcode', function() {
				selected = tinyMCE.activeEditor.selection.getContent();
				// Only works if user has selected an image url, otherwise abort
				if ( ! selected ) {
					return;
				}
				editor.windowManager.open({
					title: 'Create a CSS lightbox',
					body: [
						{type: 'textbox', name: 'id', label: editor.getLang('css-lightbox.id')},
						{type: 'textbox', name: 'title', label: editor.getLang('css-lightbox.title')},
						{type: 'textbox', name: 'caption', label: editor.getLang('css-lightbox.caption')},
						{type: 'textbox', name: 'width', label: editor.getLang('css-lightbox.width')},
						{type: 'textbox', name: 'height', label: editor.getLang('css-lightbox.height')},
						{type: 'textbox', name: 'alt', label: editor.getLang('css-lightbox.alt')},
						{type: 'checkbox', name: 'icon', label: editor.getLang('css-lightbox.icon')}
					],
					onsubmit: function( e ) {
						// Only works if user specifies an ID, otherwise abort
						if ( ! e.data.id ) {
							return;
						}
						var new_content = '[css_lightbox id="' + e.data.id + '"';
						var atts = [];
						atts['title'] = e.data.title;
						atts['caption'] = e.data.caption;
						atts['width'] = e.data.width;
						atts['height'] = e.data.height;
						atts['alt'] = e.data.alt;
						atts['icon'] = e.data.icon;
						for( var index in atts) {
							new_content += ' ' + index + '="' + atts[index] + '"';
						}
						new_content += ']';
						editor.insertContent( new_content + selected + '[/css_lightbox]' );
					}
				});
			});
			

			editor.addButton('css_lightbox_button', {
				title: 'Create lightbox for image url',
				text: 'Lightbox',
				icon: false,
				cmd: 'css_lightbox_insert_shortcode'
			});
		}
	});

	tinymce.PluginManager.add( 'css_lightbox_button', tinymce.plugins.csslightbox );
});