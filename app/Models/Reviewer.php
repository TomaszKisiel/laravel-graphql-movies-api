<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model {

    use HasFactory;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'ratings')
            ->as('rating')
            ->withPivot([
                'summary',
                'artistic_value',
                'sound_effects',
                'storytelling',
                'technical_implementation',
                'scenography'
            ])
            ->using( Rating::class )->withTimestamps();
    }

    public function ratings() {
        return $this->hasMany( Rating::class );
    }
}
