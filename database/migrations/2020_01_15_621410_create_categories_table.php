<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('categories_status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');
            $table->timestamps();
        });

        Schema::create('category_translations', function (Blueprint $table) {
            
            $table->increments('categories_trans_id');
            
            $table->integer('category_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('categories_title');
            $table->text('categories_desc');

            $table->unique(['category_id', 'locale']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_translations');
    }
}
