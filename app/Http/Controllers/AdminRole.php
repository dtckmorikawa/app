<?php

namespace App\Http\Controllers;

use WebDevEtc\BlogEtc\Helpers;
use Illuminate\Http\Request;
use Log;
use App\User;

class AdminRole extends Controller
{
    //
    protected $connection = 'mysql_common';
    public function __construct()
    {
        Log::debug('AdminRoll>__construct is called');
    }

    public function index () 
    {

        //ユーザーの一覧を表示
        Log::debug('AdminRoll>index is called');

        $title = 'ロールの管理'; // default title...
        $users = user::query();
        $users = $users->orderBy("id", "desc")->paginate(config("blogetc.per_page", 10));

        return view("admin-role.index", [
            'users' => $users,
            'title' => $title,
        ]);
    }

    public function edit(Request $request, $id){
        //ユーザー権限の編集
        Log::debug('AdminRole>edit is called');

        //idからユーザーの情報を取得
        $user = user::where("id", $id)->firstOrFail();
       
        return view("admin-role.edit", [
            'target_user' => $user, 
        ]);
    }
        
    //search for users
    public function search(Request $request){
        Log::debug('AdminRole>search is called');
        $user_name = $request->name;
        
        if ($user_name != '') {
          $users = user::where('name', 'like','%'.$user_name.'%')->orderBy('created_at','desc')->paginate();
        }else {
          $users = user::orderBy('id','desc')->paginate();
        }

        //$query = $request->get("s");
        //$users=user::search($query)->paginate();
    
        \View::share("title",  $user_name . "の検索結果");
        return view("admin-role.search", ['query' => $user_name, 'users' => $users]);
    }

    //update for users
    public function update(Request $request){
        
        Log::debug('AdminRole>update is called');
        
        $target_user_id = $request->target_user_id;
        $newrole = $request->admin_value;

        //DB更新
        $target_user = user::where("id", $target_user_id)->update(['admin'=>$newrole]);

        \Session::flash('flash_message', '権限を変更しました。');
        return redirect()->route("adminrole.edit",$target_user_id);
    }
}
