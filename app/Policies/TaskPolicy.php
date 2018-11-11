<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * 指定されたユーザーが指定されたタスクを削除できるか決定
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    // このメソッドはユーザのIDがタスクのuser_idと一致するかを調べるだけ。
    // 全ポリシーメソッドはtrueかfalseを返す必要がある。
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
