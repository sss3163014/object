var _KD_JSAPI = "http://jsapi.kdnet.net";
var _KD_USERDOMAIN="http://user.kdnet.net";
var _KD_DOMAIN = "http://www.kdnet.net";

function SetWinHeight() { 
	var club_kcis=document.getElementById("club_kcis");
	if (document.getElementById) { 
		if (club_kcis && !window.opera) { 
			if (club_kcis.contentDocument && club_kcis.contentDocument.body.offsetHeight) {
				club_kcis.height = club_kcis.contentDocument.body.offsetHeight;
			}
			else if(club_kcis.Document && club_kcis.Document.body.scrollHeight) {
				club_kcis.height = club_kcis.Document.body.scrollHeight; 
			}
		} 
	} 
} 

//改变尺寸时进行相关操作
function reTopNav(){
	var sWidth = document.body.scrollWidth, oWidth = document.body.offsetWidth;
	if($.browser.mozilla){ sWidth=$(document).width(); oWidth=$(window).width(); }
	if(document.body.style.overflow != "hidden" && document.body.scroll!="no" && sWidth > oWidth){
		$('.top-fixed-nav').addClass('top-fixed-nav-s2');
		var allHeight = $('.top-fixed-nav').height();
		$('.nav-opacity').css({'height':allHeight+'px'});
		$('.nav-line-b').css({'top':allHeight+'px'});
		$('.nav-space-t').css({'padding-top':(allHeight+2)+'px'});
		$('.msg-box').css({'margin-top':(allHeight+2)+'px'});
	} else {
		$('.top-fixed-nav').removeClass('top-fixed-nav-s2');
		var allHeight = $('.top-fixed-nav').height();
		$('.nav-opacity').css({'height':allHeight+'px'});
		$('.nav-line-b').css({'top':allHeight+'px'});
		$('.nav-space-t').css({'padding-top':(allHeight+2)+'px'});
		$('.msg-box').css({'margin-top':(allHeight+2)+'px'});
	}
}

function upheader() {
	$("#ajax_header").html('');
	var data = {};
	$.getJSON("http://jsapi.kdnet.net/ajax_update_header.asp?jsoncallback=?",
	data,
	function(obj){
	}); 
}

function upheader_total(flag) {
	if (document.getElementById('update_flag').innerHTML == "1" || flag == 0) {
		$("#ajax_header_total").html('');
		var data = {};
		//$.getJSON("<%=KD_JSAPI%>/ajax_header_total.asp?jsoncallback=?",
		$.getJSON(_KD_JSAPI+ "/ajax_header_total.asp?jsoncallback=?",
		data,
		function(obj){
			//alert(obj.Ajax_Header);<b class="msg-arrow">9</b>
			$("#ajax_header_total").html(obj.Ajax_Header);
			$("#ajax_header").html(obj.Ajax_Header_old);
	
			if (obj.Ajax_Header_old != "") $("#ajax_header").css('display','block'); 
			else $("#ajax_header").css('display','none'); 
			
			if (obj.Ajax_Header_atme > 0) {
				if (obj.Ajax_Header_atme > 99) {
					$("#Ajax_Header_atme").html('<b class="msg-arrow"><span class="msg-al">N</span><i class="msg-ar"></i></b>');
				}
				else {
					$("#Ajax_Header_atme").html('<b class="msg-arrow"><span class="msg-al">'+obj.Ajax_Header_atme+'</span><i class="msg-ar"></i></b>');
				}
			}

			if (obj.Ajax_Header_reme > 0) {
				if (obj.Ajax_Header_reme > 99) {
					$("#Ajax_Header_reme").html('<b class="msg-arrow"><span class="msg-al">N</span><i class="msg-ar"></i></b>');
				}
				else {
					$("#Ajax_Header_reme").html('<b class="msg-arrow"><span class="msg-al">'+obj.Ajax_Header_reme+'</span><i class="msg-ar"></i></b>');
				}
			}

			if (obj.Ajax_Header_sms > 0) {
				if (obj.Ajax_Header_sms > 99) {
					$("#Ajax_Header_sms").html('<b class="msg-arrow"><span class="msg-al">N</span><i class="msg-ar"></i></b>');
				}
				else {
					$("#Ajax_Header_sms").html('<b class="msg-arrow"><span class="msg-al">'+obj.Ajax_Header_sms+'</span><i class="msg-ar"></i></b>');
				}
			}
	
			if (obj.Ajax_Header_fans > 0) {
				if (obj.Ajax_Header_fans > 99) {
					$("#Ajax_Header_fans").html('<b class="msg-arrow"><span class="msg-al">N</span><i class="msg-ar"></i></b>');
				}
				else {
					$("#Ajax_Header_fans").html('<b class="msg-arrow"><span class="msg-al">'+obj.Ajax_Header_fans+'</span><i class="msg-ar"></i></b>');
				}
			}

			if (obj.Ajax_Header_notice > 0) {
				if (obj.Ajax_Header_notice > 99) {
					$("#Ajax_Header_notice").html('<b class="msg-arrow"><span class="msg-al">N</span><i class="msg-ar"></i></b>');
				}
				else {
					$("#Ajax_Header_notice").html('<b class="msg-arrow"><span class="msg-al">'+obj.Ajax_Header_notice+'</span><i class="msg-ar"></i></b>');
				}
			}
		}); 
		document.getElementById('update_flag').innerHTML = "0";
	}
}

