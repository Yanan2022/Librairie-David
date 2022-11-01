<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypearticleIdToTypesArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('typearticle_models', function (Blueprint $table) {
            $table->foreignId('type_parent_id')->nullable()->constrained('typearticle_models')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('typearticle_models', function (Blueprint $table) {
            $table->dropForeign(['type_parent_id']);
            $table->dropColumn('type_parent_id');
        });
    }
}
