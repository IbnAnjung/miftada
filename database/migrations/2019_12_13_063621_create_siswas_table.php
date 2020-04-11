<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nis', 15);
            $table->string('nama', 50);
            $table->bigInteger('kelas_id')->unsigned();
            $table->bigInteger('status_siswa_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('status_siswa_id')->references('id')->on('status_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
