<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
	protected $table = 'admins';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'email', 'password'
	];

	public function checklogin($email, $password) {
		$admins = Admin::where('email', '=', $email)->where('password', '=', $password)->get();

		return $admins;
	}
	//
}
