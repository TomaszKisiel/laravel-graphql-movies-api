<?php

namespace Tests\Unit\Models;


use App\Models\Actor;
use App\Models\Movie;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ActorTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function actor_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'actors', [
                'id', 'first_name', 'last_name', 'gender', 'eyes_color', 'hair_color', 'height', 'weight', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function actor_belongs_to_many_movies_with_roles_pivot() {
        $actor = Actor::factory()
            ->hasAttached(
                Movie::factory()->count(2),
                Role::factory()->definition()
            )->create();

        $this->assertCount( 2, $movies = $actor->movies );
        $this->assertInstanceOf( Movie::class, $movie = $movies[0] );

        $this->assertNotNull( $role = $movie->role );
        $this->assertNotNull( $role->title );
    }

    /** @test */
    public function actor_has_many_roles() {
        $actor = Actor::factory()
            ->hasAttached(
                Movie::factory()->count(2),
                Role::factory()->definition()
            )->create();

        $this->assertCount( 2, $roles = $actor->roles );
        $this->assertInstanceOf( Role::class, $roles[0] );
    }
}
