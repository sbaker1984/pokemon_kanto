<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('pokedex_number');
            $table->string('name');
            $table->integer('height');
            $table->integer('weight');
            $table->JSON('abilities');
            $table->JSON('forms');
            $table->JSON('moves');
            $table->JSON('sprites');
            $table->JSON('stats');
            $table->JSON('types');
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
        Schema::dropIfExists('pokedex');
    }
}
