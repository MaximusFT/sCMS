'use strict';

$(function(){
	$('.toc').toc({'smoothScrolling': true});
	/*
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
	*/
    $('form').on('submit',function () {
        var form = $(this);
        var button = $(':submit', form);

        button.button('loading');


        $.post(form.attr('action'), form.serialize(), function (response) {

            form.find('.error').remove();
            form.find('.has-error').removeClass('has-error');

            if (response.form && ! $.isEmptyObject(response.form)) {
                // Display errors
                for (var name in response.form) {
                    if (response.form.hasOwnProperty(name)) {
                        form.find('[name=' + name + ']').focus().parent().addClass('has-error')
                            .find('input')
                            .before('<small class="error text-danger">' + response.form[name] + '</small>');
                    }
                }

                // Re-Enables the button
                button.button('reset');
            }
            else {
                // Success
                button.replaceWith('<div class="alert alert-success">' + response.confirm + '</div>');

                if (form.data('success')) {
                    setTimeout(function () {
                        window.location = form.data('success');
                    }, 4000);
                }


                //form.find('fieldset').attr('disabled','disabled');
            }
        }, 'json');

        return false;
    }).on('change', 'input', function () {

        // Clears the error status

        var group = $(this).parents('.form-group:first');

        group.find('.error').remove();
        group.removeClass('has-error');
    })
});
