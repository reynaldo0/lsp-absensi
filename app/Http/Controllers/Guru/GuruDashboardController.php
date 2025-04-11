<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
