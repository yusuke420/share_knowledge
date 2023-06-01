<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Read;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::latest()->paginate(20);
        $posts->load('user');
        return view('admin.dashboard', compact('posts'));
    }

    // 投稿フォームを表示するアクション
    public function create(): View 
    {
        return view('admin.auth.post');
    }

    public function store(Request $request): RedirectResponse
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'importance' => 'required',
            'body' => 'required',
            'image' => 'nullable|max:1024|mimes:jpg,jpeg,png,gif',
        ]);

        // モデルを使って投稿を保存する
        $post = Post::create([
            'title' => $request->title,
            'importance' => $request->importance,
            'body' => $request->body,
        ]);

        event(new Registered($post));

        // 投稿完了後にリダイレクトする
        return redirect()->route('admin.dashboard')->with('message', '周知を投稿しました。');
    }

    public function controllerSearchPost(Request $request, Post $post)
    {
        $keyword = $request->input('search');
        $posts = $post->modelSearchPost($keyword);
        return view('admin.search_result_post', ['posts' => $posts]);
    }

    public function controllerSortPost(Request $request, Post $post)
    {
        $importance = $request->input('sort');
        $posts = $post->modelSortPost($importance);
        return view('admin.search_result_post', ['posts' => $posts]);
    }

    public function detail(Request $request, Post $post)
    {
        $users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();
        return view('admin.detail', compact('post','users'));
    }

    public function edit(Request $request, Post $post)
    {
		return view('admin.auth.edit', compact('post'));
    }

	public function update(Request $request, Post $post)
	{
        $request->validate([
            'title' => 'required|max:255',
            'importance' => 'required',
            'body' => 'required',
        ]);
        $read=Read::where('post_id', $post->id);
        $read->delete();

        $data = [
            'title' => $request->title,
            'importance' => $request->importance,
            'body' => $request->body,
        ];
        $post->user_id = Auth::guard('admin')->user()->id;
        $post->update($data);

        $users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();
        return view('admin.detail', compact('post', 'users'))->with('message', '投稿を更新しました。');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.dashboard')->with('message', '投稿を削除しました。');
    }
}