<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('name_kana')->length(20)->comment('名前（かな）');
            $table->string('name_roma')->length(20)->comment('名前（英字）');
            $table->string('employee_id')->unique()->comment('社員ID');
            $table->string('login_id')->length(20)->comment('ログインID');
            $table->string('password')->comment('パスワード');
            $table->longText('profile_img')->nullable()->comment('プロフィール画像');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
