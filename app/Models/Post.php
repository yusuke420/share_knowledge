<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Read;
use Illuminate\Support\Collection;

class Post extends Model
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var
     */
    protected $fillable = [
        'title',
        'importance',
        'body',
    ];

    /**
     * userテーブルへのrelation
     *
     * @return BelongsToMany
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function reads() {
        return $this->hasMany(Read::class);
    }

    public function isReadBy($user) {
        return $this->reads()->where('user_id', $user)->exists();
    }

    public function modelSearchPost($keyword) {
        return $this->query()
            ->Where(function($query) use ($keyword) {
                $query->orWhere('title', 'Like', '%'.$keyword.'%')
                    ->orWhere('body', 'Like', '%'.$keyword.'%');
                    })->latest()->paginate(20);
    }

    public function modelSortPost($importance) {
        return $this->query()
            ->Where(function($query) use ($importance) {
                $query->orWhere('importance', 'Like', '%'.$importance.'%');
            })->latest()->paginate(20);
    }

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $table = 'posts';

    // public function getImportanceAttribute($value)
    // {
    //     switch ($value) {
    //         case '高':
    //             return 'high';
    //         case '中':
    //             return 'medium';
    //         case '低':
    //             return 'low';
    //         default:
    //             return '';
    //     }
    // }
    
    public function setImportanceAttribute($value)
    {
        switch ($value) {
            case 'high':
                $this->attributes['importance'] = 1;
                break;
            case 'medium':
                $this->attributes['importance'] = 2;
                break;
            case 'low':
                $this->attributes['importance'] = 3;
                break;
            default:
                $this->attributes['importance'] = null;
        }
    }
}
