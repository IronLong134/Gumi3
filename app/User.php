<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'style',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @param  $id
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
     * @return mixed
     */
    public function messengers()
    {
        return $this->hasMany('App\Messengers');
    }
    /**
     * @param  $id
     * @return mixed
     */
    public function getAll($id)
    {
        $user = User::all();
        return $user;
    }

}