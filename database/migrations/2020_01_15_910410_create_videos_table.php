<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoy_id')->unsigned();
            $table->string('videos_url');
            $table->enum('videos_status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');
            $table->timestamps();

            $table->foreign('categoy_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('video_translations', function (Blueprint $table) {
            
            $table->increments('videos_trans_id');
            
            $table->integer('video_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('videos_title');
            $table->text('videos_desc')->nullable();

            $table->unique(['video_id', 'locale']);

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
        Schema::dropIfExists('video_translations');
    }
}
