(()=>{"use strict";var e={};e.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),(()=>{var t;e.g.importScripts&&(t=e.g.location+"");var r=e.g.document;if(!t&&r&&(r.currentScript&&(t=r.currentScript.src),!t)){var o=r.getElementsByTagName("script");if(o.length)for(var n=o.length-1;n>-1&&!t;)t=o[n--].src}if(!t)throw new Error("Automatic publicPath is not supported in this browser");t=t.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),e.p=t+"../"})();e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p,e.p;document.addEventListener("DOMContentLoaded",(()=>{!function(){const e=document.querySelectorAll(".smooth-link");document.querySelector(".header").clientHeight,e.length&&e.forEach((e=>e.addEventListener("click",(e=>{e.preventDefault();const t=e.target.closest(".smooth-link").getAttribute("href"),r=document.querySelector(t);if(r){const e=r.getBoundingClientRect().top+scrollY;scrollTo({behavior:"smooth",top:e,left:0})}}))))}(),function(){const e=document.querySelector(".return-link"),t=document.querySelector("section");e&&document.addEventListener("scroll",(()=>{scrollY>t.getBoundingClientRect().bottom-document.querySelector("header").clientHeight?e.closest(".return").classList.remove("hidden"):e.closest(".return").classList.add("hidden")}))}()}))})();