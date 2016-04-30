<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            //Article ID
            $table->integer('article_id')->unsigned();
            //Attachment title
            $table->string('title');
            //Attachment description
            $table->text('desc')->nullable();
            //Attachment size
            $table->integer('size');
            //Attachment type
            $table->string('extension');
            //Attachment uploading time
            //$table->dateTime('ctime');
            //Delete flag
            $table->boolean('is_del')->default(false);
            //Attachment save path in server
            $table->string('save_path');
            //Attachment user defined name
            $table->string('save_name')->nullable();
            //Attachment url
            $table->string('url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('attachments', function ($table) {
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
        Schema::drop('attachments');
    }
}
