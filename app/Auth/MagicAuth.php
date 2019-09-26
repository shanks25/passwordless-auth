<?php

namespace App\Auth;


use App\User;
use Illuminate\Http\Request;

class MagicAuth
{
	protected $request;
	protected $identifier = 'email';

	public function __construct(Request $request)
	{
		$this->request  = $request ;
	}

	public function requestLink()
	{
		$user = $this->getuserIdentifier($this->request->get($this->identifier));
		
		$user->storeToken()->sendMagicLink([
			'remember' =>$this->request->has('remember'),
			'email'=>$user->email
			
		]); 
	}

	public function getuserIdentifier($value)
	{
		return User::where($this->identifier,$value)->firstOrFail();
	}

} 