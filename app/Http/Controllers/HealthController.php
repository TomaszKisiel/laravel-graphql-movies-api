<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Reviewer;
use App\Models\Role;
use Illuminate\Http\Request;

class HealthController extends Controller {

    public function __invoke() {
        dd(
            Actor::with( [ 'movies', 'roles' ] )->limit( 5 )->get()->toArray(),
            Director::with( [ 'movies' ] )->limit( 5 )->get()->toArray(),
            Genre::with( [ 'movies' ] )->limit( 5 )->get()->toArray(),
            Movie::with( [ 'director', 'genres', 'actors', 'reviewers' ] )->limit( 5 )->get()->toArray(),
            Rating::with( [ 'movie', 'reviewer' ] )->limit( 5 )->get()->toArray(),
            Reviewer::with( [ 'movies', 'ratings' ] )->limit( 5 )->get()->toArray(),
            Role::with( [ 'movie', 'actor' ] )->limit( 5 )->get()->toArray(),
        );
    }
}
