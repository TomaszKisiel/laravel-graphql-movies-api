<?php

namespace Tests\Unit\Models;


use App\Models\Movie;
use App\Models\Rating;
use App\Models\Reviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RatingTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function rating_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'ratings', [
                'id', 'movie_id', 'reviewer_id', 'summary', 'artistic_value', 'storytelling', 'scenography', 'sound_effects', 'technical_implementation', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function rating_belongs_to_movie() {
        $rating = Rating::factory()
            ->for( Movie::factory() )
            ->for( Reviewer::factory() )
            ->create();

        $this->assertNotNull( $rating->movie );
        $this->assertInstanceOf( Movie::class, $rating->movie );
    }

    /** @test */
    public function rating_belongs_to_reviewer() {
        $rating = Rating::factory()
            ->for( Movie::factory() )
            ->for( Reviewer::factory() )
            ->create();

        $this->assertNotNull( $rating->reviewer );
        $this->assertInstanceOf( Reviewer::class, $rating->reviewer );
    }
}
