'use strict';

// Avoid `console` errors in browsers that lack a console.
!function(){for(var o,e=function(){},n=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeStamp","trace","warn"],r=n.length,i=window.console=window.console||{};r--;)o=n[r],i[o]||(i[o]=e)}();

// Place any jQuery/helper plugins in here.
function xjGrowl(response, newValue, theme){
	theme = theme || 'info';
    response = response || 'Новое значение поля = ';
    $.jGrowl(response + newValue, {themeState: theme, header: "Состояние запроса:", life: 1500});
}

function sCMSAletr(response, theme, newValue){
	theme = theme || 'info';
    newValue = newValue || response['value'];
    newValue = newValue || '';
    response = response['mgs'] || 'Значение поля было обновлено!';
    $.jGrowl(response + newValue, {themeState: theme, header: "Состояние запроса:", life: 1500});
}

;(function($, window, document){
    'use strict';

    var defaults = {
            idAjaxTarget    : 'appGo',
            itemNodeName    : 'li',
            expandBtnHTML   : '<button data-action="expand" type="button">Expand</button>',
            collapseBtnHTML : '<button data-action="collapse" type="button">Collapse</button>',
            group           : 0,
            maxDepth        : 5,
            threshold       : 20
        };

    function Plugin(element, options)
    {
        this.w  = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function()
        {
            var list = this;
            this.getContent(this.getUrl());
        },
        getUrl: function()
        {
            return window.location.pathname;
        },
        reload: function()
        {
            var that = this;
            $('#'+that.options.idAjaxTarget).empty();
            console.log(window.location);
        },
        getContent: function(pathname)
        {
            var that = this;
            $.ajax({
                type: "POST",
                url: pathname,
                data: {
                    params: '111',
                    menu_id: 'qqq'
                }
            })
            .done(function(result) {
                console.log(that.options.idAjaxTarget);
                $('#'+that.options.idAjaxTarget).empty().html(result);
            });
        },
    };
    $.fn.appGo = function(params)
    {
        var that  = this;
        $(that).data("appGo", new Plugin(that, params));
        return that;
    };
})(window.jQuery, window, document);

/**=========================================================
 * Module: Core Constants
 =========================================================*/

(function() {
  'use strict';

  // Same MQ as defined in the css
  window.MEDIA_QUERY = {
      'desktopLG': 1200,
      'desktop':   992,
      'tablet':    768,
      'mobile':    480
    };

})();

/**=========================================================
 * Init bootstrap
 =========================================================*/
(function(window, document, $, undefined){
  'use strict';

  $(function(){

    // POPOVER
    // ----------------------------------- 

    $('[data-toggle="popover"]').popover();

    // TOOLTIP
    // ----------------------------------- 

    $('[data-toggle="tooltip"]').tooltip({
      container: 'body'
    });

    // DROPDOWN INPUTS
    // ----------------------------------- 
    $('.dropdown input').on('click focus', function(event){
      event.stopPropagation();
    });

  });

})(window, document, window.jQuery);

/**=========================================================
 * Module: BrowserDetectionService.js
 * Browser detection service
 =========================================================*/

(function() {
    'use strict';

    window.browser = new Browser();

    // add a classname to target different platforms form css
    var root = document.querySelector('html');
    root.className += ' ' + browser.platform;

    function Browser() {
      /*jshint validthis:true*/
      var matched, browser = this;

      var uaMatch = function( ua ) {
        ua = ua.toLowerCase();

        var match = /(opr)[\/]([\w.]+)/.exec( ua ) ||
          /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
          /(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
          /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
          /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
          /(msie) ([\w.]+)/.exec( ua ) ||
          ua.indexOf('trident') >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
          ua.indexOf('compatible') < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
          [];

        var platformMatch = /(ipad)/.exec( ua ) ||
          /(iphone)/.exec( ua ) ||
          /(android)/.exec( ua ) ||
          /(windows phone)/.exec( ua ) ||
          /(win)/.exec( ua ) ||
          /(mac)/.exec( ua ) ||
          /(linux)/.exec( ua ) ||
          /(cros)/i.exec( ua ) ||
          [];

        return {
          browser: match[ 3 ] || match[ 1 ] || '',
          version: match[ 2 ] || '0',
          platform: platformMatch[ 0 ] || ''
        };
      };

      matched = uaMatch( window.navigator.userAgent );

      if ( matched.browser ) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
        browser.versionNumber = parseInt(matched.version);
      }

      if ( matched.platform ) {
        browser[ matched.platform ] = true;
      }

      // These are all considered mobile platforms, meaning they run a mobile browser
      if ( browser.android || browser.ipad || browser.iphone || browser[ 'windows phone' ] ) {
        browser.mobile = true;
      }

      // These are all considered desktop platforms, meaning they run a desktop browser
      if ( browser.cros || browser.mac || browser.linux || browser.win ) {
        browser.desktop = true;
      }

      // Chrome, Opera 15+ and Safari are webkit based browsers
      if ( browser.chrome || browser.opr || browser.safari ) {
        browser.webkit = true;
      }

      // IE11 has a new token so we will assign it msie to avoid breaking changes
      if ( browser.rv )
      {
        var ie = 'msie';

        matched.browser = ie;
        browser[ie] = true;
      }

      // Opera 15+ are identified as opr
      if ( browser.opr )
      {
        var opera = 'opera';

        matched.browser = opera;
        browser[opera] = true;
      }

      // Stock Android browsers are marked as Safari on Android.
      if ( browser.safari && browser.android )
      {
        var android = 'android';

        matched.browser = android;
        browser[android] = true;
      }

      // Assign the name and platform variable
      browser.name = matched.browser;
      browser.platform = matched.platform;


      return browser;
    }

})();

/**=========================================================
 * Module: checkAllTable
 * Allows to use a checkbox to check all the rest in the same
 * columns in a Bootstrap table
 =========================================================*/
(function() {
    'use strict';

    $(function(){
      checkAll( $('[data-checkall]') );
    });

    function checkAll(element) {

      element.on('change', function() {

        var th = $(this);
        var index = indexInParent(this);
        var checkbox = th.find('input'); // assumes checkbox
        var table = th.parent().parent().parent(); // table > thead > tr > th

        $.each( table.find('tbody').find('tr'),
          function(key, tr) {
            var tds = $(tr).find('td');
            var chk = tds.eq(index).find('input'); // assumes checkbox
            if(chk && chk.length)
              chk[0].checked = checkbox[0].checked;
          });

      });


      function indexInParent(node) {
        var children = node.parentNode.childNodes;
        var num = 0;
        for (var i=0; i<children.length; i++) {
           if (children[i]===node) return num;
           if (children[i].nodeType===1) num++;
        }
        return -1;
      }

    }

})();

/**=========================================================
 * Module: Support
 * Checks for features supports on browser
 =========================================================*/
/*jshint -W069*/
(function() {
    'use strict';

    window.Support = new DeviceSupport();

    function DeviceSupport() {
      /*jshint validthis:true*/
      var support = this;
      var doc = document;

      // Check for transition support
      // ----------------------------------- 
      support.transition = (function() {

        function transitionEnd() {
            var el = document.createElement('bootstrap');

            var transEndEventNames = {
              WebkitTransition : 'webkitTransitionEnd',
              MozTransition    : 'transitionend',
              OTransition      : 'oTransitionEnd otransitionend',
              transition       : 'transitionend'
            };

            for (var name in transEndEventNames) {
              if (el.style[name] !== undefined) {
                return { end: transEndEventNames[name] };
              }
            }
            return false;
          }

          return transitionEnd();
      })();

      // Check for animation support
      // ----------------------------------- 
      support.animation = (function() {

          var animationEnd = (function() {

              var element = doc.body || doc.documentElement,
                  animEndEventNames = {
                      WebkitAnimation: 'webkitAnimationEnd',
                      MozAnimation: 'animationend',
                      OAnimation: 'oAnimationEnd oanimationend',
                      animation: 'animationend'
                  }, name;

              for (name in animEndEventNames) {
                  if (element.style[name] !== undefined) return animEndEventNames[name];
              }
          }());

          return animationEnd && { end: animationEnd };
      })();

      // Check touch device
      // ----------------------------------- 
      support.touch = (
          ('ontouchstart' in window && navigator.userAgent.toLowerCase().match(/mobile|tablet/)) ||
          (window.DocumentTouch && document instanceof window.DocumentTouch)  ||
          (window.navigator['msPointerEnabled'] && window.navigator['msMaxTouchPoints'] > 0) || //IE 10
          (window.navigator['pointerEnabled'] && window.navigator['maxTouchPoints'] > 0) || //IE >=11
          false
      );

      return support;

    }
})();

/**=========================================================
 * Module: Sidebar
 * Wraps the sidebar. Handles collapsed state and slide
 =========================================================*/

(function() {
    'use strict';

    $(function(){

      uiSidebar( $('[data-ui-sidebar]') );

      $('.sidebar-nav > .nav a[href^="' + location.pathname.split('/').slice(-1)[0] + '"]').parents('li').addClass('active');

    });

    function uiSidebar (element) {
        var $body = $('body');

        element.find('a').on('click', function (event) {
          var ele = $(this),
              par = ele.parent()[0];

          // remove active class (ul > li > a)
          var lis = ele.parent().parent().children();
          $.each(lis, function(li){
            if(li !== par)
              $(li).removeClass('active');
          });

          var next = ele.next();
          if ( next.length && next[0].tagName === 'UL' ) {
            ele.parent().toggleClass('active');
            event.preventDefault();
          }
        });

        $('.sidebar-toggle, .sidebar-toggle-off').on('click', function(e){
          e.preventDefault();
          $body.toggleClass('aside-offscreen');
        });

        // on mobiles, sidebar starts off-screen
        if ( onMobile() )
          $body.addClass('aside-offscreen');

        var lastWidth = window.innerWidth;
        $(window).resize(function(){
            // resize from desktop to mobile, hide sidebar
            if ( window.innerWidth < lastWidth && onMobile() ) {
              $body.addClass('aside-offscreen');
            }
            // resize from mobile to desktop, show again sidebar
            if ( window.innerWidth > lastWidth && !onMobile() ) {
              $body.removeClass('aside-offscreen');
            }
            lastWidth = window.innerWidth;
        });

        function onMobile() {
          return window.innerWidth < MEDIA_QUERY.tablet;
        }

    }
})();

/**=========================================================
 * Module: Core Constants
 =========================================================*/

(function() {
  'use strict';

  $(function(){

    var panelInner = $('.mb-panel-inner');

    $('.mb-mails-responsive table > tbody > tr').on('click', function(e){
      e.preventDefault();
      panelInner.addClass('mb-content-open');
    });

    $('.mb-panel-back').on('click', function(e){
      e.preventDefault();
      panelInner.removeClass('mb-content-open');
    });

  });

})();



/**=========================================================
 * Module: Scrollable
 * Make a content box scrollable
 =========================================================*/

(function() {
    'use strict';

    var defaultHeight = 285;
    
    $(function(){

        $('[data-scrollable]').each(function(){
          var elem = $(this);
          var opts = elem.data();

          opts.height = opts.height || defaultHeight;

          elem.slimScroll(opts);

        });

    });

})();
