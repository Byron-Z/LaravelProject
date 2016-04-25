<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            //Creator of this article
            $table->integer('tag_uid')-> unsigned();
            //Tag name
            $table->string('name');
            //The amount of articles belong to this tag
            $table->integer('count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('tags', function ($table) {
            $table->foreign('tag_uid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
