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
			$table->softDeletes();
            $table->id();
			$table->string('psn');
			$table->string('name');

			$table->unsignedBigInteger('division_id')->nullable()->unsigned();
			$table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');

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
        Schema::dropIfExists('players');
		Schema::enableForeignKeyConstraints();
    }
}
