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
        Schema::create('nations', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nation_id');
            $table->foreign('nation_id')->references('id')->on('nations');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['nation_id']);
        });
        Schema::dropIfExists('cities');
        Schema::dropIfExists('nations');
    }
};
