<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWashOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wash_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->nullable();
            $table->double('weight')->nullable();
            $table->string('free')->default('NO');
            $table->string('service');
            $table->double('cost');
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
        Schema::dropIfExists('wash_orders');
    }
}
