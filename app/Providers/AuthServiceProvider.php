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

        'App\Task' => 'App\Policies\TaskPolicy',
            // TaskモデルをTaskPolicyに関連付ける。
            // Taskインスタンスに対するアクションを認可したい場合に毎回使われるべきポリシーをLaravelに指定することができる。
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
