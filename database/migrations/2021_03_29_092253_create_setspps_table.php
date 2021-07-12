<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetsppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setspps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('amount')->unsigned();
            $table->string('thnAjaran');
            $table->string('desk');
            $table->enum('status',['N','Y']);
            $table->bigInteger('tingkat_id')->unsigned()->index();
            $table->timestamps();
            $table->bigInteger('jnsBiaya_id')->unsigned()->index();

            $table->foreign('jnsBiaya_id')
                ->references('id')->on('jnsBiayas')
                ->onDelete('cascade');
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
        Schema::dropIfExists('setspps');
    }
}
