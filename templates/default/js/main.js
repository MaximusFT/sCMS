'use strict';

$(function(){
	var tocPos = $('#toc').offset();

	$('.toc').toc({
		'selectors': 'h2,h3,h4', //elements to use as headings
		'container': 'article', //element to find all selectors in
		'listType': '<div/>',
		'listTypeClass': 'list-group',
		'activeClass': 'active',
		'smoothScrolling': true, //enable or disable smooth scrolling on click
		'prefix': 'toc', //prefix for anchor tags and class names
		'onHighlight': function(el) {}, //called when a new section is highlighted 
		'highlightOnScroll': true, //add class to heading that is currently in focus
		'highlightOffset': 100, //offset to trigger the next headline
		'anchorName': function(i, heading, prefix) { //custom function for anchor name
			return prefix+i;
		},
		'headerText': function(i, heading, $heading) { //custom function building the header-item text
			return $heading.text();
		},
		'itemClass': function(i, heading, $heading, prefix) { // custom function for item class
  			return 'list-group-item';
		}
	});

	$('#toc').affix({
		offset: {
			top: function () {
				return (tocPos.top)
			},
			bottom: function () {
				return (this.bottom = $('footer').outerHeight(true))
			}
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