//固定位置消息控制
function tools(){
	var top=$(document).scrollTop();
	if(($.browser.msie==true)&&($.browser.version==6.0)){
		if(top>195)$("#ajax_header").css({position:"absolute",top:top-195});
	}else{
		if(top>195)$("#ajax_header").css({position:"fixed",top:0});
	}
	if(top<=195)$("#ajax_header").css({position:"static",top:0});
}

function $Cookie(){
	this.set=function(name,value){
		document.cookie=name+"="+value+";"+"max-age="+ (60*60*24*maxDay); 
	};
	this.get=function(name){
		var cookies=document.cookie.split("; ");
		for(var i=0;i<cookies.length;i++){
			var s=cookies[i].split("=");
			if(s[0]==name)return s[1];
		}
	}
}

//隐藏提示--另外用cookice控制只显示一次	
function hideTooltip(){
	$(".hide-tooltip").click(function(){
		$(this).parent("div").fadeOut("fast")	
	})		
}

function AddFavorite(sURL, sTitle) {   
    try {   
        window.external.addFavorite(sURL, sTitle);   
    } catch (e) {   
        try {   
            window.sidebar.addPanel(sTitle, sURL, "");   
        } catch (e) {   
            alert("加入收藏失败，请使用Ctrl+D进行添加");   
        }   
    }   
}   

var maxDay=365;
function GetHelp(){
	var cookie = new $Cookie();
	var help = cookie.get('help');
	if((help==null)||isNaN(help)) help=0;
	Help(help);
}

function Help(help){
	var cookie= new $Cookie();
	cookie.set('help',parseInt(help)+1,maxDay);
}

function GetSize(){
	var cookie= new $Cookie();
	var oldIndex= cookie.get('fontsize');
	if((oldIndex==null)||isNaN(oldIndex)) oldIndex=0;
	 doZoom(oldIndex);
}

function GetColor(){
	 loadcolor();
}

function  heightSet(frameId, frameName){
    // FF和IE必须要通过iframe的名字去得到内部页面高度,而其他浏览器则可以用this或ID
    if($.browser.mozilla || $.browser.msie) {
        bodyHeight =window.frames[frameName].document.body.scrollHeight + 20;
    }else{
    }
    
    //alert(bodyHeight);
    document.getElementById(frameId).height = bodyHeight;  
}

function openurl(url,div,count) {
	window.open(url);
	$("#"+div).hide();
	if (count == 1)  $("#ajax_header").html('');
}

// 设置首页
function setHomepage() {　 
	if (document.all) {
		document.body.style.behavior = 'url(#default#homepage)';
		//document.body.setHomePage('<%=KD_DOMAIN%>');
		document.body.setHomePage(_KD_DOMAIN);
	}
	else if (window.sidebar) {
		if (window.netscape) {
			try {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}catch (e) {
				alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");
			}
		}
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
		//prefs.setCharPref('browser.startup.homepage', '<%=KD_DOMAIN%>');
		prefs.setCharPref('browser.startup.homepage', _KD_DOMAIN);
	}
}

