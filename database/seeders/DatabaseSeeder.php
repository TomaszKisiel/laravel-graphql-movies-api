<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Reviewer;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     * @return void
     */
    public function run() {
        if ( config( 'app.debug', true ) ) {
            $this->debugMode();
        } else {
            $this->productionMode();
        }
    }

    private function productionMode() {
        // TODO
    }

    private function debugMode() {
        Movie::factory()
            ->count( 20 )
            ->for( Director::factory()->state([]) )
            ->hasAttached(
                Actor::factory()->count( 5 ),
                Role::factory()->definition()
            )
            ->hasAttached(
                Reviewer::factory()->count( 5 ),
                Rating::factory()->definition()
            )
            ->has( Genre::factory()->count( 2 ) )
            ->create();
    }
}
