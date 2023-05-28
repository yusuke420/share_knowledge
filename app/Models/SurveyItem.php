<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyItem extends Model
{
    use HasFactory;

    // Relationship
    public function answers()
    {
        return $this->hasMany(Answer::class, 'survey_item_id', 'id');
    }
}