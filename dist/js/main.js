!function(e){var a={};function r(s){if(a[s])return a[s].exports;var l=a[s]={i:s,l:!1,exports:{}};return e[s].call(l.exports,l,l.exports,r),l.l=!0,l.exports}r.m=e,r.c=a,r.d=function(e,a,s){r.o(e,a)||Object.defineProperty(e,a,{enumerable:!0,get:s})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,a){if(1&a&&(e=r(e)),8&a)return e;if(4&a&&"object"==typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(r.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&a&&"string"!=typeof e)for(var l in e)r.d(s,l,function(a){return e[a]}.bind(null,l));return s},r.n=function(e){var a=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(a,"a",a),a},r.o=function(e,a){return Object.prototype.hasOwnProperty.call(e,a)},r.p="",r(r.s=0)}([function(e,a){!function(){var e,a,r,s,l,d;if((e=document.getElementById("js-menu--primary"))&&void 0!==(a=e.getElementsByTagName("button")[0]))if(void 0!==(r=e.getElementsByTagName("ul")[0])){for(r.setAttribute("aria-expanded","false"),-1===r.className.indexOf("nav-menu")&&(r.className+=" nav-menu"),a.onclick=function(){-1!==e.className.indexOf("toggled")?(e.className=e.className.replace(" toggled",""),a.setAttribute("aria-expanded","false"),r.setAttribute("aria-expanded","false")):(e.className+=" toggled",a.setAttribute("aria-expanded","true"),r.setAttribute("aria-expanded","true"))},l=0,d=(s=r.getElementsByTagName("a")).length;l<d;l++)s[l].addEventListener("focus",f,!0),s[l].addEventListener("blur",f,!0);!function(e){var a,r,s=e.querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a");if("ontouchstart"in window)for(a=function(e){var a,r=this.parentNode;if(r.classList.contains("focus"))r.classList.remove("focus");else{for(e.preventDefault(),a=0;a<r.parentNode.children.length;++a)r!==r.parentNode.children[a]&&r.parentNode.children[a].classList.remove("focus");r.classList.add("focus")}},r=0;r<s.length;++r)s[r].addEventListener("touchstart",a,!1)}(e)}else a.style.display="none";function f(){for(var e=this;-1===e.className.indexOf("nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}}()}]);