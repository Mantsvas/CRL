<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiverRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_races', function (Blueprint $table) {
            $table->id();
            $table->integer('seasonId')->nullable();
            $table->integer('sectionIndex')->nullable();
            $table->string('createdDate')->nullable();
            $table->json('standings')->nullable();
            $table->string('clan_tags')->nullable();
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
        Schema::dropIfExists('river_races');
    }
}
