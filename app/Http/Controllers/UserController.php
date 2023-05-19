<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show()
	{
		$users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();
		return view('admin.auth.user-list', compact('users'));
	}

    public function SendDatabase(Request $request)
	{
		$User = new User();
		// actionの値を取得
		$action = $request->input('action');
		// action以外のinputの値を取得
		$inputs = $request->except('action');

		$referer = $inputs['referer'];
		$id = $inputs['id'];

		// 戻り先を振り分ける
		if ($referer === 'users') {
			$backPage = 'admin.dashboard';
		}

		//actionの値で分岐
		if ($action !== 'submit') {
			// 戻るボタンでリダイレクト
			return redirect()
				->route($backPage, ['id' => $id])
				->withInput($inputs);
		} else {
			// 二重送信対策 トークン再発行
			$request->session()->regenerateToken();

			if ($referer === 'users') {
				//DB登録
				$data = $request->all();
				$User->addMessage($data);
			} elseif ($referer === 'edit') {
				//DB編集
				$data = $request->all();
				$User->updateMessage($data, $id);
			}

			return view('admin.dashboard');
		}
	}

	public function controllerSearchUser(Request $request, User $user) {
        $keyword = $request->input('search');
        $users = $user->modelSearchUser($keyword);
        return view('admin.auth.search_result_user', ['users' => $users]);
    }


	/**
	 * お問い合わせ内容取得
	 */
	public function GetMessage($id)
	{
		$User = new User();
		$data = $User->getDataById($id);
		return view('admin.dashboard', ['data' => $data, 'id' => $id]);
	}

	/**
	 * DB削除
	 */
	public function DeleteDatabase($id)
	{
		$User = new User();
		$User->deleteMessage($id);
		return redirect(route('admin.dashboard'));
	}

	/**
	 * 削除完了ページ表示
	 */
	public function DeleteSuccessPage(){
		return view('admin.dashboard');
	}

	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}