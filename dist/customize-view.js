!function(e){var t={};function o(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)o.d(n,r,function(t){return e[t]}.bind(null,r));return n},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=0)}([function(e,t){var o=document.querySelector(".app-header"),n=document.querySelector(".app-header__title"),r=document.querySelector(".app-header__description"),c=document.querySelector(".breadcrumbs"),i=document.querySelectorAll(".post-thumbnail"),u=document.documentElement;wp.customize("blogname",function(e){e.bind(function(e){n.textContent=e})}),wp.customize("blogdescription",function(e){e.bind(function(e){r.textContent=e})}),wp.customize("header_bg_color",function(e){e.bind(function(e){u.style.setProperty("--header-bg-color",e)})}),wp.customize("foreground_color",function(e){e.bind(function(e){u.style.setProperty("--foreground_color",e)})}),wp.customize("primary_color",function(e){e.bind(function(e){u.style.setProperty("--color-1",e)})}),wp.customize("accent_color",function(e){e.bind(function(e){u.style.setProperty("--color-2",e)})}),wp.customize("header_color",function(e){e.bind(function(e){o.style.setProperty("--header-text-color",e)})}),wp.customize("header_text",function(e){e.bind(function(e){!1===e?(n.style.cssText="clip:rect(0 0 0 0);position:absolute",r.style.cssText="clip:rect(0 0 0 0);position:absolute"):(n.style.cssText="clip:unset;position:relative",r.style.cssText="clip:unset;position:relative")})}),wp.customize("forsite_breadcrumbs_display",function(e){e.bind(function(e){!1===e?c.classList.add("screen-reader-text"):c.classList.remove("screen-reader-text")})}),wp.customize("forsite_archive_img",function(e){e.bind(function(e){!1===e?i.forEach(function(e){e.classList.add("screen-reader-text")}):i.forEach(function(e){e.classList.remove("screen-reader-text")})})})}]);