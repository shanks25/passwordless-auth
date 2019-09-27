<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserLoginToken extends Model
{
	const TOKEN_EXIPRY = 30 ;
	protected $table = 'user_login_tokens';

	protected $fillable=  [
		'token'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function getRouteKeyName()
	{
		return 'token';
	}

	public function isExpired()
	{
		return $this->created_at->diffInSeconds(Carbon::now()) > self::TOKEN_EXIPRY;
	}

	public function belongsToEmail($email)
	{
		return (bool) ($this->user->where('email',$email)->count() === 1) ;
	}

	public function scopeExpired($query)
	{
		return $query->where('created_at','<',Carbon::now()->subSeconds(self::TOKEN_EXIPRY));
	}

}
