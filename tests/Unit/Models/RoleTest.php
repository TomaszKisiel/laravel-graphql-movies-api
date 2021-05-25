<?php

namespace Tests\Unit\Models;


use App\Models\Actor;
use App\Models\Movie;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RoleTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function role_has_expected_properties() {
        $this->assertTrue(
            Schema::hasColumns( 'roles', [
                'id', 'movie_id', 'actor_id', 'title', 'created_at', 'updated_at'
            ] )
        );
    }

    /** @test */
    public function role_belongs_to_actor() {
        $role = Role::factory()
            ->for( Actor::factory() )
            ->for( Movie::factory() )
            ->create();

        $this->assertNotNull( $role->actor );
        $this->assertInstanceOf( Actor::class, $role->actor );
    }


    /** @test */
    public function role_belongs_to_movie() {
        $role = Role::factory()
            ->for( Actor::factory() )
            ->for( Movie::factory() )
            ->create();

        $this->assertNotNull( $role->movie );
        $this->assertInstanceOf( Movie::class, $role->movie );
    }
}
