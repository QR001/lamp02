<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->default(0)->commit('用户的id,默认是0代表未被领取');
            $table->integer('c_money')->commit('金额');
            $table->string('c_type',10)->commit('1 优惠券 2 红包');
            $table->string('c_status',10)->commit('1 未使用 2 已使用 3已过期');
            $table->string('c_time',50)->commit('有效时间');
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
        Schema::dropIfExists('coupons');
    }
}
