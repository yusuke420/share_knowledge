<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Read extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * 投稿に既読しているかどうか
     *
     * @param integer $user
     * @return boolean
     */
    public function isReadBy($user) {
        return $this->reads()->where('user_id', $user)->exists();
    }

}