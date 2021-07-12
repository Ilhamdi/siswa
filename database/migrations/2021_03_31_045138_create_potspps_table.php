<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotsppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potspps', function (Blueprint $table) {
            $table->id();
            $table->string('desk');
            $table->integer('amount');
            $table->enum('status',['N','Y']);
            $table->bigInteger('siswa_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('siswa_id')
                ->references('id')->on('siswas')
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
        Schema::dropIfExists('potspps');
    }
}
