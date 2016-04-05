<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_article', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('attachment_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('attachment_article', function ($table) {
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('attachment_id')->references('id')->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachment_article');
    }
}
