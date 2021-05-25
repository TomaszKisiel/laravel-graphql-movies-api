<?php

namespace Tests\Unit\Models;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DirectorTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function director_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'directors', [
                'id', 'first_name', 'last_name', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function director_has_many_movies() {
        $director = Director::factory()
            ->has( Movie::factory()->count( 2 ) )
            ->create();

        $this->assertCount( 2, $movies = $director->movies );
        $this->assertInstanceOf( Movie::class, $movies[0] );
    }
}
