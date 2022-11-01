<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->index();
            $table->string("nom", 160);
            $table->string("prenoms", 160);
            $table->string("telephone", 160);
            $table->string("email", 64)->nullable();
            $table->string("ville", 160);
            $table->string("commune", 160)->nullable();
            $table->string("quartier", 160)->nullable();
            $table->string("adresse", 250)->nullable();
            $table->json("coordonnees")->nullable();
            $table->string("etat", 64)->default("Soumis");
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
        Schema::dropIfExists('commandes');
    }
}
