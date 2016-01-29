<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLottoGameNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotto_game_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lotto_games_id')->unsigned();
            $table->foreign('lotto_games_id')->references('id')->on('lotto_games');
            $table->integer('number');
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
        Schema::drop('lotto_game_numbers');
    }
}
