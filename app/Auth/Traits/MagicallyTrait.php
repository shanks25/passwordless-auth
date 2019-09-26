<?php

namespace App\Auth\Traits;

use App\Mail\MagicMail;
use App\UserLoginToken;
use Mail;

trait MagicallyTrait 
{
	public function token()
	{
		return $this->hasone(UserLoginToken::class);
	}

	public function storeToken()
	{
		$this->token()->delete();

		$this->token()->create([
			'token'=>sha1(rand())
		]);
		return $this;
	}
	public function sendMagicLink($options)
	{
		Mail::to($this)->send(new MagicMail($this,$options));
	}
	
}