//添加浏览器滚动判断
var scrollY = 0;
function showHideTopNav(){
	if(typeof(document.body.style.minWidth) != 'undefined') {
		var topFixedNavHeight = $('.top-fixed-nav').height();
		$(window).scroll(function(){
			if($(window).scrollTop()==0 || $(window).scrollTop()<(topFixedNavHeight+2)){
				$('.top-fixed-nav').stop().css({'position':'absolute','top':'0px'});
				$('.top-fixed-nav .nav-opacity').stop().css({'position':'absolute','top':'0px'});
				$('.top-fixed-nav .tooltip').stop().show().css({'opacity':'1'});
				$('#ajax_header').stop().show().css({'opacity':'1'});
				if(bwidth){
					$('.proving-n-msg').css({'position':'relative','top':(topFixedNavHeight+2)+'px'});
				} else {
					$('.proving-n-msg').css({'position':'relative','top':'0px'});
				}
			} else {
				if(scrollY > $(window).scrollTop()){
					if(bwidth){
						$('.proving-n-msg').css({'position':'relative','top':(topFixedNavHeight+2)+'px'});
					} else {
						$('.proving-n-msg').css({'position':'relative','top':'0px'});
					}
					$('.top-fixed-nav').css({'position':'fixed'});
					if(!$('.top-fixed-nav').is(":animated")){
						$('.top-fixed-nav, .nav-opacity').animate({top:'0px'});
						$('.top-fixed-nav .tooltip').fadeIn(500);
						$('#ajax_header').fadeIn(500);
						$('.top-fixed-nav .nav-opacity').css({'position':'fixed'});
					}
				} else {
					if($(window).scrollTop() < (topFixedNavHeight+65)){
						if(bwidth){
							$('.proving-n-msg').css({'position':'fixed','top':(topFixedNavHeight+2)+'px'});
						} else {
							$('.proving-n-msg').css({'position':'fixed','top':'0px'});
						}
					}
					if(!$('.top-fixed-nav').is(":animated")){
						$('.top-fixed-nav .tooltip').fadeOut(500);
						$('#ajax_header').fadeOut(500);
						$('.top-fixed-nav, .nav-opacity').animate({top:'-'+(topFixedNavHeight+2)+'px'});
						$('.proving-n-msg').css({'position':'fixed','top':'0px'});
						scrollY = $(window).scrollTop();
					}
				}
			}
			scrollY = $(window).scrollTop();
		});
	}
}

//改变尺寸时进行相关操作
var bwidth = false;
function reTopNav(){
	var sWidth = document.body.scrollWidth, oWidth = document.body.offsetWidth;
	if($.browser.mozilla){ sWidth=$(document).width(); oWidth=$(window).width(); }
	if(document.body.style.overflow != "hidden" && document.body.scroll!="no" && sWidth > oWidth){
		$('.top-fixed-nav').addClass('top-fixed-nav-s2');
		var allHeight = $('.top-fixed-nav').height();
		$('.nav-opacity').css({'height':allHeight+'px'});
		$('.nav-line-b').css({'top':allHeight+'px'});
		if($('.proving-n-msg').length && !$('.proving-n-msg').is(':hidden')){
			$('.nav-space-t').css({'padding-top':(allHeight+2+$('.proving-n-msg').height()+12)+'px'});
		}else{
			$('.nav-space-t').css({'padding-top':(allHeight+2)+'px'});
		}
		$('.msg-box').css({'margin-top':(allHeight+2)+'px'});
		$('.proving-n-msg').css({'position':'relative','top':(allHeight+2)+'px'});
		bwidth = true;
	} else {
		$('.top-fixed-nav').removeClass('top-fixed-nav-s2');
		var allHeight = $('.top-fixed-nav').height();
		$('.nav-opacity').css({'height':allHeight+'px'});
		$('.nav-line-b').css({'top':allHeight+'px'});
		if($('.proving-n-msg').length && !$('.proving-n-msg').is(':hidden')){
			$('.nav-space-t').css({'padding-top':(allHeight+2+$('.proving-n-msg').height()+12)+'px'});
		}else{
			$('.nav-space-t').css({'padding-top':(allHeight+2)+'px'});
		}
		$('.msg-box').css({'margin-top':(allHeight+2)+'px'});
		$('.proving-n-msg').css({'position':'relative','top':'0px'});
		bwidth = false;
	}
}

function doZoom(size){
	var el = $('.posts-cont');
	var el2 = $('.replycont-text')
	var el3 = $('.quote-cont')
	var num = parseInt(el.css('font-size'));
	if (isNaN(num)) { num = parseInt(el2.css('font-size')); }
	if (isNaN(num)) { num = parseInt(el3.css('font-size')); }
	num = num + parseInt(size);
	el.css('font-size',num+'px');
	el2.css('font-size',num+'px');
	el3.css('font-size',num+'px');
	var cookie= new $Cookie();
	cookie.set('fontsize',num-14,maxDay);
}

function hide() {
	//设置cookies
	var exp = new Date();
	exp.setTime (exp.getTime()+3600000000);
	document.cookie = 'show_div=1' + '; expires=' + exp.toGMTString()+'; path=/;domain=kdnet.net';
}

function openScript(url,width,height) {
	window.open (url, "newwindow", "height="+height+", width="+width+", toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no") //写成一行
} 

