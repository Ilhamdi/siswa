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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama');
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->integer('thnMasuk')->nullable();
            $table->string('bapak');
            $table->string('ibu');
            $table->string('hpOrtu',12);
            $table->string('agama');
            $table->text('alamat');
            $table->string('foto');
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('kelas_id')->unsigned()->index();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
            $table->foreign('kelas_id')
                ->references('id')->on('kelas')
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
        Schema::dropIfExists('siswas');
    }
}
