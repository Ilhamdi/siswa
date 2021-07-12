<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetoransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->string('desk');
            $table->integer('amount');
            $table->enum('status',['proses','terima']);

            $table->bigInteger('user_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::create('setoran_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('payment_id')->unsigned()->index();
            $table->bigInteger('setoran_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('payment_id')
                ->references('id')->on('payments')
                ->onDelete('cascade');
                
            $table->foreign('setoran_id')
                ->references('id')->on('setorans')
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
        Schema::dropIfExists('setorans');
    }
}
