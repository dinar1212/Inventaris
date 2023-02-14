<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPerbaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_perbaikans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_perbaikan');
            // $table->string('nama_barang');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('data_barangs')->onDelate('cascade');
            $table->string('kerusakan');
            // $table->string('penanganan');
            $table->string('kebutuhan_komputer');
            // $table->string('hasil');
            $table->string('ket');
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
        Schema::dropIfExists('data_perbaikans');
    }
}
