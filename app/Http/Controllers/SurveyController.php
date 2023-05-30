<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Answer;
use App\Models\Survey;
use App\Models\SurveyItem;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create()
    {
        return view('admin.auth.survey');
    }
    public function show(Survey $survey)
    {
        $now = now();

        if($survey->expired_at < $now) { // すでに有効期限切れの場合
            abort(404);
        }

        $survey->load('items');
        $user_id = auth()->id();
        $is_polled = Answer::where('survey_id', $survey->id)
            ->where('user_id', $user_id)
            ->exists();

        return view('survey.index')->with([
            'survey' => $survey,
            'is_polled' => $is_polled
        ]);
    }

    public function result(Survey $survey)
    {
        $survey_items = SurveyItem::withCount('answers')
            ->where('survey_id', $survey->id)
            ->orderBy('answers_count', 'desc') // 件数で並び替え
            ->get();
        $all_count = $survey_items->sum('answers_count'); // すべての投票数

        return $survey_items->map(function($survey_item) use($all_count) {

            $percentage = ($all_count === 0)
                ? 0
                : round($survey_item->answers_count / $all_count * 100, 1); // 結果のパーセント化

            return [
                'option' => $survey_item->option,
                'percentage' => sprintf('%.1f', $percentage) // .0 が消えるのでフォーマット使用
            ];

        });
    }

    public function store(SurveyRequest $request)
    {
        $answer = new Answer();
        $answer->user_id = auth()->id();
        $answer->survey_id = $request->survey_id;
        $answer->survey_item_id = $request->survey_item_id;
        $result = $answer->save();

        return ['result' => $result];
    }
}
