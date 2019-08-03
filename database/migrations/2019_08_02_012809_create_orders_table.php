<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->comment('用户id');
            $table->string('sid')->comment('快递方式');
            $table->string('cid')->comment('使用红包或优惠卷');
            $table->string('o_no',50)->comment('订单编号');
            $table->string('o_amount')->comment('订单总计');
            $table->string('o_status',10)->comment('订单状态');
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
        Schema::dropIfExists('orders');
    }
}
