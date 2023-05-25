<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Read;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class ReadController extends Controller
{
    public function read(Post $post, Request $request, $postId){
        // Log::debug($postId);
        if($post->isReadBy(Auth::guard('admin')->user()->id)){
            if(!Auth::guard('admin')->user()){
                $user=Auth::user()->id;
                $read=Read::where('post_id', $postId)->where('user_id', $user)->first();
                $read->delete();
                return back();
            }else{
                $user=Auth::guard('admin')->user()->id;
                $read=Read::where('post_id', $postId)->where('user_id', $user)->first();
                $read->delete();
                return back();
            }
        }else{
            if(!Auth::guard('admin')->user()){
                $read=New Read();
                $read->post_id=$postId;
                $read->user_id=Auth::user()->id;
                $read->save();
                return back();
            }else{
                $read=New Read();
                $read->post_id=$postId;
                $read->user_id=Auth::guard('admin')->user()->id;
                $read->save();
                return back();
            }
        }
    }
}
