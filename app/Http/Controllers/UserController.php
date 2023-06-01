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

	public function controllerSearchUser(Request $request, User $user) {
        $keyword = $request->input('search');
        $users = $user->modelSearchUser($keyword);
        return view('admin.auth.search_result_user', compact('users'));
    }

	public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user-list.show')->with('message', 'ユーザーを削除しました。');
    }

}