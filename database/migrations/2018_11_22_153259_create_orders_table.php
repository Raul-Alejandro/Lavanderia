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
            $table->integer('idCustomer')->unsigned();
            $table->foreign('idCustomer')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
            $table->string('delivery_date',20)->nullable();
            $table->string('delivered',20)->nullable();
            $table->integer('descount')->nullable();
            $table->string('status',10)->default('UNPAID');
            $table->double('total')->nullable();
            $table->double('total_wash')->nullable();
            $table->double('total_iron')->nullable();
            $table->double('total_dry')->nullable();
            $table->double('balance')->nullable();
            $table->string('payment_type',20)->default('EFECTIVO');
            $table->double('charge')->nullable();
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->integer('idSucursal')->unsigned();
            $table->foreign('idSucursal')
                  ->references('id')
                  ->on('sucursals')
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
        Schema::dropIfExists('orders');
    }
}
