<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Read;
use App\Models\Post;


class ReadController extends Controller
{
    public function read(Post $post, Request $request){
        if($post->isReadBy(Auth::user()->id)){
            $user=Auth::user()->id;
            $read=Read::where('post_id', $post->id)->where('user_id', $user)->first();
            $read->delete();
            return back();
        }else{
            $read=New Read();
            $read->post_id=$post->id;
            $read->user_id=Auth::user()->id;
            $read->save();
            return back();
        }
    }
}
