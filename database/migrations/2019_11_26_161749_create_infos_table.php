<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('infos_key', 191);
            $table->enum('infos_status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');
            $table->timestamps();
        });

        Schema::create('info_translations', function (Blueprint $table) {
            $table->increments('infos_trans_id');
            $table->unsignedInteger('info_id');
            $table->string('locale', 191)->index();
            $table->text('infos_desc');
            
            $table->foreign('info_id')->references('id')->on('infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
        Schema::dropIfExists('info_translations');
    }
}
