<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\login;
class LoginController extends Controller
{
    public function login(){
    	return view('Login.login');
    }

    public function logindo(Request $request){
    	$post=$request->except('_token');
    	dump($post);
    	$userInfo=Login::where('user_name',$post['user_name'])->first();
    	if($userInfo){
    		if($post['user_pwd']!==($userInfo->user_pwd)){
    			return redirect('/login/login');
    		}
    	}
    	session(['userInfo'=>$userInfo]);
    	return redirect('/xin/index');
    }
}
