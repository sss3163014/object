var base = "http://super.kdnet.net/";
function parseDate(dateVal) {var re = /-/g;return new Date(Date.parse(dateVal.replace(re,'/')));}
function flashObject(swf, width, height) {
    var str = new String();
    if (navigator.appName.indexOf("Microsoft") != -1) {
    	str+='<object width="'+width+'" height="'+height+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" wmode="transparent">';
        str+='<param name="movie" value="'+swf+'">';
        str+='<param name="wmode" value="transparent">';
        str+='<param name="quality" value="autohigh">';
        str+='<param name="allowScriptAccess" value="always" > ';
		
		str+='<div style="height:75px;">';
        str+='</div>';
		
        str+='<embed width="'+width+'" height="'+height+'" src="'+swf+'" quality="autohigh" wmode="transparent" type="application/x-shockwave-flash" plugspace="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed>';
        str+='</object>';
    } else {
        str += '<object style="outline: medium none; width: '+width+'px; height: '+height+'px;" data="' + swf + '">';
        str += '<param value="always" name="allowscriptaccess">';
        str += '<param value="opaque" name="wmode">';
        str += '<param value="high" name="quality">';
        str += '<param value="application/x-shockwave-flash" name="type">';
		str+='<div style="height:75px;">';
        str+='</div>';
        str += '</object>';
    }
    return document.write(str);
}

function vHTML(url, width, height) {
//	var herf = "";
//	<a style="display:block;position:absolute; width:650px;height:75px;left:0px;top: 0px;cursor:pointer;z-index: 10;background-color:rgb(255,255,255);opacity:0;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;filter: alpha(opacity=0);" 
	var str = new String();
	if(_ktype=="flash"){
		str+='<a href="'+href+'" target="_blank" style="display:block; position:absolute;top:25px; width:'+width+'px; height:'+height+'px;cursor:pointer;z-index: 10;background-color:rgb(255,255,255);opacity:0;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;filter: alpha(opacity=0);">';
		str+='</a>';
		 if (navigator.appName.indexOf("Microsoft") != -1) {
		    	str+='<object width="'+width+'" height="'+height+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" wmode="transparent">';
		        str+='<param name="movie" value="'+base+url+'">';
		        str+='<param name="wmode" value="transparent">';
		        str+='<param name="quality" value="autohigh">';
		        str+='<param name="allowScriptAccess" value="always" > ';
				
				str+='<div style="height:75px;">';
		        str+='</div>';
				
		        str+='<embed width="'+width+'" height="'+height+'" src="'+base+url+'" quality="autohigh" wmode="transparent" type="application/x-shockwave-flash" plugspace="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed>';
		        str+='</object>';
		    } else {
		        str += '<object style="outline: medium none; width: '+width+'px; height: '+height+'px;" data="' +base+ url + '">';
		        str += '<param value="always" name="allowscriptaccess">';
		        str += '<param value="opaque" name="wmode">';
		        str += '<param value="high" name="quality">';
		        str += '<param value="application/x-shockwave-flash" name="type">';
				str+='<div style="height:75px;">';
		        str+='</div>';
		        str += '</object>';
		    }
	}
	if(_ktype=="image"){
		str+='<a style="display:block;position:absolute; width:'+width+'px; height:'+height+'px; left:0px; top:0px;">';
		str+='</a>';
		str+='<img src="'+base+url+'" width="'+width+'" height="'+height+'" />';
	}
   
    return str;
}

/**************************/
function r(d) {
	var ss = 0,sr = 0,er = 0,mx = 180,p = 0,r = Math.random()*mx;
	for (var i=0;i<d.length;i++) ss += parseInt(d[i].st);
	for (var i=0;i<d.length;i++) {var it = d[i]; sr = er; er = sr + Math.ceil(mx * it.st/ss);if (r > sr - 1 && r < er + 1) {p = i;break;}}
	var intMaxOrder=0;
	for(var i=0;i<d.length;i++){
		if(parseInt(d[i].st)>=intMaxOrder){
			p = i;
			intMaxOrder = parseInt(d[i].st);
		}
	}
	return p;
}