function gom() {
	//设置cookies
	//var exp = new Date();
	//exp.setTime (exp.getTime()+3600000000);
	//document.cookie = 'kdphone=m' + '; expires=' + exp.toGMTString()+'; path=/;domain=kdnet.net';
	//document.location.reload();
	window.location.href='http://3g.kdnet.net/app.php';
}

function reinitIframe(){
	var ifmJf = document.getElementById("ifmJfhp");
	try {
		var bHeight = ifmJf.contentWindow.document.body.scrollHeight;
		var dHeight = ifmJf.contentWindow.document.documentElement.scrollHeight;
		var height = Math.max(bHeight, dHeight);
		ifmJf.height =  height;
	}catch (ex){}
}

// 点击ip显示地区
function fetchIP(el,ip){
    if ($(el).html()!=ip) {
	    $(el).attr('title',$(el).html());
		$(el).html(ip);
	} else {
		if ($(el).attr('title')!='') {
			$(el).html($(el).attr('title'));
			return;
		} 
		$.ajax({
		  url: 'ajax.asp?a=fetchip&ip=' +ip,
		  type: "GET",
		  cache: false,
		  success: function(html){
			if (html.search("false") == -1) {
				$(el).attr('title',$(el).html());
				$(el).html(html);
			}
		  }
		});
	}
}

function update_intellect_board() {
	var data = {};
	//$.getJSON("<%=KD_JSAPI%>/ajax_intellect_board.asp?jsoncallback=?",
	$.getJSON(_KD_JSAPI + "/ajax_intellect_board.asp?jsoncallback=?",
		data,
		function(obj){
		 if (obj.Ajax_Header != "") {
			$("#intellect_board").html(obj.Ajax_Header);
		 }
	}); 
}

function keydown(e){
　 var e=e||event;
　 var currKey=e.keyCode||e.which||e.charCode;
　 if((currKey>7&&currKey<14)||(currKey>31&&currKey<47))
　 {
　 　   switch(currKey)
   　 　 { 
	         case 37:document.location.href="go.asp?boardid=88&sid=9361475"; break;
    　 　 　 case 39:document.location.href="go.asp?boardid=88&sid=9361475&action=next"; break;
    　 　 　 default:keyName = "";    break;
　 　   }
　 }
}

function goPage(el,link){
	document.location = link.replace('{pagenum}',$(el).prev().val());
}

function checkurl(tha) {
	url=tha.href;

	if(url.indexOf("kdnet")>=0)
		return true;
	else {
		return true;
		//return confirm(" 您即将访问的链接并非本站内容，\n\n 我们不能保证它是否会危害您的计算机安全，\n\n 请慎重选择。");
	}
}

function mOut() {
	if ($('#description').size() > 0) closeDiv("description");
	tips_status = false;
}


//弹出层控制--登录
function openLoginPopup() {
	$.openPopupLayer({
		name: "LoginPopup",
		width: 950,
		target: "hidden_frame",
		//success: function() {$('#popupLayer_LoginPopup').children('#_frame').attr('src', _KD_USERDOMAIN + '/login.asp?sid='+_sid);}
		success: function() {$('#popupLayer_LoginPopup').children('#_frame').attr('src', _KD_USERDOMAIN + '/login_new2.asp');}
	});
}

//弹出层控制--注册
function openRegisterPopup() {
	$.openPopupLayer({
		name: "RegisterPopup",
		width: 628,
		target: "hidden_frame",
		//success: function() {$('#popupLayer_RegisterPopup').children('#_frame').attr('src','<%=KD_USERDOMAIN%>/register.asp?sid=<%=sid%>');}
		success: function() {$('#popupLayer_RegisterPopup').children('#_frame').attr('src',_KD_USERDOMAIN + '/register_new2.asp');}
	});
}

//弹出层控制--短信
function openSMSPopup(data) {
	$.openPopupLayer({
		name: "SMSPopup",
		width: 450,
		url: "SMSPopup.asp?username="+escape(data)
	});
}

//弹出层控制--关注
function openAddFollowPopup_new(data,div) {
	$.openPopupLayer({
		name: "AddFollowPopups",
		width: 310,
		url: "checkcode.asp?Uid="+data+'&div='+div
	});
}

//弹出层控制--取消关注
function opencancelFollowPopup_new(data,div) {
	$.openPopupLayer({
		name: "cancelFollowPopups",
		width: 310,
		url: "cancelcheckcode.asp?Uid="+data+'&div='+div
	});
}

//弹出层控制--服务条款
function openItemPopup() {
	$.openPopupLayer({
		name: "ItemPopup",
		width: 700,
		target: "hidden_frame",
		success: function() {$('#popupLayer_ItemPopup').children('#_frame').attr('src','http://user.kdnet.net/item.asp');}
	});
}