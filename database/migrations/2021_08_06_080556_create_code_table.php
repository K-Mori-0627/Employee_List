<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_table', function (Blueprint $table) {
            $table->string('code_type')->comment('コード種別');
            $table->string('value')->comment('値（コード）');
            $table->string('caption')->comment('値（名前）');
            $table->integer('order')->comment('順番');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_table');
    }
}
