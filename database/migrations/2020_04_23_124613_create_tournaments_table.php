<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('rules');
            $table->string('format');
            $table->integer('min_participiants')->default(0);
            $table->integer('max_participiants')->default(0);
            $table->integer('group_count')->default(1);
            $table->integer('playoff_count');
            $table->string('type');
            $table->string('stage');
            $table->date('start_date');
            $table->boolean('is_sticked')->default(false);
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
        Schema::dropIfExists('tournaments');
    }
}
