<?php

namespace Tests\Unit\Models;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class GenreTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function genre_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'genres', [
                'id', 'title', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function genre_belongs_to_many_movies() {
        $genre = Genre::factory()
            ->hasAttached(Movie::factory()->count(2) )
            ->create();

        $this->assertCount( 2, $movies = $genre->movies );
        $this->assertInstanceOf( Movie::class, $movies[0] );
    }
}
