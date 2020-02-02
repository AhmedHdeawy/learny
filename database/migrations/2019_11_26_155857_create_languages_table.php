<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->tinyIncrements('languages_id');
            $table->string('name')->unique();
            $table->string('locale', 2)->unique();
            $table->string('dir', 3)->comment("'ltr' => left to right, 'rtl' => right to left");
            $table->tinyInteger('status')->default(1)->comment('0 => stopped, 1 => active   ');
            $table->tinyInteger('position')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
