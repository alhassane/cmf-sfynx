(function(a,b){if(typeof exports=="object"){module.exports=b()}else{if(typeof define=="function"&&define.amd){define(b)}else{a.Spinner=b()}}})(this,function(){var C=["webkit","Moz","ms","O"],x={},q;function j(c,d){var a=document.createElement(c||"div"),f;for(f in d){a[f]=d[f]}return a}function k(c){for(var d=1,a=arguments.length;d<a;d++){c.appendChild(arguments[d])}return c}var b=function(){var a=j("style",{type:"text/css"});k(document.getElementsByTagName("head")[0],a);return a.sheet||a.styleSheet}();function D(F,c,e,G){var r=["opacity",c,~~(F*100),e,G].join("-"),i=0.01+e/G*100,h=Math.max(1-(1-F)/c*(100-i),F),p=q.substring(0,q.indexOf("Animation")).toLowerCase(),E=p&&"-"+p+"-"||"";if(!x[r]){b.insertRule("@"+E+"keyframes "+r+"{0%{opacity:"+h+"}"+i+"%{opacity:"+F+"}"+(i+0.01)+"%{opacity:1}"+(i+c)%100+"%{opacity:"+F+"}100%{opacity:"+h+"}}",b.cssRules.length);x[r]=1}return r}function A(d,a){var f=d.style,h,c;if(f[a]!==undefined){return a}a=a.charAt(0).toUpperCase()+a.slice(1);for(c=0;c<C.length;c++){h=C[c]+a;if(f[h]!==undefined){return h}}}function w(c,d){for(var a in d){c.style[A(c,a)||a]=d[a]}return c}function m(c){for(var d=1;d<arguments.length;d++){var a=arguments[d];for(var f in a){if(c[f]===undefined){c[f]=a[f]}}}return c}function y(a){var c={x:a.offsetLeft,y:a.offsetTop};while(a=a.offsetParent){c.x+=a.offsetLeft,c.y+=a.offsetTop}return c}var B={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",direction:1,speed:1,trail:100,opacity:1/4,fps:20,zIndex:2000000000,className:"spinner",top:"auto",left:"auto",position:"relative"};function g(a){if(typeof this=="undefined"){return new g(a)}this.opts=m(a||{},g.defaults,B)}g.defaults={};m(g.prototype,{spin:function(N){this.stop();var H=this,i=H.opts,d=H.el=w(j(0,{className:i.className}),{position:i.position,width:0,zIndex:i.zIndex}),O=i.radius+i.length+i.width,K,E;if(N){N.insertBefore(d,N.firstChild||null);E=y(N);K=y(d);w(d,{left:(i.left=="auto"?E.x-K.x+(N.offsetWidth>>1):parseInt(i.left,10)+O)+"px",top:(i.top=="auto"?E.y-K.y+(N.offsetHeight>>1):parseInt(i.top,10)+O)+"px"})}d.setAttribute("role","progressbar");H.lines(d,H.opts);if(!q){var M=0,f=(i.lines-1)*(1-i.direction)/2,I,F=i.fps,o=F/i.speed,J=(1-i.opacity)/(o*i.trail/100),G=o/i.lines;(function L(){M++;for(var a=0;a<i.lines;a++){I=Math.max(1-(M+(i.lines-a)*G)%o*J,i.opacity);H.opacity(d,a*i.direction+f,I,i)}H.timeout=H.el&&setTimeout(L,~~(1000/F))})()}return H},stop:function(){var a=this.el;if(a){clearTimeout(this.timeout);if(a.parentNode){a.parentNode.removeChild(a)}this.el=undefined}return this},lines:function(h,n){var i=0,f=(n.lines-1)*(1-n.direction)/2,c;function o(d,a){return w(j(),{position:"absolute",width:n.length+n.width+"px",height:n.width+"px",background:d,boxShadow:a,transformOrigin:"left",transform:"rotate("+~~(360/n.lines*i+n.rotate)+"deg) translate("+n.radius+"px,0)",borderRadius:(n.corners*n.width>>1)+"px"})}for(;i<n.lines;i++){c=w(j(),{position:"absolute",top:1+~(n.width/2)+"px",transform:n.hwaccel?"translate3d(0,0,0)":"",opacity:n.opacity,animation:q&&D(n.opacity,n.trail,f+i*n.direction,n.lines)+" "+1/n.speed+"s linear infinite"});if(n.shadow){k(c,w(o("#000","0 0 4px #000"),{top:2+"px"}))}k(h,k(c,o(n.color,"0 0 1px rgba(0,0,0,.1)")))}return h},opacity:function(c,d,a){if(d<c.childNodes.length){c.childNodes[d].style.opacity=a}}});function z(){function a(c,d){return j("<"+c+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',d)}b.addRule(".spin-vml","behavior:url(#default#VML)");g.prototype.lines=function(p,n){var f=n.length+n.width,c=2*f;function G(){return w(a("group",{coordsize:c+" "+c,coordorigin:-f+" "+-f}),{width:c,height:c})}var E=-(n.width+n.length)*2+"px",h=w(G(),{position:"absolute",top:E,left:E}),t;function F(l,i,d){k(h,k(w(G(),{rotation:360/n.lines*l+"deg",left:~~i}),k(w(a("roundrect",{arcsize:n.corners}),{width:f,height:n.width,left:n.radius,top:-n.width>>1,filter:d}),a("fill",{color:n.color,opacity:n.opacity}),a("stroke",{opacity:0}))))}if(n.shadow){for(t=1;t<=n.lines;t++){F(t,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)")}}for(t=1;t<=n.lines;t++){F(t)}return k(p,h)};g.prototype.opacity=function(d,f,c,h){var l=d.firstChild;h=h.shadow&&h.lines||0;if(l&&f+h<l.childNodes.length){l=l.childNodes[f+h];l=l&&l.firstChild;l=l&&l.firstChild;if(l){l.opacity=c}}}}var v=w(j("group"),{behavior:"url(#default#VML)"});if(!A(v,"transform")&&v.adj){z()}else{q=A(v,"animation")}return g});