<?php

namespace App\Http\Requests;

use App\Models\Answer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'survey_id' => Rule::exists('survey_items')->where(function ($query) { // survey_id と survey_item_id のペアが正しいかチェック
                return $query->where('id', $this->survey_item_id);
            }),
            'survey_item_id' => function ($attribute, $value, $fail) { // 投票済みかどうかチェック

                $user_id = auth()->id();
                $exists = Answer::where('survey_id', $this->survey_id)
                    ->where('user_id', $user_id)
                    ->exists();

                if ($exists === true) {
                    $fail('すでに回答済みです');
                }
            },
        ];
    }
}
