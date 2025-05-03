<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        $startDate = now()->subDays($periode);

        $query = Absensi::with('siswa')
            ->whereDate('created_at', '>=', $startDate);

        if ($kelasFilter) {
            $query->whereHas('siswa', function ($q) use ($kelasFilter) {
                $q->where('kelas', $kelasFilter);
            });
        }

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%");
            });
        }

        $dataAbsensi = $query->latest()->get();

        $terlambat = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Terlambat')
            ->count();

        $hadir = Absensi::whereDate('created_at', '>=', $startDate)
            ->where('keterangan', 'Hadir')
            ->count();

        $totalHariIni = Absensi::whereDate('created_at', '>=', $startDate)->count();

        return view('pages.dashboard.admin', compact(
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