function getCookie(name) {
	var cookie = "";
    if(document.cookie.length > 0) {
    	var cookies = document.cookie.split(";");
        for(var i=0;i<cookies.length;i++){
			var item = cookies[i].split("=");
			if(item[0].replace(" ","") == name.replace(" ","")) {cookie = unescape(item[1]);break;}
		}
    }
    return cookie;
}

function renderPanda(d) {
	var df = d.shift();
	
	var n = new Date();n = new Date(n.getFullYear(), n.getMonth(), n.getDate());
	for (var i=0;i<d.length;i++) {var it = d[i];if (n < parseDate(it.s) || n > parseDate(it.e)) {d.splice(i,1);i--;}}
	var d = (d.length == 0)?df:d[r(d)];
	var html = "";var href = panda_url+"&adp="+d.p+"&adid="+d.id+"&adurl="+encodeURIComponent(d.u);
	switch (d.t) {case "text":html = '<a href="' + href + '" target="_blank" >'+d.c+'</a>';document.write(html);break;case "image":html = '<a href="' + href + '" target="_blank" ><img src="' + d.f + '" width="' + d.w + '" height="' + d.h + '" style="border:0px;" /></a>';document.getElementById(d.p).innerHTML = html;break;case "flash":html = '<div style="width:'+d.w+'px;height:'+d.h+'px;display:block;position:relative;">'+flashObject(d.f, d.w, d.h)+'<a href="' + href + '" target="_blank" style=\'display:block;position:absolute; width:'+d.w+'px;height:'+d.h+'px;left:0px;top: 0px;cursor:pointer;z-index: 10;background-color:rgb(255,255,255);opacity:0;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";filter: alpha(opacity=0);\'></a></div>';document.getElementById(d.p).innerHTML = html;break;case "js":var js = document.createElement('script');js.setAttribute("type","text/javascript");js.setAttribute("src", d.f);document.getElementById(d.p).appendChild(js);break;}
}


var panda_out = '';
var panda_url = "http://panda.kdnet.net/stat/pandastat.php";

var userId = 0;var userCookie = getCookie("kdnet%5Fuser");if (userCookie == "") userCookie = getCookie("kdnet_user");if (userCookie != "") userId = userCookie.split(",")[0];
panda_url = panda_url+"?userid="+userId;


/**************************/

var http=createRequestObject();
function createRequestObject() {
    var obj;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
    	return new ActiveXObject("Microsoft.XMLHTTP");
    }
    else{
    	return new XMLHttpRequest();
    }   
}


function kdclick(adId,pid,tourl) {
	//alert(adId);
   http.open("GET", 'http://super.kdnet.net/track/click.php?do=ck&adid='+adId+'&adp='+pid+'&adurl='+tourl,true);
   http.send();
}

//function kdshow(adId,pid){
//		http.open("get", 'http://super.kdnet.net/track/click.php?do=count&adid='+adId+'&adp='+pid,true);
//	    http.send();
//}

function kdshow(adId,pid){
		//alert("dd");
	  var kd_out="<scr"+"ipt src=\"http://super.kdnet.net/track/click.php?do=count&adid="+adId+"&adp="+pid+"\"></scr"+"ipt>";
	  document.write (kd_out);
}

function showfmedia(){
	eval(_kdata[s]);	
	time(_starttime,_endtime)?job():'';
}


function time(s,e){
	var date1=Date.parse(s.replace(/-/g,"/"));
	var date2=Date.parse(e.replace(/-/g,"/"));
	var now=new Date();
	if(date1 <= now && date2 >= now){
			return true;
		}else{
			return false;
		}
	}



