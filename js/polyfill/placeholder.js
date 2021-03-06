var variPlaceholder = [];

$("input, textarea").each ( function(i, e) {
    
   variPlaceholder[i] = $(e).attr('placeholder');
   
   if ( $(e).val().length < 1 && $(e).attr('placeholder') ) {
       $(e).val(variPlaceholder[i]);
       $(e).addClass('inPlaceholder');

       $(e).focus( function () {
           if ( $(e).val() == variPlaceholder[i] ) {
               $(e).val('');
               $(e).removeClass('inPlaceholder');
           }
       });
 
       $(e).blur( function () {
           if ( $(e).val() == '' ) {
                $(e).val(variPlaceholder[i]);
                $(e).addClass('inPlaceholder');
           }    
       });
       
   }
   
});




/** 
 * Html5 Placeholder Polyfill - v2.0.6 - 2012-11-14
 * web: * http://blog.ginader.de/dev/jquery/HTML5-placeholder-polyfill/
 * issues: * https://github.com/ginader/HTML5-placeholder-polyfill/issues
 * Copyright (c) 2012 Dirk Ginader; Licensed MIT, GPL 
*/

//(function(a){function d(a,b){a.val()===""?a.data("placeholder").removeClass(b.hideClass):a.data("placeholder").addClass(b.hideClass)}function e(a,b){a.data("placeholder").addClass(b.hideClass)}function f(a,b){var c=b.is("textarea"),d=b.offset();if(b.css("padding")&&b.css("padding")!=="0px"){var e=b.css("padding").split(" ");d.top+=Number(e[0].replace("px","")),d.left+=Number(e[e.length-1].replace("px",""))}else b.css("padding-top")&&b.css("padding-top")!=="0px"&&(d.top+=Number(b.css("padding-top").replace("px",""))),b.css("padding-left")&&b.css("padding-left")!=="0px"&&(d.left+=Number(b.css("padding-left").replace("px","")));a.css({width:b.innerWidth()-(c?20:4),height:b.innerHeight()-6,lineHeight:b.css("line-height"),whiteSpace:c?"normal":"nowrap",overflow:"hidden"}).offset(d)}function g(a,b){var d=a.val();(function f(){c=requestAnimationFrame(f),a.val()!==d&&(e(a,b),i(),h(a,b))})()}function h(a,b){(function e(){c=requestAnimationFrame(e),d(a,b)})()}function i(){cancelAnimationFrame(c)}function j(a){b&&window.console&&window.console.log&&window.console.log(a)}var b=!1,c;a.fn.placeHolder=function(b){j("init placeHolder");var c=this,h=a(this).length;return this.options=a.extend({className:"placeholder",visibleToScreenreaders:!0,visibleToScreenreadersHideClass:"placeholder-hide-except-screenreader",visibleToNoneHideClass:"placeholder-hide",hideOnFocus:!1,removeLabelClass:"visuallyhidden",hiddenOverrideClass:"visuallyhidden-with-placeholder",forceHiddenOverride:!0,forceApply:!1,autoInit:!0},b),this.options.hideClass=this.options.visibleToScreenreaders?this.options.visibleToScreenreadersHideClass:this.options.visibleToNoneHideClass,a(this).each(function(b){var k=a(this),m=k.attr("placeholder"),n=k.attr("id"),p,q,r,s;if(m===""||m===undefined)m=k[0].attributes.placeholder.value;p=k.closest("label"),k.removeAttr("placeholder");if(!p.length&&!n){j("the input element with the placeholder needs an id!");return}p=p.length?p:a('label[for="'+n+'"]').first();if(!p.length){j("the input element with the placeholder needs a label!");return}s=a(p).find(".placeholder");if(s.length)return f(s,k),s.text(m),k;p.hasClass(c.options.removeLabelClass)&&p.removeClass(c.options.removeLabelClass).addClass(c.options.hiddenOverrideClass),q=a("<span>").addClass(c.options.className).text(m).appendTo(p),r=q.width()>k.width(),r&&q.attr("title",m),f(q,k),k.data("placeholder",q),q.data("input",q),q.click(function(){a(this).data("input").focus()}),k.focusin(function(){!c.options.hideOnFocus&&window.requestAnimationFrame?g(k,c.options):e(k,c.options)}),k.focusout(function(){d(a(this),c.options),!c.options.hideOnFocus&&window.cancelAnimationFrame&&i()}),d(k,c.options),a(document).bind("fontresize resize",function(){f(q,k)}),a.event.special.resize?a("textarea").bind("resize",function(a){f(q,k)}):a("textarea").css("resize","none"),b>=h-1&&(a.attrHooks.placeholder={get:function(b){return b.nodeName.toLowerCase()==="input"||b.nodeName.toLowerCase()==="textarea"?a(b).data("placeholder")?a(a(b).data("placeholder")).text():a(b)[0].placeholder:undefined},set:function(b,c){return a(a(b).data("placeholder")).text(c)}})})},a(function(){var b=window.placeHolderConfig||{};if(b.autoInit===!1){j("placeholder:abort because autoInit is off");return}if(("placeholder"in a("<input>")[0]||"placeHolder"in a("<input>")[0])&&!b.forceApply){j("placeholder:abort because browser has native support");return}a("input[placeholder], textarea[placeholder]").placeHolder(b)})})(jQuery);