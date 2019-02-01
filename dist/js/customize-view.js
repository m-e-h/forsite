!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t){
/**
 * Customize preview script.
 *
 * This file handles the JavaScript for the live preview frame in the customizer.
 * Any includes or imports should be handled in this file. The final result gets
 * saved back into `dist/js/customize-preview.js`.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */
document.querySelector(".app-header");var n=document.querySelector(".app-header__title"),o=document.querySelector(".app-header__description"),r=function(e,t){document.documentElement.style.setProperty(e,t)};wp.customize("blogname",function(e){e.bind(function(e){n.textContent=e})}),wp.customize("blogdescription",function(e){e.bind(function(e){o.textContent=e})}),wp.customize("header_textcolor",function(e){e.bind(function(e){r("--header-text-color",e),[n,o].forEach(function(t){"blank"===e?(t.style.clip="rect(0 0 0 0)",t.style.position="absolute"):(t.style.color=e,t.style.clip="auto",t.style.position="relative")})})}),wp.customize("header_bg_color",function(e){e.bind(function(e){r("--header-bg-color",e)})}),wp.customize("primary_color",function(e){e.bind(function(e){r("--color-1",e)})}),wp.customize("accent_color",function(e){e.bind(function(e){r("--color-2",e)})})}]);