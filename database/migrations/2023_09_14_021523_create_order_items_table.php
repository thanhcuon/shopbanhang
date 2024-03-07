<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('order_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('order_id');
                $table->integer('product_id');
                $table->integer('quantity');
                $table->string('total');
                $table->timestamps();
        });

        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id'); // Tham chiếu đến người dùng (user) của địa chỉ
            $table->string('fullname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
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
        Schema::dropIfExists('order_items');
    }
}
