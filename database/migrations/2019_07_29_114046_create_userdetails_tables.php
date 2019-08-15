<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserdetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdetails', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            
            $table->bigInteger('uid')->unsigned()->comment('用户表的外键');
            $table->string('realname',50);
            $table->string('sex',10);
            $table->text('description');
            $table->integer('integral',false,false);
            $table->string('phone',50);
            $table->string('pic',150);
            $table->string('paypwd',255);
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
        Schema::dropIfExists('userdetails');
    }
}
