<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();

			$table->unsignedBigInteger('home_player_id')->unsigned();
			$table->foreign('home_player_id')->references('id')->on('players')->onDelete('cascade');

			$table->unsignedBigInteger('away_player_id')->unsigned();
			$table->foreign('away_player_id')->references('id')->on('players')->onDelete('cascade');

			$table->foreignId('division_id')->constrained()->onDelete('cascade');

			$table->integer('home_score')->nullable()->unsigned();
			$table->integer('away_score')->nullable()->unsigned();
			$table->string('outcome')->nullable();
			$table->boolean('has_result')->default(false);
			$table->integer('match_week')->unsigned();

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
		Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('matches');
		Schema::enableForeignKeyConstraints();
    }
}
