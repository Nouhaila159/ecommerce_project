<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('idCommande');
            $table->integer('idC')->unsigned()->nullable();
            $table->date('date_commande')->nullable();
            $table->date('date_livraison');
            $table->string('adresse_livraison', 500);
            $table->unsignedDecimal('prix_livraison', 10, 0);
            $table->string('statut_livraison', 500)->default('non livrée');
            $table->string('statut_commande', 500)->default('non traitée');
            $table->string('validation')->default('en cours');// Ajout de l'attribut validation
            $table->string('origine')->default('siteWeb'); // Ajout de l'attribut origine avec valeur par défaut
            $table->timestamps();

            $table->foreign('idC')->references('idC')->on('client')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande');
    }
};
