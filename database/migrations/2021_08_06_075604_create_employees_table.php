<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('employee_id')->unique()->comment('社員ID');
            $table->char('role')->length(1)->comment('役職');
            $table->char('department')->length(1)->comment('部署');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->date('birthday')->nullable()->comment('誕生日');
            $table->text('technology')->nullable()->comment('得意な技術');
            $table->text('hobby')->nullable()->comment('趣味');
            $table->text('freespace')->nullable()->comment('フリースペース');
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
        Schema::dropIfExists('employees');
    }
}
