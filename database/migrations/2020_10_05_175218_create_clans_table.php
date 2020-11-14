<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clans', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->integer('location_id')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->integer('badgeId')->nullable();
            $table->integer('clanScore')->nullable();
            $table->integer('clanWarTrophies')->nullable();
            $table->integer('requiredTrophies')->nullable();
            $table->integer('donationsPerWeek')->nullable();
            $table->integer('members')->nullable();
            $table->json('memberList')->nullable();
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
        Schema::dropIfExists('clans');
    }
}
