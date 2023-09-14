<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrigineToClientTable extends Migration
{
    public function up()
    {
        Schema::table('client', function (Blueprint $table) {
            // Ajouter la colonne "origine"
            $table->string('origine')->nullable();
            
            // Supprimer la contrainte d'unicité sur la colonne "emailC"
            $table->dropUnique('client_emailC_unique');
        });
    }

    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
            // Pour annuler les modifications, vous pouvez supprimer la colonne "origine"
            $table->dropColumn('origine');

            // Rétablir la contrainte d'unicité sur la colonne "emailC"
            $table->unique('emailC');
        });
    }
}
