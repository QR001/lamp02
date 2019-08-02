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
            $table->integer('bid')->default(0);
            $table->string('g_name');
            $table->integer('g_oprice');
            $table->integer('g_nprice');
            $table->string('g_img');
            $table->string('g_status')->default('1');
            $table->string('g_color');
            $table->string('g_size');
            $table->integer('g_sales')->comment("商品销量");
            $table->integer('g_stock')->comment("商品库存");
            $table->integer('g_integral')->default(0);
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
