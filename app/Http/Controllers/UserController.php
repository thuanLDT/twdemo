<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

  public function index() {
    $user_data = User::where('id', '!=', Auth::id())->get(); //自分以外のデータを取得する。
    $findFollow = Follow::where('user_id', '=', Auth::id())->get();

    $followId = [];
    foreach($findFollow as $follow) {
      $followId[] = $follow->follow_id; //配列が複数あるので、アローで配列を指定。
    }

    // dd($followId);

    return view('user.list', ['users' => $user_data, 'followId' => $followId]);
  }

  public function follow($follow_id) {
    $follow = new Follow; //followsテーブル指定してインスタンスを作成
    $follow->user_id = Auth::id(); //ログイン中のidを取得
    $follow->follow_id = $follow_id; //フォロー先のidを取得
    $follow->save(); //保存

    return redirect()->route('user_list'); //名前がつけられている場合はアロー引っ張る。
  }

  public function destroy($follow_id) {
    Follow::where('follow_id',$follow_id)->delete();
    return redirect()->route('user_list');
  }
}
