<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Read extends Component
{
    public $post;

    public function read(Post $post, Request $request){
        if($post->isReadBy(Auth::guard('admin')->user()->id)){
            if(!Auth::guard('admin')->user()){
                $user=Auth::user()->id;
                $read=Read::where('post_id', $post->id)->where('user_id', $user)->first();
                $read->delete();
                return back();
            }else{
                $user=Auth::guard('admin')->user()->id;
                $read=Read::where('post_id', $post->id)->where('user_id', $user)->first();
                $read->delete();
                return back();
            }
        }else{
            if(!Auth::guard('admin')->user()){
                $read=New Read();
                $read->post_id=$post->id;
                $read->user_id=Auth::user()->id;
                $read->save();
                return back();
            }else{
                $read=New Read();
                $read->post_id=$post->id;
                $read->user_id=Auth::guard('admin')->user()->id;
                $read->save();
                return back();
            }
        }
    }

    public function render()
    {
        return view('livewire.read');
    }

}
