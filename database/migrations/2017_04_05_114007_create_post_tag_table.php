<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('article_id', false, true)->length(10);
            $table->integer('tag_id', false, true)->length(10);
        });

        Schema::table('article_tag', function(Blueprint $table)
        {
            $table->foreign('article_id')->references('id')->on('articles');
        });

        Schema::table('article_tag', function(Blueprint $table)
        {
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_tag');
    }
}
