<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule_models', function (Blueprint $table) {
            $table->id();
            $table->text('marque');
            $table->text('couleur');
            $table->text('capacite');
            $table->text('numerocarteGrise');
            $table->text('nomproprietaire');
            $table->text('nomconducteur');
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
        Schema::dropIfExists('vehicule_models');
    }
}
