<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    // Relationship
    public function items()
    {
        return $this->hasMany(SurveyItem::class, 'survey_id', 'id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function isAnsweredBy($user) {
        return $this->answers()->where('user_id', $user)->exists();
    }
}