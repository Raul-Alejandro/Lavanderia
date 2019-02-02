<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDryCleanerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dry_cleaner_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(1);
            $table->integer('descount')->nullable();
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
        Schema::dropIfExists('dry_cleaner_orders');
    }
}
