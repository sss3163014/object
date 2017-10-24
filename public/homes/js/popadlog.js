var kd_l = window.location;
kd_l=escape(kd_l);

kd_s = escape(popArray[s]);
/*
$(function(){
	tracking_log();
});
*/
function tracking_log_popad(){}

function tracking_log_popad2()
{
	var strBody = $("body").html();
	//alert(strBody);
	var re=/\<([^>]*)=([^>]*)\.swf/gi;
	var arr=strBody.match(re);
	for(var i=0;i<arr.length;i++)
	{
		//alert(arr[i]);
		if(arr[i].indexOf("kdnet.net")<0){
			var kd_out="<scr"+"ipt src=\"http://tracking.cat898.com/about/popadlog.php?l=" + kd_l  ;
			kd_out=kd_out + "&i="+kd_s;
			kd_out=kd_out +"\">";
			kd_out=kd_out + "</scr"+"ipt>";
			//alert(kd_out);
			document.write(kd_out);
			break;
		}
	}

	/*
	var strHead = document.getElementsByTagName("body")[0].innerHTML;
	//alert(strHead);
	var startPos = strHead.lastIndexOf('http://static.csbew.com/k.js');
	var lastString = strHead.substring(startPos)
	//alert(document.getElementsByTagName("head")[0].innerHTML);
	alert(lastString);
	if(lastString.indexOf("<embed")>0){
		var kd_out="<scr"+"ipt src=\"http://tracking.cat898.com/about/popadlog.php?l=" + kd_l  ;
		kd_out=kd_out + "&i="+kd_s;
		kd_out=kd_out +"\">";
		kd_out=kd_out + "</scr"+"ipt>";
		alert(kd_out);
		document.write(kd_out);
	}
	*/
}

(function(){
       tracking_log_popad2();
})();
