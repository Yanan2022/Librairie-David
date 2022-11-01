<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraison_models', function (Blueprint $table) {
            $table->id();
            $table->text('nomclient');
            $table->text('prenomclient');
            $table->text('contactclient');
            $table->text('long');
            $table->text('lat');
            $table->integer('idcolis');
            $table->text('description_colis');
            $table->text('imagecolis');
            $table->foreignId('idEntreprise')->constrained('entreprise_models', 'id')->onDelete("CASCADE");
            $table->foreignId('idArticle')->constrained('tb_articles', 'id')->onDelete("CASCADE");
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
        Schema::dropIfExists('livraison_models');
    }
}
