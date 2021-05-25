<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role extends Pivot {

    use HasFactory;

    protected $table = 'roles';

    public $incrementing = true;

    public $timestamps = true;

    public function actor() {
        return $this->belongsTo( Actor::class );
    }

    public function movie() {
        return $this->belongsTo( Movie::class );
    }

}
