jQuery(document).ready(function($) {
	// hides as soon as the DOM is ready
	$( 'div.v-option-body' ).hide();
	// shows on clicking the noted link
	$( 'h3' ).click(function() {
		$(this).toggleClass("open");
		$(this).next("div").slideToggle( '1000' );
		return false;
	});

	var formfield, type;
  
  jQuery('#linen_logo_img_upload_button').click(function() {
    formfield = jQuery(this).attr('data-field-id');
    tb_show('', 'media-upload.php?post_id=&type=image&TB_iframe=true');
    return false;
  });
  
  window.original_send_to_editor = window.send_to_editor;
  window.send_to_editor = function(html) {
    if(formfield) {
      source = jQuery(html).find('img').attr('src');
      jQuery('#'+formfield).val(source);
      tb_remove();
    }else{
      window.original_send_to_editor(html);
    }
  }
});

function toggleColorpicker (link, id, toggledir, opentext, closetext) {
	jQuery( '.colorpicker_container' ).hide();
	if (toggledir == "open") {
		jQuery( '#'+id+'_colorpicker' ).show();
		jQuery(link).replaceWith( '<a href="javascript:return false;" onclick="toggleColorpicker (this, \''+id+'\', \'close\', \''+opentext+'\', \''+closetext+'\' )">'+closetext+'</a>' );
	} else {
		jQuery(link).replaceWith( '<a href="javascript:return false;" onclick="toggleColorpicker (this, \''+id+'\', \'open\', \''+opentext+'\', \''+closetext+'\' )">'+opentext+'</a>' );
	}
}