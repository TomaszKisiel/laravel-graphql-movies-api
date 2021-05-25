<?php

namespace Tests\Unit\Models;


use App\Models\Movie;
use App\Models\Rating;
use App\Models\Reviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReviewerTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function reviewer_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'reviewers', [
                'id', 'first_name', 'last_name', 'seniority', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function reviewer_belongs_to_many_movies_with_rating_pivot() {
        $reviewer = Reviewer::factory()
            ->hasAttached(
                Movie::factory()->count( 2 ),
                Rating::factory()->definition()
            )
            ->create();

        $this->assertCount( 2, $movies = $reviewer->movies );
        $this->assertInstanceOf( Movie::class, $movie = $movies[0] );

        $this->assertNotNull( $rating = $movie->rating );
        $this->assertNotNull( $rating->summary );
        $this->assertNotNull( $rating->scenography );
        $this->assertNotNull( $rating->storytelling );
        $this->assertNotNull( $rating->sound_effects );
        $this->assertNotNull( $rating->technical_implementation );
        $this->assertNotNull( $rating->artistic_value );
    }

    /** @test */
    public function reviewer_has_many_ratings() {
        $reviewer = Reviewer::factory()
            ->hasAttached(
                Movie::factory()->count( 2 ),
                Rating::factory()->definition()
            )
            ->create();

        $this->assertCount( 2, $ratings = $reviewer->ratings );
        $this->assertInstanceOf( Rating::class, $ratings[0] );
    }
}
