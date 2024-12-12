<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class postController extends Controller
{
    public function create() {

        return view('createPost');
    }

    public function createcomment(Request $request, $postUuid) {
        //nieuwe comment van user
        $comment = new comment;
        $user = User::find($request->input('userId'));
        //varibale transfers
        $comment->username = $user->name;
        $comment->userId = $user->id;
        $comment->comment = $request->input("comment");
        $comment->postUuid = $postUuid;
        $comment->save();
        return redirect()->back();
    }

    public function store(Request $request) {
        // maak post aan

        $post = new post;
        //request post info uit forms
        $request->validate([
            'caption' => 'required|max:50',
        ]);
        $post->username = $request->input('username');
        $post->uuid = Str::uuid();
        $post->userId = $request->input('userId');
        $post->caption = $request->input('caption');


        //max 7 files en alleen op vrijdag
        if ($request->file('image')) {

            Carbon::setLocale('nl');
            $weekMap = [
                0 => 'SU',
                1 => 'MO',
                2 => 'TU',
                3 => 'WE',
                4 => 'TH',
                5 => 'FR',
                6 => 'SA',
            ];
            $dayOfTheWeek = Carbon::now()->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];
            if($weekday == "MO") {
                 $lastDayPost= post::where('userId', $post->userId)->where('created_at', ">", DB::raw('NOW() - INTERVAL 1 DAY'))->take(100)->get();
                if($lastDayPost->isEmpty()) {
                    $i = 0;
                    foreach($request->File('image') as $image) {
                        if($i < 7){
                            $post->addMedia($image)->toMediaCollection($post->userId)->setCustomProperty('postUuid', $post->uuid);
                            $i++;
                        }
                    }
                    $post->save();
                    return redirect('/home');
        }else{return redirect('/home');}} else {return redirect('/home');}
        //save post
        return redirect('/home');
        }}




    public function index() {
        //define user
        $user = User::find(Auth::id());
        //als user nieuw is standaard pfp upload
        if($user->imageId == "test") {
            $user->imageId = Str::random(20);
            $user->addMediaFromUrl("https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png")->toMediaCollection($user->imageId);
            $user->save();
        }
        // request alle posts
        $post = post::all();
        $image = post::with('media')->get();
        return view('dashboard')->with('post', $post)->with('image', $image);
    }
    public function dashboard() {
        //zie index
        $user = User::find(Auth::id());
        if($user->imageId == "test") {
            $user->role = "user";
            $user->imageId = Str::random(20);
            $user->addMediaFromUrl("https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png")->toMediaCollection($user->imageId);
            $user->save();
        }
        $post = post::all();
        $image = post::with('media')->get();
        return view('dashboard')->with('post', $post)->with('image', $image);
    }
}
