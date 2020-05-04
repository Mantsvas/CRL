<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_details', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->integer('home_player_1');
            $table->integer('home_player_2')->nullable();
            $table->integer('away_player_1');
            $table->integer('away_player_2')->nullable();
            $table->string('type');
            $table->integer('number');
            $table->integer('home_score');
            $table->integer('away_score');
            $table->integer('winner_id_1')->nullable();
            $table->integer('winner_id_2')->nullable();
            $table->enum('winner_side', ['home', 'away'])->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('game_details');
    }
}
