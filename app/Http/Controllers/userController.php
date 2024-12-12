<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\comment;

class userController extends Controller
{

    public function changePfp(Request $request, $id) {
        //request pfp en define user
        $image = $request->file('upload');
        $user = User::findorfail($id);
        //image uuid en save naar db en storage
        $user->imageId = Str::random(20);
        $user->addMedia($image)->toMediaCollection($user->imageId);
        $user->save();
        return redirect()->back();
    }

    public function index() {

        $user = User::all();
        $image = User::with('media')->get();

        return view('indexUser')->with('user', $user)->with('image', $image);
    }

    public function showPost($id, $uuid){
        //define user en vraag/define post/comments
        $user = User::findorfail($id);
        $media = $user
        ->getMedia($user->imageId)
        ->first();
        $post = post::where('uuid', $uuid)->get()->first();
        $image = post::where('userId', $id)->with('media')->get();
        $comments = comment::where('postUuid', $uuid)->get();


    return view('showPost')->with('user', $user)->with('media', $media)->with('post', $post)->with('image', $image)->with('uuid', $uuid)->with('comments', $comments);
    }

    public function show($id) {
        //define user en request post
        $user = User::findorfail($id);
            $media = $user
            ->getMedia($user->imageId)
            ->first();
            $post = post::where('userId', $id)->get();
            $image = post::where('userId', $id)->with('media')->get();

        return view('showUser')->with('user', $user)->with('media', $media)->with('post', $post)->with('image', $image);
    }


    public static function admin() {
        //als user admin role heeft
        if (Auth::check()){
            if(Auth::user()->role == 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function agenda() {
        //als user agenda role heeft
        if (Auth::check()){
            if(Auth::user()->role == 'agenda') {
                return true;
            }
            else{
                if(Auth::user()->role == 'admin') {
                    return true;
                }
            }
        }
        return false;
    }


}
