<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //Comment id
            $table->increments('id');
            //Comment user id
            $table->integer('uid')->unsigned();
            //Article ID
            $table->integer('article_id')->unsigned();
            //Comment content
            $table->text('content');
            //Comment time
            //$table->dateTime('ctime');
            //Comment id of the comment you reply
            $table->integer('to_reply_id')->unsigned();
            //Delete flag
            $table->boolean('is_del')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('comments', function ($table) {
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
