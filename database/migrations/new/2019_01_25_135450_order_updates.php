<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('quantity')->nullable();
            $table->double('price')->nullable();
            $table->string('status')->nullable();
            $table->integer('idOrder')->unsigned();
            $table->foreign('idOrder')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('order_updates');
    }
}
