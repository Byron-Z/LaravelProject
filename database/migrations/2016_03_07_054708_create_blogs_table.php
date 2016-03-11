<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->integer('blogs_uid')-> unsigned();
            $table->text('content');
            $table->integer('read_count');
            $table->integer('reply_count');
            $table->dateTime('post_time');
            $table->dateTime('last_change_time');
            $table->boolean('is_del');
            $table->timestamps();
        });

        Schema::table('blogs', function ($table) {
            $table->foreign('blogs_uid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
