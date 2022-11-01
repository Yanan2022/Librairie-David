<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_controllers', function (Blueprint $table) {
            $table->id();
            $table->text('CodeArticle');   
            $table->text('LibelleArticle'); 
            $table->text('PrixArticle'); 
            $table->text('EtatArticle'); 
            $table->text('ImageArticle');  
            $table->text('StatutArticle');
            $table->integer('IdTypeArticle')->index();  
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
        Schema::dropIfExists('article_controllers');
    }
}
