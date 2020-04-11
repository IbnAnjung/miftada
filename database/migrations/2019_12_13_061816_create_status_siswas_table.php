<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keterangan', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();

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
        Schema::dropIfExists('status_siswas');
    }
}
