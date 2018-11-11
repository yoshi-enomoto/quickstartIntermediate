<?php

namespace App\Http\Controllers;

// このコントローラー内で使用していない為、コメントアウトにしてみた。
// use App\Http\Requests;
// use App\Http\Controllers\Controller;
// use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * タスクリポジトリーインスタンス
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    // public function __construct()
        // 初期の記述
    // TaskControllerのコンストラクターでキー＆バリューとして指定？
    //  ＝他で活用する為。
    // Laravelは全コントローラーの依存解決にコンテナを使っていますので、依存はコントローラーインスタンスへ自動的に注入されます？？？
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
            // 認証されたユーザにのみ、アクセスを許す設定

        $this->tasks = $tasks;
            // 『$this』：TaskController
            // 『$tasks』：TaskRepository
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // // $requestからuserを取り出し、そのリレーションを用いてタスクを取り出している。
        // // storeアクションと同様
        // $tasks = $request->user()->tasks()->get();

        // // 第２引数に、ビューで使用するデータを配列で渡す。
        // // 配列のキーはビューの中で変数となる。
        // return view('tasks.index', [
        //     'tasks' => $tasks,
        // ]);

        // 上記すべて、TaskRepository作成前の記述
        // 下記はTaskRepository作成後の記述
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
                // 『$this』：TaskController
                // 『->tasks』：TaskRepository（コンストラクタで定義）
                // 『->forUser()』：TaskRepositoryクラスで定義したメソッドが使用可。
                // ＝task全てを返す。
        ]);
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
     * 指定タスクの削除
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    // ルートの『{task}』とメソッド中の『$task』が一致するため、暗黙的モデル結合となる。（implicit）
    public function destroy(Request $request, Task $task)
    {
        // 第一引数は、呼び出したいポリシーメソッド名前。
        // 第二引数は、現在関心を向けているモデルインスタンス。
        // 現在のユーザは自動的にポリシーメソッドに送られるので、Taskインスタンスをポリシーメソッドに送る。
        $this->authorize('destroy', $task);
            // 正常なのか、Reponseで#messageがnull
            // アクションが非許可になれば（つまりポリシーのdestroyメソッドがfalseを返したら）、403例外が投げられ、ユーザにエラーページが表示される。
            // ＝『AuthServiceProvider.php』の$policies内をわざと書き間違えてみると閲覧可能。

        $task->delete();

        return redirect('/tasks');
    }
}
