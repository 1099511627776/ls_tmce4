var ls = ls || {};
/**
 * Различные настройки
 */
ls.settings = (function ($) {
	this.getTinymce = function() {
		return {
			mode : "specific_textareas",
			editor_selector : "mce-editor",
			menubar : "false",
			theme : "modern",
			content_css : DIR_STATIC_SKIN + "/css/reset.css" + "," + DIR_STATIC_SKIN + "/css/tinymce.css?" + new Date().getTime(),
			toolbar: [
				"bold italic underline strikethrough | alignleft aligncenter alignright | fontsizeselect | link unlink | image media | code | pagebreak",
				"undo redo | blockquote | removeformat | emoticons" //| spellchecker",
			],
			plugins : "lseditor,media,pagebreak,emoticons,image,media,code,link,spellchecker", //contextmenu
			browser_spellcheck:true,
			convert_urls : false,
			extended_valid_elements : "embed[src|type|allowscriptaccess|allowfullscreen|width|height]",
			pagebreak_separator : "<cut>",
			media_strict : false,
			language : TINYMCE_LANG,
			inline_styles:false,
			image_description: false,
			image_title: false,
			media_dimensions: false,
			media_alt_source:false,
			media_poster: false,
			formats : {
					underline :     {inline : 'u', exact : true},
					strikethrough : {inline : 's', exact : true}
				},
			file_picker_callback: function(callback, value, meta) {
				if(meta.filetype=='image') {
					$('#tmce4_form').submit(function(evt){
						ls.ajaxSubmit('upload/image','tmce4_form',function(response){
							$('#tmce4_form input').val(null);
							callback(response.sFile);
						});
						$('#tmce4_form').unbind('submit');
						return false;
					});
					$('#tmce4_form input').click();
				}
			}
		};
	};

	this.getTinymceComment = function() {
		return {
			mode : "specific_textareas",
			editor_selector : "mce-editor",
			menubar : "false",
			theme : "modern",
			content_css : DIR_STATIC_SKIN + "/css/reset.css" + "," + DIR_STATIC_SKIN + "/css/tinymce.css?" + new Date().getTime(),
			toolbar: [
				"bold italic underline strikethrough | alignleft aligncenter alignright | link unlink | image media ",
				"undo redo | blockquote | emoticons" //| spellchecker",
			],
			plugins : "lseditor,media,pagebreak,emoticons,image,media,code,link,spellchecker", //contextmenu
			browser_spellcheck:true,
			convert_urls : false,
			extended_valid_elements : "embed[src|type|allowscriptaccess|allowfullscreen|width|height]",
			pagebreak_separator : "<cut>",
			media_strict : false,
			language : TINYMCE_LANG,
			inline_styles: false,
			image_description: false,
			image_title: false,
			media_dimensions: false,
			media_alt_source:false,
			media_poster: false,
			formats : {
				underline :     {inline : 'u', exact : true},
				strikethrough : {inline : 's', exact : true}
			},
			file_picker_callback: function(callback, value, meta) {
				if(meta.filetype=='image') {
					$('#tmce4_form').submit(function(evt){
						ls.ajaxSubmit('upload/image','tmce4_form',function(response){
							$('#tmce4_form input').val(null);
							callback(response.sFile);
						});
						$('#tmce4_form').unbind('submit');
						return false;
					});
					$('#tmce4_form input').click();
				}
			}
		}
	}
	return this;
}).call(ls.settings || {},jQuery);
