<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',5);
            $table->double('quantity');
            $table->integer('idInventory')->unsigned();
            $table->foreign('idInventory')
                  ->references('id')
                  ->on('inventories')
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
        Schema::dropIfExists('inventory_updates');
    }
}
