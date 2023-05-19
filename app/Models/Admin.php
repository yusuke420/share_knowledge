<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'admins';

    //多対多のリレーションを書く
    public function reads()
    {
        return $this->belongsToMany('App\Models\Post','post_user','user_id','post_id')->withTimestamps();
    }

    //この投稿に対して既に既読しているかどうかを判別する
    public function isRead($postId)
    {
    return $this->reads()->where('post_id',$postId)->exists();
    }

    //isReadを使って、既に既読したか確認したあと、既読する（重複させない）
    public function read($postId)
    {
        if($this->isRead($postId)){
            //もし既に既読していたら何もしない
        } else {
            $this->reads()->attach($postId);
        }
    }

    //isReadを使って、既に既読したか確認して、もししていたら解除する
    public function unread($postId)
    {
        if($this->isRead($postId)){
            //もし既に既読していたら消す
            $this->reads()->detach($postId);
        } else {
        }
    }
}