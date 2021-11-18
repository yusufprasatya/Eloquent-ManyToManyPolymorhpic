<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;
    public function dosens()
    {
        return $this->morphedByMany('\App\Models\Dosen', 'beaiswaable');
    }

    public function mahasiswas()
    {
        return $this->morphedByMany('\App\Models\Mahasiswa', 'beaiswaable');
    }
}
