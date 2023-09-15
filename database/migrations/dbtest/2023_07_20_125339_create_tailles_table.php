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
        Schema::create('tailles', function (Blueprint $table) {
            $table->increments('idT');
            $table->integer('idR')->unsigned()->nullable();
            $table->string('taille', 10)->nullable();
            $table->integer('quantiteT')->nullable();
            $table->timestamps();

            $table->foreign('idR')->references('idR')->on('reference')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tailles');
    }
};
