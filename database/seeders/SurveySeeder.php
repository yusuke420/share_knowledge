<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\SurveyItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run()
    {
        $test_surveys = [
            [
                'title' => '好きな動物は？',
                'options' => [
                    '犬',
                    '猫',
                    'パンダ',
                    'アライグマ',
                    'カモノハシ'
                ]
            ],
            [
                'title' => '行ってみたい国は？',
                'options' => [
                    'アメリカ',
                    'イギリス',
                    'フランス',
                    'ドイツ',
                    'カナダ'
                ]
            ]
        ];

        foreach ($test_surveys as $test_survey) {

            $survey = new Survey();
            $survey->title = $test_survey['title'];
            $survey->expired_at = today()->addDays(rand(3, 7));
            $survey->save();

            $test_options = $test_survey['options'];

            foreach ($test_options as $test_option) {
                $survey_item = new SurveyItem();
                $survey_item->survey_id = $survey->id;
                $survey_item->option = $test_option;
                $survey_item->save();
            }
        }
    }
}

