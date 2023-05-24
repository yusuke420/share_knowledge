<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Read;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Pagination\Paginator;


class PostController extends Controller
{
    public function index()
    {
        $posts=Post::latest()->paginate(20);
        $posts->load('user');
        return view('dashboard', compact('posts'));    
    }

    public function readPost(Request $request, $id)
    {
        // ユーザーIDを取得します
        $userId = $request->user()->id;
        
        // 投稿を取得します
        $post = Post::findOrFail($id);
        
        // ポストとユーザーの関連を確認します
        $existingRead = $post->reads()->where('user_id', $userId)->exists();
        
        if ($existingRead) {
            // すでにいいね済みの場合、いいねを解除します
            $post->reads()->detach($userId);
            $isRead = false;
        } else {
            // いいねが存在しない場合、いいねを追加します
            $post->reads()->attach($userId);
            $isRead = true;
        }
        
        return response()->json(['isRead' => $isRead]);
    }

    /**
     * 投稿の検索機能
     *
     * @param Request $request
     * @param Post $post
     * @return view
     */
    public function controllerSearchPost(Request $request, Post $post)
    {
        $keyword = $request->input('search');
        $posts = $post->modelSearchPost($keyword);
        return view('search_result_post', ['posts' => $posts]);
    }

    public function controllerSortPost(Request $request, Post $post)
    {
        $importance = $request->button('sort');
        $posts = $post->modelSortPost($importance);
        return view('search_result_post', ['posts' => $posts]);
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
}