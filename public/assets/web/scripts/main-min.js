$(document).ready(function(){"use strict";function e(){$(".side-item-link.active[data-toggle= 'collapse']").removeClass("collapsed").siblings(".collapse").collapse("show")}function a(){$(".side-item-link[data-toggle= 'collapse']").siblings(".collapse").collapse("hide")}localStorage.nightMood&&"false"!=localStorage.nightMood?(localStorage.nightMood="true",$("body").addClass("theme-dark")):(localStorage.nightMood="false",$("body").removeClass("theme-dark")),$("#night-mood-toggle").on("click",function(e){e.preventDefault(),$("body").hasClass("theme-dark")?($("body").removeClass("theme-dark"),localStorage.nightMood="false"):($("body").addClass("theme-dark"),localStorage.nightMood="true")}),localStorage.sideNavCollapsed&&"false"!=localStorage.sideNavCollapsed?(localStorage.sideNavCollapsed="true",$("body").addClass("side-nav-collapsed")):(localStorage.sideNavCollapsed="false",$(window).innerWidth()>1199?$("body").removeClass("side-nav-collapsed"):$("body").addClass("side-nav-collapsed"),$(window).innerWidth()>1199&&e()),$("#menu-toggle").on("click",function(o){o.preventDefault(),$("body").hasClass("side-nav-collapsed")?($("body").removeClass("side-nav-collapsed"),$(".close-side-nav-overlay").fadeIn(),localStorage.sideNavCollapsed="false",e()):($("body").addClass("side-nav-collapsed"),$(".close-side-nav-overlay").fadeOut(),localStorage.sideNavCollapsed="true",a())}),$(".side-nav").on("mouseenter",function(){$("body.side-nav-collapsed").length>0&&($("body").addClass("side-nav-expanded"),e(),$(".close-side-nav-overlay").fadeIn())}),$(".side-nav").on("mouseleave",function(){$("body.side-nav-collapsed").length>0&&(a(),$("body").removeClass("side-nav-expanded"),$(".close-side-nav-overlay").fadeOut())}),$(".close-side-nav-overlay").on("click",function(){$("body").addClass("side-nav-collapsed"),$(this).fadeOut(),localStorage.sideNavCollapsed="true",a()}),$(".email-row .main-checkbox input").on("change",function(){$(this).is(":checked")?$(this).parents(".email-row").addClass("email-row-checked"):$(this).parents(".email-row").removeClass("email-row-checked"),$(".email-row .main-checkbox input:checked").length>0?$(this).parents("body").find(".email-global-actions").eq(0).find(".email-actions").addClass("active"):$(this).parents("body").find(".email-global-actions").eq(0).find(".email-actions").removeClass("active")}),$("#user-image-input").on("change",function(e){let a=$(this),o=$(".user-image > img");""===a.val()?o.remove():(o.remove(),$(".user-image").prepend('<img src="'+URL.createObjectURL(e.target.files[0])+'">'))}),$(".box-circle").each(function(){let e=0,a=$(this),o=a.find(".circle-border"),l=o.data("color1"),s=o.data("color2"),d=a.find(".percentage"),n=d.data("percentage"),i=3.6*n;o.css({"background-color":s}),setTimeout(function(){!function a(){e+=1;e<0&&(e=0);if(e>i)return void(e=i);n=e/3.6;d.text(n.toFixed(1)+" %");e<=180?o.css("background-image","linear-gradient("+(90+e)+"deg, transparent 50%,"+l+" 50%),linear-gradient(90deg, "+l+" 50%, transparent 50%)"):o.css("background-image","linear-gradient("+(e-90)+"deg, transparent 50%,"+s+" 50%),linear-gradient(90deg, "+l+" 50%, transparent 50%)");setTimeout(function(){a()},1)}()},1)})}),$(window).on("load",function(){$("body").removeClass("no-transition")});