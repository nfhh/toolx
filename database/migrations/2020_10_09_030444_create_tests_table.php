<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('sn')->unique();
            $table->text('result')->comment('测试结果');
            $table->unsignedBigInteger('user_id')->default(0)->comment('测试人');
            $table->unsignedInteger('uptimes')->default(1)->comment('测试次数');
            $table->string('finished')->default('')->comment('最终结果');
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
        Schema::dropIfExists('tests');
    }
}
