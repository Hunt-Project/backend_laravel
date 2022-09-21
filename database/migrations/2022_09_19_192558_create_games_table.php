<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function($table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->tinyInteger('type')->default(0);
            $table->timestamp('last_play')->nullable();
            $table->unique('name');
        });
        Schema::create('prizes', function(Blueprint $table) {
            $table->id();
            $table->string('title',20);
            $table->string('descr')->nullable();
            $table->decimal('value')->nullable();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            
            $table->unsignedBigInteger('prize_id');
            $table->foreign('prize_id')->references('id')->on('prizes');
            $table->timestamps();
        });
        Schema::create('tags', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games');
            $table->string('data',60);
        });
        Schema::create('partecipations', function(Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games');
            $table->integer('quote');
            $table->timestamps();
            $table->index(['users_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['prize_id']);
        });
        Schema::dropIfExists('games');
        
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['game_id']);
        });
        Schema::dropIfExists('tags');
        
        Schema::table('partecipations', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropForeign(['game_id']);
        });
        Schema::dropIfExists('partecipations');


        Schema::dropIfExists('prizes');

        Schema::table('users', function($table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropColumn('last_play');
            $table->dropColum('type');
        });
    }
};
