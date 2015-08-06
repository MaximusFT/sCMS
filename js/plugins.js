// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
/*!
 * toc - jQuery Table of Contents Plugin
 * v0.3.2
 * http://projects.jga.me/toc/
 * copyright Greg Allen 2014
 * MIT License
*/
/*!
 * smooth-scroller - Javascript lib to handle smooth scrolling
 * v0.1.2
 * https://github.com/firstandthird/smooth-scroller
 * copyright First+Third 2014
 * MIT License
*/
//smooth-scroller.js

(function($) {
  $.fn.smoothScroller = function(options) {
    options = $.extend({}, $.fn.smoothScroller.defaults, options);
    var el = $(this);

    $(options.scrollEl).animate({
      scrollTop: el.offset().top - $(options.scrollEl).offset().top - options.offset
    }, options.speed, options.ease, function() {
      var hash = el.attr('id');

      if(hash.length) {
        if(history.pushState) {
          history.pushState(null, null, '#' + hash);
        } else {
          document.location.hash = hash;
        }
      }

      el.trigger('smoothScrollerComplete');
    });

    return this;
  };

  $.fn.smoothScroller.defaults = {
    speed: 400,
    ease: 'swing',
    scrollEl: 'body,html',
    offset: 0
  };

  $('body').on('click', '[data-smoothscroller]', function(e) {
    e.preventDefault();
    var href = $(this).attr('href');

    if(href.indexOf('#') === 0) {
      $(href).smoothScroller();
    }
  });
}(jQuery));

(function($) {
var verboseIdCache = {};
$.fn.toc = function(options) {
  var self = this;
  var opts = $.extend({}, jQuery.fn.toc.defaults, options);

  var container = $(opts.container);
  var headings = $(opts.selectors, container);
  var headingOffsets = [];
  var activeClassName = opts.activeClass;

  var scrollTo = function(e, callback) {
    if (opts.smoothScrolling && typeof opts.smoothScrolling === 'function') {
      e.preventDefault();
      var elScrollTo = $(e.target).attr('href');

      opts.smoothScrolling(elScrollTo, opts, callback);
    }
    $('a', self).removeClass(activeClassName);
    $(e.target).addClass(activeClassName);
    // $(e.target).parent().addClass(activeClassName);
  };

  //highlight on scroll
  var timeout;
  var highlightOnScroll = function(e) {
    if (timeout) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function() {
      var top = $(window).scrollTop(),
        highlighted, closest = Number.MAX_VALUE, index = 0;
      
      for (var i = 0, c = headingOffsets.length; i < c; i++) {
        var currentClosest = Math.abs(headingOffsets[i] - top);
        if (currentClosest < closest) {
          index = i;
          closest = currentClosest;
        }
      }
      
      $('a', self).removeClass(activeClassName);
      highlighted = $('a:eq('+ index +')', self).addClass(activeClassName);
      opts.onHighlight(highlighted);      
    }, 50);
  };
  if (opts.highlightOnScroll) {
    $(window).bind('scroll', highlightOnScroll);
    highlightOnScroll();
  }

  return this.each(function() {
    //build TOC
    var el = $(this);
    var ul = $(opts.listType);
    ul.addClass(opts.listTypeClass);

    headings.each(function(i, heading) {
      var $h = $(heading);
      headingOffsets.push($h.offset().top - opts.highlightOffset);

      var anchorName = opts.anchorName(i, heading, opts.prefix);

      //add anchor
      if(heading.id !== anchorName) {
        var anchor = $('<span/>').attr('id', anchorName).insertBefore($h);
      }

      //build TOC item
      var a = $('<a/>')
        .text(opts.headerText(i, heading, $h))
        .addClass(opts.itemClass(i, heading, $h, opts.prefix))
        .attr('href', '#' + anchorName)
        .bind('click', function(e) {
          	$(window).unbind('scroll', highlightOnScroll);
          	scrollTo(e, function() {
          	});
        	$(window).bind('scroll', highlightOnScroll);
          	el.trigger('selected', $(this).attr('href'));
        });
        /*
        
      var li = $('<li/>')
        .addClass(opts.itemClass(i, heading, $h, opts.prefix))
        .append(a);
      	ul.append(li);
        */

      ul.append(a);
    });
    el.append(ul);
    // el.html(ul);
  });
};

jQuery.fn.toc.defaults = {
  container: 'body',
  listType: '<ul/>',
  listTypeClass: 'sample',
  selectors: 'h1,h2,h3',
  smoothScrolling: function(target, options, callback) {
    $(target).smoothScroller({
      offset: options.scrollToOffset
    }).on('smoothScrollerComplete', function() {
      callback();
    });
  },
  scrollToOffset: 0,
  prefix: 'toc',
  activeClass: 'toc-active',
  onHighlight: function() {},
  highlightOnScroll: true,
  highlightOffset: 100,
  anchorName: function(i, heading, prefix) {
    if(heading.id.length) {
      return heading.id;
    }

    var candidateId = $(heading).text().replace(/[^a-z0-9]/ig, ' ').replace(/\s+/g, '-').toLowerCase();
    if (verboseIdCache[candidateId]) {
      var j = 2;
      
      while(verboseIdCache[candidateId + j]) {
        j++;
      }
      candidateId = candidateId + '-' + j;
      
    }
    verboseIdCache[candidateId] = true;

    return prefix + '-' + candidateId;
  },
  headerText: function(i, heading, $heading) {
    return $heading.text();
  },
  itemClass: function(i, heading, $heading, prefix) {
    return prefix + '-' + $heading[0].tagName.toLowerCase();
  }

};

})(jQuery);

///////////////////////////////////////

