<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot {

    use HasFactory;

    protected $table = 'ratings';

    public $incrementing = true;

    public $timestamps = true;

    public function movie() {
        return $this->belongsTo( Movie::class );
    }

    public function reviewer() {
        return $this->belongsTo( Reviewer::class );
    }

}
