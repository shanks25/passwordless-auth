<?php

namespace App\Http\Controllers;

use App\Auth\MagicAuth;
use App\UserLoginToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagicLoginController extends Controller
{
	public function index()
	{
		return view('auth.magiclogin');
	}

	public function sendmail(Request $request,MagicAuth $auth)
	{ 
		$auth->requestLink($request); 
		return redirect('login/magic')->with('success',"We\'ve' Sent to you a magic link");
	}

	public function validateToken(Request $request,UserLoginToken $token)
	{	
		$token->delete();
		if ($token->isExpired()) {
			return redirect('login/magic')->with('error','Magic login Link is Expired please try again'); 
		}
		if (!$token->belongsToEmail($request->email)) {
			return redirect('login/magic')->with('error','Invalid magic link'); 
		}
		Auth::login($token->user,$request->remember);
		return redirect('home');
	}


	public function validateLogin($request)
	{
		$this->validate($request,[
			'email' =>'required|email|max:255|exists:users,email'	
		]);
	}
}
