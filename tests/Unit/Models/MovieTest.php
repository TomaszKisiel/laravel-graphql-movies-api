<?php

namespace Tests\Unit\Models;


use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Reviewer;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MovieTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function movie_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'movies', [
                'id', 'director_id', 'title', 'description', 'duration', 'released_at', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function movie_belongs_to_director() {
        $movie = Movie::factory()
            ->for( Director::factory() )
            ->create();

        $this->assertNotNull( $movie->director );
        $this->assertInstanceOf( Director::class, $movie->director );
    }

    /** @test */
    public function movie_belongs_to_many_actors_with_roles_pivot() {
        $movie = Movie::factory()
            ->for( Director::factory() )
            ->hasAttached(
                Actor::factory()->count( 5 ),
                Role::factory()->definition()
            )
            ->create();

        $this->assertCount( 5, $actors = $movie->actors );
        $this->assertInstanceOf( Actor::class, $actor = $actors[ 0 ] );

        $this->assertNotNull( $role = $actor->role );
        $this->assertNotNull( $role->title );
    }

    /** @test */
    public function movie_belongs_to_many_reviewers_with_rating_pivot() {
        $movie = Movie::factory()
            ->for( Director::factory() )
            ->hasAttached(
                Reviewer::factory()->count( 2 ),
                Rating::factory()->definition()
            )
            ->create();

        $this->assertCount( 2, $reviewers = $movie->reviewers );
        $this->assertInstanceOf( Reviewer::class, $reviewer = $reviewers[ 0 ] );

        $this->assertNotNull( $rating = $reviewer->rating );
        $this->assertNotNull( $rating->summary );
        $this->assertNotNull( $rating->artistic_value );
        $this->assertNotNull( $rating->sound_effects );
        $this->assertNotNull( $rating->technical_implementation );
        $this->assertNotNull( $rating->scenography );
        $this->assertNotNull( $rating->storytelling );
    }

    /** @test */
    public function movie_belongs_to_many_genres() {
        $movie = Movie::factory()
            ->has( Genre::factory()->count( 2 ) )
            ->create();

        $this->assertCount( 2, $genres = $movie->genres );
        $this->assertInstanceOf( Genre::class, $genres[ 0 ] );
    }

    /** @test */
    public function movie_has_many_ratings() {
        $movie = Movie::factory()
            ->has( Rating::factory()->for( Reviewer::factory() )->count( 3 ) )
            ->create();

        $this->assertCount( 3, $ratings = $movie->ratings );
        $this->assertInstanceOf( Rating::class, $ratings[ 0 ] );
    }

}
