// Avoid `console` errors in browsers that lack a console.
!function(){for(var o,e=function(){},n=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeStamp","trace","warn"],r=n.length,i=window.console=window.console||{};r--;)o=n[r],i[o]||(i[o]=e)}();

// smooth-scroller - Javascript lib to handle smooth scrolling * v0.1.2
!function(a){a.fn.smoothScroller=function(b){b=a.extend({},a.fn.smoothScroller.defaults,b);var c=a(this);return a(b.scrollEl).animate({scrollTop:c.offset().top-a(b.scrollEl).offset().top-b.offset},b.speed,b.ease,function(){var a=c.attr("id");a.length&&(history.pushState?history.pushState(null,null,"#"+a):document.location.hash=a),c.trigger("smoothScrollerComplete")}),this},a.fn.smoothScroller.defaults={speed:400,ease:"swing",scrollEl:"body,html",offset:0},a("body").on("click","[data-smoothscroller]",function(b){b.preventDefault();var c=a(this).attr("href");0===c.indexOf("#")&&a(c).smoothScroller()})}(jQuery);

// toc - jQuery Table of Contents Plugin  * v0.3.2
!function(t){t.fn.toc=function(e){var o,i=this,n=t.extend({},jQuery.fn.toc.defaults,e),r=t(n.container),s=t(n.selectors,r),l=[],a=n.activeClass,c=function(e,o){if(n.smoothScrolling&&"function"==typeof n.smoothScrolling){e.preventDefault();var r=t(e.target).attr("href");n.smoothScrolling(r,n,o)}t("a",i).removeClass(a),t(e.target).addClass(a)},f=function(e){o&&clearTimeout(o),o=setTimeout(function(){for(var e,o=t(window).scrollTop(),r=Number.MAX_VALUE,s=0,c=0,f=l.length;f>c;c++){var h=Math.abs(l[c]-o);r>h&&(s=c,r=h)}t("a",i).removeClass(a),e=t("a:eq("+s+")",i).addClass(a),n.onHighlight(e)},50)};return n.highlightOnScroll&&(t(window).bind("scroll",f),f()),this.each(function(){var e=t(this),o=t(n.listType);o.addClass(n.listTypeClass),s.each(function(i,r){var s=t(r);l.push(s.offset().top-n.highlightOffset);var a=n.anchorName(i,r,n.prefix);if(r.id!==a){t("<span/>").attr("id",a).insertBefore(s)}var h=t("<a/>").text(n.headerText(i,r,s)).addClass(n.itemClass(i,r,s,n.prefix)).attr("href","#"+a).bind("click",function(o){t(window).unbind("scroll",f),c(o,function(){}),t(window).bind("scroll",f),e.trigger("selected",t(this).attr("href"))});o.append(h)}),e.append(o)})},jQuery.fn.toc.defaults={container:"article",listType:"<div/>",listTypeClass:"list-group",selectors:"h2,h3,h4",smoothScrolling:function(e,o,i){t(e).smoothScroller({offset:o.scrollToOffset}).on("smoothScrollerComplete",function(){i()})},scrollToOffset:0,prefix:"toc",activeClass:"active",onHighlight:function(){},highlightOnScroll:!0,highlightOffset:100,anchorName:function(t,e,o){return o+t},headerText:function(t,e,o){return o.text()},itemClass:function(t,e,o,i){return"list-group-item"}}}(jQuery);

// Paste plug in after this sentense!