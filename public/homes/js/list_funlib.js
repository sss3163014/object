var _KD_JSAPI = "http://jsapi.kdnet.net";

function changelists(_boardid) {
	var url = "list.asp?boardid=" + _boardid + "&selTimeLimit=0&action=&topicmode=0&s=&page=1&t="+document.getElementById("t").value;
	location.href=url;
}

//显示列表页话题选项
function showListTopic(){
	if($('.taxis-ex').hasClass('taxis-current')){
		$('.taxis-ex').removeClass('taxis-current').find('.tax-ex-box').hide();
		iscloseTaxbox = true;
	} else {
		$('.taxis-ex').addClass('taxis-current').find('.tax-ex-box').show();
		iscloseTaxbox = false;
	}
}

//点击后目标关闭
var iscloseTaxbox = false;
function openTaxbox(obj){
	$('body').bind('click', function(){
		if(iscloseTaxbox){
			$(obj).hide();
			$('.taxis-ex').removeClass('taxis-current');
			setTimeout(function(){ iscloseTaxbox = false; }, 100);
		}
	});
	setTimeout(function(){ iscloseTaxbox = true; }, 100);
}

function fetchReply(data){
	data = data.split(',');
	var fetchBtn = $("tr[name='showreply_" + data[1] + "_" + data[0] + "']");
	var f = $(fetchBtn);
	$.ajax({
		url: 'ajax_list.asp?a=fetchreply&boardid=' + data[0] + '&rootid=' + data[1] + '&star=' + data[2] ,
		type: "GET",
		cache: false,
		beforeSend:  function(){
			//$(f).after(".reply-cont").html('正在读取关于本主题的跟贴，请稍侯……');
		},
		error: function(html){
			$(f).next(".reply-cont").html('<tr>读取本主题的跟贴失败，请重试！</tr>');
		},
		success: function(html){
			if (html.search("ul") == -1) {
				if (html == "")
					$(f).next(".reply-cont").html('<tr>读取本主题的跟贴失败，请重试！</tr>');
				else
					$(f).next(".reply-cont").html(html);
			} else {
				$(f).next(".reply-cont").html(html);
			}
		}
	});
}
