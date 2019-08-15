<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bid');
            $table->integer('sfid');
            $table->integer('sid');
            $table->string('g_name');
            $table->integer('g_oprice');
            $table->integer('g_nprice');
            $table->string('g_color');
            $table->string('g_img');
            $table->string('g_size');
            $table->integer('g_sales');
            $table->integer('g_stock');
            $table->integer('g_integral');
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
        Schema::dropIfExists('goods');
    }
}
