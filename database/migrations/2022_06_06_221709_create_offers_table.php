<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description')->nullable();
            $table->string('localisation')->nullable();
            $table->string('categorie')->nullable();
            $table->double('prix')->nullable();
            $table->integer('nombre_des_chambres')->nullable();;
            $table->integer('nombre_des_salles_de_bain')->nullable();;
            $table->integer('nombre_des_cuisines')->nullable();;
            $table->string('type_doffre')->nullable();
            $table->string('wilaya')->nullable();
            $table->unsignedBigInteger('agence_id')->nullable();

//            $table->unsignedBigInteger('category_id')->nullable();
//            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
