<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
//引入redis
use Illuminate\Support\Facades\Redis;
//引入阿里大鱼
use iscms\Alisms\SendsmsPusher as Sms;
//引入数据库类
use App\Model\index_users_login;
use App\Model\data_users_info;
use App\Model\data_users_register;

class LandController extends Controller
{
   protected $indexUserLogin;

   protected $register;

   protected $userInfo;

   public $sms;

   public function __construct(Sms $sms)
   {
      $this->indexUserLogin = new index_users_login;

      $this->register = new data_users_register;

      $this->userInfo = new data_users_info;

      $this->sms = $sms;
   }
   
   public function index()
   {
      return view('home.user.land');
   }


   public function doText(Request $request)
   {
         //去用户登陆表里查询
         $result = $this->indexUserLogin->where('login_name', $request['tel'])->first();

         if($result) {
            //返回错误信息
          return json_encode(['msg' => '手机号已经注册', 'code' => 1]);
         }
         //从缓存中的注册表中查询
         $exists = Redis::exists("STRING_USER_VERIFY_CODE_ ". $request['tel']);

         if(!empty($exists)) {

            return '重复发送';
         }
         //阿里大鱼发送流程
         $number = rand(100000,999999);
   
         $phone = $request['tel'];


         $jj = [
            'number' => "$number",
            'name' => "$phone"
         ];

         $name = '兄弟连';

         
         $content = json_encode($jj);

         $code = 'SMS_75835101';

         $result = $this->sms->send($phone,$name,$content,$code);
         // dd($result);
         //发送走把手机号码和验证码存入缓存中去
         if($result->result->success) {
            //存入字符串列表中
            Redis::sEtex("STRING_USER_VERIFY_CODE_" . $phone, 600, $number);
            return json_encode(['msg' => '发送成功']);
         } else {
            return json_encode(['msg' => '发送失败']);
         }
  
   }


   public function store(Request $request)
   {  
      //密码处理
      $password = trim($request['password']);
      //判断俩次密码是否一致
      if($password != $request['repassword']) {
         return '俩次密码输入不一致';
      }
      //从redis中取出手机验证码
      $code = Redis::get("STRING_USER_VERIFY_CODE_". $request['tel']);
      //拼接需要保存的信息
      $request['login_name'] = $request['tel'] = trim($request['tel']);
      //获取当前时间
      $request['created_at'] = $request['last_login_at'] = time();
      //验证redis中是否存在验证码
      if(empty($code)) {
         return '验证码已失效! 请重新发送~';
      }
      //判断提交的验证码和redis中的是否一致
      if($code != $request['code']) {
         return '验证码错误';
      }
      //密码加密
      $request['password'] = md5($password);
      //生成注册IP
      $request['last_login_ip'] = $request['register_ip'] = $request->getClientIp();
      // dd($request->all());
      //初始化昵称
      $request['nickname'] = 'youke';
      try {
         //开始事务
         \DB::beginTransaction();
         //准备sql语句
         $registerSql = [
               'tel' => $request['tel'],
               'password' => $request['password'],
               'register_ip' => $request['register_ip'],
               'created_at' => $request['created_at']
         ];
         //向用户注册原始表中添加一条数据,并返回这条数据的ID
         $registerResult = $this->register->insertGetId($registerSql);
         //判断用户注册原始表是否插入成功
         if(empty($registerResult)) {
            //抛出异常
            throw new Exception('注册失败1');
         }
         //用户注册原始表的ID是用户基本表，用户登陆索引表的user_id
         $request['user_id'] =  $registerResult;
         //准备sql语句
         $indexUserSql = [
               'user_id' => $request['user_id'],
               'login_name' => $request['login_name'],
               'password' => $request['password'],
               'last_login_ip' => $request['last_login_ip'],
               'last_login_at' => $request['last_login_at']
         ];
         //向用户个人信息表中添加一条数据
         $userinfoResilt = $this->indexUserLogin->insert($indexUserSql);
         //判断用户个人信息表是否成功
         if(empty($userinfoResilt)) {
            throw new Exception('注册失败2');
         }
         //准备sql语句
         $userinfoSql = [
               'user_id' => $request['user_id'],
               'nickname' => $request['nickname'],
               'tel' =>  $request['tel']
         ];
         //向用户登陆表中添加一条信息
         $indexUserResult = $this->userInfo->insert($userinfoSql);
         //判断用户登陆表是否成功
         if(empty($indexUserResult)) {
            throw new Exception('注册失败3');
         }
         //全部正确  事务提交
         \DB::commit();
         //存入用户登陆信息
         $request->session()->put('user', $indexUserSql);
         //存入用户个人信息
         $request->session()->put('userInfo', $userinfoSql);
         //注册成功,跳转登陆页面
         return redirect('home');
      } catch (Exception $e) {
         //事务回滚
         \DB::rollBack();
         //返回失败信息
          return '注册失败4';
      }
   }

   public function doLand(Request $request)
   {
      $tel = $request['tel'];
      $pass = $request['password'];
      //查询缓存
      $result = Redis::hgetall($tel);
      //判断缓存中是否有数据
      if(empty($result)) {
         //没有，查询数据库
         $result = $this->indexUserLogin->where('login_name', $tel)->first();
         //判断帐号是否存在
         if(empty($result)) {
            return json_encode(['code' => 0, 'msg' => '帐号错误']);
         }
         //对象转化为数组
         $result = $result->toArray();
         //在redis存入用户登陆信息
         redis::hmset($tel, $result);
      }
      //判断密码是否正确
      if(md5($pass) != $result['password']) {
         return json_encode(['code' => 1, 'msg' => '密码错误']);
      }
      //根据得到的user_id查询，并得到个人信息
      $userinfo = $this->userInfo->where('user_id',$result['user_id'])->first();
      //存入用户登陆信息
      $request->session()->put('user', $result);
      //存入用户个人信息
      $request->session()->put('userInfo', $userinfo);

      
      //跳转回首页
      return json_encode(['code' => 2]);
   }
}
