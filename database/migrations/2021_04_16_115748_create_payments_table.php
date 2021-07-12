<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('paid');
            $table->integer('returnMoney');
            $table->string('desk');
            $table->date('month');

            $table->bigInteger('siswa_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('group_payments_id')->unsigned()->nullable()->index();
            $table->bigInteger('jnsbiayas_id')->unsigned()->nullable()->index();
            $table->bigInteger('kelas_id')->unsigned()->nullable()->index();

            $table->timestamps();

            $table->foreign('siswa_id')
                ->references('id')->on('siswas')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('group_payments_id')
                ->references('id')->on('group_payments')
                ->onDelete('cascade');
            $table->foreign('jnsbiayas_id')
                ->references('id')->on('jnsbiayas')
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
        Schema::dropIfExists('payments');
    }
}
