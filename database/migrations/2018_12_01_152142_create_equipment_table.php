<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('model');
            $table->string('serial')->nullable();
            $table->string('intentory_no')->nullable();
            $table->date('purchase_date')->nullable();
            $table->float('price')->nullable();
            $table->integer('given_to')->default(1);
            $table->string('accept_cert_no')->nullable();
            $table->integer('status')->default(1);
            $table->boolean('deleted')->default(0);
            //$table->foreign('given_to')->references('id')->on('employees');
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
        Schema::dropIfExists('equipment');
    }
}
