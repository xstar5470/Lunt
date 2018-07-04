<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('/posts');
        }
        return view('login.login');
    }

    public function login(Request $request)
    {
        $data = $request->only('nickname', 'password');
        $remember = $request->input('is_remember') ? true : false;
        $rules = [
            'nickname' => 'required',
            'password' => 'required',
        ];
        $message = [
            "nickname.required" => "请输入用户名",
            "password.required" => "请输入密码",
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return err('', $validator->errors()->first());
        }

        if (\Auth::attempt($data, $remember)) {
            return json_encode(['code' => 0, 'message' => '登录成功']);
        } else {
            return err('', '账号密码不匹配');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


}
