<?php

namespace App\Http\Controllers\Admin;

use App\Model\data_admin_users;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
//引入验证码类
use Gregwar\Captcha\CaptchaBuilder;
class LoginController extends Controller
{
	/**
     *	登陆页面显示
     *
     * @param  
     * @return 页面
     */
	public function index()
	{
		return view('admin/login');
	}

	/**
     *	验证码显示
     *
     * @param  
     * @return 验证码
     */
	public function captcha($tmp)
	{

        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 220, $height = 60, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        \Session::flash('mycode', $phrase);
        //生成图片
		return response($builder->output())->header('Content-Type', 'image/jpeg');
	}

	/**
     *	登陆数据操作
     *
     * @param  
     * @return 
     */
	public function store(Request $request)
	{
		$code = \Session::get('mycode');
		if ($code != $request['code']) {
			return json_encode(['msg' => '验证码错误', 'code' => 3]);
		}
		$result = data_admin_users::where('tel',$request['tel'])->first();

		if(empty($result)) {
			return json_encode(['msg' => '帐号错误', 'code' => 0]);
		}

		if (md5($request['password']) != $result->password) {
			return json_encode(['msg' => '密码错误', 'code' => 1]);
		}
		$request->session()->put('admin_user', $result->toArray());
		return json_encode(['code' => 2]);
	}
}