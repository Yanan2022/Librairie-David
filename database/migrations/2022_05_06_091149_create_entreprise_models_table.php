<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepriseModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise_models', function (Blueprint $table) {
            $table->id();
            $table->text('CodeEntreprise');
            $table->text('LibelleEntreprise');
            $table->text('ContactEntreprise');
            $table->text('AdresseEntreprise');
            $table->text('MailEntreprise');
            $table->text('SiteEntreprise');
            $table->string('long')->index();
            $table->string('lat')->index();
            $table->integer('Id_Catégorie');
            $table->integer('Id_pays');
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
        Schema::dropIfExists('entreprise_models');
    }
}
