<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(1);
            $table->string('type',20);
            $table->integer('idWashService')->unsigned()->nullable();
            $table->foreign('idWashService')
                  ->references('id')
                  ->on('wash_services')
                  ->onDelete('cascade');
            $table->integer('idIronService')->unsigned()->nullable();
            $table->foreign('idIronService')
                  ->references('id')
                  ->on('iron_services')
                  ->onDelete('cascade');
            $table->integer('idDryService')->unsigned()->nullable();
            $table->foreign('idDryService')
                  ->references('id')
                  ->on('dry_cleaner_services')
                  ->onDelete('cascade');
            $table->integer('idPromotion')->unsigned();
            $table->foreign('idPromotion')
                  ->references('id')
                  ->on('promotions')
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
        Schema::dropIfExists('requirement_services');
    }
}
