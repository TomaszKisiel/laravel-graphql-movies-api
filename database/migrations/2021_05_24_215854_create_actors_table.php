<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
        Schema::create( 'actors', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'first_name' );
            $table->string( 'last_name' );
            $table->enum( 'gender', [ 'M', 'F' ] );
            $table->enum( 'eyes_color', [ 'blue', 'brown', 'green', 'black', 'gray', 'amber' ] );
            $table->enum( 'hair_color', [ 'white', 'silver', 'blonde', 'auburn', 'brunette', 'black', 'ginger' ] );
            $table->float( 'height', 5, 2 );
            $table->float( 'weight', 6, 2 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'actors' );
    }
}
