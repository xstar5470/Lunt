<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        $data = $request->only('nickname','password','repassword');
        $rules = [
            'nickname' => 'required|unique:users',
            'password' => 'required|between:6,12',
            'repassword' => 'required|same:password',
        ];
        $message=[
            "nickname.required"=>"请输入用户名",
            "password.required"=>"请输入密码",
            "repassword.required"=>"请输入确认密码",
            "nickname.unique"=>"用户名已存在",
            "repassword.same"=>"两次密码不一致",
            "password.min"=>"密码长度不在6-12位之间",
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->fails()){
            return err('',$validator->errors()->first());
        }
        $data['password'] = bcrypt($data['password']);
        unset($data['repassword']);
        User::create($data);
        return res('','注册成功，跳转登录页');
    }




}
