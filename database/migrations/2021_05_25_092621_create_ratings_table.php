<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('reviewer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('summary');
            $table->integer('artistic_value')->default(0);
            $table->integer('storytelling')->default(0);
            $table->integer('scenography')->default(0);
            $table->integer('sound_effects')->default(0);
            $table->integer('technical_implementation')->default(0);
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
        Schema::dropIfExists('ratings');
    }
}
