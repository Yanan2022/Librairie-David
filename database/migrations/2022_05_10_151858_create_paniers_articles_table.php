<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaniersArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers_articles', function (Blueprint $table) {
            $table->foreignId('panier_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('article_id')->constrained('tb_articles')->onDelete('CASCADE');
            $table->integer('quantite')->unsigned()->default(1);
            $table->integer('prix_unitaire')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paniers_articles');
    }
}
