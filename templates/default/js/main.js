'use strict';

$(function(){
	var tocPos = $('#toc').offset();
	$('.toc').toc({'smoothScrolling': true});
	$('#toc').affix({
		offset: {
			top: function(){return (tocPos.top)},
			bottom: function(){return (this.bottom=$('footer').outerHeight(true))}
		}
	});

	$('#subscribeForm').on('submit', function(event){
		event.preventDefault();
		var $this = $(this),
	    	promises = $.map([$this.attr('action')], function(urls) {
	        return $.ajax({
				url : urls,
				data : $this.serialize(),
				type : "post"
			}).then(function(result) {
		        ga('send', 'FORM', 'button', 'click', 'Subscribe');
				$('#subscribeForm').replaceWith('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Успех!</strong> Вы добавлены на подписку новостей</div>');
	        });
	    });
	})
	$('#questionForm').on('submit', function(event){
		event.preventDefault();
		var $this = $(this),
	    	promises = $.map([$this.attr('action')], function(urls) {
	        return $.ajax({
				url : urls,
				data : $this.serialize(),
				type : "post"
			}).then(function(result) {
		        ga('send', 'FORM', 'button', 'click', 'Question');
				$(result).replaceAll('#questionForm');
	        });
	    });
	})
	$('#commentForm').on('submit', function(event){
		event.preventDefault();
		var $this = $(this),
	    	promises = $.map([$this.attr('action')], function(urls) {
	        return $.ajax({
				url : urls,
				data : $this.serialize(),
				type : "post"
			}).then(function(result) {
		        ga('send', 'FORM', 'button', 'click', 'Comment');
		        // yaCounter24224152.reachGoal('FORM');
				$(result).replaceAll('#commentForm');
	        });
	    });
	})
	$('#articleMore').on('click', 'a', function(event){
		event.preventDefault();
		var $this = $(this),
	    	promises = $.map(['/articles/more/'], function(urls) {
	        return $.ajax({
				url : urls,
				type : "post"
			}).then(function(result) {
				$(result).replaceAll('#articleMore');
	        });
	    });
	})
});