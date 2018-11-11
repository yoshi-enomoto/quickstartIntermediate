<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * アプリケーションにマップするポリシー
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',

        'App\Models\Task' => 'App\Policies\TaskPolicy',
            // TaskモデルをTaskPolicyに関連付ける。
            // Taskインスタンスに対するアクションを認可したい場合に毎回使われるべきポリシーをLaravelに指定することができる。

            // 今回の場合、『'App\Task'』に書き換えてみると、403例外が投げられ、ユーザにエラーページが閲覧できる。

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
