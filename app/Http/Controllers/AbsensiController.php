<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode', 1); // default 1 hari (hari ini)
        $tanggalAwal = Carbon::now()->subDays($periode - 1)->startOfDay(); // contoh: 5 hari terakhir
        $tanggalAkhir = Carbon::now()->endOfDay();

        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
        $kelasFilter = $request->get('kelas_filter');
        $search = $request->get('search');

        $absensiHariIni = Absensi::with('siswa')
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->whereHas('siswa') // biar data yang siswa-nya valid aja
            ->when($kelasFilter, function ($query) use ($kelasFilter) {
                $query->whereHas('siswa', function ($q) use ($kelasFilter) {
                    $q->where('kelas', $kelasFilter);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%")
                        ->orWhere('nisn', 'like', "%$search%");
                });
            })
            ->get();

        return view('pages.absensi.index', compact(
            'absensiHariIni',
            'kelasList',
            'periode',
            'kelasFilter',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'keterangan' => 'required|array',
        ]);

        $tanggal = now()->toDateString();

        foreach ($request->siswa_id as $siswaId) {
            $keterangan = $request->keterangan[$siswaId] ?? null;

            if ($keterangan) {
                Absensi::updateOrCreate(
                    ['siswa_id' => $siswaId, 'tanggal' => $tanggal],
                    ['keterangan' => $keterangan]
                );
            }
        }

        return redirect()->route('absensi.create')->with('success', 'Data kehadiran berhasil disimpan atau diperbarui.');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $tanggal = now()->toDateString();
        $kelasFilter = $request->get('kelas_filter');

        $query = Siswa::orderBy('nama');
        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        $siswa = $query->paginate(10)->appends(['kelas_filter' => $kelasFilter]);

        $absenHariIni = Absensi::whereDate('tanggal', $tanggal)->get()->keyBy('siswa_id');

        return view('pages.absensi.create', compact('siswa', 'absenHariIni', 'kelasFilter', 'kelasList'));
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
