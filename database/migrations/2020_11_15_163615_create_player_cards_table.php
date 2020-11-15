<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('card_id');
            $table->string('player_tag');
            $table->integer('count');
            $table->integer('level');
            $table->integer('starLevel')->nullable();
            $table->integer('maxLevel');
            $table->string('name');
            $table->integer('collected_total')->nullable();
            $table->integer('available_to_collect_total')->nullable();
            $table->integer('spent')->nullable();
            $table->integer('price_to_max')->nullable();
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
        Schema::dropIfExists('player_cards');
    }
}
