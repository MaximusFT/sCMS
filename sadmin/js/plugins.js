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



/**
Typeahead.js input, based on [Twitter Typeahead](http://twitter.github.io/typeahead.js).
It is mainly replacement of typeahead in Bootstrap 3.
**/
(function ($) {
    "use strict";
    var Constructor = function (options) {
        this.init('typeaheadjs', options, Constructor.defaults);
    };

    $.fn.editableutils.inherit(Constructor, $.fn.editabletypes.text);

    $.extend(Constructor.prototype, {
        render: function() {
            this.options.typeahead.remote.dataParams = $.fn.editableutils.tryParseJson(this.options.scope.dataset.typeparams, true);
            console.log(this.options.typeahead.remote.dataParams.extension_id);
            this.renderClear();
            this.setClass();
            this.setAttr('placeholder');
            this.$input.typeahead(this.options.typeahead);
            // copy `input-sm | input-lg` classes to placeholder input
            if($.fn.editableform.engine === 'bs3') {
                if(this.$input.hasClass('input-sm')) {
                    this.$input.siblings('input.tt-hint').addClass('input-sm');
                }
                if(this.$input.hasClass('input-lg')) {
                    this.$input.siblings('input.tt-hint').addClass('input-lg');
                }
            }
        }
    });

    Constructor.defaults = $.extend({}, $.fn.editabletypes.list.defaults, {
        /**
        @property tpl
        @default <input type="text">
        **/
        tpl:'<input type="text">',
        /**
        Configuration of typeahead itself.
        [Full list of options](https://github.com/twitter/typeahead.js#dataset).

        @property typeahead
        @type object
        @default null
        **/
        typeahead: null,
        /**
        Whether to show `clear` button

        @property clear
        @type boolean
        @default true
        **/
        clear: true
    });
    $.fn.editabletypes.typeaheadjs = Constructor;
}(window.jQuery));





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