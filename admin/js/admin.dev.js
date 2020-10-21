jQuery(document).ready(function($){
		
	$('.meta-box-sortables .head-wrap').parent().addClass('closed');	
	$('.meta-box-sortables .head-wrap').click(function(e){
		e.preventDefault();
		$(this).next().toggle();
		$(this).parent().toggleClass('closed');
	}).next().hide();

	// Toggle all
	$('.toggle-all').click(function(e){
		$('.meta-box-sortables .head-wrap').each(function(){
			$(this).next().toggle();
			$(this).parent().toggleClass('closed');
		});
		e.preventDefault();
	})
	
	// To Show/Hide the widget hooks
	$('a.toggle-widget-hooks').click(function(){
		$(this).closest('li').find('li.widget-hooks').fadeToggle();
		return false;
	});
	
	// Remember the opened options panes
	$('.meta-box-sortables .head-wrap, .toggle-all').click(function(){
			var postboxes = $('.left-wrap .postbox');
			var openboxes = new Array();
			$('.left-wrap .panel-wrap:visible').each(function(index){   
					var openbox = $(this).parent();
					openboxes.push(postboxes.index(openbox));                        
			});                    
			mgrapheneSetCookie('mgraphene-tab-'+mgraphene_tab+'-boxes', openboxes.join(','), 100);                    
	});

	// reopen the previous options panes
	var oldopenboxes = mgrapheneGetCookie('mgraphene-tab-'+mgraphene_tab+'-boxes');                
	if (oldopenboxes != null && oldopenboxes != '') {
			var boxindexes = oldopenboxes.split(',');                    
			for (var boxindex in boxindexes){                            
					$('.left-wrap .postbox:eq('+boxindexes[boxindex]+')').children('.panel-wrap').show();
			}
	}
	
	// Display spinning wheel when options form is submitted
	$('.left-wrap input[type="submit"]').click(function(){
		ajaxload = '<img src="' + mgraphene_uri + '/images/ajax-loader.gif" alt="Working..." class="ajaxload" />';
		if ( $(this).parents('.panel-wrap').length > 0 )
			$(this).parent().prepend(ajaxload);
		else
			$(this).parent().append(ajaxload);
	});
	
	// Save options via AJAX
	$('#mgraphene-options-form').submit(function(){
		
		var data = $(this).serialize();
		data = data.replace('action=update', 'action=mgraphene_ajax_update');
		
		$.post(ajaxurl, data, function(response) {
			$('.ajaxload').remove();
			mgraphene_show_message(response);
			
			if ( response.search('error') == -1 ) t = 1000
			else t = 4000;
			t = setTimeout('mgraphene_fade_message()', t);
		});
		
		return false;
	});
		
	/* Farbtastic colour picker */
		$('div.colorpicker').each(function(){
			var $this = $(this);
			$this.hide();                    
			$this.farbtastic($this.siblings('input.color'));
		});                    
		$('input.color')
			.focusin(function(){ $(this).siblings('div.colorpicker').show(); })
			.focusout(function(){ $(this).siblings('div.colorpicker').hide(); });    
		
		$('.clear-color').click(function(){
			$(this).siblings('input.color').attr('value', '').removeAttr('style');
			return false;
		});
	
	// Custom background preview
	$('#bg-imgurl').bind('keyup', function(){
		$('#mgraphene-bg-preview').css('background-image', 'url(' + $(this).val() + ')');
	});
	$('.bg-position-wrap input').bind('mouseup', function(){
		$('#mgraphene-bg-preview').css('background-position', $(this).val());
	});
	$('.bg-position-wrap label').bind('mouseup', function(){
		$('#mgraphene-bg-preview').css('background-position', $(this).prev().val());
	});
	$('.bg-repeat-wrap input').bind('mouseup', function(){
		$('#mgraphene-bg-preview').css('background-repeat', $(this).val());
	});
	$('.bg-repeat-wrap label').bind('mouseup', function(){
		$('#mgraphene-bg-preview').css('background-repeat', $(this).prev().val());
	});
	$('#bg_colour, #picker_bg_colour div').bind('mouseup keyup', function(){
		$('#mgraphene-bg-preview').css('background-color', $.farbtastic('#picker_bg_colour').color);
	});
	
	// Header preview
	$('#picker_header_top div, #picker_header_bottom div, #header_top, #header_bottom').bind('mouseup keyup', function(){
		var bgTop = $.farbtastic('#picker_header_top').color;
		var bgBottom = $.farbtastic('#picker_header_bottom').color;
		$('.mgraphene-header-preview #header').attr('style', '\
			background: ' + bgTop + ';\
			background: -moz-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: -webkit-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
		');
	});
	$('#picker_header_title div, #header_title').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview .site-title a').css('color', $.farbtastic('#picker_header_title').color);
	});
	$('#picker_header_desc div, #header_desc').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview .site-desc').css('color', $.farbtastic('#picker_header_desc').color);
	});
	$('#picker_nav_bg div, #nav_bg').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview #nav').css('background-color', $.farbtastic('#picker_nav_bg').color );
	});
	$('#picker_nav_bg_current div, #nav_bg_current').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview li.current-menu-item a').css('background-color', $.farbtastic('#picker_nav_bg_current').color);
	});
	$('#picker_nav_text div, #nav_text').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview li a').css('color', $.farbtastic('#picker_nav_text').color);
		$('.mgraphene-header-preview li.current-menu-item a').css('color', $.farbtastic('#picker_nav_text_current').color);
	});
	$('#picker_nav_text_current div, #nav_text_current').bind('mouseup keyup', function(){
		$('.mgraphene-header-preview li.current-menu-item a').css('color', $.farbtastic('#picker_nav_text_current').color);
	});
	
	// Footer preview
	$('#picker_copyright_bg div, #copyright_bg').bind('mouseup keyup', function(){
		$('#mgraphene-footer .footer-menu-wrap').css('background-color', $.farbtastic('#picker_copyright_bg').color);
	});
	$('#picker_copyright_text div, #copyright_text').bind('mouseup keyup', function(){
		$('#mgraphene-footer p').css('color', $.farbtastic('#picker_copyright_text').color);
		$('#mgraphene-footer .credit p').css('color', $.farbtastic('#picker_credit_text').color);
	});
	$('#picker_footer_menu_text div, #footer_menu_text').bind('mouseup keyup', function(){
		$('#mgraphene-footer #footer-menu a').css('color', $.farbtastic('#picker_footer_menu_text').color);
	});
	$('#picker_credit_bg div, #credit_bg').bind('mouseup keyup', function(){
		$('#mgraphene-footer .credit').css('background-color', $.farbtastic('#picker_credit_bg').color);
	});
	$('#picker_credit_text div, #credit_text').bind('mouseup keyup', function(){
		$('#mgraphene-footer .credit p').css('color', $.farbtastic('#picker_credit_text').color);
	});
	$('#picker_credit_link_text div, #credit_link_text').bind('mouseup keyup', function(){
		$('#mgraphene-footer .credit a').css('color', $.farbtastic('#picker_credit_link_text').color);
	});
	
	// Content preview (top half)
	$('#picker_content_title_bg div, #content_title_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-header').css('background-color', $.farbtastic('#picker_content_title_bg').color);
	});
	$('#picker_content_title_text div, #content_title_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-header a').css('color', $.farbtastic('#picker_content_title_text').color);
	});
	$('#picker_content_meta_text div, #content_meta_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-header .entry-meta').css('color', $.farbtastic('#picker_content_meta_text').color);
	});
	$('#picker_content_cat_bg div, #content_cat_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-cats').css('background-color', $.farbtastic('#picker_content_cat_bg').color);
	});
	$('#picker_content_cat_text div, #content_cat_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-cats p').css('color', $.farbtastic('#picker_content_cat_text').color);
	});
	$('#picker_content_cat_link_bg div, #content_cat_link_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-cats a').css('background-color', $.farbtastic('#picker_content_cat_link_bg').color);
	});
	$('#picker_content_cat_link_text div, #content_cat_link_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-cats a').css('color', $.farbtastic('#picker_content_cat_link_text').color);
	});
	$('#picker_content_bg div, #content_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry').css('background-color', $.farbtastic('#picker_content_bg').color);
	});
	$('#picker_content_text div, #content_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-content p').css('color', $.farbtastic('#picker_content_text').color);
	});
	$('#picker_content_link div, #content_link').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-content a').css('color', $.farbtastic('#picker_content_link').color);
	});
	
	// Content preview (bottom half)
	$('#picker_content_pages_bg div, #content_pages_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .pages-links a').css('background-color', $.farbtastic('#picker_content_pages_bg').color);
	});
	$('#picker_content_pages_text div, #content_pages_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .pages-links p').css('color', $.farbtastic('#picker_content_pages_text').color);
	});
	$('#picker_content_pages_link div, #content_pages_link').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .pages-links a').css('color', $.farbtastic('#picker_content_pages_link').color);
	});
	$('#picker_content_tag_bg div, #content_tag_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-tags').css('background-color', $.farbtastic('#picker_content_tag_bg').color);
	});
	$('#picker_content_tag_text div, #content_tag_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-tags p').css('color', $.farbtastic('#picker_content_tag_text').color);
	});
	$('#picker_content_tag_link_bg div, #content_tag_link_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-tags a').css('background-color', $.farbtastic('#picker_content_tag_link_bg').color);
	});
	$('#picker_content_tag_link_text div, #content_tag_link_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-tags a').css('color', $.farbtastic('#picker_content_tag_link_text').color);
	});
	$('#picker_content_nav_bg div, #content_nav_bg').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-nav').css('background-color', $.farbtastic('#picker_content_nav_bg').color);
	});
	$('#picker_content_nav_next_bg div, #content_nav_next_bg4').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-nav .next').css('background-color', $.farbtastic('#picker_content_nav_next_bg').color);
	});
	$('#picker_content_nav_text div, #content_nav_text').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-nav .post-title a').css('color', $.farbtastic('#picker_content_nav_text').color);
	});
	$('#picker_content_nav_link div, #content_nav_link').bind('mouseup keyup', function(){
		$('.mgraphene-content-preview .entry-nav .post-link a').css('color', $.farbtastic('#picker_content_nav_link').color);
	});
	
	// Other sections preview
	$('#picker_section_title_bg_top div, #section_title_bg_top, #picker_section_title_bg_bottom div, #section_title_bg_bottom').bind('mouseup keyup', function(){
		var bgTop = $.farbtastic('#picker_section_title_bg_top').color;
		var bgBottom = $.farbtastic('#picker_section_title_bg_bottom').color;
		$('.mgraphene-sections-preview .post-list-title').attr('style', '\
			background: ' + bgTop + ';\
			background: -moz-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: -webkit-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
		');
	});
	$('#picker_section_title_text div, #section_title_text').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .post-list-title a').css('color', $.farbtastic('#picker_section_title_text').color);
	});
	$('#picker_section_bg div, #section_bg').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .post-list-wrap').css('background-color', $.farbtastic('#picker_section_bg').color);
	});
	$('#picker_section_text div, #section_text').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .post-list-content li').css('color', $.farbtastic('#picker_section_text').color);
	});
	$('#picker_section_link div, #section_link').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .post-list-content a').css('color', $.farbtastic('#picker_section_link').color);
	});
	$('#picker_section_list_border div, #section_list_border').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .post-list-content li').css('border-color', $.farbtastic('#picker_section_list_border').color);
	});
	$('#picker_section_nav_bg div, #section_nav_bg').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .posts-nav').css('background-color', $.farbtastic('#picker_section_nav_bg').color);
	});
	$('#picker_section_nav_text div, #section_nav_text').bind('mouseup keyup', function(){
		$('.mgraphene-sections-preview .posts-nav a').css('color', $.farbtastic('#picker_section_nav_text').color);
	});	
	
	// Comments section preview
	$('#picker_comments_title_bg_top div, #comments_title_bg_top, #picker_comments_title_bg_bottom div, #comments_title_bg_bottom').bind('mouseup keyup', function(){
		var bgTop = $.farbtastic('#picker_comments_title_bg_top').color;
		var bgBottom = $.farbtastic('#picker_comments_title_bg_bottom').color;
		$('.mgraphene-comments-preview .comments-wrap-header').attr('style', '\
			background: ' + bgTop + ';\
			background: -moz-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: -webkit-gradient(linear, left top, left bottom, from(' + bgTop + '), to(' + bgBottom + '));\
			background: -webkit-linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
			background: linear-gradient( ' + bgTop + ', ' + bgBottom + ' );\
		');
	});
	$('#picker_comments_title_divider div, #comments_title_divider').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .pings-count').css('border-color', $.farbtastic('#picker_comments_title_divider').color);
	});
	$('#picker_comments_title_text div, #comments_title_text').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .comments-wrap-header a').css('color', $.farbtastic('#picker_comments_title_text').color);
	});
	$('#picker_comments_reply_bg div, #comments_reply_bg').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .add-comment').css('background-color', $.farbtastic('#picker_comments_reply_bg').color);
	});
	$('#picker_comments_reply_text div, #comments_reply_text').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .add-comment a').css('color', $.farbtastic('#picker_comments_reply_text').color);
	});
	$('#picker_comments_meta_text div, #comments_meta_text').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .comment-meta').css('color', $.farbtastic('#picker_comments_meta_text').color);
	});
	$('#picker_comments_bg div, #comments_bg').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .comments-wrap').css('background-color', $.farbtastic('#picker_comments_bg').color);
	});
	$('#picker_comments_text div, #comments_text').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .comment-entry').css('color', $.farbtastic('#picker_comments_text').color);
	});
	$('#picker_comments_link div, #comments_link').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview .comment a').css('color', $.farbtastic('#picker_comments_link').color);
	});
	$('#picker_comments_list_border div, #comments_list_border').bind('mouseup keyup', function(){
		$('.mgraphene-comments-preview li').css('border-color', $.farbtastic('#picker_comments_list_border').color);
	});
	
	
	
});

function mgrapheneSetCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function mgrapheneGetCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function mgrapheneDeleteCookie(name) {
	mgrapheneSetCookie(name,"",-1);
}

function mgraphene_show_message(response) {
	jQuery('.mgraphene-ajax-response').html(response).fadeIn(400);
}

function mgraphene_fade_message() {
	jQuery('.mgraphene-ajax-response').fadeOut(1000);	
	clearTimeout(t);
}