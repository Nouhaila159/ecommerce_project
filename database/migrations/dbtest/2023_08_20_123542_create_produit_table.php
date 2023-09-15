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
        Schema::create('produit', function (Blueprint $table) {
            $table->increments('idP');
            $table->string('nomP', 255)->nullable();
            $table->string('descriptionP', 255)->nullable();
            $table->integer('idMarque')->unsigned();
            $table->integer('idCategorie')->unsigned();
            $table->integer('idMateriel')->unsigned();
            $table->decimal('prixP', 10, 2)->nullable();
            $table->integer('reductionP');
            $table->string('statutP', 500)->default('non publié');
            $table->timestamps();

            $table->foreign('idMarque')->references('idMarque')->on('marque')->onDelete('cascade');
            $table->foreign('idCategorie')->references('idCategorie')->on('categorie')->onDelete('cascade');
            $table->foreign('idMateriel')->references('idMateriel')->on('materiel')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
};