// 弹窗广告
var ua = navigator.userAgent;
var $IE = (navigator.appName == "Microsoft Internet Explorer");
var $IE5 = $IE && (ua.indexOf('MSIE 5') != -1);
var $IE5_0 = $IE && (ua.indexOf('MSIE 5.0') != -1);
var $Gecko = ua.indexOf('Gecko') != -1;
var $Safari = ua.indexOf('Safari') != -1;
var $Opera = ua.indexOf('Opera') != -1;
var $Mac = ua.indexOf('Mac') != -1;
var $NS7 = ua.indexOf('Netscape/7') != -1;
var $NS71 = ua.indexOf('Netscape/7.1') != -1;
var kdPopWinHoldTime = 25;
//document.domain = 'kdnet.net';
if ($Opera) {
	$IE = true;
	$Gecko = false;
	$Safari =  false;
}
if ($IE5) {
		$IE = true;
		$Gecko = false;
		$Safari =  false;
}

function $_t(root,tag,id){
	var ar=root.getElementsByTagName(tag);
	for (var i=0;i<ar.length;i++){
		if (ar[i].id==id) return ar[i];
	}
	return null;
}
function _(root){
	
	var ids=arguments;
	var i0=0;
	
	if (typeof(root) == 'string') root = document;
	else i0=1;
	
	for (var i=i0;i<ids.length;i++){
		var s=root.getElementsByTagName("*");
	
		var has=false;
		for (var j=0;j<s.length;j++){
			if (s[j].id==ids[i]){
				root=s[j];
				has=true;
				break;
			}
		}
		if (!has) return null;
	}
	return root;
}

function $dele(o,fn,rv){
	
	var r = function (){
		
		var s=arguments.callee;
		
		var args = [];
		for (var i=0;i<s.length;i++) args[i]=s[i];
		var argStr = args.join(",");
		if (argStr.length > 0) argStr=","+argStr;
		
		var callStr="s.thiz[s.fn]("+argStr+")";
		var v=eval(callStr);
		
		
		if (s.rv!=null) {
			return s.rv;
		}	else {
			return v;
		}
	}
	
	r.thiz=o;
	r.fn=fn;
	r.rv=rv;
	
	return r;
}

function $ge(e){
	if (e!=null) return e;
	if ($IE) {
		return window.event;
	}	else return e;
}

function $gte(e,ev){
	if (!e.getElementById) e=e.ownerDocument;
	if ($IE) {
		return ev!=null ? ev : e.parentWindow.event;
	} else {
		return ev;
		throw new Error("this method can only execute in IE");
	}
}
function $addEL(n,e,l,b){
	
	if ($IE){
		if (n["$__listener_"+e]==null){
			var lst=function (e){
				
				var f=arguments.callee;
				var ar=f.fList;
				
				e=$ge(e);
				for (var i=0;i<ar.length;i++){					
					ar[i](e);
				}
			}
			lst.fList=[];			
			n["$__listener_"+e]=lst;
			n["on"+e]=n["$__listener_"+e];
			
		}
		var fList=n["$__listener_"+e].fList;
		fList[fList.length]=l;
		
	} else {
		n.addEventListener(e,l,b);
	}
}
function $cancelEvent (e) {
	if ($IE) {
		e.returnValue = false;
		e.cancelBubble = true;

	} else
		e.preventDefault();
};

function $cancelEventtan (e) {
};

function $cpAttr(o,p){
	for (var i in p){
		var s=p[i];
		o[i]=s;
	}
	return o;
}
function $getValue(v,d){
	return v==null ? d : v;
}
var $gv=$getValue;

