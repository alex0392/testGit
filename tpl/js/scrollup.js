jQuery( document ).ready(function() {
	jQuery('#scrollup img').mouseover( function(){
		jQuery( this ).animate({opacity: 0.65},100);
	}).mouseout( function(){
		jQuery( this ).animate({opacity: 1},100);
	}).click( function(){
		window.scroll(0 ,0); 
		return false;
	});

	jQuery(window).scroll(function(){
		if ( jQuery(document).scrollTop() > 0 ) {
			jQuery('#scrollup').fadeIn('slow');
		} else {
			jQuery('#scrollup').fadeOut('slow');
		}
	});
});



function showHideLoader(hide) {
	if(hide) {
		$('#loader').hide();
	} else {
		
		$('#loader').show();
		showFader();
	}
}

function showFader(){
  if (!$('#fader').get(0)){
    fader_html = '<div id="fader" style="background: #f5f5f5 none repeat scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; visibility: visible;  position: absolute; z-index:10; left: 0pt; top: 0pt; display: none; "> </div>';
    $('#container').after(fader_html);
  }
  fader_obj = $('#fader');
  fader_obj.css({
  'opacity': '0.7',
  'height': $(document).height()+'px',
  'width': $('body').width()+'px'
  });
  fader_obj.show();
}