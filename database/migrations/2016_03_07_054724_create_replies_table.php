<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('uid')->unsigned();;
            $table->integer('blogs_id')->unsigned();;
            $table->integer('blogs_uid')->unsigned();;
            $table->text('content');
            $table->dateTime('ctime');
            $table->integer('to_reply_id')->unsigned();;
            $table->integer('to_reply_uid')->unsigned();;
            $table->boolean('is_del');
            $table->timestamps();
        });

        Schema::table('replies', function ($table) {
            $table->foreign('blogs_uid')->references('id')->on('users');
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('to_reply_uid')->references('id')->on('users');
            $table->foreign('blogs_id')->references('id')->on('blogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('replies');
    }
}
