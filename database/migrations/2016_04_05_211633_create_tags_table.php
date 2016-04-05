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
            //Tag name
            $table->string('name')->unique();
            //The amount of articles belong to this tag
            $table->integer('count')->default(0);
            $table->softDeletes();
            $table->timestamps();
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