var $dom={
	parseInt : function(s) {
		if (s == null || s == '' || typeof(s)=='undefined')
			return 0;

		return parseInt(s);
	},
	getClientSize : function(n){
		if ($IE){
			var s= {x:n.clientLeft,y:n.clientTop};
			s.l=s.x;
			s.t=s.y;
			s.r=n.clientRight;
			s.b=n.clientBottom;
			
			s.w=n.clientWidth;
			s.h=n.clientHeight;
			
			return s;
		} else {
			var t=n.style;
			if (t.borderLeftWidth.length==0 || t.borderTopWidth.length==0 || t.borderRightWidth.length==0 || t.borderBottomWidth.length==0){
				
				var l=n.offsetWidth;
				t.borderLeftWidth="0px";
				l-=n.offsetWidth;
				
				var r=n.offsetWidth;
				t.borderRightWidth="0px";
				r-=n.offsetWidth;
				
				var o=n.offsetHeight;
				t.borderTopWidth="0px";
				o-=n.offsetHeight;
				
				var b=n.offsetHeight;
				t.borderBottomWidth="0px";
				b-=n.offsetHeight;
				
				t.borderLeftWidth=l+"px";
				t.borderTopWidth=o+"px";
				t.borderRightWidth=r+"px";
				t.borderBottomWidth=b+"px";
				
				var s={l:l,r:r,t:o,b:b,x:l,y:o};
				
				
				return s;
			} else {
				var s= {
						x: this.parseInt(n.style.borderLeftWidth),
						y: this.parseInt(n.style.borderTopWidth),
						r: this.parseInt(n.style.borderRightWidth),
						b: this.parseInt(n.style.borderBottomWidth)
					};
				s.l=s.x;
				s.t=s.y;
				return s;
			}
		}
	},
	
	
	
	getSize : function (n,withMargin){
		var c={
			x : n.offsetWidth != null ? n.offsetWidth : 0,
			y : n.offsetHeight != null ? n.offsetHeight : 0
		};
		
		if (withMargin) {
			var m=this.getMargin(n);
			c.x+=m.l+m.r;
			c.y+=m.t+m.b;
		}
		return c; 
	},
	
	setSize : function(elmt,x,y,withMargin){
		if ($IE){
			if (withMargin){				
				var m=this.getMargin(elmt);
				x-=m.l+m.r;
				y-=m.t+m.b;				
			}			
			elmt.style.width=x;			
			elmt.style.height=y;			
		} else {
			var clientSize=this.getClientSize(elmt);
			var dx=clientSize.l+clientSize.r;
			
			var dy=clientSize.t+clientSize.b;
			
			elmt.style.width=x-dx+"px";
			elmt.style.height=y-dy+"px";
		}
	},
	
	getPosition : function (elmt,withMargin){
		var c;
		
		c={
			x:elmt.offsetLeft,
			y:elmt.offsetTop
		};
		if (withMargin){
			var m=this.getMargin(elmt);
			c.x-=m.l;
			c.y-=m.t;
		}
		
		return c;
	},
	setPosition : function (elmt,x,y,withMargin){
		if (withMargin){
		}	
		elmt.style.left=x+"px";
		elmt.style.top=y+"px";
	},
		
	
	setAlpha : function (n,a){
		return;
		n.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity="+a*100+");";
		n.style.opacity = a;
		n.style.MozOpacity = a;
	}
	
}
var $motion={
	smooth : function (s, e, t){
		if (t>1) t=1;
		return (e - s) * t + s;
	}
}

function PopUp(id, config){
	this.id=id;
	
	var c = this.config = config;
	c.width 	= $gv(c.width,300);
	c.height 	= $gv(c.height,320);
	c.bottom 	= $gv(c.bottom,0);
	c.right 	= $gv(c.right,20);
	c.display 	= $gv(c.display,true);
	c.contentUrl= $gv(c.contentUrl,"");
	c.motionFunc= $gv(c.motionFunc,$motion.smooth);
	c.position	= {x:0,y:0};
	
	var t=c.time;
	t.slideIn	= $gv(t.slideIn,10);
	t.hold		= $gv(t.hold,10);
	t.slideOut	= $gv(t.slideOut,10);
	
	t.slideIn 	*= 1000;
	t.hold		*= 1000;
	t.slideOut	*= 1000;
	
	this.container = $("body").get(0);//document.body;
	this.popup = null;
	this.content = null;
	this.switchButton = null;
	this.closeButton = null;
	this.popIframe = null;
	
	this.moveTargetPositionX = 0;
	this.startPositionX = null;
	this.moveTargetPosition = 0;
	this.startMoveTime = null;
	this.startPosition = null;
	
	this.minTimeout = null;
	this.status = PopUp.STOP;
	this.intervalHandle = null;
	
	this.mm = "max";
	
	this.imgMin = "images/min.gif";
	this.imgMax = "images/max.gif";
}

