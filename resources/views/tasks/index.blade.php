{{-- 親ページを呼ぶ --}}
@extends('layouts.app')

{{-- 親ページへの挿入内容 --}}
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

    <div class="panel-body">
        <!-- バリデーションエラーの表示 -->
        {{-- テンプレートのロードを行う --}}
        @include('common.errors')

        <!-- 新タスクフォーム -->
        <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- タスク名 -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>
            </div>

    <!-- TODO: 現在のタスク -->

        </div>
    </div>
@endsection
