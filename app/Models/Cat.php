<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['breed'];
    
    public $timestamps = false;

    public function breed() {
        return $this->belongsTo(Breed::class);
    }
}
