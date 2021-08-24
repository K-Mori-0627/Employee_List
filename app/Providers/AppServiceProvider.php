<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //----------------------------------------------
        // リポジトリ
        //----------------------------------------------
        // User
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class,
        );
        // Admin
        $this->app->bind(
            \App\Repositories\AdminRepositoryInterface::class,
            \App\Repositories\AdminRepository::class,
        );
        // CodeTable
        $this->app->bind(
            \App\Repositories\CodeTableRepositoryInterface::class,
            \App\Repositories\CodeTableRepository::class,
        );
        // Employee
        $this->app->bind(
            \App\Repositories\EmployeeRepositoryInterface::class,
            \App\Repositories\EmployeeRepository::class,
        );
        // Information
        $this->app->bind(
            \App\Repositories\InformationRepositoryInterface::class,
            \App\Repositories\InformationRepository::class,
        );

        //----------------------------------------------
        // ユーザー側画面サービス
        //----------------------------------------------
        // ホーム画面
        $this->app->bind(
            \App\Services\User\HomeServiceInterface::class,
            function ($app) {
                return new \App\Services\User\HomeService(
                    $app->make(\App\Repositories\UserRepositoryInterface::class),
                    $app->make(\App\Repositories\InformationRepositoryInterface::class)
                );
            },
        );
        // お知らせ一覧画面
        $this->app->bind(
            \App\Services\User\InformationServiceInterface::class,
            function ($app) {
                return new \App\Services\User\InformationService(
                    $app->make(\App\Repositories\InformationRepositoryInterface::class)
                );
            },
        );
        // メンバーリスト画面
        $this->app->bind(
            \App\Services\User\EmployeeServiceInterface::class,
            function ($app) {
                return new \App\Services\User\EmployeeService(
                    $app->make(\App\Repositories\UserRepositoryInterface::class)
                );
            },
        );
        // プロフィール画面
        $this->app->bind(
            \App\Services\User\ProfileServiceInterface::class,
            function ($app) {
                return new \App\Services\User\ProfileService(
                    $app->make(\App\Repositories\UserRepositoryInterface::class),
                    $app->make(\App\Repositories\CodeTableRepositoryInterface::class)
                );
            },
        );
        // パスワード変更画面
        $this->app->bind(
            \App\Services\User\PasswordServiceInterface::class,
            function ($app) {
                return new \App\Services\User\PasswordService(
                    $app->make(\App\Repositories\UserRepositoryInterface::class)
                );
            },
        );

        //----------------------------------------------
        // 管理者側画面サービス
        //----------------------------------------------
        // ホーム画面
        $this->app->bind(
            \App\Services\Admin\HomeServiceInterface::class,
            function ($app) {
                return new \App\Services\Admin\HomeService(
                    $app->make(\App\Repositories\AdminRepositoryInterface::class)
                );
            },
        );
        // お知らせ設定画面
        $this->app->bind(
            \App\Services\Admin\EmployeeServiceInterface::class,
            function ($app) {
                return new \App\Services\Admin\EmployeeService(
                    $app->make(\App\Repositories\UserRepositoryInterface::class),
                    $app->make(\App\Repositories\EmployeeRepositoryInterface::class),
                    $app->make(\App\Repositories\CodeTableRepositoryInterface::class)
                );
            },
        );
        // メンバー設定画面
        $this->app->bind(
            \App\Services\Admin\InformationServiceInterface::class,
            function ($app) {
                return new \App\Services\Admin\InformationService(
                    $app->make(\App\Repositories\InformationRepositoryInterface::class)
                );
            },
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
