<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    use HasFactory;

    protected $hidden = [ 'pivot' ];

    public function director() {
        return $this->belongsTo( Director::class );
    }

    public function actors() {
        return $this->belongsToMany( Actor::class, 'roles' )
            ->as( 'role' )
            ->withPivot([
                'title'
            ])
            ->using( Role::class )
            ->withTimestamps();
    }

    public function genres() {
        return $this->belongsToMany( Genre::class )->withTimestamps();
    }

    public function reviewers() {
        return $this->belongsToMany( Reviewer::class, 'ratings' )
            ->as( 'rating' )
            ->withPivot( [
                'summary',
                'artistic_value',
                'storytelling',
                'scenography',
                'sound_effects',
                'technical_implementation',
            ] )
            ->using( Rating::class )
            ->withTimestamps();
    }

    public function ratings() {
        return $this->hasMany( Rating::class );
    }
}
