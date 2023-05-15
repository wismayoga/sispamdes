<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendataans', function (Blueprint $table) {
            $table->id();
            $table->string('id_petugas');
            $table->string('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->integer('nilai_meteran');
            $table->string('foto_meteran');
            $table->integer('total_harga');
            $table->string('status_pembayaran');
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
        Schema::dropIfExists('pendataans');
    }
};