//static members
PopUp.STOP = 0;
PopUp.MOVE_DOWN = 1;
PopUp.MOVE_UP = 2;
PopUp.SWITCH_TO_MIN = PopUp.MOVE_DOWN | 4;
PopUp.SWITCH_TO_MAX = PopUp.MOVE_UP | 8;

var __o={
	create : function (){
		
		var doc=document;
		var c=this.config;	
		
		var p = this.popup = doc.createElement("div");
		this.container.appendChild(p);
		
		p.id=this.id;
		p.style.cssText="position:absolute;\
						z-index:9000;\
						overflow:hidden;\
						border:0px solid #f00;\
						";
		$dom.setSize(p, c.width, c.height);
		
		
		
		var t = this.content = doc.createElement("div");
		p.appendChild(t);
		
		t.id = this.id+"_content";
		t.style.cssText="position:absolute;\
						z-index:1;\
						overflow:hidden;";
		$dom.setSize(t, c.width, c.height);
		$dom.setPosition(t,0,0);//add
		
		c.position.y = c.height;//add
		//---------------vertical popup begin --------------------
		c.position.x = 0;//c.width;//
		//---------------vertical popup end --------------------
		this.onresize();//add
		
		var maxHTML = "";var smallHTML = "";
		
		t.innerHTML = "<a id='closeButton' href='#'></a>"+
									"<a id='switchButton' href='#'></a>"+
					  			"<div id='div_"+this.id+"_content_iframe' style='margin-top:22px;'><div id='"+this.id+"_content_iframe' width='300' height='300'>"+vHTML(max,300,300)+"</div>" +
					  			"<div id='"+this.id+"_content_iframe_min'  style='display:none;' width='100' height='100'>"+vHTML(small,100,100)+"</div></div>";


		//this.popIframe = $_t(t,'iframe',this.id+"_content_iframe");
		var sBtn = this.closeButton = $_t(t,'a',"closeButton");
		sBtn.style.cssText='position:absolute;\
							z-index:2;\
							\
							font-size:0px;\
							line-height:0px;\
							\
							left:271px;\
							top:0px;\
							width:29px;\
							height:22px;\
							\
							background-image:url("http://pandacdn.kdnet.net/images/x.gif");';

		//this.popIframe.src = c.contentUrl;
		$addEL(sBtn,"click",$dele(this,"hide2"),true);
		$addEL(sBtn,"click",$cancelEvent,true);
		$addEL(sBtn,"click",$cancelEventtan,true);

		var cBtn = this.switchButton = $_t(t,'a',"switchButton");
		cBtn.style.cssText='position:absolute;\
							z-index:2;\
							\
							font-size:0px;\
							line-height:0px;\
							\
							left:240px;\
							top:0px;\
							width:31px;\
							height:22px;\
							\
							background-image:url(base+"img/_.gif");';

		$addEL(cBtn,"click",$dele(this,"switchMode"),true);
		$addEL(cBtn,"click",$cancelEvent,true);
		$addEL(cBtn,"click",$cancelEventtan,true);


		
		var container=$IE ? document.body : document.documentElement;
		
		$addEL(document.body,"resize",$dele(this,"onresize"),true);
		
			this.__hackTimer=window.setInterval("__popup.onresize()",50);
		
		
		$addEL(container,"scroll",$dele(this,"onresize"),true);
		
		//initialize position at once.
		this.onresize();
		
	},
	
	show : function (){
		
		if (!this.config.display) return;
		
		this.moveTargetPosition = 0;
		this.status = PopUp.MOVE_UP;
		this.startMove();
	},
	
	hide : function (){
		window.clearTimeout(this.minTimeout);
		this.moveTargetPosition = this.config.height;
		this.moveTargetPositionX = this.config.width;
		this.status = PopUp.MOVE_DOWN;
		this.startMove();
	},

	hide2 : function (){
		window.clearTimeout(this.minTimeout);
		this.minTimeout = window.setTimeout("__popup.minimize()",15000);
		this.moveTargetPosition = this.config.height;
		this.moveTargetPositionX = this.config.width;
		this.status = PopUp.MOVE_DOWN;
		this.startMove();
	},
	
	minimize : function (){
		//alert("minimize");
		
		this.mm = "min";

		this.moveTargetPosition = 200;//this.config.height - 180;
		this.moveTargetPositionX = 200;
		this.status = PopUp.SWITCH_TO_MIN;
		this.startMove();
		
	},
	
	maximize : function (){
		//alert("maximize");
		if (!this.config.display) return;
		
		this.mm = "max";

		//document.getElementById("div_xp_content_iframe").innerHTML = "<iframe  id='xp_content_iframe' src="+max +"?random="+Math.random()+" frameborder=0 scrolling=no width='300' height='300'></iframe>";
		document.getElementById("xp_content_iframe").style.display="block";
		document.getElementById("xp_content_iframe_min").style.display="none";
		
		//this.config.time.hold = 3000;
		this.moveTargetPosition = 0;
		this.moveTargetPositionX = 0;
		this.status = PopUp.SWITCH_TO_MAX;//PopUp.MOVE_UP;//

		var s = this.switchButton.style;
		s.display="none";

		this.startMove();
		
		
		var s = this.switchButton.style;
		var bg = s.backgroundImage;
		
		if (bg.indexOf(this.imgMax) > -1) {
			bg = bg.replace(this.imgMax,this.imgMin);
			s.backgroundImage = bg;			
		}
	},
	
	delayHide : function (){		
		this.config.time.hold = 3000000;
		window.setTimeout("__popup.hide()",this.config.time.hold);
	},
	
	delayMin : function (){
		this.config.time.hold = kdPopWinHoldTime * 1000;
		this.minTimeout = window.setTimeout("__popup.minimize()",this.config.time.hold);
	},
	
	switchMode : function (){
		//alert("switch");
		if (this.mm == "min"){
			//this.maximize();
			//alert('x');
			this.mm = "hide";
			this.hide();
		} else {
			this.minimize();
		}
	},
	
	startMove : function (){
		this.stopMove();		
		this.intervalHandle = window.setInterval("__popup.move()",100);
		
		this.startMoveTime = new Date().getTime();
		//this.startPosition = $dom.getPosition(this.content).y;//parseInt(this.content.style.top);
		this.startPosition = this.config.position.y;
		this.startPositionX = this.config.position.x;
		//alert(this.config.position.x +":"+this.config.position.y);
	},
	
	stopMove : function (){
		if (this.intervalHandle != null) window.clearInterval(this.intervalHandle);
		this.intervalHandle = null;
	},
	
	
	move : function (){
		
		
		var t = new Date().getTime();
		t = t - this.startMoveTime;
		
		var total = this.status & PopUp.MOVE_UP ? 
					this.config.time.slideIn : 
					this.config.time.slideOut;
		
		var y = this.config.motionFunc(this.startPosition, this.moveTargetPosition, t/total);
		var x = this.config.motionFunc(this.startPositionX,this.moveTargetPositionX,t/total);
		//this.content.style.top = y + "px";
		this.config.position.y = y;
		this.config.position.x = x;
		this.onresize();
				
		if (t >= total){
			this.onFinishMove();
			//alert(this.mm +":"+this.popIframe.src);
			if(this.mm == "min"){
				//$_t(t,'iframe',this.id+'_content_iframe');
				//alert(this.mm);
				//this.popIframe.src = small;
				//.src="http://localhost/kdnet/static/fd/pop-min.htm";
				//document.getElementById("div_xp_content_iframe").innerHTML = "<iframe id='xp_content_iframe' src="+small +"?random="+Math.random()+" frameborder=0 scrolling=no width='100' height='100'></iframe>";
				document.getElementById("xp_content_iframe_min").style.display="block";
				document.getElementById("xp_content_iframe").style.display="none";

				var s = this.switchButton.style;
				s.display="block";
				s.left = "71px";
				s.backgroundImage = "url('http://pandacdn.kdnet.net/images/x_1.gif')";
				//alert(this.config.position.x +":"+this.config.position.y);
			}
			else if(this.mm == "max"){
				var s = this.switchButton.style;
				s.display="block";
				s.left = "240px";
				s.backgroundImage = "url('"+base+"img/_.gif')";
			}

		}
	},
	
	onFinishMove : function (){
		this.stopMove();
		//this.content.style.top = this.moveTargetPosition + "px";
		//alert(this.status +":" + PopUp.MOVE_UP +":"+PopUp.SWITCH_TO_MAX);
		if ((this.status == PopUp.MOVE_UP || this.status == PopUp.SWITCH_TO_MAX) && this.config.time.hold > 0 ){
			this.delayMin();
		} 
		else if (this.status == PopUp.SWITCH_TO_MIN && this.config.time.hold > 0 ){
			this.delayHide();
		}
		else {
			if (this.__hackTimer!=null) window.clearInterval(this.__hackTimer);
		}
		this.status = PopUp.STOP;
	},
	
	onresize : function (){
		var c=this.config;
		//var t=document.documentElement;
		var t= document.body;
		
		var dx= t.clientWidth + t.scrollLeft;
		var dy= $(window).height()+$(window).scrollTop();
		
		var x = dx - c.right - c.width + c.position.x;
		var y = dy - c.bottom - c.height + c.position.y;
		
		
		$dom.setPosition(this.popup, x, y);	
		$dom.setSize(this.popup, c.width-c.position.x, c.height-c.position.y);
	}

}



