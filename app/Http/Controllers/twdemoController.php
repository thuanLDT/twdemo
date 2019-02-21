<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class twdemoController extends Controller {

  public function index() {
    $findFollow = Follow::where('user_id', '=', Auth::id())->get();
    $timeLineData = [Auth::id()];

    foreach($findFollow as $follow) {
      $timeLineData[] = $follow->follow_id;
    }
    // dd($timeLineData);

    // $user_data = Tweet::all();
    $user_data = Tweet::whereIn('user_id',$timeLineData)->latest()->get();
    return view('home', ['tweets' => $user_data]);
  }

  public function Tweet(Request $req) {
    $user_tweet = new Tweet; //tweetsテーブルを指定してインスタンスを生成。
    $user_tweet->tweet = $req->tweet; //記述されたツイートを要求する。
    $user_tweet->user_id = auth::id();//どこのデータベースに何をあてがうか。
    $user_tweet->save();
    return redirect("/home");
  }

}
