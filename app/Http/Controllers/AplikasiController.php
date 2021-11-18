<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    //Show all data
    public function all()
    {
        echo "## Dosen ## <br>";
        $dosens = Dosen::all();
        foreach ($dosens as $dosen) {
            echo "$dosen->nama | ";
        }
        echo "<hr>";
        echo "## Mahasiswa ## <br>";
        $mahasiswas = Mahasiswa::all();
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nama | $mahasiswa->jurusan <br>";
        }
        echo "<hr>";
        echo "## Beasiswa ## <br>";
        $beasiswas = Beasiswa::all();
        foreach ($beasiswas as $beasiswa) {
            echo "$beasiswa->nama | $beasiswa->jumlah_dana <br>";
        }
    }

    public function inputBeasiswa1()
    {
        $dosens = Dosen::find([3, 4, 5]);
        $beasiswas = Beasiswa::where('jumlah_dana', '>=', 10000000)->get();

        foreach ($dosens as  $dosen) {
            $dosen->beasiswas()->attach($beasiswas);
        }
        echo "Semua dosen sudah mendapat beasiswa";
    }
}
