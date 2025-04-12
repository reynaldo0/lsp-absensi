<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');

        $kelasFilter = $request->kelas_filter;
        $search = $request->search;
        $periode = $request->periode ?? 10;

        // Batas waktu periode
        $startDate = now()->subDays($periode);

        // Query data absensi dalam rentang periode
        $query = Absensi::with('siswa')
            ->whereDate('created_at', '>=', $startDate);

        // Filter kelas
        if ($kelasFilter) {
            $query->whereHas('siswa', function ($q) use ($kelasFilter) {
                $q->where('kelas', $kelasFilter);
            });
        }

        // Filter nama / nisn
        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%");
            });
        }

        $dataAbsensi = $query->latest()->get();

        // Semua perhitungan pakai filter periode
        $terlambat = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Terlambat')
            ->count();

        $hadir = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Hadir')
            ->count();

        $totalHariIni = Absensi::whereDate('created_at', '>=', $startDate)->count();

        return view('pages.guru.dashboard', compact(
            'dataAbsensi',
            'kelasList',
            'kelasFilter',
            'search',
            'periode',
            'terlambat',
            'hadir',
            'totalHariIni'
        ));
    }
}
