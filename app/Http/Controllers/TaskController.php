<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * 新しいコントローラインスタンスの生成
     *
     * @return void
     */
    // 認証されたユーザにのみ、アクセスを許す設定
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ValidatesRequestsトレイトが使用可能！
        //  →ControllerでValidatesRequetsをuseしている為
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスクの作成処理…
        // createメソッドは属性の配列を受け取り、データベースへ保存する前に、関連するモデルの外部キー値を自動的に設定する。
        // 以下の場合、createメソッドは、$request->user()でアクセスできる現在の認証済みユーザのIDを指定したタスクのuser_idプロパティへ自動的に設定します。
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        // 実URLで与える場合
        return redirect('/tasks');
        // nameで与える場合
        // return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
