<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    public function beasiswa()
    {
        return $this->morphToMany('App\Models\Beasiswa', 'beasiswaable')->withTimestamps();
    }
}
