<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //Article ID
            $table->increments('id');
            //Article title
            $table->string('title');
            //Creator of this article
            $table->integer('article_uid')-> unsigned();
            //Article content
            $table->longText('content');
            //times of reading
            $table->integer('read_count')->default(0);
            //number of comments
            $table->integer('comment_count')->default(0);
            //Post time
            //$table->dateTime('post_time');
            //Last change time
            //$table->dateTime('last_change_time');
            //Delete flag, used for user rolling back
            $table->boolean('is_del')->default(false);
            //privileges
            $table->boolean('comment_permition')->default(true);
            $table->boolean('is_public')->default(true);
            $table->boolean('reproduct_permition')->default(true);
            /*Article type
            0: original
            1: reproduction
            2: translation
            */
            $table->tinyInteger('type')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('articles', function ($table) {
            $table->foreign('article_uid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
