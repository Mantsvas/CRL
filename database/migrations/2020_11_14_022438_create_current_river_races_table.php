<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentRiverRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_river_races', function (Blueprint $table) {
            $table->id();
            $table->string('clan_tag');
            $table->json('clans');
            $table->integer('sectionIndex');
            $table->integer('fame')->nullable();
            $table->integer('repairPoints')->nullable();
            $table->string('finishTime')->nullable();
            $table->json('participants')->nullable();
            $table->integer('clanScore')->nullable();
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
        Schema::dropIfExists('current_river_races');
    }
}
