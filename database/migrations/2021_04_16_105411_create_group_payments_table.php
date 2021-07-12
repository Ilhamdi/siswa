<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_payments', function (Blueprint $table) {
            $table->id();
            $table->datetime('tglBayar');
            $table->integer('totalBayar');

            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('siswa_id')->unsigned()->nullable()->index();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('group_payments');
    }
}