$cpAttr(PopUp.prototype,__o);


function readCookie(name)
{

}

function writeCookie(name, value, hours)
{
  var expire = "";
  if(hours != null)
  {
    expire = new Date((new Date()).getTime() + hours * 3600000);
    expire = "; expires=" + expire.toGMTString();
  }
  document.cookie = name + "=" + escape(value) + expire + ";path=/";
}

function job(){

	/**
	* config object
	*/
	var cfg={
		width 			: 300,
		height 			: 322,		
		bottom			: 0,
		right			: 0,		
		display			: true,			
		contentUrl		: max,		
		time : {
			slideIn			: 1,
			hold				: kdPopWinHoldTime,
			slideOut		: 1
		}					
	}
	
	var displayTimeList = ["7+7"];	
	var displayMode = "once";
	var cookieName="sina_blog_popup_next_display_time";
	
	var hours={};
	var delays=[];
	for (var i=0;i<displayTimeList.length;i++) {
		var o = displayTimeList[i];
		var ar = o.split("+");
		var t = parseInt(ar[0]);
		for (var m=0;m<ar.length-1;m++){
		    ar[m]=ar[m+1];
		}		
		hours[t]=true;
		for (var j=0;j<ar.length;j++){
			hours[t + parseInt(ar[j])]=true;
		}		
	}
	displayTimeList=[];
	for (var i in hours){
		var s = parseInt(i);
		if (isNaN(s)) continue;
		displayTimeList[displayTimeList.length]=s;
	}
	displayTimeList = displayTimeList.sort();
	
	
	var pp = new PopUp("xp", cfg);
	window.__popup=pp;
	pp.create();
	
	var n=readCookie(cookieName);	
	
	if (displayMode=="eachTime") 
		pp.show();
	else {
		var tm=new Date().getTime();
		if (n==null || tm>n) {
			pp.show();

		}
	}
}

function doit(){
	if (document.body == null) {		
		window.setTimeout(doit,500);
		return;
	}
	job();
}

function neoneo() {
window.onload = job;
}
