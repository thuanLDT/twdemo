<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\Auth;

class twdemoController extends Controller {

  public function index() {
    return view('home');
  }

  public function Tweet(Request $req) {
    $user_tweet = new Tweet;
    $user_tweet->tweet = $req->tweet;
    $user_tweet->user_id = auth::id();
    $user_tweet->save();
    return redirect("/");
  }


}
