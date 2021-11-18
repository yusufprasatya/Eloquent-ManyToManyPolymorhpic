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

        foreach ($dosens as $dosen) {
            $dosen->beasiswas()->attach($beasiswas);
        }
        echo "Semua dosen sudah mendapat beasiswa";
    }

    public function inputBeasiswa2()
    {
        $mahasiswas = Mahasiswa::where('jurusan', 'Teknik Informatika')->get();
        $beasiswas = Beasiswa::whereIn('nama', ['Beasiswa Telkom', 'Beasiswa LPDP', 'Beasiswa PPA'])->get();

        foreach ($mahasiswas as $mahasiswa) {
            $mahasiswa->beasiswas()->sync($beasiswas);
        }

        // Cari mahasiswa dengan id 4, lalu attach dengan beasiswa id 3
        Mahasiswa::find(4)->beasiswas()->attach(Beasiswa::find(3));

        echo "Mahasiswa sudah mendapat beasiswa";
    }

    public function tampilBeasiswa1()
    {
        $dosen = Dosen::where('nama', 'Betsy Moen M.T')->first();

        echo "## Daftar beasiswa $dosen->nama ##";
        echo "<hr>";
        foreach ($dosen->beasiswas as $beasiswa) {
            echo "Beasiswa $beasiswa->nama
                (Rp. " . number_format($beasiswa->jumlah_dana) . ")<br>";
        }
    }

    public function tampilBeasiswa2()
    {
        $mahasiswas = Mahasiswa::has('beasiswas')->get();

        foreach ($mahasiswas as $mahasiswa) {
            echo "## Daftar beasiswa $mahasiswa->nama ##";
            echo "<hr>";
            foreach ($mahasiswa->beasiswas as $beasiswa) {
                echo "Beasiswa $beasiswa->nama
                    (Rp. " . number_format($beasiswa->jumlah_dana) . ")<br>";
            }
            echo "<br>";
        }
    }

    public function tampilBeasiswa3()
    {
        $beasiswas = Beasiswa::has('mahasiswas')->get();

        foreach ($beasiswas as $beasiswa) {
            echo "Penerima $beasiswa->nama: ";
            foreach ($beasiswa->mahasiswas as $mahasiswa) {
                echo "$mahasiswa->nama, ";
            }
            echo "<hr>";
        }
    }

    public function tampilBeasiswa4()
    {
        $beasiswas = Beasiswa::doesntHave('dosens')->get();

        echo "## Daftar beasiswa yang tidak diambil dosen ##";
        echo "<hr>";
        foreach ($beasiswas as $beasiswa) {
            echo "$beasiswa->nama <br>";
        }
    }
}
