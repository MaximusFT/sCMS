'use strict';

$(function(){
	$('.toc').toc({'smoothScrolling': true});
	var topLink = $('#top-link');
	topLink.css({'padding-bottom': $(window).height()});
	topLink.toplinkwidth();
	$(window).resize(function(){
		topLink.toplinkwidth();
	});
	$(window).scroll(function() {
		if( topLink.toplinkwidth() ) {
			if($(window).scrollTop() >= 1) {
				topLink.fadeIn(300).children('a').html('<span id="topicon"></span>1111').parent().removeClass('bottom_button').addClass('top_button');
			} else {
				topLink.children('a').html('<span id="backicon"></span>2222').parent().removeClass('top_button').addClass('bottom_button');
			}
		}
	});
	topLink.on('click', function(e) {
		if($(this).hasClass('bottom_button')){
			$("body").scrollTo(topLink.data('pos') + 'px', 500 );
		} else {
			topLink.data('pos', ((window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop) );
			$("body, html").animate({scrollTop: 0},500);
		}
		return false;
	});
});