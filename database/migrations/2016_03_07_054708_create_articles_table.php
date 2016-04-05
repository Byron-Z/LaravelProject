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
            $table->integer('article_id')-> unsigned();
            //Article content
            $table->text('content');
            //times of reading
            $table->integer('read_count')->default(0);
            //number of comments
            $table->integer('comment_count')->default(0);
            //Post time
            $table->dateTime('post_time');
            //Last change time
            $table->dateTime('last_change_time');
            //Delete flag, used for user rolling back
            $table->boolean('is_del')->default(false);
            /*Article privilege
            0: public
            1: only friends can see
            2: private
            */
            $table->tinyInteger('privilege')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('articles', function ($table) {
            $table->foreign('article_id')->references('id')->on('users');
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
