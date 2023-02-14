<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kel_labs', function (Blueprint $table) {
            $table->id();
            // $table->string('lantai');
            // $table->string('lab');
            // $table->string('no_lab');

            $table->string('no_lab');
            $table->string('kondisi');
            $table->unsignedBigInteger('ket_id');
            $table->foreign('ket_id')->references('id')->on('ket_labs')->onDelate('cascade');

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
        Schema::dropIfExists('kel_labs');
    }
}
