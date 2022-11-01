<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_articles', function (Blueprint $table) {
            $table->id();
            $table->text('CodeArticle');   
            $table->text('LibelleArticle'); 
            $table->text('PrixArticle'); 
            $table->text('ImageArticle');  
            $table->text('StatutArticle');
            $table->integer('IdTypeArticle'); 
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
        Schema::dropIfExists('tb_articles');
    }
}
