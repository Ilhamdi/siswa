<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_payments', function (Blueprint $table) {
            
            
            $table->bigInteger('kelas_id')->unsigned()->index();
            $table->string('thnAjaran');
            $table->enum('status',['blmSetor','sdhSetor']);

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
        //
    }
}
