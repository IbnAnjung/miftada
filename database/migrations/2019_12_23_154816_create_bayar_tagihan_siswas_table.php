<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayarTagihanSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayar_tagihan_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tagihan_siswa_id')->unsigned();
            $table->date('tanggal');
            $table->integer('total')->default(0);
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bayar_tagihan_siswa');
    }
}
