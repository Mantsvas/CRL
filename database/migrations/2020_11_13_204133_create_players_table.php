<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('name');
            $table->string('clan_tag')->nullable();
            $table->integer('level')->nullable();
            $table->integer('trophies')->nullable();
            $table->integer('bestTrophies')->nullable();
            $table->integer('wins')->nullable();
            $table->integer('losses')->nullable();
            $table->integer('battlesCount')->nullable();
            $table->integer('threeCrownWins')->nullable();
            $table->integer('challengeCardsWon')->nullable();
            $table->integer('challengeMaxWins')->nullable();
            $table->integer('tournamentCardsWon')->nullable();
            $table->integer('tournamentBattleCount')->nullable();
            $table->string('role')->nullable();
            $table->integer('donations')->nullable();
            $table->integer('donationsReceived')->nullable();
            $table->integer('totalDonations')->nullable();
            $table->integer('warDayWins')->nullable();
            $table->integer('clanCardsCollected')->nullable();
            $table->integer('starPoints')->nullable();
            $table->json('clan')->nullable();
            $table->json('arena')->nullable();
            $table->json('leagueStatistics')->nullable();
            $table->json('achievements')->nullable();
            $table->json('currentDeck')->nullable();
            $table->json('currentFavouriteCard')->nullable();
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
        Schema::dropIfExists('players');
    }
}
