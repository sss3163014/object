var _KD_JSAPI = "http://jsapi.kdnet.net";

function changelists(_boardid) {
	var url = "list.asp?boardid=" + _boardid + "&selTimeLimit=0&action=&topicmode=0&s=&page=1&t="+document.getElementById("t").value;
	location.href=url;
}

//��ʾ�б�ҳ����ѡ��
function showListTopic(){
	if($('.taxis-ex').hasClass('taxis-current')){
		$('.taxis-ex').removeClass('taxis-current').find('.tax-ex-box').hide();
		iscloseTaxbox = true;
	} else {
		$('.taxis-ex').addClass('taxis-current').find('.tax-ex-box').show();
		iscloseTaxbox = false;
	}
}

//�����Ŀ��ر�
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
			//$(f).after(".reply-cont").html('���ڶ�ȡ���ڱ�����ĸ��������Ժ��');
		},
		error: function(html){
			$(f).next(".reply-cont").html('<tr>��ȡ������ĸ���ʧ�ܣ������ԣ�</tr>');
		},
		success: function(html){
			if (html.search("ul") == -1) {
				if (html == "")
					$(f).next(".reply-cont").html('<tr>��ȡ������ĸ���ʧ�ܣ������ԣ�</tr>');
				else
					$(f).next(".reply-cont").html(html);
			} else {
				$(f).next(".reply-cont").html(html);
			}
		}
	});
}
