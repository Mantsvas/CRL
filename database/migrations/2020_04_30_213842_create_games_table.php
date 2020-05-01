<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('tournament_id');
            $table->string('team_type');
            $table->integer('home_team_id')->nullable();
            $table->integer('away_team_id')->nullable();
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->integer('winner_id')->nullable();
            $table->integer('round');
            $table->boolean('real_game')->default(true);
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
        Schema::dropIfExists('games');
    }
}
