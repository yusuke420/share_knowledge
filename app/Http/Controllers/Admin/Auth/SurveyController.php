<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SurveyController extends Controller
{
    public function create(): View 
    {
        return view('admin.auth.survey');
    }

    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'options' => 'required',
        ]);

        // モデルを使って投稿を保存する
        $survey = Survey::create([
            'title' => $request->title,
            'options' => $request->options,
        ]);

        event(new Registered($survey));

        // 投稿完了後にリダイレクトする
        return redirect(RouteServiceProvider::ADMIN_HOME);
    }


    public function edit(Request $request, Survey $survey)
    {
		return view('admin.auth.edit', compact('survey'));
    }

    /**
	 * お問い合わせフォーム データベース登録・編集
	 */
	public function update(Request $request, Survey $survey)
	{
        $request->validate([
            'title' => 'required|max:255',
            'options' => 'required',
        ]);
        $survey->title = $request->title;
        $survey->options = $request->options;
        $survey->user_id = Auth::guard('admin')->user()->id;
        $survey->save();

        $read=Answer::where('survey_id', $survey->id);
        $read->delete();
        return back()->with('message', 'アンケートを更新しました。');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('admin.dashboard')->with('message', 'アンケートを削除しました。');
    }

}
