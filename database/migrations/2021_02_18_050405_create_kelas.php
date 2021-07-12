<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('namaKelas');
            $table->string('waliKelas');
            $table->string('deskripsi');
            $table->bigInteger('tingkat_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('tingkat_id')
                ->references('id')->on('tingkats')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
