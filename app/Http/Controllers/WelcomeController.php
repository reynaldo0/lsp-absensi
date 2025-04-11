<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 1);
        $kelasFilter = $request->get('kelas_filter');
        $search = $request->get('search');

        $absensi = Absensi::with('siswa')
            ->whereDate('tanggal', '>=', now()->subDays($periode - 1))
            ->when($kelasFilter, fn($q) => $q->whereHas('siswa', fn($s) => $s->where('kelas', $kelasFilter)))
            ->when($search, fn($q) => $q->whereHas(
                'siswa',
                fn($s) =>
                $s->where('nama', 'like', "%$search%")->orWhere('nisn', 'like', "%$search%")
            ))
            ->get();

        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');

        return view('welcome', compact('absensi', 'kelasList', 'periode', 'kelasFilter', 'search'));
    }
}
