<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('c_score')->comment("评分");
            $table->string('c_content')->comment("评论内容");
            $table->string('c_img')->comment('评论图片');
            $table->bigInteger('uid')->unsigned();
            // $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('gid')->unsigned();
            // $table->foreign('gid')->references('id')->on('goods')->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}
