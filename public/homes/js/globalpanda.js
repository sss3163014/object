function chkdiv(divid){ 
  var chkid=document.getElementById(divid); 
  if(chkid != null) return true; 
  else return false; 
}

var pandalist=new Array(
"www_index_l_1",
"www_index_l_2",
"www_index_r_1",
"www_index_r_2",
"www_index_r_3",
"www_index_r_4",
"www_index_r_5",
"www_index_s_1",
"www_index_s_2",
"www_index_s_3",
"www_index_s_4",
"www_index_s_5",
"club_index_s_1",
"club_index_r_1",
"club_index_r_2",
"club_index_r_3",
"club_index_r_4",
"club_index_l_1",
"club_index_l_2",
"club_index_l_3",
"club_index_l_4",
"club_index_l_8",
"club_index_l_5",
"club_list_l_1",
"club_list_l_2",
"club_list_r_1",
"club_list_r_2",
"club_list_r_3",
"club_list_r_4",
"club_dispbbs_s_1",
"club_dispbbs_l_1",
"club_dispbbs_l_2",
"club_dispbbs_l_3",
"club_dispbbs_r_1",
"club_dispbbs_r_2",
"club_dispbbs_r_3",
"club_dispbbs_r_4",
"club_dispbbs_r_5",
"t_index_s_1",
"t_index_s_2",
"t_index_r_1",
"t_index_r_2",
"user_index_s_1",
"user_index_r_1",
"user_index_l_1",
"user_register_s_1",
"user_login_s_1",
"user_forget_s_1",
"data_index_s_1",
"data_index_s_2",
"data_index_s_3",
"data_index_l_1",
"data_index_r_1",
"data_hot_l_1",
"data_hot_l_2",
"data_hot_r_1",
"data_hot_r_2",
"data_hot_r_3",
"data_hot_r_4",
"data_rank_l_1",
"data_rank_l_2",
"data_rank_l_3",
"data_rank_r_1",
"data_rank_r_2",
"data_rank_r_3",
"data_rank_r_4",
"data_vote_l_1",
"data_vote_l_2",
"data_vote_l_3",
"data_vote_l_4",
"data_vote_r_1",
"data_vote_r_2",
"data_vote_r_3",
"data_vote_r_4",
"data_list_s_1",
"data_list_l_1",
"data_list_l_2",
"data_list_r_1",
"data_list_r_2",
"data_list_r_3",
"data_list_r_4",
"data_content_l_1",
"data_content_l_2",
"data_content_l_3",
"data_content_r_1",
"data_content_r_2",
"data_content_r_3",
"data_content_r_4",
"data_content_r_5",
"chat_index_s_1",
"chat_index_s_2",
"chat_index_r_1",
"chat_index_r_2",
"chat_index_r_3",
"special_index_s_1",
"special_index_r_1",
"special_index_r_2",
"special_index_r_3",
"research_library_l_1",
"research_user_l_1",
"research_library_cont_l_1",
"research_library_index_s_1",
"research_library_index_l_1",
"research_library_index_r_1",
"research_council_r_1",
"research_council_r_2",
"research_council_s_1",
"3g_intro_s_1",
"weekly_index_s_1",
"school_index_s_1",
"club_dispbbs_s_3",
"club_dispbbs_s_4",
"club_dispbbs_s_5",
"club_dispbbs_s_6",
"club_dispbbs_s_7",
"club_dispbbs_s_8",
"club_dispbbs_l_4",
"club_dispbbs_l_5",
"club_dispbbs_s_59"
);

for(pandakey in pandalist) 
{
    if(chkdiv(pandalist[pandakey])&&chkdiv('panda_'+pandalist[pandakey])) 
	{      
        document.getElementById(pandalist[pandakey]).innerHTML= document.getElementById('panda_'+pandalist[pandakey]).innerHTML;
        document.getElementById('panda_'+pandalist[pandakey]).innerHTML="";
    }
}

//acs86
var ac_as_id = 45195;
var ac_click_track_url = "";
var ac_format = 0;
var ac_mode = 1;
var ac_width = 280;
var ac_height = 210;

//itopnetworks
var itop_client = 924;
var itop_slotid = 1802;
var itop_width = 300;
var itop_height = 250;

 var s = Math.floor(7*Math.random()+1); //产生从1到7的随机数字
// switch(s)  {
// 	case 1: document.writeln("<scr"+"ipt type='text\/javascript' src='http://static.acs86.com/g.js'><\/scr"+"ipt>");break; 
// 	case 2: document.writeln("<scr"+"ipt type='text\/javascript' src='http://s.itopnetworks.com/s.js' id='itop247_1802'><\/scr"+"ipt>");break; 
// 	case 3: document.writeln("<scr"+"ipt type='text\/javascript' src='http://static.acs86.com/g.js'><\/scr"+"ipt>");break; 
// 	case 4: document.writeln("<scr"+"ipt type='text\/javascript' src='http://s.itopnetworks.com/s.js' id='itop247_1802'><\/scr"+"ipt>");break; 
// 	case 5: document.writeln("<scr"+"ipt type='text\/javascript' src='http://static.acs86.com/g.js'><\/scr"+"ipt>");break; 
// 	case 6: document.writeln("<scr"+"ipt type='text\/javascript' src='http://s.itopnetworks.com/s.js' id='itop247_1802'><\/scr"+"ipt>");break; 
// 	case 7: document.writeln("<scr"+"ipt type='text\/javascript' src='http://static.acs86.com/g.js'><\/scr"+"ipt>");break;
// }
// document.writeln("<scr"+"ipt type='text\/javascript' src='http://s.itopnetworks.com/s.js' id='itop247_1802'><\/scr"+"ipt>");
// document.writeln("<scr"+"ipt type='text\/javascript' src='http://static.acs86.com/g.js'><\/scr"+"ipt>");