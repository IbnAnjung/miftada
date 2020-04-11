<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tagihan_id')->unsigned();
            $table->bigInteger('siswa_id')->unsigned();
            $table->integer('potongan')->default(0);
            $table->integer('bayar')->default(0);
            $table->timestamps();

            $table->foreign('tagihan_id')->references('id')->on('tagihan');
            $table->foreign('siswa_id')->references('id')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan_siswa');
    }
}
