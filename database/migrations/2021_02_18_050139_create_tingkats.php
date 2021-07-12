<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('jenjang_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('jenjang_id')
                ->references('id')->on('jenjangs')
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
        Schema::dropIfExists('tingkats');
    }
}
