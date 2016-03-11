<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_blog', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->increments('id');
            $table->integer('blogs_id')->unsigned();;
            $table->integer('attachments_id')->unsigned();;
            $table->timestamps();
        });

        Schema::table('attachment_blog', function ($table) {
            $table->foreign('blogs_id')->references('id')->on('blogs');
            $table->foreign('attachments_id')->references('id')->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachment_blog');
    }
}
