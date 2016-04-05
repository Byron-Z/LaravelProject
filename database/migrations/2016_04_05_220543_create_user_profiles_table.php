<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('phone');
            $table->enum('sex', ['male', 'female']);
            $table->string('city');
            $table->string('country');
            $table->string('description');
            $table->dateTime('create_time');
            $table->dateTime('last_login_time');
            $table->dateTime('last_post_time');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('user_profiles', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_profiles');
    }
}
