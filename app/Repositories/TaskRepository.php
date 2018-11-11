<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * 指定ユーザーの全タスク取得
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        // Collectionを返す（Taskすべて）
        return $user->tasks()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}

// 全データアクセスに対して利用するTaskRepositoryをLaravelの依存注入能力を使い、TaskControllerに注入する。？？？

// TaskRepositoryを定義することで、Taskモデルとの全アクセスロジックを持つ。これは特にアプリケーションが大きくなり、アプリケーション全体からEloquentクエリを共有する必要が起きるようになると有効な手段。
